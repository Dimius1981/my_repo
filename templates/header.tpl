	<div class="header overflow-hidden">
		<div class="row">
			<nav class="navbar navbar-expand-sm">
			  <div class="container-fluid">
    			<div class="collapse navbar-collapse" id="mynavbar">
			      <ul class="navbar-nav me-auto">
			        <li class="nav-item">
			          <a class="nav-link" href="/">Главная</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="?page=about">О магазине...</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="?page=act_page">Акции</a>
			        </li>
			        {if $user_info}
				        <li class="nav-item">
				          <a class="nav-link" href="?page=cart">Корзина <span class="badge bg-primary" id="prod_in_cart">{$prod_in_cart}</span></a>
				        </li>
				        <li class="nav-item dropdown">
				        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">{$user_info.name}</a>
				        	<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					            <li><a class="dropdown-item" href="/?page=myorders">Мои заказы</a></li>
					            {if $user_info.level_id == 1}
					            <li><a class="dropdown-item" href="/?page=allorders">Все заказы</a></li>
					            <li><a class="dropdown-item" href="/?page=allusers">Пользователи</a></li>
					            {/if}
					            <li><hr class="dropdown-divider"></li>
					            <li><a class="dropdown-item" href="/?logout=true">Выход</a></li>
					        </ul>
				        </li>
		          	{else}
				        <li class="nav-item">
			          		<a class="nav-link" data-bs-toggle="modal" href="#authModal">Вход</a>
				        </li>
		          	{/if}
			      </ul>
			      <form class="d-flex">
			        <input class="form-control me-2" type="text" placeholder="Найти...">
			        <button class="btn btn-primary" type="button">Найти</button>
			      </form>
			    </div>
			  </div>
			</nav>
		</div>
		<div class="row">
			<div class="logo-title">
				<div class="logo">
					<a href="#">
						<img src="{#path#}images/logo1.png">
					</a>
				</div>
				<div class="main-title">
				</div>
			</div>
		</div>
	</div>
