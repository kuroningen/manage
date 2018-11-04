<?php namespace project\core\middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as baseVerifier;

/**
 * middlewareCsrf
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\middleware
 * @since   2018.11.04
 */
class middlewareCsrf extends baseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/register'
    ];
}