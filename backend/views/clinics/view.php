<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//\backend\assets\RemoveImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Clinics */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clinics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="clinics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add Photos', ['photo', 'id' => $model->id], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Add Doctor', ['/doctors/create','id' => $model->id], ['class' => 'btn btn-success btn-lg']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text'
        ],
    ]) ?>


    <?php





    // print_r($gallery );
    $img_str='';
    echo ' <div class="row">';
    foreach($model->photos as $img_g){
        //$url_delete= \yii\helpers\Url::toRoute(['clinics/deleteGimg', 'id_photo' => $img_g->getUrl('400x309')]);
        $url_delete= \yii\helpers\Url::toRoute(['clinics/deleteimg', 'id_photo' => $model->id, 'id_img' => $img_g->url]); //настройка роутера на нужный урл
        $img_str.='		
		<div class="col-xs-6 col-md-3">
		<div  class="thumbnail reshenie_image_form">
			 <a class="btn delete_reshenie_img" title="Удалить?" href="'.$url_delete.'" data-id="'.$img_g->id.'"><span class="glyphicon glyphicon-remove"></span></a> 
		  <a class="fancybox img-rounded" rel="gallery1" href="'.$img_g->url.'">'.Html::img($img_g->url, ['alt' => '']).'</a>
		</div>
		</div> ';
    }
    echo $img_str;
    echo '</div>';
    ?>








</div>





