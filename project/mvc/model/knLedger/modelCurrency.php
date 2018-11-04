<?php namespace project\mvc\model\knLedger;

use project\db\knLedger\tblCurrency;
use project\mvc\model\modelCommon;

/**
 * Class that represents tblCurrency
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\mvc\model\knLedger
 * @since   2018.11.03
 */
class modelCurrency extends modelCommon
{
    /**
     * Name of table
     *
     * @var string
     */
    protected $sTable = tblCurrency::class;

    /**
     * Structure of Table
     *
     * @var array
     */
    protected $aStructure = [
        'id'    => 0,
        'info'  => ''
    ];
}
