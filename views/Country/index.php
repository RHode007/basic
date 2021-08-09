<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->getIsGuest()){ ?>

        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>

        <!--// keys is an array consisting of the keys associated with the selected rows
        var keys = $('#grid').yiiGridView('getSelectedRows');-->

        <?= Html::submitButton('Delete', ['class' => 'btn btn-danger','id'=> 'idaDelete']);

        $this->registerJs(
            "
            $('#idaDelete').on('click', function() { 
            
                var dialog = confirm('Are you sure to submit the installment?');
                if (dialog == true) {
                    var keys = $('#ecom').yiiGridView('getSelectedRows');
                    // console.log(keys);
                    var ajax = new XMLHttpRequest();
                    $.ajax({
                        type: 'POST',
                        url: 'index.php?r=country/bulk', 
                        data: {keylist: keys},
                        success: function(result){
                          console.log(result);
                        }
                      });
                }
                //alert('Button clicked!');
                //var keys1 = $('#ecom').yiiGridView('getSelectedRows');
                //console.log(keys1);
                });
                ",
            $this::POS_READY,
            'btn btn-danger'
        );
        }

        Modal::begin([
            'header' => '<h2>Column toggle</h2>',
            'toggleButton' => [
                'label' => 'Column toggle',
                'tag' => 'button',
                'class' => 'btn btn-info',
            ],
            'footer' => 'Низ окна',
        ]);

        echo Html::button('Checkbox', ['id' => 'hide-id', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);
        echo Html::button('SKU', ['id' => 'hide-SKU', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);
        echo Html::button('Name', ['id' => 'hide-name', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);
        echo Html::button('Qty', ['id' => 'hide-Qty', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);
        echo Html::button('Type', ['id' => 'hide-Type', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);
        echo Html::button('Image', ['id' => 'hide-Image', 'title' => 'Title', 'class' => 'showModalButton btn btn-success']);

        $this->registerJs("
        $('#hide-id').on('click', function(){
            $('.listing-id').toggle();
        });
        $('#hide-SKU').on('click', function(){
            $('.listing-SKU').toggle();
        });
        $('#hide-name').on('click', function(){
            $('.listing-name').toggle();
        });
        $('#hide-Qty').on('click', function(){
            $('.listing-Qty').toggle();
        });
        $('#hide-Type').on('click', function(){
            $('.listing-Type').toggle();
        });
        $('#hide-Image').on('click', function(){
            $('.listing-Type').toggle();
        });
        ");

        Modal::end();
        ?>
    </p>



    <?php Pjax::begin();?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'pageSize' => $pageSize]);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'ecom',

        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn',
            'options' => [ 'id' => 'listing-id'],
            'name' => 'actions[]',
            'contentOptions' => ['class' => 'listing-id'],
            'headerOptions' => ['class' => 'listing-id'],
            'filterOptions' => ['class' => 'listing-id'],
            'visible'=>!Yii::$app->user->getIsGuest()
            ],
            [//'class' => 'yii\grid\SerialColumn',=
            'label' => 'SKU',
            'attribute' => 'SKU',
            'options' => [ 'SKU' => 'listing-SKU'],
            'contentOptions' => ['class' => 'listing-SKU'],
            'headerOptions' => ['class' => 'listing-SKU'],
            'filterOptions' => ['class' => 'listing-SKU'],
            ],
            ['label' => 'Название',
            'attribute' => 'name',
            'options' => [ 'name' => 'listing-name'],
            'contentOptions' => ['class' => 'listing-name'],
            'headerOptions' => ['class' => 'listing-name'],
            'filterOptions' => ['class' => 'listing-name'],
            ],
            ['label' => 'Кол-во на складе',
            'attribute' => 'Qty',
            'options' => [ 'Qty' => 'listing-Qty'],
            'contentOptions' => ['class' => 'listing-Qty'],
            'headerOptions' => ['class' => 'listing-Qty'],
            'filterOptions' => ['class' => 'listing-Qty'],
            ],
            ['label' => 'Тип товара',
            'attribute' => 'Type',
            'options' => [ 'Type' => 'listing-Type'],
            'contentOptions' => ['class' => 'listing-Type'],
            'headerOptions' => ['class' => 'listing-Type'],
            'filterOptions' => ['class' => 'listing-Type'],
            ],
            ['label' => 'Картинка',
            'attribute' => 'imageFile',
            'format' => 'image',
            'options' => [ 'Image' => 'listing-Image'],
            'value' => function($model) { return $model->getImageUrl(); },
            'headerOptions' => ['style' => 'width:20%;','class' => 'listing-Image'],
            'contentOptions' => ['class' => 'img1 listing-Image'],
            'filterOptions' => ['class' => 'listing-Image'],
            ],
            ['class' => 'yii\grid\ActionColumn',
            'visible'=>!Yii::$app->user->getIsGuest()
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
