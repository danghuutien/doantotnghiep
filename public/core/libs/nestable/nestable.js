$(document).ready(function() {
	// Ẩn hoặc hiện tất cả nesttabe
	$('body').on('click', '*[data-nestable_action]', function(e) {
		e.preventDefault();
		action = $(this).data('nestable_action');
		id = $(this).attr('href');
		$(id).nestable(action);
	});

	$('body').on('click', '*[data-nestable_remove]', function(event) {
		event.preventDefault();
		id_name = $(this).closest('.dd').attr('id');
		$(this).closest('.dd-item').remove();
		$('#'+id_name).change();
	});

	$('body').on('click', '*[data-nestable_edit]', function(event) {
		event.preventDefault();
		$(this).closest('.dd-item').children('.dd-collape').slideToggle('fast');
	});

	$('body').on('click', '.menu-submit',function(event) {
		event.preventDefault();
		type = $(this).data('type');
		id_name = $(this).data('name');
		name = $(this).closest('.card-body').find('.menu-name').val();
		link = $(this).closest('.card-body').find('.menu-link').val();
		target = $(this).closest('.card-body').find('.menu-target').val();
		rel = $(this).closest('.card-body').find('.menu-rel').val();
		data = {
			type: type,
			name: name,
			link: link,
			target: target,
			rel: rel
		};
		switch(type) {
			case 'custom_link':
				html = generateMenu(data);
			break;
			case 'fix_link':
				html = generateMenu(data);
			break;
			case 'table_link':
				table = $(this).closest('.card-body').find('.menu-table').val();
				id = $(this).closest('.card-body').find('.menu-link option:selected').data('id');
				if (!checkEmpty(table)) { data.table = table; }
				if (!checkEmpty(id)) { data.id = id; }
				html = generateMenu(data);
			break;
		}
		$('#'+id_name).children('.dd-list').append(html);
		$('#'+id_name).change();
		$(this).closest('.card-body').find('input.menu-name').val('');
		$(this).closest('.card-body').find('input.menu-link').val('');
		$(this).closest('.card-body').find('select.menu-link').prop('selectedIndex',0);
		$(this).closest('.card-body').find('select.menu-target').prop('selectedIndex',0);
		$(this).closest('.card-body').find('select.menu-rel').prop('selectedIndex',0);
	});
});

function changeMenu(element) {
	array_class = ['name','link','target','rel'];

	$.each(array_class, function(index, item) {
		$('body').on('change keyup', element+' .menu-'+item ,function() {
			value = $(this).val();
			if (item == 'link') {
				id = $(this).find('option:selected').data('id');
				if (!checkEmpty(id)) {
					$(this).closest('.dd-item').attr('data-id', id).data('id', id);
					console.log('change');
				}
			}
			$(this).closest('.dd-item').attr('data-'+item, value).data(item, value)
	    	$(element).change();
	    });
	});
}

function generateMenu(data) {
	data_attribute = '';
	$.each(data, function(index, value) {
		data_attribute += `data-${index}="${value}" `
	});
	html = `<li class="dd-item" ${data_attribute}>
        <div class="dd-handle">
        	<div class="dd-title">${data.name}</div>
        </div>
    	<div class="dd-action">
    		<button type="button" class="remove" data-nestable_remove><i class="fas fa-trash"></i></button>
    	</div>
    </li>`;
    return html;
}