<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'admin';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Список пользователей</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fa fa-user"></i> Логин</th>
                                <th><i class="fa fa-envelope"></i> Email</th>
                                <th><i class="fa fa-user"></i> Менеджер</th>
                                <th><i class="fa fa-user"></i> Администратор</th>
                                <th><i class="fa fa-cogs"></i> Управление</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= Html::encode($user->username) ?></td>
                                    <td><?= Html::encode($user->email) ?></td>
                                    <td><?= $user->is_manager ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></td>
                                    <td><?= $user->is_admin ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></td>
                                    <td>
                                        <?= Html::a('<i class="fa fa-edit"></i> Ред.', ['admin/edit-user', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $user->id], [
                                                'class' => 'btn btn-danger',
                                                'data' => [
                                                    'confirm' => 'Вы уверены, что хотите удалить этого пользователя?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h1 class="card-title">Создать нового пользователя</h1>
                </div>
                <div class="card-body">
                    <form action="/admin/create-user" method="post">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <div class="form-group">
                            <label for="newUsername"><i class="fa fa-user"></i> Логин</label>
                            <input type="text" class="form-control" id="newUsername" name="newUsername">
                        </div>
                        <div class="form-group">
                            <label for="newEmail"><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="newEmail" name="newEmail">
                        </div>
                        <div class="form-group">
                            <label for="newPassword"><i class="fa fa-lock"></i>Пароль</label>
                            <input type="password" class="form-control" id="Password" name="newPassword">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="newIsManager" name="newIsManager">
                            <label class="form-check-label" for="newIsManager"><i class="fa fa-user-tie"></i> Менеджер</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="newIsAdmin" name="newIsAdmin">
                            <label class="form-check-label" for="newIsAdmin"><i class="fa fa-user-shield"></i> Администратор</label>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
