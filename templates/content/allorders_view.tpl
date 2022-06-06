<!--Отображаем список заказов пользователя-->
{if $all_orders_count > 0}
<div class="my_orders_view m-3">
	<div class="row pb-2 bg-info">
		<div class="col-1 text-center m-2">
			<b>#id</b>
		</div>
		<div class="col-2 m-2">
			<b>Пользователь</b>
		</div>
		<div class="col-2 m-2">
			<b>Дата создания</b>
		</div>
		<div class="col-2 text-center m-2">
			<b>Сумма, тг</b>
		</div>
		<div class="col text-center m-2">
			<b>Статус заказа</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Действия</b>
		</div>
	</div>

	{foreach $all_orders as $item}
	<div class="row pb-2{$item.bg_color}">
		<div class="col-1 text-center m-2">
			{$item.id}
		</div>
		<div class="col-2 m-2">
			{$item.user_name}
		</div>
		<div class="col-2 text-center m-2">
			{$item.date_create}
		</div>
		<div class="col-2 text-center m-2">
			{$item.sum_order}
		</div>
		<div class="col m-2">
			<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" data-order-id="{$item.id}" data-status-name="{$item.status_name}">
			{foreach $list_status as $status}
				{if $item.status == $status.id}
			  		<option selected value="{$status.id}">{$status.name}</option>
				{else}
					<option value="{$status.id}">{$status.name}</option>
				{/if}
			{/foreach}
			</select>
		</div>
		<div class="col-1 text-center m-2">
			<a class="p-2" href="/?page=orderview&id={$item.id}&br=2">{#eye_ico#}</a>
		</div>
	</div>
	{/foreach}

{else}
	<div class="row p-3">
		<div class="col text-center">
			<h3>Нет новых заказов!</h3>
		</div>
	</div>
{/if}
</div>
