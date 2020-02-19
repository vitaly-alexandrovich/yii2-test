<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Data */

$this->title = 'Внести транзакцию';
$this->params['breadcrumbs'][] = ['label' => 'транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
