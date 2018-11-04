<?php namespace project\db\knLedger;

use Illuminate\Database\Eloquent\Model as dbModel;

/**
 * tblWallet
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\db\knLedger
 * @since   2018.11.03
 */
class tblWallet extends dbModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql-kn-ledger';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_wallet';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
