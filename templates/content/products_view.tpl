{config_load file='my_conf.conf'}
<div class="row row-cols-auto justify-content-center">
	{foreach $gpl as $item}
	{if $item.id == $group_info.id}
		{if $item.sub}
		{foreach $item.sub as $subitem}
		<div class="col p-3">
			<div class="item d-flex flex-column justify-content-start align-items-center  shadow">
				{if $user_info.level_id == 1}
					<div class="prod_icons p-2">
						<a class="prod_color_text p-2" data-bs-toggle="modal" href="#editGroupModal" data-group-id="{$subitem.id}">{#pencil_ico#}</a>
				  		<a class="prod_color_text p-2" data-bs-toggle="modal" href="#deleteGroupModal" data-group-id="{$subitem.id}" data-group-name="{$subitem.name}" data-subgroup-col="{count($item.sub)}" data-prod-col="{$subitem.col}">{#trash_ico#}</a>
					</div>
				{/if}
				<div class="item_img">
					<a href="?page=products&group={$subitem.id}">
						{if $subitem.image}
							<img src="{#images#}{$subitem.image}"/>
						{else}
							<img src="{#images#}blank.png"/>
						{/if}
					</a>
				</div>
				<div class="item_text p-2">
					<div class="text_ellipsis">
						<a href="?page=products&group={$subitem.id}">
							<b>{$subitem.name}</b>
						</a>
					</div>
				</div>
			</div>
		</div>
		{/foreach}
		{/if}
	{/if}
	{/foreach}
</div>

<div class="row row-cols-auto justify-content-center">
	{foreach $products as $item}
		<div class="col p-3">
			<div class="item d-flex flex-column justify-content-start align-items-center  shadow">
				{if $item.sale}
					<div class="sale px-2">
						Sale -{$item.sale_percent}%
					</div>
				{/if}
				{if $user_info.level_id == 1}
					<div class="prod_icons p-2">
						<a class="prod_color_text p-2" data-bs-toggle="modal" href="#editProductModal" data-product-id="{$item.id}">{#pencil_ico#}</a>
				  		<a class="prod_color_text p-2" data-bs-toggle="modal" href="#deleteProductModal" data-product-id="{$item.id}" data-product-name="{$item.name}">{#trash_ico#}</a>
					</div>
				{/if}
				<div class="item_img">
					<a href="#">
						{if $item.image}
							<img src="{#images#}{$item.image}"/>
						{else}
							<img src="{#images#}prod_blank.png"/>
						{/if}
					</a>
				</div>
				<div class="item_text p-2">
					<div class="text_ellipsis">
						<a href="#">
							<b>{$item.name}</b>
						</a>
					</div>
					<div class="text_ellipsis">
						<a href="#">
							{$item.description}
						</a>
					</div>
				</div>
				<div class="item_price pb-2 d-flex flex-row justify-content-around align-items-center">
					<div class="price">
						{if $item.sale}
							{$item.new_price}т
							<div class="old_price">{$item.price}т</div>
						{else}
							{$item.price}т
						{/if}
					</div>
					<div class="korzinka">
						<a href="#">
							<img src="{#path#}images/korz2.png"/>
						</a>
					</div>
				</div>
			</div>
		</div>
	{/foreach}
</div>