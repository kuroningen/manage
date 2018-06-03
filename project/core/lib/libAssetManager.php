<?php namespace project\core\lib;

use Exception;
use MatthiasMullie\Minify\Minify as Minifier;
use MatthiasMullie\Minify\CSS as CSSMinifier;
use MatthiasMullie\Minify\JS as JSMinifier;

/**
 * Framework agnostic asset manager. Requires MatthiasMullie/Minify
 * MatthiasMullie/Minify Repository: https://github.com/matthiasmullie/minify
 * MatthiasMullie/Minify is being used by https://www.minifier.org
 *
 * For easy integration,
 *   - Ensure that your project uses composer.
 *
 * Include MatthiasMullie/Minify on your project.
 *   - composer require "MatthiasMullie/Minify"
 *
 * Test case not yet available. To be done later.
 *
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @since   2018.05.08
 * @version v0.0.1-rc
 */
class libAssetManager
{
    /**
     * CSS Extension
     */
    private const EXT_CSS = 'css';

    /**
     * Javascript Extension
     */
    private const EXT_JS = 'js';

    /**
     * Array of external CSS links
     * @var array
     */
    private $aExternalCss = [];

    /**
     * Array of external Javascript links
     * @var array
     */
    private $aExternalJs = [];

    /**
     * Array of Internal CSS located in resources/assets/css folder
     * @var array
     */
    private $aInternalCss = [];

    /**
     * Array of Internal JS located in resources/assets/js folder
     * @var array
     */
    private $aInternalJs = [];

    /**
     * CSS Path
     * @var string
     */
    protected $sCssPath = DS . 'assets' . DS . 'css';

    /**
     * JS Path
     * @var string
     */
    protected $sJsPath = DS . 'assets' . DS . 'js';

    /**
     * Public JS/CSS Path
     * @var array
     */
    protected $aPublicPath = [
        'js'  => PUBLIC_PATH . DS . 'assets' . DS. 'js',
        'css' => PUBLIC_PATH . DS . 'assets' . DS . 'css'
    ];

    /**
     * Public JS/CSS Url
     * @var array
     */
    protected $aPublicUrl = [
        'js' => 'assets/js',
        'css' => 'assets/css'
    ];

    /**
     * Uses CSS from project/resources/css
     * The blade file must export html.blade.php
     * @param string $sCssAsset
     * @throws Exception
     */
    public function useCss(string $sCssAsset)
    {
        $this->useAsset(RESOURCES_PATH . $this->sCssPath . DS . $sCssAsset . '.' . self::EXT_CSS, $this->aInternalCss);
    }

    /**
     * Uses JS from project/resources/js
     * The blade file must export html.blade.php
     * @param string $sJsAsset
     * @throws Exception
     */
    public function useJs(string $sJsAsset)
    {
        $this->useAsset(RESOURCES_PATH . $this->sJsPath . DS . $sJsAsset . '.' . self::EXT_JS, $this->aInternalJs);
    }

    /**
     * Uses asset
     * @param string $sAsset
     * @param array  $aAsset
     * @throws Exception
     */
    private function useAsset(string $sAsset, array &$aAsset)
    {
        if (file_exists($sAsset) === false) {
            throw new Exception('Asset cannot be found: ' . $sAsset);
        }
        $sContent = file_get_contents($sAsset);
        $sHash = hash('sha256', $sContent);
        $aAsset[$sHash] = $sAsset;
    }

    /**
     * Uses external CSS
     * @param $sCssAssetUrl
     */
    public function useExternalCss($sCssAssetUrl)
    {
        $this->aExternalCss[] = $sCssAssetUrl;
    }

    /**
     * Uses external Javascript
     * @param $sJsAssetUrl
     */
    public function useExternalJs($sJsAssetUrl)
    {
        $this->aExternalJs[] = $sJsAssetUrl;
    }

    /**
     * Returns external css link
     * @return array
     */
    public function getExternalCssLink(): array
    {
        return $this->aExternalCss;
    }

    /**
     * Returns external js link
     * @return array
     */
    public function getExternalJsLink(): array
    {
        return $this->aExternalJs;
    }

    /**
     * Compiles internal CSS assets
     * @return string
     */
    public function compileCssAsset(): string
    {
        return $this->compileAsset(new CSSMinifier(), $this->aInternalCss, self::EXT_CSS);
    }

    /**
     * Compiles internal JS assets
     * @return string
     */
    public function compileJsAsset(): string
    {
        return $this->compileAsset(new JSMinifier(), $this->aInternalJs, self::EXT_JS);
    }

    /**
     * Compiles CSS or JS assets
     * @param Minifier $oMinifier   Minifier to use (CSS or JS)
     * @param array    $aAssets     Assets to compile
     * @param string   $sExtension  File Extension
     * @return string
     */
    private function compileAsset(Minifier $oMinifier, array $aAssets, string $sExtension): string
    {
        $sCompiledFileName = $this->getCompiledFileName($aAssets, $sExtension);
        foreach ($aAssets as $sAsset) {
            $oMinifier->add($sAsset);
        }
        $oMinifier->minify($this->getCompiledFileDir($sCompiledFileName));
        return $this->getCompiledFileUrl($sCompiledFileName);
    }

    /**
     * Calculates the filename of the given assets
     * @param array  $aAssets
     * @param string $sExtension
     * @return string
     */
    private function getCompiledFileName(array $aAssets, string $sExtension): string
    {
        return hash('sha256', implode('', array_keys($aAssets))) . '.' . $sExtension;
    }

    /**
     * Returns the full path of the compiled asset
     * @param string $sCompiledFileName
     * @return string
     */
    private function getCompiledFileDir(string $sCompiledFileName): string
    {
        return $this->aPublicPath[pathinfo($sCompiledFileName, PATHINFO_EXTENSION)] . DS . $sCompiledFileName;
    }

    /**
     * Returns the URL of compiled asset
     * @param string $sCompiledFileName
     * @return string
     */
    private function getCompiledFileUrl(string $sCompiledFileName): string
    {
        return url($this->aPublicUrl[pathinfo($sCompiledFileName, PATHINFO_EXTENSION)] . DS . $sCompiledFileName);
    }
}
