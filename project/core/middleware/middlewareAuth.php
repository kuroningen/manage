<?php namespace project\core\middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use project\core\bl\toolLogin\blLogin;
use project\core\exception\toolLogin\Login\LoginException;

/**
 * Middleware that checks whether user is logged in.
 *   - If logged in, it'll pass the user to access its protected page.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\middleware
 * @since   2018.06.03
 */
class middlewareAuth
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
     * middlewareAuth constructor.
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
            ->setUriToSession()
            ->checkIfUserIsLoggedIn()
            ->getResponse();
    }

    /**
     * Sets the handle parameters.
     *
     * @param Request $oRequest
     * @param Closure $oNext
     * @return middlewareAuth
     */
    private function setHandleParams(Request $oRequest, Closure $oNext): middlewareAuth
    {
        $this->oRequest = $oRequest;
        $this->next = $oNext;
        return $this;
    }

    /**
     * Sets URI to session
     *
     * @return middlewareAuth
     */
    private function setUriToSession(): middlewareAuth
    {
        session(['redirect' => $this->oRequest->getRequestUri()]);
        return $this;
    }

    /**
     * Check if user is logged in.
     *
     * @return middlewareAuth
     */
    private function checkIfUserIsLoggedIn(): middlewareAuth
    {
        $this->oResponse = ($this->isLoggedIn() === false) ? redirect('login') : ($this->next)($this->oRequest);
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
