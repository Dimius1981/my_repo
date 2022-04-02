{config_load file='my_conf.conf'}
		<div class="aside" id="catalog_menu">
			<nav class="navbar navbar-dark bg-dark">
			  <div class="container-fluid">
			  	{if $user_info.level_id == 1}
			  	<div>
				    <a class="navbar-text" data-bs-toggle="modal" href="#editGroupModal" id="btnNewGroup" data-group-id="0">{#journal_plus_ico#}</a>
				  	<a class="navbar-brand" href="#">Каталог</a>
			    </div>
          		{else}
          		<a class="navbar-brand" href="#">Каталог</a>
          		{/if}
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="true" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
			    </button>
			  </div>
			</nav>		
			<div class="collapse show" id="navbarToggleExternalContent">
			   <ul class="nav flex-column">
			   	{foreach $gpl as $gpl_item}
				  <li class="nav-item">
				  	{* ?page=products&group=1 *}
				  	{if $user_info.level_id == 1}
				  	<div class="d-flex group_color_text"><a class="nav-link group_color_text p-2 btn-edit-group" data-bs-toggle="modal" href="#editGroupModal" data-group-id="{$gpl_item.id}">{#pencil_ico#}</a>
				  	<a class="nav-link group_color_text p-2" data-bs-toggle="modal" href="#editGroupModal">{#trash_ico#}</a>
				    <a class="nav-link group_color_text p-2" href="?page=products&group={$gpl_item.id}">{$gpl_item.name}</a></div>
				    {else}
				    <div class="d-flex group_color_text"><a class="nav-link group_color_text p-2" href="?page=products&group={$gpl_item.id}">{$gpl_item.name}</a></div>
				    {/if}

				    	{if $gpl_item.sub}
					   <ul class="nav flex-column">
					   	{foreach $gpl_item.sub as $sub_item}
						  <li class="nav-item">
						  	{if $user_info.level_id == 1}
						  	<div class="d-flex group_color_text subgroup ps-3">
						  	<a class="nav-link group_color_text subgroup p-2 btn-edit-group" data-bs-toggle="modal" href="#editGroupModal" id="btnEditGroup" data-group-id="{$sub_item.id}">{#pencil_ico#}</a>
						  	<a class="nav-link group_color_text subgroup p-2" data-bs-toggle="modal" href="#editGroupModal">{#trash_ico#}</a>
						    <a class="nav-link group_color_text subgroup p-2" href="?page=products&group={$sub_item.id}">{$sub_item.name}</a>
							</div>
							{else}
							<div class="d-flex group_color_text subgroup ps-3">
							<a class="nav-link group_color_text subgroup p-2" href="?page=products&group={$sub_item.id}">{$sub_item.name}</a>
							</div>
							{/if}
						  </li>
						{/foreach}
						</ul>
						{/if}
				  </li>
				{/foreach}
				</ul>
			</div>
		</div>
