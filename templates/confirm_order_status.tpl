<!-- Модальное окно -->
<div class="modal fade" id="confOrderStatus" tabindex="-1" aria-labelledby="confOrderStatusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confOrderStatusLabel">Изменить статус заказа</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <p id="deleteProductQuestion">Вы действительно хотите изменить статус заказа #<span id="conf_order_id">11</span></br>на <b><span id="conf_new_status">Новый статус</span></b></p>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnChangeOrderStatus" data-order-id="0" data-status-id="0">Изменить</button>
        </div>
    </div>
  </div>
</div>

