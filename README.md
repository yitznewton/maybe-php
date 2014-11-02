# A Maybe monad implementation for PHP

This project was wholly inspired by
[a blog post](http://linepogl.wordpress.com/2011/03/15/a-php-maybe-monad-2/)
by @linepogl.

## Motivation

Dealing with `null` values (and, in PHP, falsy values) is tedious and prone
to developer error (viz the null pointer exception, trying to dereference
a `null`).

In my exposure to Haskell, I learned about the awesomeness of pattern matching,
whereby you can get the compiler to force yourself to handle all possibilities.
This combines with a tool called `Maybe` to require specific handling for
"null" and "non-null" possibilities.

PHP does not offer pattern matching, but we can still use classes to wrap raw
values, and require us to handle null conditions, without repeated explicit
null checking and conditionals.

## Example

Before:

```php
$blogpost = $repository->get($blogpostId);
echo $blogpost->teaser();  // oh noe! what if $blogpost is null?! :boom:
```

After:

```php
$blogpost = new \Yitznewton\Maybe\Maybe($repository->get($blogpostId));
echo $blogpost->select(function ($bp) { $bp->teaser(); })->valueOr('No blogpost found');
```