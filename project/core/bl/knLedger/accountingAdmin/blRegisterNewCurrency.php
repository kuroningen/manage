<?php namespace project\core\bl\knLedger\accountingAdmin;

use project\core\exception\knLedger\accountingAdmin\registerNewCurrency\EmptyCurrencyNameException;
use project\core\exception\knLedger\accountingAdmin\registerNewCurrency\EmptyCurrencySymbolException;
use project\mvc\model\knLedger\modelCurrency;

/**
 * Responsible for registration of new currency
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @package project\core\bl\knLedger\accountingAdmin
 * @since   2018.11.04
 */
class blRegisterNewCurrency
{
    /**
     * @var modelCurrency
     */
    private $oCurrency;

    /**
     * Information about the currency.
     *
     * @var array
     */
    private $aInfo;

    /**
     * Stringified information about the currency.
     *    - To be converted as json.
     *    - To be also encrypted.
     *
     * @var string
     */
    private $sInfo;

    /**
     * blRegisterNewCurrency constructor.
     *
     * @param modelCurrency $oCurrency
     */
    public function __construct(modelCurrency $oCurrency)
    {
        $this->oCurrency = $oCurrency;
    }

    /// DRAFT
    ///     - id
    ///     - info
    ///
    /// INFO:
    ///     {
    ///         "name": "",
    ///         "symbol": ""
    ///     }

    /**
     * Sets the name of currency.
     *
     * @param string $sCurrencyName
     * @return blRegisterNewCurrency
     * @throws EmptyCurrencyNameException
     */
    public function name(string $sCurrencyName): blRegisterNewCurrency
    {
        $this->aInfo['name'] = $sCurrencyName;
        if (strlen($sCurrencyName) === 0) {
            throw new EmptyCurrencyNameException('Name of currency cannot be empty.');
        }
        return $this;
    }

    /**
     * Sets the name of symbol.
     *
     * @param string $sCurrencySymbol
     * @return blRegisterNewCurrency
     * @throws EmptyCurrencySymbolException
     */
    public function symbol(string $sCurrencySymbol): blRegisterNewCurrency
    {
        $this->aInfo['symbol'] = $sCurrencySymbol;
        if (strlen($sCurrencySymbol) === 0) {
            throw new EmptyCurrencySymbolException('Name of currency cannot be empty.');
        }
        return $this;
    }

    /**
     * Registers the currency.
     *
     * @return blRegisterNewCurrency
     */
    public function register(): blRegisterNewCurrency
    {
        return $this
            ->stringify()
            ->encrypt();
    }

    /**
     * Stringifies array of information ($aInfo) into json string.
     *
     * @return blRegisterNewCurrency
     */
    private function stringify(): blRegisterNewCurrency
    {
        $this->sInfo = json_encode($this->aInfo);
        return $this;
    }

    /**
     * Encrypts the information.
     *
     * @return blRegisterNewCurrency
     */
    private function encrypt(): blRegisterNewCurrency
    {
        /// Question is how...?
        return $this;
    }
}
