<?php namespace project\mvc\controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Controller responsible for authenticating the admin
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.06.03
 */
class contLogin extends contBase
{

    /**
     * @var Response|Redirect|View
     */
    private $oResponse;

    /**
     * Flag whether login is good or bad
     * @var bool
     */
    private $bIsLoginGood = false;

    /**
     * @var Request
     */
    private $oRequest;

    /**
     * contLogin constructor.
     * @param Request $oRequest
     */
    public function __construct(Request $oRequest)
    {
        $this->oRequest = $oRequest;
    }

    /**
     * Shows the login page
     * @param array $aParams
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage($aParams = [])
    {
        return view('template.admin-lte.login.template')->with(array_merge([
            'sError' => ''
        ], $aParams));
    }

    /**
     * @return Response|Redirect|View
     */
    public function doLogin()
    {
        return $this
            ->generatePassIfNoPassword()
            ->checkLogin()
            ->getResponse();
    }

    /**
     * Logs user out
     * @return RedirectResponse|Redirector
     */
    public function doLogout()
    {
        session()->forget('user');
        return redirect('login');
    }

    /**
     * Returns response
     * @return Response|Redirect|View
     */
    private function getResponse()
    {
        return $this->oResponse;
    }

    /**
     * Checks validity of login
     * @return contLogin
     */
    private function checkLogin() : contLogin
    {
        if ($this->oResponse !== null) {
            return $this;
        }
        $this->oResponse = $this->showLoginPage([
            'sError' => 'Invalid username and/or password.'
        ]);
        if ($this->isLoginValid()) {
            session(['user' => $this->oRequest->get('username')]);
            $this->oResponse = redirect('admin');
        }
        return $this;
    }

    /**
     * Checks whether login is valid or not
     * @return bool
     */
    private function isLoginValid()
    {
        return strtoupper(env('MASTER_LOGIN')) === strtoupper($this->oRequest->get('username')) &&
            password_verify($this->oRequest->get('password'), env('MASTER_PASSWORD'));
    }

    /**
     * Generates password hash if password is not yet set
     * @return contLogin
     */
    private function generatePassIfNoPassword() : contLogin
    {
        if (env('MASTER_PASSWORD') === '') {
            $this->oResponse = response('MASTER_PASSWORD=' . password_hash($this->oRequest->get('password'), PASSWORD_DEFAULT));
        }
        return $this;
    }
}
