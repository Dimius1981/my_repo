<!-- Модальное окно -->
<form class="add_to_cart_form" id="add_to_cart_form">
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addToCartModalLabel">Добавить товар в корзину</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <p><b><span id="cart-prod-name">Название товара</span></b></br>
              Цена: <span id="cart-prod-price">1000</span> т</br>
              Количество: <span id="cart-prod-col">1</span> шт</p>
              <h3>Итого: <span id="cart-prod-sum">1000</span> т</h3>
            </div>
            <div class="col">
              <label for="cart-col-prod" class="col-form-label">Количество:</label>
              <input type="number" class="form-control" id="cart-col-prod" name="cart-col-prod" min="1" max="1000">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnAddToCart">Добавить</button>
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="cart_product_id" id="cart_product_id" value="">
</form>