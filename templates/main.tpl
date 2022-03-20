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
						<h4 class="m-2">{$PageTitle}</h4>
					</div>
					<div class="col">
						<div class="new_class">
							<p class="m-3"><a class="group_color_text" href="/">Главная</a> / {$PageTitle}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="page_content">
				{eval $Content}
			</div>
		</div>
	</div>
	<div class="footer">
		{include file='footer.tpl'}
	</div>
</div>


</body>
</html>
