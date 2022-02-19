{config_load file='my_conf.conf'}
<!DOCTYPE html>
<html lang="en">
<head>
  <title>{$TITLE}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>
<body>

<h1>{$name1}</h1>

<p>arr1[0] = {$arr1[0]}</p>
<p>arr1[1] = {$arr1[1]}</p>
<p>arr1[2] = {$arr1[2]}</p>

<br/>

{foreach $arr2 as $keyvar => $itemvar}
	<p>{$keyvar} = {$itemvar}</p>
{/foreach}

<br/>

<h3>arr2(Block 2) = {$arr2['Block 2']}</h3>

<br/>

<table>
	<tr>
		<td>Num</td>
		<td>Name</td>
		<td>Value</td>
	</tr>
{foreach $data as $item}
	<tr>
	{foreach $item as $itemvar}
		<td>{$itemvar}</td>
	{/foreach}
	</tr>
{/foreach}
</table>

<br/>
<br/>



</body>
</html>
