<?php namespace project\mvc\controller;

/**
 * Class contSampleController
 * @package project\mvc\controller
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @since   2018.04.19
 */
class contSampleController extends contBase
{
    /**
     * Shows sample page
     */
    public function showSamplePage()
    {
        return 'This is a sample page.';
    }
}