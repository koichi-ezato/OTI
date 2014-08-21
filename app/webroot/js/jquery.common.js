$(function(){
	var aTags = $('a');
	aTags.each(function(){
		var url = $(this).attr('href');
		if((url !== undefined) && ($(this).attr('target') !== '_blank')){
			if(url.substr(0,1) !== "#"){
				$(this).removeAttr('href');
				$(this).click(function(){
					location.href = url;
				});
			}
		}
	});
	$(document).on('swipeleft','#container',function(){
		if($('.ui-page-active').jqmData('panel') !== 'open'){
			$('#panel').panel('open');
		}
	});
});
function checkZeroDivide(val){
	if(!isFinite(val) || isNaN(val)) {
		return 0;
	} else {
		var keta = 100;
		val = val * keta;
		val = Math.round(val);
		val = val / keta;
	}
	return val;
}
