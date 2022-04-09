<!-- Модальное окно -->
<form class="edit_group_form" id="edit_group_form">
<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editGroupModalLabel">Добавить группу товаров</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <label for="group-image" class="col-form-label">Картинка группы:</label>
              <div class="item_img">
                  <img id="group-image" src="./images/subgroup1-1.png"/>
              </div>
            </div>
            <div class="col-8">
              <div class="mb-3">
                <label for="group-name" class="col-form-label">Название группы:</label>
                <input type="text" class="form-control" id="group-name" aria-describedby="validationGroupName" name="group-name" required>
                <div class="invalid-feedback" id="validationGroupName">
                  Пожалуйста, введите название группы товаров.
                </div>
              </div>
              <div class="mb-3">
                <label for="group-par-id" class="col-form-label">Родительская группа:</label>
                <select class="form-select" id="group-par-id" name="group-par-id">
                  <option selected value="0">Нет</option>
                  {foreach $gpl as $gpl_item}
                  <option value="{$gpl_item.id}">{$gpl_item.name}</option>
                  {/foreach}
                </select>
              </div>
              <div class="mb-3">
                <label for="group-description" class="col-form-label">Описание группы:</label>
                <textarea class="form-control" id="group-description" name="group-description"></textarea>
              </div>
              <div class="mb-3">
                <label for="group-file" class="col-form-label">Файл:</label>
                <input type="text" class="form-control" id="group-file" name="group-file">
              </div>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnSaveGroup">Сохранить</button>
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="group_id" id="group_id" value="">
</form>