<?php

namespace common\models;

use Yii;
use sadovojav\cutter\behaviors\CutterBehavior;

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
class Doctors extends \yii\db\ActiveRecord
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
            [['name'], 'required'],
            [['clinic_id'], 'integer'],
            ['image', 'file', 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            [['name', 'avatar'], 'string', 'max' => 255],
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

    public function behaviors()
    {
        return [
            'image' => [
                'class' => CutterBehavior::className(),
                'attributes' => 'image',
                //'attributes' => ['image'],
                'baseDir' => '/uploads/',
                'basePath' => '@webroot',
            ],

        ];
    }
}
