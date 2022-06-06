{config_load file='my_conf.conf'}
<!DOCTYPE html>
<html lang="en">
<head>
	{include file='head.tpl'}
</head>
<body>
<div class="container-fluid">
	{include file='header.tpl'}
	<div class="wrapper">
		{include file='aside.tpl'}
		<div class="page">
			<div class="page_header">
				<div class="row">
					<div class="col">
						<h4 class="m-2">
						{if ($user_info.level_id == 1) && ($page == 'products')}
							<a class="btn_new_products" data-bs-toggle="modal" href="#editProductModal" id="btnNewProduct" data-product-id="0">{#journal_plus_ico#}</a>
						{/if}
						  {$PageTitle}
						</h4>
					</div>
					<div class="col">
						<nav class="new_class" aria-label="breadcrumb">
						  <ol class="breadcrumb m-3">
						    <li class="breadcrumb-item"><a class="group_color_text" href="#">Главная</a></li>
						    {if $breadcrumb}
						    	{foreach $breadcrumb as $item}
						    		<li class="breadcrumb-item"><a class="group_color_text" href="{$item.link}">{$item.name}</a></li>
						    	{/foreach}
						    {/if}
						    <li class="breadcrumb-item" aria-current="page">{$PageTitle}</li>
						  </ol>
						</nav>
						<!--
						<div class="new_class">
							<p class="m-3"><a class="group_color_text" href="/">Главная</a> / {$PageTitle}</p>
						</div>
						-->
					</div>
				</div>
			</div>
			<div class="page_content" id="page_content">
				{eval $Content}
			</div>
		</div>
	</div>
	<div class="footer">
		{include file='footer.tpl'}
	</div>
</div>

{include file='authorization.tpl'}

{if $user_info.level_id == 1}
  {include file='edit_group.tpl'}
  {include file='delete_group.tpl'}
  {include file='edit_product.tpl'}
  {include file='confirm_order_status.tpl'}
{/if}

{if $user_info}
	{include file='add_to_cart.tpl'}
  {include file='delete_product.tpl'}
{/if}


<script src="./templates/js/script.js"></script>
{if ($page == 'products') || ($page == '') || ($page == 'prod') || ($page == 'cart')}
<script src="./templates/js/products.js"></script>
{/if}
</body>
</html>
