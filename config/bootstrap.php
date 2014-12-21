<?php

namespace CakeHaml\Config;

use \Cake\Core\Configure;

class ConfigureKey
{
    const HAML_CONFIG = 'default_haml_config';

    const HAML_OUTPUT_PATH = 'haml_output_path';
}

Configure::write(ConfigureKey::HAML_CONFIG, [
    'format' => 'html5',
    'enable_escaper' => true,
    'escape_html' => true,
    'escape_attrs' => true,
    'cdata' => true,
    'autoclose' => ['meta', 'img', 'link', 'br', 'hr', 'input', 'area', 'param', 'col', 'base'],
    'charset' => 'UTF-8',
    'enable_dynamic_attrs' => true,
]);

Configure::write(ConfigureKey::HAML_OUTPUT_PATH, \CACHE .'views' . DS . 'haml' . DS);
