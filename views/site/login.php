<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

$this->title = 'Вход';
?>
<div class="site-login d-flex justify-content-center align-items-center" style="height: 60vh;">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><?= Html::encode($this->title) ?></h1>

            <p class="card-text">Пожалуйста, заполните следующие поля для входа:</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
