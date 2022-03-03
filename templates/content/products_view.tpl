<div class="row row-cols-auto justify-content-center">
	{foreach $products as $item}
		<div class="col p-3">
			<div class="item d-flex flex-column justify-content-start align-items-center">
				<div class="item_img">
					<img src="{#images#}{$item.image}"/>
				</div>
				<div class="item_text p-2">
					<p>{$item.name}</p>
				</div>
				<div class="item_price pb-2 d-flex flex-row justify-content-around align-items-center">
					<div class="price">
						<span class="price">{$item.price}т</span>
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