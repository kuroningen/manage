<?php namespace project\mvc\model\toolLogin;

use project\db\toolLogin\tblLogin;
use project\mvc\model\modelCommon;

/**
 * Class that represents tblLogin
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\model\toolLogin
 * @since   2018.11.03
 */
class modelLogin extends modelCommon
{
    /**
     * Name of table
     *
     * @var string
     */
    protected $sTable = tblLogin::class;

    /**
     * Structure of Table
     *
     * @var array
     */
    protected $aStructure = [
        'id'        => 0,
        'username'  => '',
        'password'  => '',
        'rights'    => 0
    ];
}
