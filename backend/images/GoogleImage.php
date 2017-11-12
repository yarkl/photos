<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 08.11.17
 * Time: 9:49
 */

namespace backend\images;



use common\models\Photos;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class GoogleImage implements ImageManagerInterface
{




    public  function save($fullPath)
    {
        return \Yii::$container->get(Filesystem::class)->writeStream($fullPath, fopen($fullPath, 'r'));
    }

    public function has($path)
    {

        return \Yii::$container->get(GoogleStorageAdapter::class)->has($path);
    }

    public function delete($path)
    {
        return \Yii::$container->get(GoogleStorageAdapter::class)->delete($path);
    }

    public function getUrl($path){

        return \Yii::$container->get(GoogleStorageAdapter::class)->getUrl($path);
    }





}