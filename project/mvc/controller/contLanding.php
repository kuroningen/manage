<?php namespace project\mvc\controller;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * contLanding.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.11.04
 */
class contLanding extends contBase
{

    /**
     * Shows the landing page.
     *
     * @return Factory|View
     */
    public function showLandingPage()
    {
        return view('landing');
    }
}
