{config_load file='my_conf.conf'}
{if $prod_in_cart > 0}
<div class="cart_view m-3">
	<div class="row pb-2 bg-info">
		<div class="col-1 text-center m-2">
			<b>#id</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Фото</b>
		</div>
		<div class="col m-2">
			<b>Название и описание товара</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Цена, тг</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Кол-во, шт</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Сумма, тг</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Удалить</b>
		</div>
	</div>

	{foreach $prod_carts as $item}
	<div class="row pb-2{$item.bg_color}">
		<div class="col-1 text-center m-2">
			{$item.id}
		</div>
		<div class="col-1 text-center m-2">
			{if $item.image}
				<img src="{#images#}{$item.image}" width="70px" height="150px"/>
			{else}
				<img src="{#images#}prod_blank.png" width="70px" height="150px"/>
			{/if}
		</div>
		<div class="col m-2">
			{$item.name}</br>
			{$item.description}
		</div>
		<div class="col-1 text-center m-2">
			{if $item.sale}
				<p>{$item.new_price}</br>
				(<s>{$item.price}</s>)</p>
			{else}
				<p>{$item.price}</p>
			{/if}
		</div>
		<div class="col-1 text-center m-2">
			<input type="number" class="form-control" name="prod-col" value="{$item.col}" data-cart-id="{$item.id}" data-cart-prod-id="{$item.product_id}" data-cart-price="{$item.new_price}">
		</div>
		<div class="col-1 text-center m-2" id="sum-{$item.id}">
			{$item.sum}
		</div>
		<div class="col-1 text-center m-2">
			<a class="p-2" data-bs-toggle="modal" href="#deleteProductModal" data-product-id="{$item.id}" data-product-name="{$item.name}" data-page-delete="cartdelete">{#trash_ico#}</a>
		</div>
	</div>
	{/foreach}

	<div class="row pb-2 bg-info">
		<div class="col-1 text-center m-2">

		</div>
		<div class="col-1 text-center m-2">

		</div>
		<div class="col m-2">
			<b>Общая сумма за все товары:</b>
		</div>
		<div class="col-1 text-center m-2">

		</div>
		<div class="col-1 text-center m-2">

		</div>
		<div class="col-1 text-center m-2">
			<b>{$all_sum} тг</b>
		</div>
		<div class="col-1 text-center m-2">

		</div>
	</div>

	<div class="row p-3">
		<div class="col">
			Адрес даставки
      	</div>
	</div>

	<div class="row p-3 bg-info">
		<div class="col">
			Способ оплаты
      	</div>
	</div>

<form>
	<div class="row p-3">
		<div class="col text-end">
			<button type="button" class="btn btn-secondary">Отчистить корзину</button>
          	<button type="submit" class="btn btn-primary">Оформить заказ</button>
      	</div>
	</div>
</div>
<input type="hidden" name="page" value="addorder"/>
</form>
{else}
	<div class="row p-3">
		<div class="col text-center">
			<h3>В вашей корзине нет товаров!</h3>
		</div>
	</div>
{/if}