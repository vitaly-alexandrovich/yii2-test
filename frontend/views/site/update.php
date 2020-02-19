<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Data */

$this->title = 'Обновить транзакцию: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
