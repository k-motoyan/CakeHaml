<?php

namespace CakeHaml;

use \MtHaml\Environment;
use Cake\Filesystem\File;

class CakeHaml
{
    private static $_parser;

    private $_view_file;

    public function __construct(File $view_file, $config = [])
    {
        $this->_view_file = $view_file;
        if (!self::$_parser) {
            self::$_parser = new Environment('php', $config);
        }
    }

    public function getContent()
    {
        $file_path = $this->_view_file->pwd();
        return self::$_parser->compileString(file_get_contents($file_path), $file_path);
    }
}