<?php namespace project\core\bl\toolLogin;
use project\core\exception\toolLogin\UserNotExistException;
use project\core\lib\libSha256;
use project\mvc\model\toolLogin\modelLogin;

/**
 * Responsible for checking whether user has certain access right to certain module.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\bl\toolLogin
 * @since   2018.11.04
 */
class blRights
{
    const ACTIVATED = 1;
    const ACCOUNTING = 2;
    const ACCOUNTING_ADMIN = 4;
    const USER_AND_RIGHTS_MANAGEMENT = 8;

    const ERR_INVALIDUSERNAME = 'Username (%s) does not exist.';

    /**
     * The matching user.
     *
     * @var array
     */
    private $aUser;

    /**
     * @var modelLogin
     */
    private $oLogin;

    /**
     * blRights constructor.
     *
     * @param modelLogin $oLogin
     */
    public function __construct(modelLogin $oLogin)
    {
        $this->oLogin = $oLogin;
    }

    /**
     * Sets the user to be checked whether currently logged-in user has a certain rights.
     *
     * @param $sUsername
     * @return blRights
     * @throws UserNotExistException
     */
    public function user($sUsername): blRights
    {
        $sUsername  = libSha256::newInstance()
            ->sha256($sUsername)->sha256()->sha256()->sha256()->sha256()->sha256()
            ->getHash();
        $this->aUser = $this->oLogin->read(['username' => $sUsername]);
        if (count($this->aUser) === 0) {
            throw new UserNotExistException(sprintf(self::ERR_INVALIDUSERNAME, $sUsername));
        }
        return $this;
    }

    /**
     * Checks whether currently logged-in user has a certain rights.
     *
     * @param int $iRight
     * @return bool
     */
    public function hasRight(int $iRight): bool
    {
        return (((int)$this->aUser[0]['rights'] & $iRight) === $iRight);
    }
}
