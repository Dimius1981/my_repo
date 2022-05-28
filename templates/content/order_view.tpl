{config_load file='my_conf.conf'}
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
	</div>

	{foreach $my_items as $item}
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
			<p>{$item.price}</p>
		</div>
		<div class="col-1 text-center m-2">
			{$item.col}
		</div>
		<div class="col-1 text-center m-2" id="sum-{$item.id}">
			{$item.sum}
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

</div>