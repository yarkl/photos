<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 09.11.17
 * Time: 10:50
 */

namespace backend\images;


use yii\base\Component;

class ImageFactory extends Component
{

    public  $storage;

    protected function getStorage(){

        switch($this->storage){
            case 'google':
               return new GoogleImage();
            break;
            case 'amazon':
                return new AmazonImage();
            break;
            default:
                return new LocalImage();

        }

    }


    public function getUrl($path){

        return $this->getStorage()->getUrl($path);
    }

    public function saveImage($path){
        return $this->getStorage()->save($path);
    }

    public function has($path){

        return $this->getStorage()->has($path);
    }

    public function putStream($path){
        return $this->getStorage()->putStream($path);
    }




}