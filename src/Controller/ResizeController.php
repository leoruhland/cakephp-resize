<?php

namespace Resize\Controller;

use Resize\Controller\AppController;
use Gregwar\Image\Image;

class ResizeController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        if($this->Auth) {
            $this->Auth->allow('resize');
        }
    }

    public function resize($size="", $filename = "")
    {
        $this->autoRender = false;
        $dimensions = explode('x', $size);
        if(!isset($dimensions[0])){
            $dimensions[0] = 150;
        }
        if(!isset($dimensions[1])){
            $dimensions[1] = $dimensions[0];
        }
        $width = (int)$dimensions[0];
        $height = (int)$dimensions[1];
        if($width > 0 && $height > 0){
            $cacheFilename = 'resize' . DS . $size . DS . $filename;
            if(!file_exists($cacheFilename)){
                $cacheFilename = Image::open($filename)
                ->zoomCrop($width, $height, 'transparent', 'center', 'center')
                ->save($cacheFilename);
            }
            $this->redirect('/'.$cacheFilename);
        }
    }
}
