<?php

namespace backend\controllers;

use backend\images\models\Image;
use common\models\Photos;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Yii;
use common\models\Clinics;
use common\models\searchClinicsSearch;
use yii\helpers\FileHelper;

use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ClinicsController implements the CRUD actions for Clinics model.
 */
class ClinicsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Clinics models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new searchClinicsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clinics model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $photos = (new \yii\db\Query())
            ->select(['url'])
            ->from('photos')
            ->where(['clinic_id' => $id])
            ->all();



        return $this->render('view', [
            'model' => $this->findModel($id),
            'photos' => $photos,

        ]);
    }

    /**
     * Creates a new Clinics model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clinics();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clinics model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Clinics model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPhoto($id){
        $model = $this->findModel($id);
        $string = Yii::$app->request->post('string');
        $stringSuccess = '';
        if (!is_null($string)) {
            $stringSuccess = 'Photos was Resized';
            $photos = $model->getImages();
            foreach($photos as $photo){
                $photo->getUrl($string);
            }
        }
        return $this->render('photo',[
            'model' => $model,
            'stringSuccess' => $stringSuccess,

        ]);
    }


    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('@backend/web/img/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {

            $fileName = basename($file);
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    public function actionUploadd($id)
    {

        $model = Clinics::findOne($id);
        $imageFile = UploadedFile::getInstance($model, 'image');

        $directory = Yii::getAlias('@webroot/img/temp') .
        DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {

           FileHelper::createDirectory($directory);
        }
        if ($imageFile) {

            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath) && $filePath) {

                $model->attachImage($filePath);
                //$this->saveImgToGae($filePath);
                //FileHelper::removeDirectory($directory);

                $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'image-delete?name=' . $fileName,
                            'deleteType' => 'POST',

                        ],
                    ],
                ]);
            }

        }


        return '';
    }




    /**
     * Finds the Clinics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clinics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clinics::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
