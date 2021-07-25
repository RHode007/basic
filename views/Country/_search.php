<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="country-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]);

    ?>

    <?= $form->field($model, 'SKU')->label('Поиск') ?>
    <?/*= $form->field($model, 'name') */?><!--
    <?/*= $form->field($model, 'Qty') */?>
    --><?/*= $form->field($model, 'Type') */?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Reset', ['id' => 'eraseSearch','onclick'=>'document.querySelector(\'#p0 .form-control\').value = \'\'','class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php

    $this->registerJs("
        $('#w1').on('click','#eraseSearch', function(){
           document.querySelector('#p0 .form-control').value = '';
        });");
    ?>
    <div class="form-group">
        <?= Html::label('Page Size', ['class' => 'control-label']) ?>
        <?= Html::dropDownList('pageSize', $pageSize,
            [0 => 'ALL', 10 => '10', 20 => '20', 50 => '50'],
            ['class' => 'form-control','id' => 'setList','options' =>[ '10' => ['Selected' => true]]]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Set', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Reset', ['onclick' => 'document.querySelector(\'#setList\').value=10','class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
