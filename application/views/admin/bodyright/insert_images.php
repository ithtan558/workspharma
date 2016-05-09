<script>
	$(document).ready(function(e) {
		$("#insert_related_articles").click(function(e){
			e.preventDefault();
			$('#popup2').bPopup({
				content:'iframe', //'ajax', 'iframe' or 'image'
				contentContainer:'.content',
				loadUrl:'<?php echo URL.'admin/media_insert_images'?>' //Uses jQuery.load()
			});
		})  
    });
</script>
<!-- get position images -->
<script>
function getPositionImages(position){
	alert(document.URL);
	//$("#fulltext_articles").val(document.URL);
	//CKEDITOR.instances.fulltext_articles.insertText('some text here');
	$("#images").val(document.URL);
	parent.$("#popup2").bPopup().close();
    return false;
}
</script>
<!-- end get position images -->
<div id="popup2" style="width:1000px; height:450px !important;  left: 100px; position: fixed; top: 50px !important; z-index: 9999; opacity: 0; display: none;">
    <span class="button b-close"><span>X</span></span>
    <div class="content"></div>
</div>

<!-- get position images -->
<script>

</script>
<!-- end get position images -->