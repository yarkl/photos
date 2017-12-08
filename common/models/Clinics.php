<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "clinics".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 *
 * @property Photos[] $photos
 */
class Clinics extends \yii\db\ActiveRecord
{
   public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'text' => 'Text',
        ];
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['clinic_id' => 'id']);
    }


    public function behaviors(){
        return [
            'image' => [
                'class' => 'backend\images\behaviors\ImageBehave',
            ]
        ];
    }

}
