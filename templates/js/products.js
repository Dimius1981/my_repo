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
  var page_delete = $(e.relatedTarget).data('page-delete');
  $('#btnDeleteProduct').attr('data-product-id', product_id);
  $('#btnDeleteProduct').attr('data-page-del', page_delete);
  //alert(prod_col);

  $('#deleteProductQuestion').html('Вы действительно хотите удалить товар: '+
    '<b>' + product_name + '</b>?');

});


$('#btnDeleteProduct').on('click', function(e) {
  var product_id = $(this).attr('data-product-id');
  var page_delete = $(this).attr('data-page-del');
  //alert(product_id);
  $.get('/?page=' + page_delete + '&id='+product_id, function(data){
    //console.log(data);
    //alert('Delete!');
    $('#deleteProductModal').modal('hide'); //Прячем окно
    if (page_delete == 'productdelete') {
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
    } else {
      //Обновим страницу корзины
      $.get('/?page=cart&tp=carts_view.tpl', function(data) {
        console.log(data);
        if (data) {
          $('#page_content').html(data);
        }
      });
      //и счетчик товаров в корзине
      $.getJSON('/?page=colcart', function(data) {
        console.log(data.col_prod_cart);
        $('#prod_in_cart').html(data.col_prod_cart);
      });
    }
  });
});

//Открытие модального окна добавления товаров в корзину
$('#addToCartModal').on('show.bs.modal', function (e) {
  //alert('Open!');
  var product_id = $(e.relatedTarget).data('cart-product-id');
  $('#cart_product_id').val(product_id);
  var product_name = $(e.relatedTarget).data('cart-product-name');
  $('#cart-prod-name').html(product_name);
  var product_price = $(e.relatedTarget).data('cart-product-price');
  $('#cart-prod-price').html(product_price);

  var product_col = 1;
  $('#cart-prod-col').html(product_col);
  $('#cart-col-prod').val(product_col);

  var product_sum = product_col * product_price;
  $('#cart-prod-sum').html(product_sum);
});


$('#cart-col-prod').on('change', function() {
  //alert($(this).val());
  var col = $(this).val();
  var price = $('#cart-prod-price').html();
  var sum = col * price;
  $('#cart-prod-col').html(col);
  $('#cart-prod-sum').html(sum);
});

/*
$('#cart-col-prod').on('keyup', function() {
  //alert($(this).val());
  var col = $(this).val();
  var price = $('#cart-prod-price').html();
  var sum = col * price;
  $('#cart-prod-col').html(col);
  $('#cart-prod-sum').html(sum);
});
*/

$('#btnAddToCart').on('click', function() {
  //alert($('.add_to_cart_form').serialize());
  $.post('/?page=addcart', $('.add_to_cart_form').serialize(), function(data) {
    console.log(data);
    $('#addToCartModal').modal('hide');
    //Обновить кол-во товаров в меню "Корзина"
    $.getJSON('/?page=colcart', function(data) {
        console.log(data.col_prod_cart);
        $('#prod_in_cart').html(data.col_prod_cart);
    });
  });
});


$("[name='prod-col']").on('click', function(){
  var cart_id = $(this).attr('data-cart-id');
  var product_id = $(this).attr('data-cart-prod-id');
  var product_price = $(this).attr('data-cart-price');
  var product_col = $(this).val();
  //alert($(this).val() + ', ' + cart_id + ', ' + product_id);

  var new_sum = product_col * product_price;
  $('#sum-'+cart_id).html(new_sum);

  $.get('/?page=updcart&id='+cart_id+'&col='+product_col+'&prod='+product_id, function(data) {
    console.log(data);
  });
});