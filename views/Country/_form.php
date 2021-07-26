<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


   <!-- <fieldset>
        <legend>Загрузить изображение</legend>
        <?/*= $form->field($model, 'imageFile')->fileInput(); */?>
        <?php /*if (!empty($model->imageFile)) {
            $img = Yii::getAlias('@webroot') . '/uploads/' . $model->imageFile;
            if (is_file($img)) {
                $url = Yii::getAlias('@web') . '/uploads/' . $model->imageFile;
                echo 'Уже загружено ', Html::a('изображение', $url, ['target' => '_blank']);
                echo '<img src="/uploads/',$model->imageFile,'" style="max-width:10%" alt="";>';
            }
        }*/?>
    </fieldset>-->
    <?php
    if(isset($model->imageFile) && file_exists(Yii::getAlias('@webroot', $model->imageFile)))
    {
        echo Html::img(Yii::getAlias('@web') .'uploads/' . $model->imageFile, ['class'=>'img-responsive','style'=>'max-width:10%']);
    }
    ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Qty')->textInput() ?>
    <?= $form->field($model, 'Type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
