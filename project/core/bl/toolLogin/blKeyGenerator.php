<?php namespace project\core\bl\toolLogin;

/**
 * Responsible for generation of new key, and encrypting key using user's password.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\bl\toolLogin
 * @since   2018.11.04
 */
class blKeyGenerator
{
    /**
     * Encryption key that is to be encrypted.
     *
     * @var string
     */
    private $sEncryptionKey;

    /**
     * The encrypted key, encrypted by supplied user password.
     *
     * @var string
     */
    private $sEncryptedKey;

    /**
     * Random HMAC key.
     *   - From $_ENV['HMAC_KEY'].
     *
     * @var string
     */
    private $sHmacKey;

    /**
     * PBKDF2 Key.
     *   - SHA512, 1000x iteration, 32 characters.
     *
     * @var string
     */
    private $sPbkdf2Key;

    /**
     * Sets the HMAC Key.
     *   - Get this from $_ENV['HMAC_KEY'].
     *
     * @param string $sHmacKey
     * @return blKeyGenerator
     */
    public function setHmacKey(string $sHmacKey): blKeyGenerator
    {
        $this->sHmacKey = $sHmacKey;
        return $this;
    }

    /**
     * Generates a random 256-bit key.
     *
     * @return blKeyGenerator
     */
    public function generateKey(): blKeyGenerator
    {
        $this->sEncryptionKey = random_bytes(32);
        return $this;
    }

    /**
     * Sets the key, to be encrypted.
     *
     * @param string $sEncryptionKey
     * @return blKeyGenerator
     */
    public function setKey(string $sEncryptionKey): blKeyGenerator
    {
        $this->sEncryptedKey = $sEncryptionKey;
        return $this;
    }

    /**
     * Encrypts generated key.
     *
     * @param $sPassword
     * @return blKeyGenerator
     */
    public function encryptGeneratedKey($sPassword): blKeyGenerator
    {
        return $this
            ->deriveKeyForKeyEncryption($sPassword)
            ->doEncryptKey();
    }

    /**
     * Returns the encrypted key, in base64 format.
     *
     * @return string
     */
    public function getEncryptedKey(): string
    {
        return base64_encode($this->sEncryptedKey);
    }

    /**
     * Returns the plain-text encryption key.
     *
     * @return string
     */
    public function getEncryptionKey(): string
    {
        return $this->sEncryptionKey;
    }

    /**
     * Creates a 32-byte key from user's password, that will serve as encryption key
     * for encrypting the encryption key.
     *
     * @param string $sPassword
     * @return blKeyGenerator
     */
    private function deriveKeyForKeyEncryption(string $sPassword): blKeyGenerator
    {
        $this->sPbkdf2Key = hash_pbkdf2('sha512', $sPassword, $this->sHmacKey, 1000, '32', true);
        return $this;
    }

    /**
     * Encrypts the encryption key, with the 32-byte key from user's password.
     *
     * @return blKeyGenerator
     */
    private function doEncryptKey(): blKeyGenerator
    {
        $this->sEncryptedKey = openssl_encrypt($this->sEncryptionKey, 'aes-256', $this->sPbkdf2Key);
        return $this;
    }
}
