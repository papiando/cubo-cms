$(document).ready(function() {
	$('#filter-text').on('change paste keyup',function() {
		var pattern = new RegExp($(this).val().normalize('NFD'),'i');
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(pattern.test($(this).data('item').title.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').description.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').tags.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').name.normalize('NFD'))) {
				filter = filter & ~1;
			} else {
				filter = filter | 1;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-status').on('change',function() {
		var status = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(status == -1 || status == $(this).data('item').status) {
				filter = filter & ~2;
			} else {
				filter = filter | 2;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-category').on('change',function() {
		var category = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(category == -1 || category == $(this).data('item').category) {
				filter = filter & ~4;
			} else {
				filter = filter | 4;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-language').on('change',function() {
		var language = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(language == -1 || language == $(this).data('item').language) {
				filter = filter & ~8;
			} else {
				filter = filter | 8;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('.table-item').each(function() {
		$('#filter-text').trigger('change');
		$('#filter-status').trigger('change');
		//$('#filter-category').trigger('change');
		//$('#filter-language').trigger('change');
	});
});