$(function(){
	$('.changebg a').click(function(){
		var i = $(this).index()+1;
		$('body').css('background-image','url(/public/images/bg'+i+'.jpg)');
		$.get('/index/misc/theme_bg?i='+i);
	});
});