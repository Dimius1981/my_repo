//Открытие модального окна редактирования группы товаров
$('#editGroupModal').on('show.bs.modal', function (e) {
  //alert('Open!');
  //return e.preventDefault(); // останавливает отображение модального окна
  $('#editGroupModalLabel').text('Загрузка...');
  $('#group-name').val('');
  $('#group-description').val('');
  $('#group-image').attr('src', './images/blank.png');
  $('#group-file').val('');
  $('#group-par-id').val(0);

  //Отключим валидацию формы
	$('.edit_group_form').removeClass('was-validated');
  $('#group-name').removeClass('is-invalid');

  var group_id = $(e.relatedTarget).data('group-id');
  $('#group_id').val(group_id);
  if (group_id > 0) {
  	  //Выполним AJAX запрос на получение информации по выбранной группе товаров
  	  $.getJSON('/?page=jgroup&group='+group_id, function(data) {
  	  	//alert(data.name);
		$('#editGroupModalLabel').text('Группа товаров #id = ' + data.id);
		$('#group-name').val(data.name);
		$('#group-description').val(data.description);
		if (data.image) {
		  $('#group-image').attr('src', './images/'+data.image);
		  $('#group-file').val('./images/'+data.image);
		}
		$('#group-par-id').val(data.par_id);
  	  });
  } else {
  	$('#editGroupModalLabel').text('Новая группа товаров');
  }
});





//Обработчик события по нажатию на кнопке btnSaveGroup
//который не слетает после обновления AJax-ом модального окна редактирования группы
$(document).on('click', '#btnSaveGroup', function () {
	//alert('Click');
	var form_invalid = 0; //0- форма без ошибок
	if ($('#group-name').val() == '') {
		$('#group-name').addClass('is-invalid');
		form_invalid = 1;
	} else {
		$('#group-name').removeClass('is-invalid');
	}

	if (form_invalid) {
		//Отправка не возможна
		$('.edit_group_form').addClass('was-validated');
	} else {
		//Отправим форму
		$('.edit_group_form').removeClass('was-validated');

		$.post('/?page=groupsubmit', $('.edit_group_form').serialize(), function(data) {
			//console.log(data);
			$('#editGroupModal').modal('hide');
			//Отправили данные на сервер, теперь обновим каталог!
			$.get('/?page=catalog_view', function(data) {
				if (data) {
					$('#catalog_menu').replaceWith(data);
				}
				$.get('/?page=modalgroup', function(data) {
					$('#edit_group_form').replaceWith(data);
				});
			});
		});
	}
});



//Открытие модального окна удаления группы товаров
$('#deleteGroupModal').on('show.bs.modal', function (e) {
	var group_id = $(e.relatedTarget).data('group-id');
  var group_name = $(e.relatedTarget).data('group-name');
  var subgroup_col = $(e.relatedTarget).data('subgroup-col');
  var prod_col = $(e.relatedTarget).data('prod-col');

  //alert(prod_col);

  $('#deleteGroupQuestion').html('Вы действительно хотите удалить группу: '+
  	'<b>' + group_name + '</b>?');

  if ((prod_col == 0) && (subgroup_col == 0)) {
  	//Нет товаров и подгрупп, можем удалять
  	$('#btnDeleteGroup').removeAttr("disabled");
  	$('#deleteGroupAlert').hide();
  	$('#btnDeleteGroup').attr('data-group-id', group_id);
  } else {
  	//Есть товары или подгруппы. Удалять нельзя!
  	$('#btnDeleteGroup').attr("disabled", "");
  	$('#deleteGroupAlert').html('Эту группу удалить нельзя!</br>Она содержит: <b>'+
  		subgroup_col + '</b> подгрупп и <b>' + prod_col + '</b> товаров.');
  	$('#deleteGroupAlert').show();
  }

});



$('#btnDeleteGroup').on('click', function(e) {
	var group_id = $(this).attr('data-group-id');
	//alert(group_id);
	$.get('/?page=groupdelete&group='+group_id, function(data){
		//console.log(data);
		//alert('Delete!');
		$('#deleteGroupModal').modal('hide'); //Прячем окно
		//Отправили данные на сервер, теперь обновим каталог!
		$.get('/?page=catalog_view', function(data) {
			if (data) {
				$('#catalog_menu').replaceWith(data); //Обновим каталог
			}
			$.get('/?page=modalgroup', function(data) {
				$('#edit_group_form').replaceWith(data); //Обновим список групп в окне редактирования
			});
		});
	});
});







$('.form-select').on('change', function() {
	//alert($(this).val());
	//console.log($(this).children('option:selected').text());
	var order_id = $(this).data('order-id');
	var status_name = $(this).children('option:selected').text();
	$('#conf_order_id').html(order_id);
	$('#conf_new_status').html(status_name);
	$('#btnChangeOrderStatus').data('order-id', order_id);
	$('#btnChangeOrderStatus').data('status-id', $(this).val());
	$('#confOrderStatus').modal('show');
});




$('#btnChangeOrderStatus').on('click', function() {
	//alert($(this).data('order-id'));
	var order_id = $(this).data('order-id');
	var status_id = $(this).data('status-id');
	$.get('/?page=updordst&id='+order_id+'&status='+status_id, function(data){
		console.log(data);
		$('#confOrderStatus').modal('hide');
	});
})