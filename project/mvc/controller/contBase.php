<?php namespace project\mvc\controller;

use Illuminate\Foundation\Bus\DispatchesJobs as dispatchesJobs;
use Illuminate\Routing\Controller as baseController;
use Illuminate\Foundation\Validation\ValidatesRequests as validatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests as authorizesRequests;

/**
 * contBase
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.06.03
 */
class contBase extends baseController
{
    use authorizesRequests, dispatchesJobs, validatesRequests;
}