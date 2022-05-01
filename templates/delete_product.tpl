<!-- Модальное окно -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProductModalLabel">Удалить товар</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <p id="deleteProductQuestion">Вы действительно хотите удалить товар?</p>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnDeleteProduct" data-product-id="0">Удалить</button>
        </div>
    </div>
  </div>
</div>

