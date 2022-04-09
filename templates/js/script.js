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





//Обработка нажатия на кнопку Сохранить модального окна редактирования групп товаров
$('#btnSaveGroup').on('click', function() {
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
			console.log(data);
			$('#editGroupModal').modal('hide');
			//Отправили данные на сервер, теперь обновим каталог!
			$.get('/?page=catalog_view', function(data) {
				if (data) {
					$('#catalog_menu').replaceWith(data);
				}
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
		console.log(data);
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