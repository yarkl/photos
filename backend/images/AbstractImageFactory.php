<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 08.11.17
 * Time: 9:47
 */

namespace backend\images;


abstract class AbstractImageFactory
{
    abstract protected function getStorage($storage);
}