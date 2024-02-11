<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>

<?php $form = ActiveForm::begin(
        [
            'action' => \yii\helpers\Url::toRoute('apple/generate'),
            'method' => 'post'
        ]
); ?>
    <?= Html::submitButton('Generate Apples') ?>
<?php ActiveForm::end(); ?>

<?php foreach ($apples as $apple): ?>
    <div class="apple">
        <div class="apple__color <?=$apple['color'];?>"></div>
        <div class="apple__status">
            <?=\common\models\Apple::STATUS_NAMES[$apple['status']];?>
        </div>
        <div class="apple__integrality">
            <?=$apple['integrality'];?> %
        </div>
        <div class="apple__action">
            <?php $form = ActiveForm::begin(
                [
                    'action' => \yii\helpers\Url::toRoute('apple/down'),
                    'method' => 'post'
                ]
            ); ?>
                <input type="hidden" name="apple_id" value="<?=$apple['id']?>">
                <?= Html::submitButton('Упасть') ?>
            <?php ActiveForm::end(); ?>
            <br>
            <?php $form = ActiveForm::begin(
                [
                    'action' => \yii\helpers\Url::toRoute('apple/bite'),
                    'method' => 'post'
                ]
            ); ?>
            <input type="hidden" name="apple_id" value="<?=$apple['id']?>">
            <input type="number" name="percent" value="10">
            <span>%</span>
            <?= Html::submitButton('Откусить') ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php endforeach; ?>

<style>
    .apple {
        display: flex;
        align-items: center;
        padding: 15px;
    }
    .apple div {
        padding: 15px;
    }
    .apple__color {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: #fff;
    }
    .apple__color.green {
        background-color: green;
    }
    .apple__color.yellow {
        background-color: yellow;
    }
    .apple__color.red {
        background-color: red;
    }
</style>
