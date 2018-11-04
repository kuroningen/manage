<?php namespace project\mvc\controller\toolLogin;

use project\core\bl\toolLogin\blKeyGenerator;
use project\mvc\controller\contBase;

/**
 * Controller responsible for generating random 256-bit string (in base64)
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\controller
 * @since   2018.11.04
 */
class contKeyGenerator extends contBase
{
    /**
     * @var blKeyGenerator
     */
    private $oKeyGenerator;

    /**
     * contKeyGenerator constructor.
     *
     * @param blKeyGenerator $oKeyGenerator
     */
    public function __construct(blKeyGenerator $oKeyGenerator)
    {
        $this->oKeyGenerator = $oKeyGenerator;
    }

    /**
     * Generates random key (in 32 bits, base64-encoded).
     */
    public function generateKey()
    {
        return response()->json(['key' => base64_encode(random_bytes(32))]);
    }

    /**
     * Encrypts generated key with supplied password.
     */
    public function encryptKeyWithPassword()
    {

    }
}
