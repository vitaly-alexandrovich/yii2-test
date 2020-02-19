<?php

use common\helpers\DateHelper;
use common\models\Data;
use common\widgets\DatesFilter;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список транзакций';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="data-index">

    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Внести транзакцию', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-3">
            <?= DatesFilter::widget([
                'filterModel' => $searchModel,
            ]) ?>
        </div>
        <div class="col-md-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'card_number',
                    'date',
                    [
                        'attribute' => 'year',
                        'filter' => Data::availableYears(),
                    ],

                    [
                        'attribute' => 'month',
                        'filter' => DateHelper::getMonths(),
                    ],

                    'volume',
                    'service',
                    'address_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
