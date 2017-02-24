<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
<?php $this->beginBody() ?>
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">☰</button>
            <a class="navbar-brand" href="#"></a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">☰</a>
                </li>

                <li class="nav-item px-1">
                    <a class="nav-link" href="#">Добавить объявление</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="#">Мои объявления</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="#">Настройки</a>
                </li>
            </ul>
            <ul class="nav navbar-nav float-xs-right hidden-md-down">
                <li class="nav-item dropdown user-phone">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="hidden-md-down">admin</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <div class="dropdown-header text-xs-center">
                            <strong><?=Yii::t('app', 'Account')?></strong>
                        </div>
                        <?= Html::a(Yii::t('app', 'Logout').'<i class="fa fa-lock"></i>', ['/user/logout'],['class' => 'dropdown-item', 'data-method'=>'post']); ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link aside-toggle" href="#">☰</a>
                </li>

            </ul>
        </div>
    </header>
    <div class="sidebar">

        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">
                    Добавить объявление
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Аренда</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="/flatrent/"><i class="icon-puzzle"></i> Квартира</a>
                        </li>
                    </ul>
                </li>
                <li><hr></li>
                <li class="nav-title">
                    Мои объявления
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Аренда</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="/review/flat"><i class="icon-puzzle"></i> Квартира</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <main class="main">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </main>


<footer class="footer">
    <span class="text-left">
        <a href="http://m-sity.com">m-sity.com</a> © 2016.
    </span>
    <span class="float-xs-right">
        Powered by <a href="http://m-sity.com">m-sity.com</a>
    </span>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
