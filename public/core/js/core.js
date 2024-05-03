$(document).ready(function() {
// Đường dẫn admin
	admin_dir = $('meta[name=admin_dir]').attr('content');
// di chuyển lên đầu trang
    // Thẻ có data-gototop khi click vào sẽ luộn lên top
    // eg: <a href="javascript:;" data-gototop>Lên trên top</a>
    $('body').on('click', '*[data-gototop]', function(e){
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

// Đổi ngôn ngữ toàn trang
	$('body').on('click', '*[data-language]', function(e) {
		e.preventDefault();
		value = $(this).data('language');
		pushOrUpdate({
			setLanguage: value,
		});
		window.location.reload();
	});

// Đổi ngôn ngữ tại bảng
	$('body').on('change', '*[data-language_table]', function(e) {
		e.preventDefault();
		value = $(this).val();
		setCookie('table_locale', value, 1);
		loadData('progress');
	});

// Đổi số lượng bản ghi được load
	$('body').on('change', '*[data-pagesize]', function(e) {
		e.preventDefault();
		value = $(this).val();
		setCookie('sudo_page_size', value, 1);
		loadData('progress');
	});

// Cuộn chuột
    /*
        Hiệu ứng cuộn xuống 1 id/class duy nhất nào đó trong trang
        data-scroll: id/class box muốn cuộn
        data-top: là một số sẽ đặt một khoảng cách top là giá trị
        eg: <a href="#id" data-scroll="#id" data-top="20">Click cuộn xuống</a>
    */
    $('body').on('click','*[data-scroll]',function(e) {
        e.preventDefault();
        id = $(this).data('scroll');
        offset_top = $(this).data('top');
        if (!checkEmpty(offset_top)) {
            offset_top = $(id).offset().top-offset_top;
        } else {
            offset_top = $(id).offset().top;
        }
        $('html, body').animate({scrollTop: offset_top}, 500);
    });

// Toggle box
    /*
        Khi click vào data-toggle_btn thì sẽ tạo hiệu ứng toggle cho data-toggle_box
        data-toggle_btn: không giá trị, là nút click box
        data-toggle_wrap: không giá trị, là box cha chứa cả data-toggle_btn và data-toggle_box
        data-toggle_box: không giá trị, là box muốn toggle
        eg:
        <div data-toggle_wrap>
            <div data-toggle_btn></div>
            <div data-toggle_box></div>
        </div>
    */
    $('body').on('click','*[data-toggle_btn]',function(e) {
        e.preventDefault();
        $(this).closest('*[data-toggle_wrap]').find('*[data-toggle_box]').slideToggle();
    });
 
// Load tìm kiếm
	$('body').on('click', '#listdata .search-container .search-btn', function(e) {
		e.preventDefault();
		form_serialize = $(this).closest('form').serialize();
		if (checkEmpty(window.location.search)) {
			form_serialize = '?'+form_serialize;
		} else {
			form_serialize = window.location.search+'&'+form_serialize;
		}
		var newUrl = window.location.origin+window.location.pathname+form_serialize;
		update_url(newUrl);
		loadData();
	});
// Load Sắp xếp tại bảng listdata
	$('body').on('click', '*[data-order_by]', function(e) {
		e.preventDefault();
		order_by 		= $(this).data('order_by');
		order_fields 	= $(this).data('order_fields');
		if (order_by == 'desc') {
			$(this).data('order_by', 'asc');
		} else {
			$(this).data('order_by', 'desc');	
		}
		pushOrUpdate({
			order_fields: order_fields,
			order_by: order_by,
		});
		loadData();
	});

// Load phân trang tại bảng listdata
	$('body').on('click', '#listdata .pagination a.page-link', function(e) {
		e.preventDefault();
		href = $(this).attr('href');
		page = getUrlParameter(href, 'page');
		pushOrUpdate({ page: page, });
		loadData();
	});

// Hành động checkall và uncheckall
	$('body').on('change', '.checkall', function(e) {
		$checkall = $(this).is(':checked');
		$(this).closest('#listdata').find('.checkone').prop('checked', $checkall);
	});

// Tự động cập nhật nội dung sửa khi chỉ cần đặt data-quick_edit vào input, select, textarea
	$('body').on('change', '*[data-quick_edit]', function(e) {
		e.preventDefault();
		// Giá trị
		value = $(this).val();
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// Trường
		field = $(this).attr('name');
		// Mảng id_array
		id_array = [];
		id_array.push(id);
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
			value 		: value,
			field 		: field,
		};
		loadAjaxPost('/'+admin_dir+'/ajax/quick_edit', data, {
			beforeSend: function(){},
	        success:function(result){
	        	if (result.status == 1) {
	        		alertText(result.message);
	        	} else {
	        		alertText(result.message, 'warning');
	        	}
	        },
	        error: function (error) {}
		});
	});

// Tự động cập nhật ghim khi chỉ cần đặt data-pin_edit vào input, select, textarea
	$('body').on('change', '*[data-pin_edit]', function(e) {
		e.preventDefault();
		// Giá trị
		value = $(this).val();
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// Trường
		place = $(this).attr('name');
		// Mảng id_array
		id_array = [];
		id_array.push(id);
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
			value 		: value,
			place 		: place,
		};
		loadAjaxPost('/'+admin_dir+'/ajax/quick_pin_edit', data, {
			beforeSend: function(){},
	        success:function(result){
	        	console.log(result);
	        	if (result.status == 1) {
	        		alertText(result.message);
	        	} else {
	        		alertText(result.message, 'warning');
	        	}
	        },
	        error: function (error) {}
		});
	});
	// Quick edit trang thai
	$('body').on('change', '#listdata .form-switch input', function(e){
		e.preventDefault();
		if($(this).is(':checked')){
			value = 1;
		}else{
			value = 0;
		}
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// Trường
		field = $(this).attr('name');
		// Mảng id_array
		id_array = [];
		id_array.push(id);
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
			value 		: value,
			field 		: field,
		};
		loadAjaxPost('/'+admin_dir+'/ajax/quick_edit', data, {
			beforeSend: function(){},
	        success:function(result){
	        	console.log(result);
	        	if (result.status == 1) {
	        		alertText(result.message);
	        	} else {
	        		alertText(result.message, 'warning');
	        	}
	        },
	        error: function (error) {}
		});
	});
// Xóa khi click icon
	$('body').on('click', '*[data-quick_delete]', function(e) {
		e.preventDefault();
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// mảng id_array
		id_array = [];
		id_array.push(id);
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
		};
		if (confirm( $(this).data('message') )) {
			loadAjaxPost('/'+admin_dir+'/ajax/quick_delete', data, {
				beforeSend: function(){},
		        success:function(result){
		        	if (result.status == 1) {
		        		alertText(result.message);
		        		loadData('no_action');
		        	} else {
		        		alertText(result.message, 'warning');
		        	}
		        },
		        error: function (error) {}
			});
		}
	});

	$('body').on('click', '*[data-delete_forever]', function(e) {
		e.preventDefault();
		// Bảng
		const _this = $(this)
		const table = _this.closest('*[data-table]').data('table')
		const id = _this.data('id')
		// Chuẩn hóa data
		const data = {
			_method 	: 'DELETE',
			id,
			table
		};
		if (confirm( $(this).data('message') )) {
			loadAjaxPost('/'+admin_dir+'/'+table+'/delete-forever/'+id, data, {
				beforeSend: function(){},
		        success:function(result){
		        	if (result.status == 1) {
		        		alertText(result.message);
		        		loadData('no_action');
		        	} else {
		        		alertText(result.message, 'warning');
		        	}
		        },
		        error: function (error) {}
			});
		}
	});

// Xóa nhưng dùng controller để custom
	$('body').on('click', '*[data-delete_custom]', function(e) {
		e.preventDefault();
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// Chuẩn hóa data
		data = {
			_method 	: 'DELETE'
		};
		if (confirm( $(this).data('message') )) {
			loadAjaxPost('/'+admin_dir+'/'+table+'/'+id, data, {
				beforeSend: function(){},
		        success:function(result){
		        	if (result.status == 1) {
		        		alertText(result.message);
		        		loadData('no_action');
		        	} else {
		        		alertText(result.message, 'warning');
		        	}
		        },
		        error: function (error) {}
			});
		}
	});

// Lấy lại bản ghi
	$('body').on('click', '*[data-quick_restore]', function(e) {
		e.preventDefault();
		// Bảng
		table = $(this).closest('*[data-table]').data('table');
		// id
		id = $(this).closest('*[data-id]').data('id');
		// mảng id_array
		id_array = [];
		id_array.push(id);
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
		};
		loadAjaxPost('/'+admin_dir+'/ajax/quick_restore', data, {
			beforeSend: function(){},
	        success:function(result){
	        	if (result.status == 1) {
	        		alertText(result.message);
	        		loadData('no_action');
	        	} else {
	        		alertText(result.message, 'warning');
	        	}
	        },
	        error: function (error) {}
		});
	});

// Cập nhật toàn bộ giá trị trong bảng
	$('body').on('click', '*[data-action_all]', function(e) {
		e.preventDefault();
		e = $(this);
		// Giá trị
		value = $(this).parents('.box-action').find('select[data-action]').val();
		if(value == -2){
			alertText('Vui lòng chọn hành động', 'warning');
			return false;
		}
		// Bảng
		table = $(this).data('table');
		// Trường
		field = $('select[data-action]').data('field');
		// Mảng id_array
		id_array = [];
		e.closest('#listdata').find('.checkone:checked').each(function() {
			id = $(this).closest('*[data-id]').data('id');
			id_array.push(id);
		});
		// Chuẩn hóa data
		data = {
			table 		: table,
			id_array 	: id_array,
			value 		: value,
			field 		: field,
		};
		loadAjaxPost('/'+admin_dir+'/ajax/quick_edit', data, {
			beforeSend: function(){},
	        success:function(result){
	        	if (result.status == 1) {
	        		alertText(result.message);
	        		// Tải lại dữ liệu tại bảng
	        		loadData('no_action');
	        		// bỏ check nút chọn tất cả
					e.closest('#listdata').find('.checkall').prop('checked', false);
	        	} else {
	        		alertText(result.message, 'warning');
	        	}
	        },
	        error: function (error) {}
		});
	});

// media action
	$('body').on('click', '*[data-image]', function(e) {
		e.preventDefault();
		url_media = $(this).data('image');
		$('#media').find('iframe').attr('src', url_media);
		$('#media').modal('toggle');
	});
	$("#media").on("hidden.bs.modal", function () {
	    $('#media').find('iframe').attr('src', '');
	});
	$('body').on('click', '*[data-delete_nocomfirm]', function(e) {
		e.preventDefault();
		$(this).closest('*[data-delete_box]').remove();
	});
	$('body').on('click', '*[data-delete_comfirm]', function(e) {
		e.preventDefault();
		confirm_text = $(this).data('delete_comfirm');
		if (confirm(confirm_text)) {
			$(this).closest('*[data-delete_box]').remove();	
		}
	});

// Cache clear
	$('body').on('click', '*[data-cache_clear]', function(e) {
		e.preventDefault();
		loadAjaxPost('/'+admin_dir+'/ajax/cache_clear', {}, {
	        beforeSend: function(){},
	        success:function(result){
	        	if (result.status == 1) {
	        		alertText(result.message);
	        	} else {
	        		alertText(result.message, 'error');
	        	}
	        },
	        error: function (error) {}
	    }, 'progress');
	});
});
// close alert
	$('body').on('click', '*[close-alert]', function(e){
		e.preventDefault();
		$(this).hide();
	});
// Load Dữ liệu ListData
// animate: progress | loading | no_action
function loadData(animate='progress') {
	loadAjaxGet(window.location.href, {
        beforeSend: function(){},
        success:function(result){
        	$('#listdata').find('.table-responsive > table.table').find('tbody').html(result.data_html);
			$('#listdata').find('.pagination-sm').html(result.paginate);
			$('#listdata').find('.total').html(result.show_data.total);
			setTimeout(function() {
				$("#listdata").find('.table-responsive').animate({ scrollTop: 0 }, 500);
			}, 200);
        },
        error: function (error) {}
    }, animate);
}
var option = $('input[name="option"]:checked').val();
if(option == 2) {
    $('body').find('#min_order').parent().css('display', 'none');
}
$('body .col-lg-4').on('change', 'input[name="option"]', function(e) {
    option = $('input[name="option"]:checked').val();
    loadAjaxPost('/'+admin_dir+'/vouchers/load_option', { option: option }, {
        beforeSend: function(){},
        success:function(result){
            if (option == 1) {
                $('body').find('#drag_products').css('display', 'none');
                $('body').find('#min_order').parent().css('display', 'block');
                $('body').find('#drag_products').removeClass('check-require');
            } else {
                $('body').find('#min_order').parent().css('display', 'none');
                if($('body').find('#drag_products').length) {
                    $('body').find('#drag_products').css('display', 'block');
                } else {
                    $('body').find('#min_order').parent().after(result)
                }
                $('body').find('#drag_products').addClass('check-require');
            }
        },
        error: function (error) {}
    }, 'progress');
})
if($('input[name="option"]').length) {
    $('body').on('click','button[type=submit]', function(e) {
        if($('body').find('#drag_products.check-require').length) {
            $('#products_input').css('border', '1px solid #ced4da');
            $('#products_box').find('.error').remove();
            if($('input[name="products[]"]').length == 0) {
                e.preventDefault();
                $('#products_box').append(formHelper('Sản phẩm áp dụng không được để trống'));
                $('#products_input').css('border', '1px solid #ff0000');
            }
        }
    });
}
