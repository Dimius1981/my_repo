<div class="prod_info m-3">
	<div class="row">
		<div class="col-4 text-center">
			{if $prod_info.image}
				<img src="{#images#}{$prod_info.image}"/>
			{else}
				<img src="{#images#}prod_blank.png"/>
			{/if}
		</div>
		<div class="col-8">
			<div class="row">
				<div class="col"><b>Код товара: </b></div>
				<div class="col">{$prod_info.id}</div>
			</div>
			<div class="row">
				<div class="col"><b>Группа товара: </b></div>
				<div class="col">{$prod_info.group_id}</div>
			</div>
			<div class="row">
				<div class="col"><b>Название товара: </b></div>
				<div class="col">{$prod_info.name}</div>
			</div>
			<div class="row">
				<div class="col"><b>Описание: </b></div>
				<div class="col">{$prod_info.description}</div>
			</div>
			<div class="row">
				<div class="col">
					<b>Цена: </b>
				</div>
				<div class="col text-center">
					{if $prod_info.sale}
						<h3>{$prod_info.new_price}т</h3>
						<div class="old_price">{$prod_info.price}т</div>
					{else}
						<h3>{$prod_info.price}т</h3>
					{/if}
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCartModal" data-cart-product-id="{$prod_info.id}" data-cart-product-name="{$prod_info.name}" data-cart-product-price="{$prod_info.new_price}">Добавить в корзину</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row m-3">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		    <a class="nav-link active" data-bs-toggle="tab" href="#home">Описание</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Характеристики</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Отзывы</a>
		  </li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane container active" id="home">
		  	<p>{$prod_info.description}</p>
		  </div>
		  <div class="tab-pane container fade" id="menu1">
		  	<p>Характеристики товара</p>
		  </div>
		  <div class="tab-pane container fade" id="menu2">
		  	<p>Отзывы</p>
		  </div>
		</div>

	</div>
</div>