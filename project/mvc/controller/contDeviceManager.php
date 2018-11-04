<?php namespace project\mvc\controller;

use Illuminate\Http\Request;

/**
 * contDeviceManager
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.06.03
 */
class contDeviceManager extends contBase
{
    /**
     * @var Request
     */
    private $oRequest;

    /**
     * contDeviceManager constructor.
     * @param Request $oRequest
     */
    public function __construct(Request $oRequest)
    {
        $this->oRequest = $oRequest;
    }

    /**
     * Show all devices (connected or not connected)
     */
    public function showDevices()
    {
        return view('devices');
    }
}
