<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 09.11.17
 * Time: 10:53
 */

namespace backend\images;


interface ImageManagerInterface
{
    public  function save($path);

    public  function has($path);

    public  function delete($path);
}