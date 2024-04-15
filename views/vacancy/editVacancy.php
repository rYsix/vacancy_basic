<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\CreateVacancyForm */

$this->title = 'Изменить вакансию';
?>

<style>
    .card-body {
        background-color: #f8f9fa; 
        border-radius: 0 0 .25rem .25rem;
        border-top: 1px solid rgba(0, 0, 0, .125); 
        background-color: #ced4da; 


    }
</style>
<style>
    .form-group {
        padding: 10px;
        border-radius: 8px; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        background-color: #f8f9fa; 
        
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <h1 class="card-header"><?= Html::encode($this->title) ?></h1>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'is_active')->checkbox(['class' => 'form-check-input'])->label('<i class="fa fa-check"></i>') ?>

                    <?= $form->field($model, 'position_name')->textInput(['maxlength' => true])->label('<i class="fa fa-briefcase"></i> Название должности') ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('<i class="fa fa-file-text"></i> Описание') ?>

                    <?= $form->field($model, 'salary')->textInput()->label('<i class="fa fa-money"></i> Заработная плата') ?>

                    <?= $form->field($model, 'requirements')->textarea(['rows' => 6])->label('<i class="fa fa-list-ul"></i> Требования') ?>

                    <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6])->label('<i class="fa fa-tasks"></i> Обязанности') ?>

                    <?= $form->field($model, 'work_schedule')->textInput(['maxlength' => true])->label('<i class="fa fa-calendar"></i> График работы') ?>

                    <?= $form->field($model, 'academic_direction')->textInput(['maxlength' => true])->label('<i class="fa fa-graduation-cap"></i> Академическое направление') ?>

                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('<i class="fa fa-map-marker"></i> Местоположение') ?>

                    <?= $form->field($model, 'publication_date')->widget(DatePicker::class, [
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        'language' => 'ru',
                    ])->label('<i class="fa fa-calendar"></i> Дата публикации') ?>

                    <?= $form->field($model, 'application_deadline')->widget(DatePicker::class, [
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        'language' => 'ru',
                    ])->label('<i class="fa fa-calendar"></i> Крайний срок подачи заявок') ?>

                    <?= $form->field($model, 'company')->textInput(['maxlength' => true])->label('<i class="fa fa-building"></i> Компания') ?>

                    <?= $form->field($model, 'contact_info')->textInput(['maxlength' => true])->label('<i class="fa fa-phone"></i> Контактная информация') ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success btn-lg mt-3', 'style' => 'width: 70%;']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
