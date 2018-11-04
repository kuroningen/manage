<?php namespace project\mvc\controller\toolLogin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use project\core\bl\toolLogin\blLogin;
use project\core\exception\toolLogin\Login\LoginException;
use project\mvc\controller\contBase;

/**
 * Controller responsible for authenticating the admin.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.06.03
 */
class contLogin extends contBase
{
    /**
     * @var Request
     */
    private $oRequest;

    /**
     * @var blLogin
     */
    private $oLogin;

    /**
     * contLogin constructor.
     *
     * @param Request $oRequest
     * @param blLogin $oLogin
     */
    public function __construct(Request $oRequest, blLogin $oLogin)
    {
        $this->oRequest = $oRequest;
        $this->oLogin = $oLogin;
    }

    /**
     * Shows the login page.
     *
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
     * @return Redirect|View
     */
    public function doLogin()
    {
        $this->oRequest->flash();
        $sRedirect = session('redirect');
        try {
            session($this->oLogin
                ->username($this->oRequest->input('username'))
                ->password($this->oRequest->input('password'))
                ->throwErrorIfCredentialsAreNotValid()
                ->throwErrorIfUserIsNotActivated()
                ->getSession());
            session()->forget('redirect');
            return redirect($sRedirect ?? '/');
        } catch (LoginException $e) {
            return $this->showLoginPage(['sError' => $e->getMessage()]);
        }
    }

    /**
     * Logs user out.
     *
     * @return RedirectResponse
     */
    public function doLogout()
    {
        session()->forget('user');
        return redirect('login');
    }
}
