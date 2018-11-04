<?php namespace project\db\toolLogin;

use Illuminate\Database\Eloquent\Model as dbModel;

/**
 * tblLogin
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\db\toolLogin
 * @since   2018.11.03
 */
class tblLogin extends dbModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql-tool-login';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_login';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
