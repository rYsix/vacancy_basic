<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php $this->registerCsrfMetaTags() ?>  
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<style>
    .navbar-nav{
        color: black;
        text-align: center;
        background-color: #015490;
        border-radius: 4px;

    }
    .nav-item{
        border-bottom: 1px solid #015a9a;
        border-radius: 4px;
    }
</style>

<header>
    <!--<img src="/logo_new.png" style="position: fixed; margin-top: 4cm; z-index: -1" alt=""-->
    <?php
    NavBar::begin([
        'brandLabel' => 'Вакансии',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark fixed-top',
            'style' => 'background-color: #015590; height: 63px;',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'ППС', 'url' => ['/pps/pps']],
        ['label' => 'CREAT user tmp', 'url' => ['/site/about']],
        //['label' => 'Обратная связь', 'url' => ['/site/contact']],
    ];
    
    $isManager = !Yii::$app->user->isGuest && Yii::$app->user->identity->is_manager;
    if ($isManager) {
        $menuItems[] = ['label' => 'Создать вакансию', 'url' => ['/vacancy/create-vacancy']];
        $menuItems[] = ['label' => 'Просмотреть отклики', 'url' => ['/vacancy/responses']];
    }
    
    /*if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Зерегистрироваться', 'url' => ['/site/signup']];
    }
    */

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Войти',['/site/login'],[
            'class' => [ 'btn btn-link login text-decoration-none'],
            'style'=>[';color: #ffffff']
            ]
        ),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none', 'style'=>[';color: #ffffff']]
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>

</header>

<script>
    var headerheight = jQuery('header').outerHeight();
jQuery('header').css("margin-top",headerheight);
</script>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start"><?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();