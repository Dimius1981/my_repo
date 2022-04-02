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