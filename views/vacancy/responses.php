<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'Отклики на вакансии';
?>

<div class="site-responses">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-responsive rounded p-3 shadow-sm bg-light">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-bordered'], 
                'headerRowOptions' => ['style' => 'background-color: #007bff; color: #fff;'], // Задаем цвет фона и цвет текста для заголовков
                'columns' => [
                    [
                        'attribute' => 'full_name',
                        'label' => 'Полное имя',
                    ],
                    [
                        'attribute' => 'vacancy_id',
                        'label' => 'Вакансия',
                        'value' => function ($response) {
                            if (!empty($response->vacancy_id)) {
                                $vacancy = \app\models\Vacancy::findOne($response->vacancy_id);
                                if ($vacancy !== null) {
                                    return Html::a(Html::encode($vacancy->position_name), ['vacancy/detail', 'id' => $vacancy->id], ['class' => 'btn btn-primary btn-sm']);
                                }
                            }
                            return null;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'Email',
                        'value' => function ($response) {
                            $email = Html::encode($response->email);
                            return $email;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'white-space: nowrap;'], 
                    ],                
                    [
                        'attribute' => 'about',
                        'label' => 'О себе',
                    ],
                    [
                        'attribute' => 'attachment_path',
                        'label' => 'Резюме',
                        'value' => function ($response) {
                            if (!empty($response->attachment_path)) {
                                return Html::a('<i class="fa fa-file-pdf-o"></i> Скачать резюме', '/access-file' . $response->attachment_path, ['class' => 'btn btn-info btn-sm']);
                            }                   
                            return null;
                        },
                        'format' => 'raw',
                    ],
                ],
                'summary' => 'Показано {begin} - {end} из {totalCount} Откликов',
            ]); ?>
        </div>

        <?= LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            'options' => ['class' => 'pagination justify-content-center mt-4'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'page-item-disabled',
            'prevPageCssClass' => 'page-item',
            'nextPageCssClass' => 'page-item',
            'prevPageLabel' => '&laquo;11',
            'nextPageLabel' => '&raquo;11',
            
        ]); ?>
    </div>
</div>

<style>
    .page-item-disabled {
        visibility: hidden;
    }
</style>
