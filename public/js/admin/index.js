$(document).ready(function(e) {
	$('.select-submit').change(function(){
		$(this).parents('form').submit();
	});
	/*datepicker*/
	$("#datepicker" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	  yearRange: "1930:2020"
	});
	$("#datepicker1" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	  yearRange: "1930:2020"
	});
/*end datepiker*/
	var URL=$("#base_url").val();
	//datatables
	var oTable = $('.datatables').DataTable({
            "bJQueryUI": true,
            "bProcessing": true,
            "bRedraw": true,
            "aaSorting": [[0, "asc"]],
			'iDisplayLength': 50
    });
	//end datatables
	//tab jquery
	$('.vtabs a').tabs();
	//end tab jquery
	/*popup*/
	/*$("#insert_images").live("click",function(e){
		e.preventDefault();
		//centering with css
		centerPopup_insert_images();
		//load popup
		loadPopup_insert_images();
		
	});
	//Click out event!
	$("#backgroundPopup").live("click",function(){
		disablePopup_insert_images();
	});*/
	/*end popup*/
});
/*submit btn delete*/
function submitbuttondelete(action){
	var r = confirm("Bạn có chắc chắn muốn xóa!");
    if (r == true) {
        $(this).submit();
    }
}
/*end submit btn delete*/
/*function save*/
function submitbutton(action){
	var URL=geturl();
	var url=$("#url").val();
	if(action=='cancel')
	{
		window.location.href=URL+'admin/'+url;
	}
	else
	{
		$("#t").val(action);
		$("#adminForm").submit();
	}
}

function submitOrdering(id,stt,action){
	$("#stt").val(stt);
	$("#t").val(id);
	var URL=geturl();
	$('#from-admin').attr('action', URL+'admin/'+action);
	//alert(URL+'admin/'+action);
	$('#from-admin').submit();
}

function submitOrderingSub(id,stt,catid,action){
	$("#catid").val(catid);
	$("#stt").val(stt);
	$("#t").val(id);
	var URL=geturl();
	$('#from-admin').attr('action', URL+'admin/'+action);
	$('#from-admin').submit();
}
/*end function save*/
/*function save*/
function geturl(){
	var URL=$("#base_url").val();
	return URL;
}
$.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = $(this); 
		
		$(obj.attr('href')).hide();
		
		$(obj).click(function() {
			$(selector).removeClass('selected');
			
			$(selector).each(function(i, element) {
				$($(element).attr('href')).hide();
			});
			
			$(this).addClass('selected');
			
			$($(this).attr('href')).show();
			
			return false;
		});
	});

	$(this).show();
	
	$(this).first().click();
};

/*checkbox delete tat ca*/
	function toggle(source){
		checkboxes=document.getElementsByName('delete[]');
		for(var i=0,n=checkboxes.length;i<n;i++){
		checkboxes[i].checked=source.checked;
		}
	}
/*end checkbox delete tat ca*/

/*checkbox add product typcial*/
	function toggle_add(source){
		checkboxes=document.getElementsByName('add[]');
		for(var i=0,n=checkboxes.length;i<n;i++){
		checkboxes[i].checked=source.checked;
		}
	}
/*end add product typcial*/


/*popup*/
/*var popupStatus_insert_images = 0;
//loading popup with jQuery magic!_ add website
function loadPopup_insert_images(){
	//loads popup only if it is disabled
	if(popupStatus_insert_images==0){
		$("#backgroundPopup").css({
			"background":"black"
		});
		$("#backgroundPopup").fadeIn(500);
		$("#insert_images").fadeIn(500);
		popupStatus_insert_images = 1;
	}
}
function loadbackgroundPopup(){
	if(popupStatus_insert_images==0){
		$("#backgroundPopup").css({
			"opacity": "0.5"
		});
		$("#backgroundPopup").fadeIn(500);
		setTimeout(function(){$("#backgroundPopup").hide(500)},3000)
	}
}
//disabling popup with jQuery magic!
function disablePopup_insert_images(){
	//disables popup only if it is enabled
	if(popupStatus_insert_images==1){
		$("#backgroundPopup").fadeOut(500);
		$("#insert_images").fadeOut(500);
		popupStatus_insert_images = 0;
	}
}
//centering popup
function centerPopup_insert_images(){
	//request data for centering
	//centering
	$("#insert_images").css({
		"position": "fixed",

	});
}*/
/*end popup*/