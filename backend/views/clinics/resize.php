<?php \yii\widgets\Pjax::begin(); ?>
<?= \yii\helpers\Html::beginForm(['clinics/resize', 'id' => $model->id], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= \yii\helpers\Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
<?= \yii\helpers\Html::submitButton('Resize', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
<?= \yii\helpers\Html::endForm() ?>
    <h3><?php echo $stringSize ?></h3>
<?php \yii\widgets\Pjax::end(); ?>


<?php ?>