<?php

namespace Resize\Controller;

use Cake\Core\Configure;
use Gregwar\Image\Image;
use Resize\Controller\AppController;
use Cake\Core\Exception\Exception;

class ResizeController extends AppController
{
    public $config;

    public function initialize()
    {
        parent::initialize();

        if($this->Auth) {
            $this->Auth->allow('resize');
        }

        $this->config = Configure::read('Resize.settings');
    }

    public function resize($fullSize="", $filename = "")
    {
        $this->autoRender = false;
        $cacheFilename = 'resize' . DS . $fullSize . DS . $filename;

        $size = $this->_checkSize($fullSize);

        if($this->_checkFile($cacheFilename)){
            $cacheFilename = Image::open($filename)
            ->zoomCrop($size[0], $size[1], 'transparent', 'center', 'center')
            ->save($cacheFilename);
            $this->redirect('/'.$cacheFilename);
        }
    }

    private function _checkSize($fullSize){
        $size = explode('x', $fullSize);
        $size[0] = (int) $size[0];
        $size[1] = (int) $size[1];
        $isValidSize = true;
        if(!isset($size[0]) || !isset($size[1])){
            $isValidSize = false;
        } else if ( $size[0] <= 0 || $size[1] <= 0 ){
            $isValidSize = false;
        } else if(!$this->_checkAllowedSizes($size)){
            $isValidSize = false;
        }

        if(!$isValidSize){
            $size = $this->config['defaultSize'];
        }
        $size[0] = ($size[0] > $this->config['maxSize'][0]) ? $this->config['maxSize'][0] : $size[0];
        $size[1] = ($size[1] > $this->config['maxSize'][1]) ? $this->config['maxSize'][1] : $size[1];
        return $size;
    }

    private function _checkAllowedSizes($size){
        if( !is_array($this->config['sizes']) || empty($this->config['sizes']) ){
            return true;
        } else {
            foreach($this->config['sizes'] as $curSize) {
                if( empty( array_diff($size, $curSize) ) ) {
                    return true;
                }
            }
            return false;
        }
    }

    private function _checkFile($cacheFilename){
        if(!file_exists($cacheFilename)){
            return true;
        }
    }
}
