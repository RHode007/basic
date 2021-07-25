<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>


    <fieldset>
        <legend>Загрузить изображение</legend>
        <?= $form->field($model, 'imageFile')->fileInput(); ?>
        <?php if (!empty($model->imageFile)) {
            $img = Yii::getAlias('@webroot') . '/uploads/' . $model->imageFile;
            if (is_file($img)) {
                $url = Yii::getAlias('@web') . '/uploads/' . $model->imageFile;
                echo 'Уже загружено ', Html::a('изображение', $url, ['target' => '_blank']);
                echo '<img src="/uploads/',$model->imageFile,'" style="max-width:10%" alt="";>';
            }
        }?>
    </fieldset>

   <!-- <?/*= $form->field($model, 'Pic')->fileInput() */?>
    <button>Submit</button>-->
    <?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Qty')->textInput() ?>
    <?= $form->field($model, 'Type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
