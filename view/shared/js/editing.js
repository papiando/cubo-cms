function toSeoUrl(url) {
	return url.normalize('NFD')
		.replace(/[\u0300-\u036f]/g,'')
		.replace(/\s+/g,'-')
		.toLowerCase()
		.replace(/&/g,'-and-')
		.replace(/[^a-z0-9\-]/g,'')
		.replace(/-+/g,'-')
		.replace(/^-*/,'')
		.replace(/-*$/,'');
}
$(document).ready(function() {
	$('select[readonly] option:not(:selected)').attr('disabled',true);
	$('#title').on('change',function() {
		if($('#name').val()=='') {
			$('#name').val(toSeoUrl($(this).val()));
		}
	});
	$('#name').on('change',function() {
		$(this).val(toSeoUrl($(this).val()));
	});
	$(':input:not(.changed)').on('change paste keyup',function() {
		$('#submit').removeAttr('disabled');
		$(this).addClass('changed');
		var name = $(this).attr('name');
		if(name.substr(0,1)=='-') {
			$(this).attr('name',name.substr(1,name.length));
		}
	});
});