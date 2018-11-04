<?php namespace project\mvc\model\knLedger;

use project\db\knLedger\tblLedger;
use project\mvc\model\modelCommon;

/**
 * Class that represents tblLedger
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\model\knLedger
 * @since   2018.11.03
 */
class modelLedger extends modelCommon
{
    /**
     * Name of table
     *
     * @var string
     */
    protected $sTable = tblLedger::class;

    /**
     * Structure of Table
     *
     * @var array
     */
    protected $aStructure = [
        'id'         => 0,
        'wallet_id'  => 0,
        'tx'         => ''
    ];
}
