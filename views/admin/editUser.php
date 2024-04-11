<?php

use yii\helpers\Html;

$this->title = 'Редактирование пользователя';

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><i class="fa fa-user-edit"></i> Редактирование пользователя</h1>
                </div>
                <div class="card-body">
                    <form action="/admin/edit-user?id=<?= $user->id ?>" method="post">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <div class="form-group">
                            <label for="editUsername"><i class="fa fa-user"></i> Логин</label>
                            <input type="text" class="form-control" id="editUsername" name="username" value="<?= $user->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="editEmail"><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" value="<?= $user->email ?>">
                        </div>
                        <div class="form-group">
                            <label for="editPassword"><i class="fa fa-lock"></i> Новый пароль</label>
                            <input type="password" class="form-control" id="editPassword" name="newPassword">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="editIsManager" name="is_manager" <?= $user->is_manager ? 'checked' : '' ?>>
                            <label class="form-check-label" for="editIsManager"><i class="fa fa-user-tie"></i> Менеджер</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="editIsAdmin" name="is_admin" <?= $user->is_admin ? 'checked' : '' ?>>
                            <label class="form-check-label" for="editIsAdmin"><i class="fa fa-user-shield"></i> Администратор</label>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
