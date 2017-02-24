<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="container d-table">
        <div class="d-100vh-va-middle">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-group">
                        <div class="card p-2">
                            <div class="card-block">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'layout' => 'horizontal',
                                    'fieldConfig' => [
                                        'template' => "<div class=\"col-lg-12\" >{input}</div>\n<div style=\"position:absolute;\" class=\"col-lg-12\">{error}</div>",
                                        'labelOptions' => ['class' => 'col-lg-12 control-label'],
                                    ],
                                ]); ?>
                                <h1><?=Yii::t('app', 'Login')?></h1>
                                <p class="text-muted"><?=Yii::t('app', 'Sign In to your account')?></p>
                                <div class="input-group mb-1">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <button type="button" class="btn btn-link px-0"><?=Yii::t('app', 'Forgot password?')?></button>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
                            <div class="card-block text-xs-center">
                                <div>
                                    <h2><?=Yii::t('app','Sign up')?></h2>
                                    <p><?=Yii::t('app', 'Sign-up now and start to earn money together with us.');?></p>
                                    <button type="button" class="btn btn-primary active mt-1"><?=Yii::t('app','Register now')?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
