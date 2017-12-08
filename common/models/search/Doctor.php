<?php

namespace common\models;

use Google\Cloud\Storage\StorageClient;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\imagine\Image;
use League\Flysystem\Filesystem;



/**
 * This is the model class for table "doctor".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 * @property integer $clinic_id
 *
 * @property Clinics $clinic
 */
class Doctor extends \yii\db\ActiveRecord
{


    public $image;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           //[['name', 'avatar', 'clinic_id'], 'required'],
            [['clinic_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['clinic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clinics::className(), 'targetAttribute' => ['clinic_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'clinic_id' => 'Clinic ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Clinics::className(), ['id' => 'clinic_id']);
    }

    public function saveImage(){
        $path = Yii::getAlias('@webroot');
        $storageClient = new StorageClient([
            'projectId' => 'meeting-1505992494072',
            'keyFilePath' => $path.'/meeting-7c77b82098b3.json'
        ]);
        $bucket = $storageClient->bucket('meeting-1505992494072');

        $adapter = new GoogleStorageAdapter($storageClient, $bucket);

        $filesystem = new Filesystem($adapter);
        $files = FileHelper::findFiles(Yii::getAlias('@webroot/images/avatars/'));
        $newPath = Yii::getAlias('@webroot/images/avatars/');
        foreach($files as $file){
            $path = basename($file);
            $filesystem->writeStream($newPath.'/'.$path, fopen($newPath.'/'.$path, 'r'));
        }
    }


    public function behaviors()
    {
        return [

            [
                'class' => \maxmirazh33\image\Behavior::className(),
                'savePathAlias' => '@webroot/images/',
                'urlPrefix' => '/images/',
                'crop' => true,
                'attributes' => [
                    'avatar' => [
                        'savePathAlias' => '@webroot/images/avatars/',
                        'urlPrefix' => '/images/avatars/',
                        'width' => 160,
                        'height' => 160,
                    ],


                ],
            ],


            //other behaviors
        ];

    }



}
