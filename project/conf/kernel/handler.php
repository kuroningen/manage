<?php namespace project\conf\kernel;

use Exception as exception;
use Illuminate\Foundation\Exceptions\Handler as exceptionHandler;
use Illuminate\Http\Request as request;
use Symfony\Component\HttpFoundation\Response as response;

/**
 * Class exceptionHandler
 * @package project\conf\kernel
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @since   2018.04.19
 */
class handler extends exceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  exception $exception
     * @return void
     * @throws exception
     */
    public function report(exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  request  $request
     * @param  exception  $exception
     * @return response
     */
    public function render($request, exception $exception)
    {
        return parent::render($request, $exception);
    }
}