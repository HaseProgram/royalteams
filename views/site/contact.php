<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="col-lg-4 col-sm-4 col-xs-12">
    <h3>Support</h3>
    <?php Pjax::begin(); ?>
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>

            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>If you have any questions, troubles or thoughts regarding site or you wanna contact us any other reason you can do this using form below:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'fieldConfig' => [
                'template' => '<span class="inerror"><i class="fa fa-exclamation-triangle"></i></span><span class="insuccess"><i class="fa fa-check"></i></span><div>{input}</div>'
            ],
            'options' => ['data-pjax' => '']
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Name']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
        <?= $form->field($model, 'subject')->textInput(['value' => 'f_support','type'=>'hidden']) ?>
        <?= $form->field($model, 'body')->textArea(['rows' => 3, 'placeholder' => 'Type your question here']) ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-6 col-sm-6 col-xs-6">{image}</div><div class="col-lg-6 col-sm-6 col-xs-6">{input}</div></div>',
    ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-default', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
    <?php Pjax::end(); ?>
</div>