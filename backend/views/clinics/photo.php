<?php
use dosamigos\fileupload\FileUploadUI;

// with UI
?>
<p>
    <?= \yii\helpers\Html::a('Add Photos', ['view', 'id' => $model->id], ['class' => 'btn btn-danger btn-lg']) ?>
</p>
<?= FileUploadUI::widget([
    'model' => $model,
    'attribute' => 'image',
    'url' => ['clinics/uploadd', 'id' => $model->id],
    'gallery' => true,
    'fieldOptions' => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],

    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]); ?>
