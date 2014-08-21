$(function(){
	$(document).on('click', '#add', function(){
		if (!confirm("登録します。よろしいですか？")) return false;
	});
	$(document).on('click', '#edit', function(){
		if (!confirm("編集します。よろしいですか？")) return false;
	});
});
