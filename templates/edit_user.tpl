<!-- Модальное окно -->
<form class="edit_user_form" id="edit_user_form">
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Редактировать данные пользователя</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">

              <div class="mb-3">
                <label for="edit-user-name" class="col-form-label">Имя пользователя:</label>
                <input type="text" class="form-control" id="edit-user-name" aria-describedby="validationUserName" name="edit-user-name" required>
                <div class="invalid-feedback" id="validationUserName">
                  Пожалуйста, введите имя пользователя.
                </div>
              </div>
              <div class="mb-3">
                <label for="edit-user-level-id" class="col-form-label">Уровень доступа:</label>
                <select class="form-select" id="edit-user-level-id" aria-describedby="validationUserLevelId" name="edit-user-level-id" required>
                  {foreach $user_levels as $item}
                    <option value="{$item.id}">{$item.name}</option>
                  {/foreach}
                </select>
                <div class="invalid-feedback" id="validationUserLevelId">
                  Нельзя изменить уровень доступа пользователя Администратор!
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="edit-user-login" class="col-form-label">Логин:</label>
                    <input type="text" class="form-control" id="edit-user-login" aria-describedby="validationUserLogin" name="edit-user-login" required>
                    <div class="invalid-feedback" id="validationUserLogin">
                      Пожалуйста, введите логин пользователя.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="edit-user-new-password" class="col-form-label">Новый пароль:</label>
                    <input type="password" class="form-control" id="edit-user-new-password" aria-describedby="validationUserPassword" name="edit-user-new-password" required>
                    <div class="invalid-feedback" id="validationUserPassword">
                      Пожалуйста, введите новый пароль пользователя.
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="edit-user-email" class="col-form-label">E-mail:</label>
                <input type="text" class="form-control" id="edit-user-email" aria-describedby="validationUserEmail" name="edit-user-email" required>
                <div class="invalid-feedback" id="validationUserEmail">
                  Пожалуйста, введите E-mail пользователя.
                </div>
              </div>
              <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="edit-user-enabled"  name="edit-user-enabled" aria-describedby="validationUserEnabled">
                <label class="form-check-label" for="edit-user-enabled">Разрешить вход на сайт</label>
                <div class="invalid-feedback" id="validationUserEnabled">
                  Администратор не может быть заблокирован!
                </div>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnEditSaveUser">Сохранить</button>
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="edit_user_id" id="edit_user_id" value="">
<input type="hidden" name="edit_user_password" id="edit_user_password" value="">
</form>