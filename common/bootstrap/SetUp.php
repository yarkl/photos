<?php
/**
 * Created by PhpStorm.
 * User: yar
 * Date: 07.11.17
 * Time: 20:59
 */
namespace common\bootstrap;

use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class SetUp implements \yii\base\BootstrapInterface
{
  public function bootstrap($app)
  {
      $container = \Yii::$container;
      $path = \Yii::getAlias('@webroot');
      $storageClient = new StorageClient([
          'projectId' => 'meeting-1505992494072',
          'keyFilePath' => $path.'/meeting-7c77b82098b3.json'
      ]);
      $bucket = $storageClient->bucket('meeting-1505992494072');
      $adapter = new GoogleStorageAdapter($storageClient , $bucket);
      $container->setSingleton(GoogleStorageAdapter::class, [] , [
          $storageClient,
          $bucket
      ]);

     $container->setSingleton(Filesystem::class, [] , [
         $adapter
     ]);



  }
}