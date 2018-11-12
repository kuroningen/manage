<?php namespace project\mvc\controller;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use project\core\lib\libAssetManager as asset;

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
     * @throws Exception
     */
    public function showLandingPage()
    {
        asset::i()->useCss('fader');
        asset::i()->useJs('toggle-sidebar');
        asset::i()->useJs('fader');
        return view('landing');
    }
}
