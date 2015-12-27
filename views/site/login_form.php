<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

?>


    <div id="login_form_block">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'action' => Yii::getAlias('@web') . "/site/login",
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'options' => ['class' => 'form-horizontal','data-pjax' => ''],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ]
        ]); ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'password', ['enableAjaxValidation' => true])->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-2 col-lg-5\">{input} {label}</div>\n<div class=\"col-lg-5\">{error}</div>",
        ]) ?>
        <div class="form-group">
            <div class="col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::Button('Registration',['class' => 'btn btn-success btn-change-lr']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>