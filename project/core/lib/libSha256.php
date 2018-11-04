<?php namespace project\core\lib;

/**
 * libSha256
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\lib
 * @since   2018.11.03
 */
class libSha256
{
    /**
     * Sha256 hash of something
     *
     * @var string
     */
    private $sHash;

    /**
     * Returns the new instance of this class
     *
     * @return libSha256
     */
    public static function newInstance()
    {
        return new libSha256();
    }

    /**
     * Performs sha256 digestion
     *
     * @param string $sMessage
     * @return libSha256
     */
    public function sha256(string $sMessage = null): libSha256
    {
        if ($sMessage === null) {
            $this->sHash = hash_hmac('sha256',$this->sHash, $_SERVER['HMAC_KEY'], true);
            return $this;
        }
        $this->sHash = hash_hmac('sha256',$sMessage, $_SERVER['HMAC_KEY'], true);
        return $this;
    }

    /**
     * Returns the resultant hash
     *
     * @return string
     */
    public function getHash(): string
    {
        return bin2hex($this->sHash);
    }
}
