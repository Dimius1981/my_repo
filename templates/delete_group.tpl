<!-- Модальное окно -->
<div class="modal fade" id="deleteGroupModal" tabindex="-1" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteGroupModalLabel">Удалить группу товаров</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <p id="deleteGroupQuestion">Вы действительно хотите удалить группу?</p>
              <div class="alert alert-danger" role="alert" id="deleteGroupAlert">
                Эту группу удалить нельзя!
              </div>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnDeleteGroup" data-group-id="0">Удалить</button>
        </div>
    </div>
  </div>
</div>