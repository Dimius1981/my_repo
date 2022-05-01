<!-- Модальное окно -->
<form class="edit_product_form" id="edit_product_form">
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Добавить товар</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-4">
              <label for="product-image" class="col-form-label">Картинка товара:</label>
              <div class="item_img">
                  <img id="product-image" src="./images/blank.png"/>
              </div>
            </div>
            <div class="col-8">
              <div class="mb-3">
                <label for="product-name" class="col-form-label">Название товара:</label>
                <input type="text" class="form-control" id="product-name" aria-describedby="validationProductName" name="product-name" required>
                <div class="invalid-feedback" id="validationProductName">
                  Пожалуйста, введите название товара.
                </div>
              </div>
              <div class="mb-3">
                <label for="product-group-id" class="col-form-label">Группа товара:</label>
                <select class="form-select" id="product-group-id" name="product-group-id">
                  {foreach $gpl as $gpl_item}
                  {if $gpl_item.id == $group}
                    <option value="{$gpl_item.id}" selected>{$gpl_item.name}</option>
                  {else}
                    <option value="{$gpl_item.id}">{$gpl_item.name}</option>
                  {/if}
                  {if $gpl_item.sub}
                    {foreach $gpl_item.sub as $sub_item}
                    {if $sub_item.id == $group}
                      <option value="{$sub_item.id}" selected>&nbsp;&nbsp;{$sub_item.name}</option>
                    {else}
                      <option value="{$sub_item.id}">&nbsp;&nbsp;{$sub_item.name}</option>
                    {/if}
                    {/foreach}
                  {/if}
                  {/foreach}
                </select>
              </div>
              <div class="mb-0">
                <label for="product-description" class="col-form-label">Описание товара:</label>
                <textarea class="form-control" id="product-description" name="product-description"></textarea>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="product-price" class="col-form-label">Цена товара:</label>
                    <input type="text" class="form-control" id="product-price" aria-describedby="validationProductPrice" name="product-price" required>
                    <div class="invalid-feedback" id="validationProductPrice">
                      Пожалуйста, введите цену товара.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="product-percent" class="col-form-label">
                      <input type="checkbox" class="form-check-input" id="product-sale"  name="product-sale">
                      <label class="form-check-label" for="product-sale">Скидка</label>
                    </label>
                    <input type="text" class="form-control" id="product-percent" aria-describedby="validationProductPercent" name="product-percent" required>
                    <div class="invalid-feedback" id="validationProductPercent">
                      Пожалуйста, введите процент скидки.
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="product-file" class="col-form-label">Файл:</label>
                <input type="text" class="form-control" id="product-file" name="product-file">
              </div>
            </div>
          </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
          <button type="button" class="btn btn-primary" id="btnSaveProduct">Сохранить</button>
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="product_id" id="product_id" value="">
<input type="hidden" name="page" id="page" value="{$page}">
<input type="hidden" name="group" id="group" value="{$group}">
</form>