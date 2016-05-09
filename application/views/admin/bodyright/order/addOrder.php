
<div class="box">
    <div class="heading">
       <h1 style="float:left">Thêm Đặt hàng</h1>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu đơn hàng</a></div>
      <div class="icons" onclick="javascript:submitbutton('cancel');" title=""> 
      	<div class="icon cancel">Thoát</div>
      </div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Đơn hàng</a>
      </div>
      <div id="tab-order" class="vtabs-content">
        <form method="post" id="adminForm" action="">
        <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
        <table cellpadding="4" cellspacing="4" width="100%">
            <tbody>
            	<tr class="alt-row">
                    <td>Id đơn hàng:</td>
                    <td><?php echo $getMaxId['idOrder'];?></td>
                    <input value="<?php echo $getMaxId['idOrder'];?>" type="hidden" id="idOrder" />
                  </tr>
                  <tr>
                    <td>Số hóa đơn:</td>
                    <td><?php echo $getMaxId['code_order'];?><input value="<?php echo $getMaxId['code_order'];?>" type="hidden" id="code_order" /></td>
                  </tr>
                <tr>
                    <td style="width: 130px;" valign="top"> Tên khách hàng <span class="star">(*)</span></td>
                    <td valign="top">
                    
                        <input name="name_users" value="<?php if(isset($name_users)) echo $name_users;?>" class="NormalTextBox"  style="width:400px;" id="name_users" type="text">
                        
                        <font style="font-style:italic;color:#707070">(VD: Nguyễn Văn A)</font>
                    </td>
                </tr>
                <tr>
                    <td style="width: 130px;" valign="top"> Địa chỉ liên hệ <span class="star">(*)</span></td>
                    <td>
                        <input value="<?php if(isset($diachi_users)) echo $diachi_users?>" class="NormalTextBox" style="width:400px;" id="address_users" name="address_users" type="text">
                    </td>
                </tr>
                <tr>
                    <td> Điện thoại di động </td>
                    <td>
                        <input value="<?php if(isset($dienthoai_users)) echo $dienthoai_users?>" class="NormalTextBox" style="width:200px;" id="phone_users" type="text" name="phone_users">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> <font color="#FF0000">Chú ý :</font><strong> Những thông tin trên được sử dụng để sau này chúng tôi sẽ gửi căn cứ vào thông tin đó để liên hệ với bạn.</strong> </td>   
                </tr>                
            </tbody>
        </table>
        
        </form>
      <table class="form table_admin list">
          <thead>
            <tr>
              <td class="left">Tên dịch vụ</td>
              <td class="left">Mã dịch vụ</td>
              <td class="left">Số lượng</td>
              <td class="left">Tổng</td>
              <td class="left">Thao tác</td>
            </tr>
          </thead>
          <tbody>
              <?php
              $grand_total = 0;
			  $listProducts=$this->cart->contents();
			  foreach($listProducts as $products)
			  {
			  ?>
			  <tr class="alt-row">
				  <td class="left"><a href=""><?php echo $products['name']?></a>
				  </td>
				  <td class="left"><?php echo $products['code'];?></td>
				  <td class="right"><?php echo $products['qty'];?></td>
				  <td class="right"><input type="hidden" value="<?php echo $products['qty']*$products['price']?>" id="total_detail<?php echo $products['id'];?>" /><?php echo number_format($products['qty']*$products['price'], 0, '', ',').' VND';?></td>
				  <td class="right"><a stt="<?php echo $products['id'];?>" class="button" id="a_delete_products" idOrder="" idProducts="<?php echo $products['id']?>">Xóa</a></td>
			  </tr>
			  <?php
			  $grand_total+=$products['qty']*$products['price'];
			  }
              ?>
            </tbody>
      </table>
      <table class="form list">
        <tbody id="totals">
            <tr>
              <td  style="color:#F00;" colspan="4" class="right">Thành tiền::</td>
              <td  style="color:#F00;" class="right"><input type="hidden" value="<?php echo $grand_total?>" id="total" /><span class="total"><?php echo formatMoney($grand_total);?></span></td>
            </tr>
        </tbody>
      </table>
      <table class="list">
        <thead>
          <tr>
            <td class="left" colspan="2">Hãy nhập vào mã dịch vụ mà bạn muốn mua ở đây</td>
          </tr>
        </thead>
        <tr>
            <td><input type="text" name="search_products" id="input_search_products" /></td>
            <td><a class="button" id="a_search_products">Tìm kiếm</a></td>
        </tr>
        </tbody>
      </table>
      <br />
      <table class="list listProductSearched">
        
      </table>
     </div>
  </div>
  <script type="text/javascript">
  function numberOnly(myfield, e){
	  var key,keychar;
	  if (window.event){key = window.event.keyCode}
	  else if (e){key = e.which}
	  else{return true}
	  keychar = String.fromCharCode(key);
	  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)){return true}
	  else if (("0123456789").indexOf(keychar) > -1){return true}
	  return false;
	};
  /*
 boxmobi prototype;
 Level 2;
*/ 
    $(document).ready(function(e) {
		<!--click nút search dịch vụ-->
    	$(".list #a_search_products").click(function(e){
			e.preventDefault();
			var keywords = $("#input_search_products").val();
			$.post("<?php echo base_url()?>admin/order/search_products",
			{
				keywords:keywords,
			},
			function(json){
				if(json.active==1)
				{
					$(".listProductSearched").html(json.msg);
				}
			},'json');
		})
		<!--end click nút search dịch vụ-->
		
		<!--click nút mua dịch vụ-->
    	$(".list #a_buy_products").live("click",function(e){
			e.preventDefault();
			var stt = $(this).attr("stt");
			var idOrder = $(this).attr("idOrder");
			var total = $("#total").val();
			var idProducts = $(this).attr("idProducts");
			var price = $(this).attr("price");
			var qty = $("#qty"+stt).val();
			$.post("<?php echo base_url()?>admin/order/addProducts",
			{
				idOrder:idOrder,
				total:total,
				idProducts:idProducts,
				price:price,
				qty:qty
			},
			function(json){
				if(json.active==1)
				{
					if(json.msg=='update')
					{
						alert('dịch vụ đã được mua trước đó vì vậy số lượng được cập nhật lại.');
						window.location.reload();
					}
					else
					{
						$(".table_admin").append(json.msg);				
						$(".total").html(json.total);
						$("#total").val(json.string_total);
					}
					
				}
				else
				{
					switch (json.msg)
					{
						case 'qty' :
						alert("Số lượng bạn cho không còn đủ trong kho!");
						break;
						case 'update' :
						alert("dịch vụ đã được mua trước đó!");
						break;
					}
				}
			},'json');
		})
		<!--end click nút mua dịch vụ-->
		
		<!--click xóa dịch vụ đã mua-->
    	$(".list #a_delete_products").live("click",function(e){
			e.preventDefault();
			var idProducts = $(this).attr("idProducts");
			$.post("<?php echo base_url()?>admin/order/removeProduct",
			{
				idProducts:idProducts
			},
			function(json){
				$(".total").html(json.total);
				$("#total").val(json.string_total);
			},'json');
			$(this).parent().parent().fadeTo(400, 0, function () { 
				$(this).remove();
			});
		})
		<!--end click xóa dịch vụ đã mua-->
		
		/*kiểm tra thông tin người dùng*/
		$("#adminForm").validate({ 
			rules: {
				
				name_users:{
					required: true
				},
				address_users:{
					required: true
				},
				
				phone_users:{
					required: true,
					number:true,
					minlength: 10,
					maxlength: 12
				}
			},
			messages: {
				
				name_users:{
					required: "Bắt buộc nhập",
				},
				address_users:{
					required: "Bắt buộc nhập",
				},
				
				phone_users:{
					required: "Bắt buộc nhập",
					number:"Phải là số",
					minlength: "Nhỏ nhất phải là 10 số",
					maxlength: "Lớn nhất là 11 số"
				}
			}
		});
		//end kiểm tra thông tin người dùng
		//luu thông tin người dùng và dịch vụ vào hóa đơn
		$("#adminForm").live("submit",function(e)
		{
			e.preventDefault();
			var code_order = $("#code_order").val();
			var name_users = $("#name_users").val();
			var address_users = $("#address_users").val();
			var phone_users = $("#phone_users").val();
			var total = $("#total").val();
			$.post('<?php echo base_url()?>admin/order/check_order',
			{
				code_order:code_order,
				name_users:name_users,
				address_users:address_users,
				phone_users:phone_users,
				total:total
			},
			function(json){
				if(json.active==1)
				{
					alert("Lưu đơn hàng thành công");
					window.open('<?php echo base_url()?>/admin/order','_self');
				}
				else
				{
					switch (json.msg)
					{
						case 'quanlity':
						alert("Chưa có dịch vụ nào");
						break;
					}
				}
			},'json');
		});
		//end luu thông tin người dùng và dịch vụ vào hóa đơn
	});
	
	
  </script>

