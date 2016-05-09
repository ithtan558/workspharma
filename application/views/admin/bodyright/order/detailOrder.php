<h1>Detail order</h1>
<div class="box">
    <div class="heading">
        <div class="buttons"><a class="button" id="cancel" onclick="javascript:submitbutton('cancel');">Exit</a></div>
        <!--<div class="buttons">
            <a class="button" id="save" onclick="javascript:submitbutton('save');">In đơn hàng</a>&nbsp;&nbsp;
        </div>-->
    </div>
    <div class="content">
      <div class="vtabs">
          <a href="#tab-order" class="selected">Thông tin đơn hàng</a>
          <a href="#tab-payment">Chi tiết thanh toán</a>
          <a href="#tab-product">Chi tiết đơn hàng</a>
      </div>
      <div id="tab-order" class="vtabs-content">
      	<form method="post" name="adminForm" id="adminForm" action="<?php echo URL.'order/print_order'?>">
        <input type="hidden" name="url" value="<?php echo $this->uri->segment(2);?>" id="url">
        <input type="hidden" name="idOrder" value="<?php echo $getOrder[0]->idOrder;?>" id="url">
            <table class="table_admin form">
              <tbody>
              <tr class="alt-row">
                <td>Id:</td>
                <td><?php echo $getOrder[0]->code_order;?></td>
              </tr>
              <tr class="alt-row">
                <td>Mã code :</td>
                <td><?php echo $getOrder[0]->postalcode_order;?></td>
              </tr>                  
              <tr class="alt-row">
                <td>Tổng tiền:</td>
                <td><?php echo formatMoney($getOrder[0]->total_order);?></td>
              </tr>
              <tr class="alt-row">
                <td>Trạng thái:</td>
                <td id="order-status"><?php 
                        if($getOrder[0]->enable_order==1)
                        echo 'Hoàn thành';
                        else
                        echo 'Đang chờ xử lý';
                    ?></td>
              </tr>
              <tr class="alt-row">
                <td>Ngày:</td>
                <td><?php echo date('d-m-Y',strtotime($getOrder[0]->date_update_order))?></td>
              </tr>
            </tbody></table>
        </form>
      </div>
      <div id="tab-payment" class="vtabs-content" style="display: none;">
        <table class="form">
          <tbody><tr>
            <td>Tên :</td>
            <td><?php echo $getOrder[0]->fullname_order?></td>
          </tr>
          <tr class="alt-row">
            <td>Email:</td>
            <td><?php echo $getOrder[0]->email_order?></td>
          </tr>
          <tr class="alt-row">
            <td>Địa chỉ 1 :</td>
            <td><?php echo $getOrder[0]->address1_order?></td>
          </tr>
          <tr class="alt-row">
            <td>Địa chỉ 2 :</td>
            <td><?php echo $getOrder[0]->address2_order?></td>
          </tr>
          <tr class="alt-row">
            <td>Điện thoại:</td>
            <td><?php echo $getOrder[0]->phone_order?></td>
          </tr>
          
        </tbody></table>
      </div>
      <div id="tab-product" class="vtabs-content" style="display: none;">
        <table class="form table_admin list">
          <thead>
            <tr>
              <td class="left">Tên dịch vụ</td>
              <td class="left">Mã code</td>
              <td class="left">Hình ảnh</td>
              
              <td class="left">Giá hiện tại</td>
              <td class="left">Giá khuyến mãi</td>
              <td class="left">Số lượng</td>
              <td class="left">Tổng tiền</td>
            </tr>
          </thead>
          <tbody>
              <?php
              $grand_total = 0;
              foreach($getOrder as $order)
              {
              ?>
              <tr class="alt-row">
                  <td class="left"><a href=""><?php echo $order->name_products?></a>
                  </td>
                  <td class="left"><?php echo $order->code_products;?></td>
                  <td align="center">
                  <img width="50" height="50" src="<?php echo IMAGES.'products/'.$order->thumb_products;?>" />
                  </td>
                  <td>
				  <?php 
						echo formatMoney($order->price_products);
					?>
					</td>
                    <td>
				  <?php 
					if($order->is_sale_products!=0 && $order->is_sale_products!='')
					{
							echo formatMoney($order->is_sale_products);
					}
					else
					{
						echo formatMoney($order->price_products);
					}
					?>
					</td>
                  <td class="right"><?php echo $order->quantily_detail_order;?></td>
                  <td class="right"><?php echo formatMoney($order->total_detail_order);?></td>
              </tr>
              <?php
              $grand_total+=$order->total_detail_order;
              }
              ?>
            </tbody>
            <tbody id="totals">
            <tr>
              <td  style="color:#F00;" colspan="6" class="right">Thành tiền::</td>
              <td  style="color:#F00;" class="right"><?php echo formatMoney($grand_total);?></td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>