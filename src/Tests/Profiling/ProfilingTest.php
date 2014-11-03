<?php

namespace Yitznewton\Maybe\Tests\Profiling;

use Yitznewton\Maybe\Maybe;

/**
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 */
class ProfilingTest extends \PHPUnit_Framework_TestCase
{
    const VALUE = 'hello';
    const ALTERNATIVE = 'goodbye';
    const ITERATIONS = 10000;

    public static function setUpBeforeClass()
    {
        require_once XHPROF_UTILS_DIR . 'xhprof_lib.php';
        require_once XHPROF_UTILS_DIR . 'xhprof_runs.php';

        // make sure we autoload outside of the profiling tests
        new Maybe(null);
    }

    /**
     * @test
     */
    public function profilingValueWithoutMaybe()
    {
        $value = self::VALUE;
        $alternative = self::ALTERNATIVE;

        $this->xhprofStart();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            if (is_null($value)) {
                $jim = $alternative;
            } else {
                $jim = substr($value, 0, 1);
            }
        }

        $this->xhprofEnd(__METHOD__);
    }

    /**
     * @test
     */
    public function profilingValueWithMaybe()
    {
        $value = self::VALUE;
        $alternative = self::ALTERNATIVE;

        $command = function ($input) {
            return substr($input, 0, 1);
        };

        $this->xhprofStart();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            $jim = (new Maybe($value))->select($command)->valueOr($alternative);
        }

        $this->xhprofEnd(__METHOD__);
    }

    private function xhprofStart()
    {
        return xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
    }

    private function xhprofEnd($runName)
    {
        $xhprofData = xhprof_disable();
        $runs = new \XHProfRuns_Default();
        $runs->save_run($xhprofData, $runName);
    }
}
