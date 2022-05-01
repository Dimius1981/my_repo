//Открытие модального окна редактирования товаров
$('#editProductModal').on('show.bs.modal', function (e) {
  //alert('Open!');

  $('#editProductModalLabel').text('Загрузка...');
  $('#product-name').val('');
  $('#product-description').val('');
  $('#product-image').attr('src', './images/blank.png');
  $('#product-file').val('');
  $('#product-sale').prop('checked', false);
  $('#product-percent').attr("readonly", "");
  $('#product-percent').val('');
  $('#product-price').val('');

  //Отключим валидацию формы
	$('.edit_product_form').removeClass('was-validated');
  $('#product-name').removeClass('is-invalid');

  var product_id = $(e.relatedTarget).data('product-id');
  $('#product_id').val(product_id);

  if (product_id > 0) {
  	  //Выполним AJAX запрос на получение информации по выбранному товару
  	  $.getJSON('/?page=jproduct&id='+product_id, function(data) {
  	  	//alert(data.name);
    		$('#editProductModalLabel').text('Товар #id = ' + data.id);
    		$('#product-name').val(data.name);
    		$('#product-description').val(data.description);
    		if (data.image) {
    		  $('#product-image').attr('src', './images/'+data.image);
    		  $('#product-file').val(data.image);
    		}
    		$('#product-group-id').val(data.group_id);
        $('#product-price').val(data.price);
        if (data.sale == 1) {
          $('#product-sale').prop('checked', true);
          $('#product-percent').removeAttr("readonly");
          $('#product-percent').val(data.sale_percent);
        }
  	  });
  } else {
  	$('#editProductModalLabel').text('Новый товар');
  }

});






/*
serialize() формы без скидки
product-name=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D1%82%D0%BE%D0%B2%D0%B0%D1%80&
product-group-id=5&
product-description=%D0%9E%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5&
product-price=100&
product-percent=&
product-file=file.png&
product_id=0

serialize() формы со скидкой
product-name=%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%20%D1%82%D0%BE%D0%B2%D0%B0%D1%80&
product-group-id=5&
product-description=%D0%9E%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5&
product-price=100&
product-sale=on&
product-percent=20&
product-file=file.png&
product_id=0
 */





//Обработчик события по нажатию на кнопке btnSaveProduct
//который не слетает после обновления AJax-ом модального окна редактирования группы
$(document).on('click', '#btnSaveProduct', function () {
  //alert('Click');

  var form_invalid = 0; //0- форма без ошибок
  if ($('#product-name').val() == '') {
    form_invalid = 1;
  }
  if ($('#product-price').val() == '') {
    form_invalid = 1;
  }

  if ($('#product-sale').is(':checked')) {
    if ($('#product-percent').val() == '') {
      form_invalid = 1;
    }
  }

  if (form_invalid) {
    //Отправка не возможна
    $('.edit_product_form').addClass('was-validated');
  } else {
    //Отправим форму
    $('.edit_product_form').removeClass('was-validated');
    //console.log($('.edit_product_form').serialize());

    $.post('/?page=productsubmit', $('.edit_product_form').serialize(), function(data) {
      //console.log(data);
      $('#editProductModal').modal('hide');

      var page = $('#page').val();
      var group = $('#group').val();
      //console.log('page = '+page);
      //console.log('group = '+group);
      //console.log('/?page='+page+'&group='+group+'&tp=products_view.tpl');
      //Отправили данные на сервер, теперь обновим список товаров!
      $.get('/?page='+page+'&group='+group+'&tp=products_view.tpl', function(data) {
        //console.log(data);
        if (data) {
          $('#page_content').html(data);
          $.get('/?page=catalog_view', function(data) {
            if (data) {
              $('#catalog_menu').replaceWith(data);
            }
          });
        }
      });
    });
  }
});


$(document).on('click', '#product-sale', function () {
  if ($(this).is(':checked')) {
    $('#product-percent').removeAttr("readonly");
  } else {
    $('#product-percent').attr("readonly", "");
  }
});




//Открытие модального окна удаления товаров
$('#deleteProductModal').on('show.bs.modal', function (e) {
  var product_id = $(e.relatedTarget).data('product-id');
  var product_name = $(e.relatedTarget).data('product-name');
  $('#btnDeleteProduct').attr('data-product-id', product_id);
  //alert(prod_col);

  $('#deleteProductQuestion').html('Вы действительно хотите удалить товар: '+
    '<b>' + product_name + '</b>?');

});


$('#btnDeleteProduct').on('click', function(e) {
  var product_id = $(this).attr('data-product-id');
  //alert(product_id);
  $.get('/?page=productdelete&id='+product_id, function(data){
    //console.log(data);
    //alert('Delete!');
    $('#deleteProductModal').modal('hide'); //Прячем окно
    var page = $('#page').val();
    var group = $('#group').val();
    //console.log('/?page='+page+'&group='+group+'&tp=products_view.tpl');
    //Отправили данные на сервер, теперь обновим список товаров!
    $.get('/?page='+page+'&group='+group+'&tp=products_view.tpl', function(data) {
      //console.log(data);
      if (data) {
        $('#page_content').html(data);
        $.get('/?page=catalog_view', function(data) {
          if (data) {
            $('#catalog_menu').replaceWith(data);
          }
        });
      }
    });
  });
});

