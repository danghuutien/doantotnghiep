url = window.location.href;
url_not_param = window.location.origin+window.location.pathname;

uploads = getUrlParameter(url,'uploads');

$(document).ready(function() {
	// Load ảnh khi mới tải trang
	loadImageLoading(url);
	
	// click vào 1 box item ảnh
	$('body').on('click','.media-content__main-list .item',function() {
		if ($(this).hasClass('upload_waiting')) return false;
		if ($(this).hasClass('uploading')) return false;
		if ($(this).hasClass('upload_success')) return false;
		if ($(this).hasClass('upload_fail')) return false;
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			setDetailEmpty();
		} else {
			if (uploads != 'multiple') {
				$('.media-content__main-list .item').removeClass('active');
			}
			$(this).addClass('active');
			// Lấy giá trị hiển thị cho box thông tin ảnh
			id = $(this).data('id');
			url_file = $(this).data('url');
			image = $(this).data('image');
			name = $(this).data('name');
			size = $(this).data('size');
			created = $(this).data('created');
			updated = $(this).data('updated');
			title = $(this).data('title');
			caption = $(this).data('caption');
			data = {
				id: id,
				url_file: url_file,
				image: image,
				name: name,
				size: size,
				created: created,
				updated: updated,
				title: title,
				caption: caption,
			}
			setDetail(data);
		}
	});
	// Hành động liên quan đến ảnh
	/* Tìm kiếm tên ảnh */
	$('body').on('click','*[data-search_btn]',function(e) {
		e.preventDefault();
		keyword = $('input[name=keyword]').val();
		pushOrUpdate({
			name: keyword
		})
		loadImageLoading(window.location.href);
	});

	/* Xóa ảnh */
	$('body').on('click','#check_delete',function() {
		id = $(this).data('id');
		data_model = {
			title: delete_title,
			text: delete_comfirm,
			footer: '<button type="button" class="btn btn-media btn-active" data-delete_image data-id="'+id+'">'+text_delete+'</button><button type="button" class="btn btn-media" data-dismiss="modal">'+text_no+'</button>',
		}
		loadModal(data_model);
	});
	$('body').on('click','*[data-delete_image]',function() {
		id = $(this).data('id');
		$("#modal-comfirm").modal('hide');
		item_box = $('.item[data-id='+id+']');

		formData = {
			'_token': $('meta[name="csrf-token"]').attr('content'),
			'_method':'DELETE',
			'id':id,
		};
		LoadAjaxPost(url_not_param+'/'+id,formData,{
			beforeSend: function(){
				item_box.addClass('uploading');
			},
	        success:function(result){
	        	item_box.fadeOut(function() {
					$(this).remove();
					checkEmptyImage();
				});
	        },
	        error: function (error) {}
		});
	});
	/* Cập nhật ảnh: tiêu đề và mô tả */
	$('body').on('click','#save_info_image',function() {
		id = $(this).data('id');
		title = $(this).parent().children('input[name=title]').val();
		caption = $(this).parent().children('textarea[name=caption]').val();
		// Nếu title hoặc caption trống thì sẽ không hiển thị
		$('.item[data-id='+id+']').data('title',title);
		$('.item[data-id='+id+']').data('caption',caption);
		if (title != '') {
			$('.item[data-id='+id+']').find('.item-info__title').css('display','block').html(text_title+': '+title);
		} else {
			$('.item[data-id='+id+']').find('.item-info__title').css('display','none').html(null);
		}
		if (caption != '') {
			$('.item[data-id='+id+']').find('.item-info__caption').css('display','block').html(text_desc+': '+caption);
		} else {
			$('.item[data-id='+id+']').find('.item-info__caption').css('display','none').html(null);
		}
		formData = {
			'_token': $('meta[name="csrf-token"]').attr('content'),
			'_method':'PUT',
			'id':id,
			'title':title,
			'caption':caption,
		};
		// gửi ajax xóa file
		LoadAjaxPost(url_not_param+'/'+id,formData,{
			beforeSend: function(){},
	        success:function(result){
	        	data_model = {
					title: update_title,
					text: update_success,
					close: 'true',
				}
				loadModal(data_model);
	        },
	        error: function (error) {}
		});
	});
	// Bộ lọc
	/* Lọc loại file */
	$('body').on('click','*[data-type="type"]',function(e) {
		e.preventDefault();
		value = $(this).data('value');
		$('*[data-type="type"]').removeClass('active');
		$(this).addClass('active');
		url_load = optimizeUrl(null,null,value);
		loadImageLoading(url_load);
	});
	/* Lọc loại Sắp xếp */
	$('body').on('click','*[data-type="filter"]',function(e) {
		e.preventDefault();
		value = $(this).data('value');
		$('*[data-type="filter"]').removeClass('active');
		$(this).addClass('active');
		url_load = optimizeUrl(null,value,null);
		loadImageLoading(url_load);
	});
	/* load lại trang và refresh bộ lọc */
	$('body').on('click','*[data-reload]',function() {
		loadImageLoading(optimizeUrl(null,null,null));
	});

	// Up ảnh và load ảnh
	/* Người dùng click để chọn file */
	$('#file').on('change', function() {
		file = this.files;
		upload_file(file);
	});
	/* người dùng kéo thả file */
	$('.media-content__main-list__upload')
	.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
		e.preventDefault();
		e.stopPropagation();
	})
	.on('dragover dragenter', function() {
		$('.media-content__main-list__upload').addClass('upload_active');
	})
	.on('dragleave dragend drop', function() {
		$('.media-content__main-list__upload').removeClass('upload_active');
	})
	.on('drop', function(e) {
	    droppedFiles = e.originalEvent.dataTransfer.files;
	    upload_file(droppedFiles);
	});
	/* Load ảnh phân trang */
	$('.media-content__main-pagination').on('click','a.page-link',function(e) {
		e.preventDefault();
		href = $(this).attr('href');
		page = getUrlParameter(href,'page');
		url_load = optimizeUrl(page,null,null);
		loadImageLoading(url_load);
	});

	// Chèn ảnh (Tương tác với Trang)
	$('body').on('click','*[data-insert]',function() {
		type = getUrlParameter(url,'uploads');
		field_id = getUrlParameter(url,'field_id');
		switch(type) {
			// Chỉ thay đổi src của thẻ ảnh
			case 'direct': 
				$('.item.active').each(function(index) {
					name = $(this).data('name');
					url_file = $(this).data('url');
					image = $(this).data('image');
					created_at = $(this).data('created_at');
					window.parent.$('#'+field_id).attr('src',image);
					window.parent.$('#input-'+field_id).val(url_file);
				});
			break;
			// Up 1 ảnh
			case 'single': 
				$('.item.active').each(function(index) {
					name = $(this).data('name');
					url_file = $(this).data('url');
					image = $(this).data('image');
					created_at = $(this).data('created_at');
					window.parent.$('#'+field_id+'_box').empty().append('<div class="item" data-delete_box><img src="'+image+'" alt=""><input type="hidden" value="'+url_file+'" name="'+field_id+'"><span class="item-delete" data-delete_noremove><i class="fa fa-trash"></i></span></div>');
					window.parent.$('#'+field_id+'_box').find('.error').remove();
				});
			break;
			// Up nhiều ảnh
			case 'multiple':
				$('.item.active').each(function(index) {
					name = $(this).data('name');
					url_file = $(this).data('url');
					image = $(this).data('image');
					created_at = $(this).data('created_at');
					window.parent.$('#'+field_id+'_box').append('<div class="item" data-delete_box><img src="'+image+'" alt=""><input type="hidden" value="'+url_file+'" name="'+field_id+'[]"><span class="item-delete" data-delete_nocomfirm><i class="fa fa-trash"></i></span></div>');
					window.parent.$('#'+field_id+'_box').find('.error').remove();
				});
			break;
			// Up ảnh vào tinyMCE
			case 'editor': 
				$('.item.active').each(function(index) {
					image = $(this).data('image');
					title = $(this).data('title');
					caption = $(this).data('caption');
					
					str = '<div class="tubo-media-item">';
					str += '<img src="'+image+'" alt="'+title+'">';
                    if(caption != '') {
                        str += '<p>'+caption+'</p>';
                    }
                    str += '</div><p></p>';
                    window.parent.tinyMCE.get(field_id).execCommand("mceInsertContent",false,str);
				});
			break;
		}
		window.parent.$('#media .close').click();
	});
});
// function chỉ dùng cho ảnh
/*
	trả về box thông tin có dữ liệu ảnh
	data = {
		id: id,
		image: image,
		name: name,
		size: size,
		created: created,
		updated: updated,
		title: title,
		caption: caption,
	}
*/
function setDetail(data) {
	str = '<p class="image_name">'+data.name+'</p><p>'+text_size+': '+data.size+'</p><p>'+text_created+': '+data.created+'</p><p>'+text_updated+': '+data.updated+'</p><input type="text" name="title" value="'+data.title+'" placeholder="'+text_title+'"><textarea rows="2" name="caption" placeholder="'+text_desc+'">'+data.caption+'</textarea><button type="button" class="btn btn-media btn-active" data-id="'+data.id+'" id="save_info_image">'+text_save+'</button><button type="button" class="btn btn-media" data-id="'+data.id+'" id="check_delete">'+text_delete+'</button>';
	$('.media-content__main-detail__thumb').empty().append('<img src="'+data.image+'" alt="">');
	$('.media-content__main-detail__desc').empty().append(str);
}
// trả về box thông tin trống
function setDetailEmpty() {
	$('.media-content__main-detail__thumb').empty().append('<i class="fa fa-image"></i>');
	$('.media-content__main-detail__desc').empty().append('<p>'+no_choose_image+'</p>');
}
function checkEmptyImage() {
	if ($('.media-content__main-list .item').length == 0) {
		$('.media-content__main-list').empty().append('<div class="media-content__main-list__upload"><i class="fa fa-cloud-upload icon"></i><label for="file" class="inputfile" files selected">'+no_image+'</label></div>');
	}
}
/*
	Load Box Modal chung
	data = {
		title: upload,
		text: upload_size_fail,
		close: 'true',
		footer: '',
	}
*/
function loadModal(data) {
	$('#modal-comfirm .modal-title').empty().text(data.title);
	$('#modal-comfirm .modal-body').empty().append('<p style="line-height: 22px;">'+data.text+'</p>');
	if (data.close == 'true') {
		$('#modal-comfirm .modal-footer').empty().append('<button type="button" class="btn btn-media btn-active" data-dismiss="modal">'+upload_close+'</button>');
	} else {
		$('#modal-comfirm .modal-footer').empty().append(data.footer);
	}
	$('#modal-comfirm').modal();
}
// Check giá trị tồn tại trong mảng
function in_array(value,arr){
	var status = false;
	for(var i=0; i<arr.length; i++){
		var name = arr[i];
		if(name == value){
		  	status = true;
		  	break;
		}
	}
	return status;
}

// upload ảnh chung
function upload_file(file) {
	check_size = 0; // 0: size hợp lệ | 1: size không hợp lệ
	check_extension = 0; // 0: extension hợp lệ | 1: extension không hợp lệ
	$.each(file,function(index,file_data) {
		if (file_data.size > max_size_file) {
			check_size = 1;
		}
		extension = file_data.name.substr( (file_data.name.lastIndexOf('.') +1) );
		allowed_image = allowed_extension_image.split(',');
		allowed_file = allowed_extension_file.split(',');
		allowed_array = $.merge(allowed_image, allowed_file);
		if (!in_array(extension, allowed_array)) {
			check_extension = 1;
		}
	});
	if (check_size == 1) {
		data_model = {
			title: upload,
			text: upload_size_fail,
			close: 'true',
		}
		loadModal(data_model);
		$('#file').val('');
	} else if(check_extension == 1) {
		text = upload_ext_fail+': '+allowed_extension_image+','+allowed_extension_file;
		data_model = {
			title: upload,
			text: text,
			close: 'true',
		}
		loadModal(data_model);
		$('#file').val('');
	} else {
		count = file.length;
		if ($('.media-content__main-list__upload').length > 0) {
			$('.media-content__main-list').empty();
		}
		if (count > 0) {
			$.each(file,function(index,file_data) {
				image_preview = URL.createObjectURL(file_data);
				name = file_data.name;
				size = formatSizeUnits(file_data.size);
				time = getCurentTime();
				str = '<div class="item upload_waiting" data-index="'+index+'"><div class="item-image"><img src="'+image_preview+'" alt=""></div><div class="item-info"><p class="item-info__name">'+name+'</p><p class="item-info__size">'+text_size+': '+size+'</p><p class="item-info__created">'+text_created+': '+time+'</p><p class="item-info__updated">'+text_updated+': '+time+'</p><p class="item-info__created">'+uploading+'</p></div></div>';
				$('.media-content__main-list').prepend(str);
			});
			data_error = [];
			id_success = [];
			$.each(file,function(index,file_data) {
				var form_data = new FormData();
				form_data.append('files', file_data);
				$.ajax({
					headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
			        type: 'POST',
			        url: url,
			        data: form_data,
			        enctype: 'multipart/form-data',
			        processData: false,
			        contentType: false,
			        beforeSend: function(){
			        	// 4 trạng thái: upload_waiting, uploading, upload_success, upload_fail
			        	$('.item[data-index='+index+']').removeClass('upload_waiting').addClass('uploading');
			        },
		        	success:function(result){
		        		if (result.status == 1) {
		        			$('.item[data-index='+index+']').removeClass('uploading').addClass('upload_success');
		        			id_success.push(result.media_id);
		        		} else {
		        			data_error.push(result.message);
			        		$('.item[data-index='+index+']').removeClass('uploading').addClass('upload_fail');
		        		}
		        	},
		        	error: function (error) {
		        		if (error.responseJSON.message) {
		        			text = error.responseJSON.message;
		        		} else {
		        			text = error.responseText;
		        		}
		        		data_error.push(text);
		        		$('.item[data-index='+index+']').removeClass('uploading').addClass('upload_fail');
		        	}
		        });
			});

			// check ajax load xong mới load lại phần tử
			load_ajax = false;
			$(document).ajaxStop(function() {
				load_ajax = true;
			});
			load_interval = setInterval(function() {
				if (load_ajax == true) {
					setTimeout(function() {
						loadImage(optimizeUrl());
						// Thêm xong sẽ chọn ảnh
						if (id_success.length > 0) {
							setTimeout(function() {
								type = getUrlParameter(url,'uploads');
								choose_one = true;
								if (type == 'multiple') {
									choose_one = false;
								}
								if (choose_one == true) {
									$('.item[data-id='+id_success[id_success.length-1]+']').click();
								} else {
									$.each(id_success, function(index, item) {
										$('.item[data-id='+item+']').click();
									});
								}
							}, 1000);
						}
					}, 2000);
					load_ajax = false;
					clearInterval(load_interval);

					if (data_error.length > 0) {
						str_error = '';
						$.each(data_error, function(index, item) {
							str_error += item+'<br>';
						});
						data_model = {
							title: 'Upload Fail',
							text: str_error,
							close: 'true',
						}
						loadModal(data_model);
					}
				}
			});
		}
		$('#file').val('');
	}
}
function loadImage(url_load) {
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: url_load,
        beforeSend: function(){},
        success:function(result){
        	history.pushState(null, null, url_load);
        	setLoadFile(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            alert('Có lỗi xảy ra!');
        }
    });
}

function loadImageLoading(url_load) {
	loadAjaxGet(url_load,{
		beforeSend: function(){},
        success:function(result){
        	history.pushState(null, null, url_load);
			setLoadFile(result);
		},
		error: function (error) {}
	});
}

function setLoadFile(result) {
	$('.media-content__main-list').empty().append(result.data);
	$('.media-content__main-pagination').empty().append(result.paginate);
	setDetailEmpty();
}
/* 
	Hàm trả về url load ajax
	page: số trang cần lấy nếu để null thì sẽ lấy page trên url hiện tại
	filter: bộ lọc cần lấy nếu để null thì sẽ lấy filter trên url hiện tại
	type: loại file cần lấy nếu để null thì sẽ lấy type trên url hiện tại
*/
function optimizeUrl(page,filter,type) {
	// mảng chưa các parame
	param_array = [];
	// tách các param tại url hiện tại
	search = decodeURI(window.location.search).replace('?', '').replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"');
	// obj được tách từ search
	url_param = {};
	// truyền giá trị search vào obj url_param
	if(search != '') {
		url_param = JSON.parse('{"' + search + '"}');
	}
	if (!checkEmpty(page)) {
		url_param.page = page;
	}
	if (!checkEmpty(filter)) {
		url_param.filter = filter;
	}
	if (!checkEmpty(type)) {
		url_param.type = type;
	}
	// Tách obj param và truyền vào mảng param_array
	for (var item in url_param) {
		if (url_param.hasOwnProperty(item)) {
	      param_array.push(encodeURIComponent(item) + "=" + encodeURIComponent(url_param[item]));
	    }
	}
	// Nối các param
	str_param = param_array.join("&");

	url_load = url_not_param+'?'+str_param;
	return url_load;
}