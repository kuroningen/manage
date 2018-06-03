<?php namespace project\core\middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * middlewareAuth
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
     * Handle an incoming request.
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $this
            ->setRequest($request)
            ->setNext($next)
            ->checkIfUserIsLoggedIn()
            ->getResponse();
    }

    /**
     * Returns response
     * @return Request|Redirect
     */
    private function getResponse()
    {
        return $this->oResponse;
    }

    /**
     * Sets request
     * @param Request $oRequest
     * @return middlewareAuth
     */
    private function setRequest(Request $oRequest): middlewareAuth
    {
        $this->oRequest = $oRequest;
        return $this;
    }

    /**
     * Sets next closure
     * @param Closure $oNext
     * @return middlewareAuth
     */
    private function setNext(Closure $oNext): middlewareAuth
    {
        $this->next = $oNext;
        return $this;
    }

    /**
     * Check if user is logged in
     * @return middlewareAuth
     */
    private function checkIfUserIsLoggedIn(): middlewareAuth
    {
        $this->oResponse = ($this->next)($this->oRequest);
        if ($this->isLoggedIn() === false) {
            $this->oResponse = redirect('login');
        }
        return $this;
    }

    private function isLoggedIn()
    {
        $sMasterLogin = env('MASTER_LOGIN');
        return session('user') === $sMasterLogin && $sMasterLogin !== '';
    }
}
