<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Overtimes */

$this->title = 'Create Overtimes';
$this->params['breadcrumbs'][] = ['label' => 'Overtimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtimes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
