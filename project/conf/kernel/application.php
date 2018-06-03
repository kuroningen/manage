<?php namespace project\conf\kernel;

use Illuminate\Foundation\Application as laravelApplication;

/**
 * Class application
 * @package project\conf\kernel
 * @author  黒人間 <kuroningen@ano.nymous.xyz>
 * @since   2018.05.02
 */
class application extends laravelApplication
{
    /**
     * The custom environment path defined by the developer.
     *
     * @var string
     */
    protected $environmentPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = '')
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . ($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
