<?php namespace project\db\knLedger;

use Illuminate\Database\Eloquent\Model as dbModel;

/**
 * tblLedger
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\db\knLedger
 * @since   2018.11.03
 */
class tblLedger extends dbModel
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
    protected $table = 'tbl_ledger';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
