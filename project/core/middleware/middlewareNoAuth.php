<?php namespace project\core\middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use project\core\bl\toolLogin\blLogin;
use project\core\exception\toolLogin\Login\LoginException;

/**
 * Middleware that checks whether user is not logged in.
 *   - If not logged in, it'll pass the user to access its protected page.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\middleware
 * @since   2018.11.04
 */
class middlewareNoAuth
{
    /**
     * @var Request
     */
    private $oRequest;

    /**
     * @var Closure
     */
    private $next;

    /**
     * Response
     * @var Request|Redirect
     */
    private $oResponse;

    /**
     * @var blLogin
     */
    private $oLogin;

    /**
     * middlewareNoAuth constructor.
     *
     * @param blLogin $oLogin
     */
    public function __construct(blLogin $oLogin)
    {
        $this->oLogin = $oLogin;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $this
            ->setHandleParams($request, $next)
            ->checkIfUserIsNotLoggedIn()
            ->getResponse();
    }

    /**
     * Sets the handle parameters.
     *
     * @param Request $oRequest
     * @param Closure $oNext
     * @return middlewareNoAuth
     */
    private function setHandleParams(Request $oRequest, Closure $oNext): middlewareNoAuth
    {
        $this->oRequest = $oRequest;
        $this->next = $oNext;
        return $this;
    }

    /**
     * Check if user is not logged in.
     *
     * @return middlewareNoAuth
     */
    private function checkIfUserIsNotLoggedIn(): middlewareNoAuth
    {
        $this->oResponse = ($this->isLoggedIn() === true) ? redirect('/') : ($this->next)($this->oRequest);
        return $this;
    }

    /**
     * Returns true if user is logged in.
     *
     * @return bool
     */
    private function isLoggedIn()
    {
        try {
            $this->oLogin->username(session('user'));
            return true;
        } catch (LoginException $e) {
            return false;
        }
    }

    /**
     * Returns response.
     *
     * @return Request|Redirect
     */
    private function getResponse()
    {
        return $this->oResponse;
    }
}
