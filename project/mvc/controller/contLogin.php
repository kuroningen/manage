<?php namespace project\mvc\controller;

/**
 * Controller responsible for authenticating the admin
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.06.03
 */
class contLogin extends contBase
{
    public function showLoginPage()
    {
        return view('template.admin-lte.login.login');
    }
}
