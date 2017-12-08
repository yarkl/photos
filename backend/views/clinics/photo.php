<?php
use dosamigos\fileupload\FileUploadUI;
use yii\web\View;
// with UI
?>
<p>
    <?= \yii\helpers\Html::a('Add Photos', ['view', 'id' => $model->id], ['class' => 'btn btn-danger btn-lg']) ?>
    <h1 id="slow-connection"></h1>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= \yii\helpers\Html::beginForm(['clinics/photo', 'id' => $model->id], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?= \yii\helpers\Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
    <?= \yii\helpers\Html::submitButton('Resize', ['id'=> "wait", 'class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
    <?= \yii\helpers\Html::endForm() ?>
    <h3><?php echo $stringSuccess ?></h3>
    <?php \yii\widgets\Pjax::end(); ?>
</p>
<?=
FileUploadUI::widget([
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
]);

?>

<?php $this->registerJs(
"$('#wait').on('click', function() { $('#slow-connection').html('Wait free trial connection is very slow') });",
View::POS_READY,
'my-button-handler'
);?>

