<?php namespace project\mvc\model\knLedger;

use project\db\knLedger\tblWallet;
use project\mvc\model\modelCommon;

/**
 * Class that represents tblWallet
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\model\knLedger
 * @since   2018.11.03
 */
class modelWallet extends modelCommon
{
    /**
     * Name of table
     *
     * @var string
     */
    protected $sTable = tblWallet::class;

    /**
     * Structure of Table
     *
     * @var array
     */
    protected $aStructure = [
        'id'           => 0,
        'currency_id'  => 0,
        'info'         => ''
    ];
}
