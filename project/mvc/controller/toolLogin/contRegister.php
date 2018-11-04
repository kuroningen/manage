<?php namespace project\mvc\controller\toolLogin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use project\core\bl\toolLogin\blRegister;
use project\core\exception\toolLogin\Register\RegisterException;
use project\mvc\controller\contBase;

/**
 * contRegister
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller\toolLogin
 * @since   2018.11.03
 */
class contRegister extends contBase
{
    /**
     * (MSG SUCCESS) Registration successfull message.
     */
    const MSG_REGISTRATIONSUCCESS = 'User has been registered successfully. User still needs to be activated by an admin.';

    /**
     * @var Request
     */
    private $oRequest;

    /**
     * @var blRegister
     */
    private $oRegister;

    /**
     * contRegister constructor.
     * @param Request $oRequest
     * @param blRegister $oRegister
     */
    public function __construct(Request $oRequest, blRegister $oRegister)
    {
        $this->oRequest = $oRequest;
        $this->oRegister = $oRegister;
    }

    /**
     * Registers a user, and returns exception if something failed.
     *
     * @return JsonResponse
     */
    public function doRegister()
    {
        $aResponse = ['success' => self::MSG_REGISTRATIONSUCCESS];
        try {
            $this->oRegister
                ->username($this->oRequest->input('username'))
                ->password($this->oRequest->input('password'))
                ->doRegister();
        } catch (RegisterException $e) {
            $aResponse = ['error' => $e->getMessage()];
        } finally {
            return response()->json($aResponse);
        }
    }
}
