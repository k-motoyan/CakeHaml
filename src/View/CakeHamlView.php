<?php

namespace CakeHaml\View;

use Cake\Core\Configure;
use Cake\View\Exception\MissingTemplateException;
use Cake\View\Exception\MissingLayoutException;
use Cake\Filesystem\File;
use App\View\AppView;
use \CakeHaml\CakeHaml;

class CakeHamlView extends AppView
{
    private static $_haml_ext = '.haml';

    private $_default_ext;

    public function initialize()
    {
        parent::initialize();
        $this->_default_ext = $this->_ext;
        $this->_ext = self::$_haml_ext;

        $haml_output_path = Configure::read(HAML_OUTPUT_PATH);
        if (!file_exists($haml_output_path) || !is_dir($haml_output_path)) {
            mkdir($haml_output_path);
        }
    }

    protected function _getViewFileName($name = null)
    {
        try {
            $file_name = parent::_getViewFileName($name);
        } catch (MissingTemplateException $e) {
            $this->_ext = $this->_default_ext;
            $file_name = parent::_getViewFileName($name);
            $this->_ext = self::$_haml_ext;
        }
        return $file_name;
    }

    protected function _getLayoutFileName($name = null)
    {
        try {
            $file_name = parent::_getLayoutFileName($name);
        } catch (MissingLayoutException $e) {
            $this->_ext = $this->_default_ext;
            $file_name = parent::_getLayoutFileName($name);
            $this->_ext = self::$_haml_ext;
        }
        return $file_name;
    }

    protected function _evaluate($view_file, $data_for_view)
    {
        $file = new File($view_file);
        if ($file->ext() !== ltrim(self::$_haml_ext, '.')) {
            return parent::_evaluate($view_file, $data_for_view);
        }

        $cache_file = new File($this->_getCacheFilePath($file));
        if ($this->_doWriteCacheFile($file, $cache_file)) {
            $cake_haml = new CakeHaml($file, Configure::read(HAML_CONFIG));
            file_put_contents($cache_file->pwd(), $cake_haml->getContent());
        }

        extract($data_for_view);
        ob_start();

        include $cache_file->pwd();

        return ob_get_clean();
    }

    private function _getCacheFilePath(File $file)
    {
        return Configure::read(HAML_OUTPUT_PATH) . 'template_' . $file->md5() . '.ctp';
    }

    private function _doWriteCacheFile(File $file, File $cache_file)
    {
        if (!file_exists($cache_file->pwd())) {
            return true;
        }
        if ( (int)$file->lastChange() > (int)$cache_file->lastChange() ) {
            return true;
        }
        return false;
    }
}