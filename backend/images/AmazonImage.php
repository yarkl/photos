<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 08.11.17
 * Time: 9:49
 */

namespace backend\images;


use common\models\Photos;

class AmazonImage  implements ImageManagerInterface
{
    private  function amazonBucketUrl(){
        return \Yii::$app->params['amazonBucket'];
    }

    public  function save($path)
    {
       return \Yii::$app->get('awss3Fs')->writeStream($path,fopen($path, 'r'));
    }

    public  function has($path)
    {
        return \Yii::$app->get('awss3Fs')->has($path);
    }

    public  function delete($path)
    {

        return \Yii::$app->get('awss3Fs')->delete($path);
    }

    public  function getUrl($path){

        return \Yii::$app->get('s3bucket')->getUrl($path);
    }


}