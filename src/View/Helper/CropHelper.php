<?php

namespace Resize\View\Helper;

use Cake\View\Helper;
/**
* CakePHP Imagine Plugin
*
* @package Imagine.View.Helper
*/
class ResizeHelper extends Helper {

    public $helpers = ['Html'];

    public function image($url = null, $options = [], $imageOptions = []) {

        if(!isset($options['width'])) $options['width'] = 100;
        if(!isset($options['height'])) $options['height'] = 100;
        if(!isset($options['type'])) $options['type'] = 'center';
        if(!isset($options['cacheFolder'])) $options['cacheFolder'] = 'img' . DS . 'cache';

        if(!file_exists($options['cacheFolder'])){
            mkdir($options['cacheFolder'], 0755);
        }

        extract(pathinfo($url)); //dirname, basename, extension, filename

        $fileHash = md5($url . $options['width'] . $options['height'] . $options['type']) . '.' . $extension;
        $finalUrl = $options['cacheFolder'] . DS . $fileHash;

        if(!file_exists($finalUrl)){
            switch($options['type']){
                case 'center':
                $crop = new \stojg\crop\CropCenter($url);
                $croppedImage = $crop->resizeAndCrop($options['width'], $options['height']);
                $croppedImage->writeimage($finalUrl);
                break;
                case 'entropy':
                $crop = new \stojg\crop\CropEntropy($url);
                $croppedImage = $crop->resizeAndCrop($options['width'], $options['height']);
                $croppedImage->writeimage($finalUrl);
                break;
                case 'balanced':
                $crop = new \stojg\crop\CropEntropy($url);
                $croppedImage = $crop->resizeAndCrop($options['width'], $options['height']);
                $croppedImage->writeimage($finalUrl);
                break;
            }
        }
        $finalUrl = str_replace('img'.DS, '',$finalUrl);
        return $this->Html->image($finalUrl, $imageOptions);
    }

}
