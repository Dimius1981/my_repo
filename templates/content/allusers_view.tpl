{config_load file='my_conf.conf'}
<!--Отображаем список пользователей-->
<div class="all_users_view m-3">
	<div class="row pb-2 bg-info">
		<div class="col-1 text-center m-2">
			<b>#id</b>
		</div>
		<div class="col text-center m-2">
			<b>Доступ</b>
		</div>
		<div class="col-2 text-center m-2">
			<b>Имя пользователя</b>
		</div>
		<div class="col text-center m-2">
			<b>Логин</b>
		</div>
		<div class="col text-center m-2">
			<b>Дата входа</b>
		</div>
		<div class="col-2 text-center m-2">
			<b>e-mail</b>
		</div>
		<div class="col-1 text-center m-2">
			<b>Действия</b>
		</div>
	</div>

	{foreach $user_list as $item}
	<div class="row pb-2{$item.bg_color}">
		<div class="col-1 text-center m-2">
			{$item.id}
		</div>
		<div class="col m-2">
			{$item.level_name}
		</div>
		<div class="col-2 m-2">
			{$item.name}
		</div>
		<div class="col m-2">
			{$item.login}
		</div>
		<div class="col text-center m-2">
			{$item.date_login}
		</div>
		<div class="col-2 m-2">
			{$item.email}
		</div>
		<div class="col-1 text-center m-2 d-flex">
			<a class="p-1" data-bs-toggle="modal" href="#editUserModal" data-user-id="{$item.id}">{#pencil_ico#}</a>
			{if $item.enabled}
				<a class="p-1" href="##" id="editUserDisabled" data-user-id="{$item.id}">{#eye_ico#}</a>
			{else}
				<a class="p-1" href="##" id="editUserEnabled" data-user-id="{$item.id}">{#eye_slash_ico#}</a>
			{/if}
			<a class="p-1" href="#">{#trash_ico#}</a>
		</div>
	</div>
	{/foreach}

</div>
