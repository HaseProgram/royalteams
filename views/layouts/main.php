<?php
$contact_form = NULL;
$user = '';
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\LoginForm;
use app\models\RegistrationForm;
use app\models\ContactForm;

$contact_model = new ContactForm();
if ($contact_model->load(Yii::$app->request->post()) && $contact_model->contact(Yii::$app->params['adminEmail']))
    Yii::$app->session->setFlash('contactFormSubmitted');

$login_model = new LoginForm();
if ($login_model->load(Yii::$app->request->post()) && $login_model->login()) {
    return $this->goBack();
}

$reg_model = new RegistrationForm();

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="logo_bg">
        <div class="logo image">
            <p class="logo-image"></p>
            <p class="loading-text animate">Loading</p>
        </div>
    </div>

    <?php
    NavBar::begin([
        'options' => [
            'id' => 'top-main-menu',
            'class' => '',
        ]
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '<i class="fa fa-home"></i> Home','url' => ['/site/index'],'options' => ['class' => 'blue njax']],
            ['label' => '<i class="fa fa-gamepad"></i> Royal Team', 'url' => ['/site/about'], 'options' => ['class' => 'red njax']],
            ['label' => '<i class="fa fa-trophy"></i> Tournaments', 'url' => ['/site/contact'], 'options' => ['class' => 'green njax']],
            Yii::$app->user->isGuest ?
                '<li class="underline"><a href="#login-modal" data-toggle="modal" data-target="#login-modal"><i class="fa fa-sign-in"></i> Log-in</a></li>' :
                '<li class="underline"><a data-method="post" href="' . Yii::getAlias('@web') . '/site/logout"><i class="fa fa-sign-out"></i> Logout (' . Yii::$app->user->identity->username . ')</a></li>',
        ],
    ]);
    NavBar::end();
    ?>

    <div id="loading-bar">
        <div id="loading-progress" class="animate"></div>
    </div>

    <?php if (Yii::$app->user->isGuest): ?>

        <?php
        Modal::begin([
            'header' => 'Sign in',
            'options' => [
                'id' => 'login-modal'
            ]
        ]);
        ?>

            <?php echo $this->render('@app/views/site/login_form.php', ['model' => $login_model]); ?>
            <?php echo $this->render('@app/views/site/registration_form.php', ['model' => $reg_model,'user' => $user]); ?>

        <?php Modal::end() ?>

    <?php endif; ?>

    <div class="container">
        <div id="content">
            <?php Pjax::begin([
                'timeout' => 10000,
            ]) ?>

                <?= Html::a('',null,['id' => 'hidden-navigation']) ?>
                <?= $content ?>

            <?php Pjax::end() ?>
        </div>
    </div>

</div>

<footer class="footer container animate">
    <div class="body-content">
        <div style="height: 40px">
            <div class="pull-left" style="position: relative; top: 10px; font-size: 14px">ROYALTEAMS.COM</div>
            <div class="pull-right">
                Follow us:&nbsp;&nbsp;
                <img src="<?= Yii::getAlias('@web'); ?>/images/facebook-128.png" height="40px">
                <img src="<?= Yii::getAlias('@web'); ?>/images/vk-128.png" height="40px">
                <img src="<?= Yii::getAlias('@web'); ?>/images/twitter-128.png" height="40px">
                <img src="<?= Yii::getAlias('@web'); ?>/images/instagram-128.png" height="40px">
            </div>
        </div>
        <hr>
        <div class="row">

                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <h3>Site</h3>



                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <h3>Account</h3>

                        <p>Registered users can take part in tournaments, become prizes, create gaming profile (including team profile),
                            see their own statistic, contact other players via out site.
                        </p>

                        <p>
                            <a class="btn btn-default" data-toggle="modal" data-target="#login-modal" href="#login-modal">
                                Log-in
                            </a>
                        </p>
                    </div>

                    <?php echo $this->render('@app/views/site/contact.php', ['model' => $contact_model]); ?>

        </div>
    </div>
</footer>
<div class="copyright container">&copy; Royal Team <?= date('Y') ?></div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
