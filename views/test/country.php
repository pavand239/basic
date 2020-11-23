<?php

use app\models\Country;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $countries Country[] */
/* @var $pagination Pagination */



?>
    <h1>Countries</h1>
    <ul>
        <?php foreach ($countries as $country){?>
            <li>
                <?= Html::encode("{$country->code} ({$country->name})") ?>:
                <?= $country->population ?>
            </li>
        <?php } ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>