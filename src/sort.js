/* jQuery file to manipulate sorter.php
 * Team 9, CMPE 226, SJSU, Fall 2014
 * Xiaoli Jiang, Jennifer Wu
 */

$(document).ready(function() {
   	$("label.btn").click(function() {
   		$(this).addClass("active").siblings().removeClass("active");	
   	});

});
