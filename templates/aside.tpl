		<div class="aside">
			<nav class="navbar navbar-dark bg-dark">
			  <div class="container-fluid">
			  	{if $user_info.level_id == 1}
			  	<a class="navbar-brand dropdown-toggle" id="navbarScrollingDropdown" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">Каталог</a>
			  	<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" data-bs-toggle="modal" href="#editGroupModal">Добавить подгруппу...</a></li>
            <li><a class="dropdown-item" href="#">Удалить подгруппу...</a></li>
          </ul>
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
				    <a class="nav-link group_color_text" href="?page=products&group={$gpl_item.id}">{$gpl_item.name}</a>

				    	{if $gpl_item.sub}
					   <ul class="nav flex-column">
					   	{foreach $gpl_item.sub as $sub_item}
						  <li class="nav-item">
						    <a class="nav-link group_color_text subgroup" href="?page=products&group={$sub_item.id}">{$sub_item.name}</a>
						  </li>
						{/foreach}
						</ul>
						{/if}
				  </li>
				{/foreach}
				</ul>
			</div>
		</div>
