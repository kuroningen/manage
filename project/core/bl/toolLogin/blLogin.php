<?php namespace project\core\bl\toolLogin;

use project\core\exception\toolLogin\Login\EmptyUsernameException;
use project\core\exception\toolLogin\Login\InvalidLoginException;
use project\core\lib\libSha256;
use project\mvc\model\toolLogin\modelLogin;

/**
 * Class responsible for checking the validity of user credential
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\bl\toolLogin
 * @since   2018.11.03
 */
class blLogin
{
    /**
     * (ERROR MESSAGE) Invalid login error.
     */
    private const ERR_INVALIDLOGIN = 'Invalid username and/or password.';

    /**
     * (ERROR MESSAGE) Empty username error.
     */
    private const ERR_USERNAMEEMPTY = 'Username cannot be empty.';

    /**
     * (RIGHTS VALUE) Rights value that indicates that user is activated.
     */
    private const IS_ACTIVATED = 1;

    /**
     * Plaintext username
     *
     * @var string
     */
    private $sPlainUsername;

    /**
     * Username to login
     *
     * @var string
     */
    private $sUsername;

    /**
     * Password to login
     *
     * @var string
     */
    private $sPassword;

    /**
     * Matched credential of user
     *
     * @var array
     */
    private $aMatchedCredential;

    /**
     * @var modelLogin
     */
    private $oLogin;

    /**
     * blLogin constructor.
     *
     * @param modelLogin $oLogin
     */
    public function __construct(modelLogin $oLogin)
    {
        $this->oLogin = $oLogin;
    }

    /**
     * Sets the username to be logged in
     *
     * @param string $sUsername
     * @return blLogin
     * @throws EmptyUsernameException
     * @throws InvalidLoginException
     */
    public function username(?string $sUsername): blLogin
    {
        $this->sPlainUsername = $sUsername;
        $this->sUsername = $sUsername;
        return $this
            ->ensureThatUsernameIsNotEmpty()
            ->hashUsername()
            ->checkIfUsernameExistInDatabase();
    }

    /**
     * Sets the password that is to be logged in
     *
     * @param string $sPassword
     * @return blLogin
     * @throws InvalidLoginException
     */
    public function password(?string $sPassword): blLogin
    {
        $this->sPassword = $sPassword;
        return $this
            ->isPasswordValid()
            ->hashPassword();
    }

    /**
     * Checks whether credentials are valid
     *
     * @return blLogin
     * @throws InvalidLoginException
     */
    public function throwErrorIfCredentialsAreNotValid(): blLogin
    {
        if (password_verify($this->sPassword, $this->aMatchedCredential[0]['password']) === false) {
            throw new InvalidLoginException(self::ERR_INVALIDLOGIN);
        }
        return $this;
    }

    /**
     * Throws an error if user is not yet activated.
     *
     * @return blLogin
     * @throws InvalidLoginException
     */
    public function throwErrorIfUserIsNotActivated(): blLogin
    {
        $bIsNotActivated = ((int)$this->aMatchedCredential[0]['rights'] & self::IS_ACTIVATED) === 0;
        if ($bIsNotActivated) {
            throw new InvalidLoginException(self::ERR_INVALIDLOGIN);
        }
        return $this;
    }

    /**
     * Returns login session (if user login is valid)
     *
     * @return array
     */
    public function getSession(): array
    {
        return ['user' => $this->sPlainUsername
        ];
    }

    /**
     * Ensures that username is not empty, otherwise, it will throw an exception.
     *
     * @return blLogin
     * @throws EmptyUsernameException
     */
    private function ensureThatUsernameIsNotEmpty(): blLogin
    {
        if (strlen($this->sUsername) === 0) {
            throw new EmptyUsernameException(self::ERR_USERNAMEEMPTY);
        }
        return $this;
    }

    /**
     * Hashes username numerous times.
     *
     * @return blLogin
     */
    private function hashUsername(): blLogin
    {
        $this->sUsername = libSha256::newInstance()
            ->sha256($this->sUsername)->sha256()->sha256()->sha256()->sha256()->sha256()
            ->getHash();
        return $this;
    }

    /**
     * Checks username whether it exists in the database or not.
     *
     * @return blLogin
     * @throws InvalidLoginException
     */
    private function checkIfUsernameExistInDatabase(): blLogin
    {
        $this->aMatchedCredential = $this->oLogin->read(['username' => $this->sUsername]);
        if (count($this->aMatchedCredential) === 0) {
            throw new InvalidLoginException(self::ERR_INVALIDLOGIN);
        }
        return $this;
    }

    /**
     * Checks whether password is valid
     *   - Invalid if password is less than 8 characters.
     *
     * @return blLogin
     * @throws InvalidLoginException
     */
    private function isPasswordValid(): blLogin
    {
        if (strlen($this->sPassword) < 8) {
            throw new InvalidLoginException(self::ERR_INVALIDLOGIN);
        }
        return $this;
    }

    /**
     * Hashes password numerous times.
     *
     * @return blLogin
     */
    private function hashPassword(): blLogin
    {
        $this->sPassword = libSha256::newInstance()
            ->sha256($this->sPassword)->sha256()->sha256()->sha256()->sha256()->sha256()
            ->getHash();
        return $this;
    }
}
