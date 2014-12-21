<?php

namespace CakeHaml;

use \MtHaml\Environment;
use Cake\Filesystem\File;

/**
 * Haml template compiler.
 */
class CakeHaml
{
    /** @var \MtHaml\Environment Hamle template parser object. */
    private static $_parser;

    /** @var \Cake\Filesystem\File Request view file object. */
    private $_view_file;

    /**
     * @param File $view_file
     * @param array $config
     */
    public function __construct(File $view_file, $config = [])
    {
        $this->_view_file = $view_file;
        if (!self::$_parser) {
            self::$_parser = new Environment('php', $config);
        }
    }

    /**
     * Get a compiled template content.
     *
     * @return string
     */
    public function getContent()
    {
        $file_path = $this->_view_file->pwd();
        return self::$_parser->compileString(file_get_contents($file_path), $file_path);
    }
}