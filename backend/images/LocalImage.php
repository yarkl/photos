<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 08.11.17
 * Time: 9:50
 */

namespace backend\images;


class LocalImage implements ImageManagerInterface
{


    public  function save($oldPath)
    {

    }

    public  function has($path)
    {

    }

    public  function delete($path)
    {

    }

    public function getUrl(){

    }


    public function copy($absolutePath, $newAbsolutePath){
        copy($absolutePath, $newAbsolutePath);
    }



}