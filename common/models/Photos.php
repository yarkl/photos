<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property integer $clinic_id
 * @property string $url
 * @property string $filePath
 *
 * @property Clinics $clinic
 */
class Photos extends \yii\db\ActiveRecord
{

    public static function create($clinic_id , $url , $filePath){
        $photos = new static();
        $photos->clinic_id = $clinic_id;
        $photos->url = $url;
        $photos->filePath = $filePath;
        if(!$photos->save()){
            throw new \DomainException('Photos was not saved');
        }
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinic_id', 'url', 'filePath'], 'required'],
            [['clinic_id'], 'integer'],
            [['url', 'filePath'], 'string', 'max' => 255],
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
            'clinic_id' => 'Clinic ID',
            'url' => 'Url',
            'filePath' => 'File Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinic()
    {
        return $this->hasOne(Clinics::className(), ['id' => 'clinic_id']);
    }
}
