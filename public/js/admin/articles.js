
$(document).ready(function(e) {
	$("#insert_related_articles").live("click",function(e){
		e.preventDefault();
		$('#popup2').bPopup({
			content:'iframe', //'ajax', 'iframe' or 'image'
			contentContainer:'.content',
			loadUrl:'<?php echo URL.'admin/article/related'?>' //Uses jQuery.load()
		});
	})  
});
