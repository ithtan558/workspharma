
<div id="thongbao" style="left: 25%; 
top: 25%; 
z-index:31 !important; 
background:#FFF;
 display:none;
  border-radius: 3px;
-moz-border-radius: 3px;
-weblit-border-radius: 3px;
-o-border-radius: 3px;
box-shadow: 0px 0px 10px -1px rgba(0, 0, 0, 0.5) inset; padding:30px;">
    <h2>Ban quản trị xin thông báo tới các thành viên của mientayads</h2>
    <span class="note">&nbsp;&nbsp;&nbsp;Quá trình nâng cấp hệ thống website đã hoàn thành, có 1 số phần thay đổi như sau</span>
    <form method="post" id="form-thongbao" name="form-thongbao" action="" enctype="multipart/form-data">
        <table align="left">
            <tbody><tr>
                <td colspan="2"><span id="error" style="color:#F00;"></span></td>
            </tr>
            <tr>
                <td align="left"><strong>1. Về tài khoản :</strong> các bạn đăng nhập hệ thống bằng tài khoản <strong>Email</strong> và <strong>mật khẩu</strong> mà đã đăng ký trước đó. <br /><br />Riêng đối với bạn nào nhớ tên đăng nhập mà không nhớ là email mình đăng ký là gì xin vui lòng liên hệ ban quản trị</td>
                
            </tr>
            <tr>
                <td align="left" style="padding-top:15px;"><strong>2. Về những tin đăng của thành viên :</strong> Ban quản trị sẽ hồi phục lại những dử liệu tin đăng củ trong thời gian sớm nhất</td>
            </tr>
            <tr><td><img width="100px" height="100px" src="<?php echo IMAGES?>Mientay_advs logo.png" /><strong>Ban quản trị mientayads.vn trân trọng thông báo!</strong></td>
            </tr>
        </tbody></table>
    </form>
</div>
<script>
var popupStatus_thongbao = 0;
//loading popup with jQuery magic!_ add website
function loadPopup_thongbao(){
	//loads popup only if it is disabled
	if(popupStatus_thongbao==0){
		$("#backgroundPopup").css({
			"background":"black"
		});
		$("#backgroundPopup").fadeIn(500);
		$("#thongbao").fadeIn(500);
		popupStatus_thongbao = 1;
	}
}
function loadbackgroundPopup(){
	if(popupStatus_thongbao==0){
		$("#backgroundPopup").css({
			"opacity": "0.5"
		});
		$("#backgroundPopup").fadeIn(500);
		setTimeout(function(){$("#backgroundPopup").hide(500)},3000)
	}
}
//disabling popup with jQuery magic!
function disablePopup_thongbao(){
	//disables popup only if it is enabled
	if(popupStatus_thongbao==1){
		$("#backgroundPopup").fadeOut(500);
		$("#thongbao").fadeOut(500);
		popupStatus_thongbao = 0;
	}
}
//centering popup
function centerPopup_thongbao(){
	//request data for centering
	//centering
	$("#thongbao").css({
		"position": "fixed",

	});
}
$(document).ready(function(e) {
	//centering with css
	centerPopup_thongbao();
	//load popup
	loadPopup_thongbao();
	
});
//Click out event!
$("#backgroundPopup").live("click",function(){
	disablePopup_thongbao();
});
</script>