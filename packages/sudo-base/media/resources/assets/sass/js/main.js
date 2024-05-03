$(document).ready(function() {
	// Đổi giao diện theme Dark Light
	$('body').on('click','*[data-toggle_theme]',function() {
		theme = $(this).closest('body').data('theme');
		if (theme == 'dark') {
			$(this).closest('body').attr('data-theme','light');
			$(this).closest('body').data('theme','light');
			$(this).find('i').removeClass('fa-sun-o').addClass('fa-moon-o');
			setLocalStorage('tubo_media_theme','light');
		} else {
			$(this).closest('body').attr('data-theme','dark');
			$(this).closest('body').data('theme','dark');
			$(this).find('i').removeClass('fa-moon-o').addClass('fa-sun-o');
			setLocalStorage('tubo_media_theme','dark');
		}
	});
	if (checkEmpty(getLocalStorage('tubo_media_theme'))) {
		$('*[data-toggle_theme]').find('i').removeClass('fa-sun-o').addClass('fa-moon-o');
	} else {
		theme = getLocalStorage('tubo_media_theme');
		if (theme == 'dark') {
            $('*[data-toggle_theme]').find('i').removeClass('fa-moon-o').addClass('fa-sun-o');
        } else {
            $('*[data-toggle_theme]').find('i').removeClass('fa-sun-o').addClass('fa-moon-o');
        }
	}

	// Đổi dạng hiển thị của List Image
	$('body').on('click','*[data-view_type]',function() {
		view = $(this).data('view_type');
		if (view == 'burger') {
			$('*[data-view_type]').removeClass('active');
			$(this).addClass('active');
			$('.media-content__main-list').removeClass('list').addClass(view);
			setLocalStorage('tubo_media_view',view);
		} else if (view == 'list') {
			$('*[data-view_type]').removeClass('active');
			$(this).addClass('active');
			$('.media-content__main-list').removeClass('burger').addClass(view);
			setLocalStorage('tubo_media_view',view);
		}
	});

	// check footer
	if ($('.media-footer').length == 0) {
		$('.media-content').addClass('no-footer');
	}

	// data-attribute action
	/* dropdown action */
	$('body').on('click','*[data-dropdown_btn]',function() {
		box = $(this).closest('*[data-dropdown_box]');
		if (box.hasClass('active')) {
			box.removeClass('active').find('*[data-dropdown_item]').slideUp();
		} else {
			$('*[data-dropdown_box]').removeClass('active').find('*[data-dropdown_item]').slideUp();
			box.addClass('active').find('*[data-dropdown_item]').slideDown();
		}
	});

	$('body').on('click','*[data]',function() {});
});

$(document).bind('click',function(e) {
	var clicked = $(e.target);
	if (!clicked.closest('.dropdown').hasClass('active')) {
        $('*[data-dropdown_box]').removeClass('active').find('*[data-dropdown_item]').slideUp();
    }
});