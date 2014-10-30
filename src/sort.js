//jQuery to manipulate sorter.php

$(document).ready(function() {
   	$("label.btn").click(function() {
   		$(this).addClass("active").siblings().removeClass("active");	
   	});
});
