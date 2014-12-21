<?php

use \Cake\Core\Configure;
use \CakeHaml\Exception\CakeHamlDefineValueDuplicateException as DefineValueDuplicateException;

if (defined('HAML_CONFIG')) {
    throw new DefineValueDuplicateException('Define value HAML_CONFIG already defined.');
}
define('HAML_CONFIG', 'default_haml_config');

if (defined('HAML_OUTPUT_PATH')) {
    throw new DefineValueDuplicateException('Define value HAML_OUTPUT_PATH already defined.');
}
define('HAML_OUTPUT_PATH', 'haml_output_path');

Configure::write(HAML_CONFIG, [
    'format' => 'html5',
    'enable_escaper' => true,
    'escape_html' => true,
    'escape_attrs' => true,
    'cdata' => true,
    'autoclose' => ['meta', 'img', 'link', 'br', 'hr', 'input', 'area', 'param', 'col', 'base'],
    'charset' => 'UTF-8',
    'enable_dynamic_attrs' => true,
]);

Configure::write(HAML_OUTPUT_PATH, \CACHE .'views' . DS . 'haml' . DS);
