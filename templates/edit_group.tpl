<!-- Модальное окно -->
<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Добавить группу товаров</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <label for="group-image" class="col-form-label">Картинка группы:</label>
              <div class="item_img" id="group-image">
                <a href="/">
                  <img src="./images/subgroup1-1.png"/>
                </a>
              </div>
              <div class="mb-3">
                <label for="group-image" class="col-form-label">Файл:</label>
                <input type="text" class="form-control" id="group-image">
              </div>
            </div>
            <div class="col-8">
              <div class="mb-3">
                <label for="group-name" class="col-form-label">Название группы:</label>
                <input type="text" class="form-control" id="group-name">
              </div>
              <div class="mb-3">
                <label for="group-par-id" class="col-form-label">Родительская группа:</label>
                <select class="form-select" id="group-par-id">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="group-description" class="col-form-label">Описание группы:</label>
                <textarea class="form-control" id="group-description"></textarea>
              </div>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary">Отмена</button>
          <button type="button" class="btn btn-primary">Добавить</button>
        </div>
    </div>
  </div>
</div>