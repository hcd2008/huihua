Number.prototype.round=Number.prototype.toFixed;
$(function(){

if($.datepicker){
	$(".datainput").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText+' 03:00:00');} });
} 

});