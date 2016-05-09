<h1>Edit order</h1>
<div class="box">
    <div class="heading">
      <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Thoát</a></div>
      <div class="buttons"><a class="button" id="save" onclick="javascript:submitbutton('save');">Lưu</a></div>
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Đơn hàng</a>
      </div>
      <div id="tab-order" class="vtabs-content">
        <form method="post" id="adminForm" action="<?php echo URL;?>">
            <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
            <input value="<?php echo $getOrder[0]->userid ;?>" id="idUsers" name="idUsers" type="hidden">
            <input value="<?php echo $getOrder[0]->idOrder ;?>" id="idOrder" name="idOrder" type="hidden">
            <table cellpadding="4" cellspacing="4" width="100%">
                <tbody>
                <tr class="alt-row">
                <td>Id:</td>
                <td><?php echo $getOrder[0]->code_order;?></td>
                <input value="<?php echo $getOrder[0]->idOrder;?>" type="hidden" id="idOrder" />
              </tr>
              <tr>
                <td>Code poste:</td>
                <td><?php echo $getOrder[0]->postalcode_order;?></td>
              </tr>
                    <tr>
                        <td style="width: 130px;" valign="top">Tên khách hàng<span class="star">(*)</span></td>
                        <td valign="top">
                            
                            <input name="name_users" class="NormalTextBox" value="<?php echo $getOrder[0]->name_users;?>"  id="name_users" type="text">
                            
                            <font style="font-style:italic;color:#707070">(Example: Nguyễn Văn A)</font>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 130px;" valign="top">Email <span class="star">(*)</span></td>
                        <td>
                            <input name="email_users" value="<?php echo $getOrder[0]->email_users;?>" class="NormalTextBox"  id="email_users" type="text">
                            
                            
                            <br>
                           
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 130px;" valign="top">Địa chỉ<span class="star">(*)</span></td>
                        <td>
                            <input value="<?php echo $getOrder[0]->address_users;?>" class="NormalTextBox" id="address_users" name="address_users" type="text"> 
                        </td>
                    </tr>
                    
                    <tr>
                        <td> Phone</td>
                        <td>
                            <input value="<?php echo $getOrder[0]->phone_users;?>" class="NormalTextBox" id="phone_users" type="text" name="phone_users">
                            
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
              <td class="left">Mã code</td>
              <td class="left">Số lượng</td>
              <td class="left">Tổng tiền</td>
              <td class="left">Thao tác</td>
            </tr>
          </thead>
          <tbody>
              <?php
              $grand_total = 0;
			  $stt=1;
              foreach($getOrder as $order)
              {
              ?>
              <tr class="alt-row">
                  <td class="left"><a href=""><?php echo $order->name_products?></a>
                  </td>
                  <td class="left"><?php echo $order->code_products;?></td>
                  <td class="right"><?php echo $order->quantily_detail_order;?></td>
                  <td class="right"><input type="hidden" value="<?php echo $order->total_detail_order?>" id="total_detail<?php echo $order->idDetailOrder;?>" /><?php echo formatMoney($order->total_detail_order);?></td>
                  <td class="right"><a stt="<?php echo $order->idDetailOrder; ?>" class="button" id="a_delete_products" idOrder="<?php echo $order->orderid?>" idDetailOrder="<?php echo $order->idDetailOrder?>">Xóa</a></td>
              </tr>
              <?php
              $grand_total+=$order->total_detail_order;
			  $stt++;
              }
              ?>
            </tbody>
      </table>
      <table class="form list">
        <tbody id="totals">
            <tr>
              <td  style="color:#F00;" colspan="4" class="right">Tổng tiền::</td>
              <td  style="color:#F00;" class="right"><input type="hidden" value="<?php echo $grand_total?>" id="total" /><span class="total"><?php echo formatMoney($grand_total);?></span></td>
            </tr>
        </tbody>
      </table>
      <table class="list">
        <thead>
          <tr>
            <td class="left" colspan="2">Xin vui lòng nhập mã Code!</td>
          </tr>
        </thead>
        <tr>
            <td><input type="text" name="search_products" id="input_search_products" /></td>
            <td align="center"><a class="button" id="a_search_products">Tìm kiếm</a></td>
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
		<!--click nút search product-->
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
		<!--end click nút search product-->
		
		<!--click nút mua product-->
    	$(".list #a_buy_products").live("click",function(e){
			e.preventDefault();
			var stt = $(this).attr("stt");
			var idOrder = $(this).attr("idOrder");
			var total = $("#total").val();
			var idProducts = $(this).attr("idProducts");
			var price = $(this).attr("price");
			var qty = $("#qty"+stt).val();
			$.post("<?php echo base_url()?>admin/order/addDetailOrder",
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
						alert('Product was purchased earlier so the number is updated.');
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
					}
				}
			},'json');
		})
		<!--end click nút mua product-->
		
		<!--click xóa product đã mua-->
    	$(".list #a_delete_products").live("click",function(e){
			e.preventDefault();
			var stt=$(this).attr("stt");
			var total = $("#total").val();
			var total_detail = $("#total_detail"+stt).val();
			var idOrder = $(this).attr("idOrder");
			var idDetailOrder = $(this).attr("idDetailOrder");
			$.post("<?php echo base_url()?>admin/order/deleteDetailOrder",
			{
				idOrder:idOrder,
				total:total,
				total_detail:total_detail,
				idDetailOrder:idDetailOrder
			},
			function(json){
				if(json.active==1)
				{
					$(".total").html(json.total);
					$("#total").val(json.string_total);
					$(".list a[stt="+stt+"]").parent().parent().fadeTo(400, 0, function () { 
						$(this).remove();
					});
				}
				else
				{
					alert("Order at least 1 product, please select the product you need to buy and then go back to delete this product!");
				}
				
			},'json');
			
			
		})
		<!--end click xóa product đã mua-->
		
		//luu thông tin người dùng và product vào hóa đơn
		$("#adminForm").live("submit",function(e)
		{
			e.preventDefault();
			var idUsers = $("#idUsers").val();
			var idOrder = $("#idOrder").val();
			var name_users = $("#name_users").val();
			var address_users = $("#address_users").val();
			var email_users = $("#email_users").val();
			var phone_users = $("#phone_users").val();
			$.post('<?php echo base_url()?>admin/order/updateInfoCustomer',
			{
				idUsers:idUsers,
				idOrder:idOrder,
				name_users:name_users,
				address_users:address_users,
				phone_users:phone_users,
				email_users:email_users
			},
			function(json){
				if(json.active==1)
				{
					alert("Cập nhật thông tin khách hàng thành công");
					window.open(window.location.pathname,"_self");
				}
				else
				{
					switch (json.msg)
					{
						case 'quanlity':
						alert("Chưa có product nào");
						break;
					}
				}
			},'json');
		});
		//end luu thông tin người dùng và product vào hóa đơn
	});
  </script>
