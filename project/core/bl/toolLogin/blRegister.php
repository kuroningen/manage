<?php namespace project\core\bl\toolLogin;

use project\core\exception\toolLogin\Register\EmptyUsernameException;
use project\core\exception\toolLogin\Register\InvalidPasswordException;
use project\core\exception\toolLogin\Register\UserAlreadyExistException;
use project\core\lib\libSha256;
use project\mvc\model\toolLogin\modelLogin;

/**
 * blRegister
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\bl\toolLogin
 * @since   2018.11.03
 */
class blRegister
{
    /**
     * (ERROR MESSAGE) Empty username error.
     */
    private const ERR_USERNAMEEMPTY = 'Username cannot be empty.';

    /**
     * (ERROR MESSAGE) Existing username error.
     */
    private const ERR_USERALREADYEXIST = 'Username already exists.';

    /**
     * (ERROR MESSAGE) Invalid password error.
     */
    private const ERR_INVALIDPASSWORD = 'Password should at least 8 characters.';

    /**
     * @var modelLogin
     */
    private $oLogin;

    /**
     * Username to register.
     *
     * @var string
     */
    private $sUsername;

    /**
     * Password of username to be registered.
     *
     * @var string
     */
    private $sPassword;

    /**
     * blRegister constructor.
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
     * @return blRegister
     * @throws EmptyUsernameException
     * @throws UserAlreadyExistException
     */
    public function username(?string $sUsername): blRegister
    {
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
     * @return blRegister
     * @throws InvalidPasswordException
     */
    public function password(?string $sPassword): blRegister
    {
        $this->sPassword = $sPassword;
        return $this
            ->isPasswordValid()
            ->hashPassword()
            ->saltThePassword();
    }

    /**
     * Registers a user.
     */
    public function doRegister(): blRegister
    {
        $this->oLogin->create([
            'username' => $this->sUsername,
            'password' => $this->sPassword
        ]);
        return $this;
    }

    /**
     * Ensures that username is not empty, otherwise, it will throw an exception.
     *
     * @return blRegister
     * @throws EmptyUsernameException
     */
    private function ensureThatUsernameIsNotEmpty(): blRegister
    {
        if (strlen($this->sUsername) === 0) {
            throw new EmptyUsernameException(self::ERR_USERNAMEEMPTY);
        }
        return $this;
    }

    /**
     * Hashes username numerous times.
     *
     * @return blRegister
     */
    private function hashUsername(): blRegister
    {
        $this->sUsername = libSha256::newInstance()
            ->sha256($this->sUsername)->sha256()->sha256()->sha256()->sha256()->sha256()
            ->getHash();
        return $this;
    }

    /**
     * Checks username whether it exists in the database or not.
     *
     * @return blRegister
     * @throws UserAlreadyExistException
     */
    private function checkIfUsernameExistInDatabase(): blRegister
    {
        $aMatchedCredential = $this->oLogin->read(['username' => $this->sUsername]);
        if (count($aMatchedCredential) > 0) {
            throw new UserAlreadyExistException(self::ERR_USERALREADYEXIST);
        }
        return $this;
    }

    /**
     * Checks whether password is valid.
     *   - Invalid if password is less than 8 characters.
     *
     * @return blRegister
     * @throws InvalidPasswordException
     */
    private function isPasswordValid(): blRegister
    {
        if (strlen($this->sPassword) < 8) {
            throw new InvalidPasswordException(self::ERR_INVALIDPASSWORD);
        }
        return $this;
    }

    /**
     * Hashes password numerous times.
     *
     * @return blRegister
     */
    private function hashPassword(): blRegister
    {
        $this->sPassword = libSha256::newInstance()
            ->sha256($this->sPassword)->sha256()->sha256()->sha256()->sha256()->sha256()
            ->getHash();
        return $this;
    }

    /**
     * Salts the password.
     *
     * @return blRegister
     */
    private function saltThePassword(): blRegister
    {
        $this->sPassword = password_hash($this->sPassword, PASSWORD_DEFAULT);
        return $this;
    }
}
