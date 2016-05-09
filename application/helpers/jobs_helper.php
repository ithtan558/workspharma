<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_promotion')) {
    function get_promotion($need, $array)
    {
        $result = 0;
        foreach ($array as $k => $v) {
            if ($v->qty == $need) {
                $result = $v->promotion;
            }
        }

        return $result;
    }
}

if ( ! function_exists('in_cart')){
    function in_cart ($need, $cart, $field='id')
    {
        foreach($cart as $k => $v){
            if ($v[$field] == $need) {
                return $v['rowid'];
            }
        }

        return FALSE;
    }
}

if ( ! function_exists('get_payment_method')){
    function get_payment_method ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 1){
            $result = $CI->lang->line('Payment visa');
        }elseif($id == 2){
            $result = $CI->lang->line('Payment ATM');
        }elseif($id == 3){
            $result = $CI->lang->line('Payment transfer');
        }

        return $result;
    }
}

if ( ! function_exists('get_invoice_status')){
    function get_invoice_status ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 2){
            $result = '<span class="span-success">'.$CI->lang->line('Unpaid').'</span>';
        }elseif($id == 1){
            $result = '<span class="span-danger">'.$CI->lang->line('Paid').'</span>';
        }

        return $result;
    }
}

if ( ! function_exists('get_job_status')){
    function get_job_status ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 3){
            $result = '<span class="span-warning">'.$CI->lang->line('Warning').'</span>';
        }elseif($id == 1){
            $result = '<span class="span-danger">'.$CI->lang->line('Active').'</span>';
        }elseif($id == 2){
            $result = '<span class="span-success">'.$CI->lang->line('Disable').'</span>';
        }

        return $result;
    }
}

if ( ! function_exists('get_job_apply_status')){
    function get_job_apply_status ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 1){
            $result = '<span class="span-danger">'.$CI->lang->line('is View').'</span>';
        }elseif($id == 0){
            $result = '<span class="span-success">'.$CI->lang->line('not View').'</span>';
        }

        return $result;
    }
}

if ( ! function_exists('get_city')){
    function get_city ($ids)
    {
        $CI = &get_instance();
        $CI->load->model('cities_model');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';

        if($ids == ''){
            return null;
        }

        $condition = array(
            "cities.id IN ({$ids}) !=" => 0
        );

        $cities = $CI->cities_model->getCities($condition);
        if($cities->num_rows() > 0) {
            foreach ($cities->result() as $item){
                if($result == ''){
                    $result = $item->city_name;
                }else{
                    $result .= ', '.$item->city_name;
                }
            }
        }

        return $result;
    }
}

if ( ! function_exists('has_countdown')){
    function has_countdown($user_id, $service_id)
    {
        $CI = &get_instance();
        $CI->load->model('m_jobs');

        $conditions = array(
            'invoices.user_id' => $user_id,
            'invoices.status' => 1,
            'invoice_details.job_service_id' => $service_id,
            'UNIX_TIMESTAMP(invoice_details.expired_at) >=' => time(),
        );

        $CI->db->select('invoice_details.id, SUM(invoice_details.countdown)');
        $CI->db->from('invoices');
        $CI->db->join('invoice_details', 'invoice_details.invoice_id = invoices.id', 'inner');
        $CI->db->where($conditions);
        $CI->db->having('SUM(invoice_details.countdown) > ', 0);

        $invoice = $CI->db->get();
        if($invoice->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}

if ( ! function_exists('has_expired')){
    function has_expired($user_id, $service_id)
    {
        $CI = &get_instance();
        $CI->load->model('m_jobs');

        $conditions = array(
            'invoices.user_id' => $user_id,
            'invoices.status' => 1,
            'invoice_details.job_service_id' => $service_id,
            'UNIX_TIMESTAMP(invoice_details.expired_at) >=' => time(),
        );

        $CI->db->select('invoice_details.id');
        $CI->db->from('invoices');
        $CI->db->join('invoice_details', 'invoice_details.invoice_id = invoices.id', 'inner');
        $CI->db->where($conditions);

        $invoice = $CI->db->get();
        if($invoice->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}

if ( ! function_exists('update_user_countdown')){
    function update_user_countdown($user_id, $service_id, $countdown, $type = 1){
        $CI 	=& get_instance();
        $CI->load->model('m_jobs');

        $condition =array(
            'invoices.user_id' => $user_id,
            'invoices.status' => 1,
            'invoice_details.job_service_id' => $service_id,
            'invoice_details.countdown > ' => 0,
            'UNIX_TIMESTAMP(invoice_details.expired_at) >=' => time(),
        );
        $order[0] = 'invoice_details.id';
        $order[1] = 'ASC';
        $result = $CI->m_jobs->getUserCountdown($condition, "invoice_details.id, invoice_details.countdown", '', '', $order);

        if($result->num_rows() > 0) {
            $invoice_detail = $result->row();

            if ($type == 1) {
                $countdown_new = $invoice_detail->countdown + $countdown;
            } else {
                $countdown_new = $invoice_detail->countdown - $countdown;
            }
            $data_update = array(
                'countdown' => $countdown_new,
            );

            try {
                $result_update = $CI->m_jobs->updateDetailInvoice(array('id' => $invoice_detail->id), $data_update);
                return $result_update;
            } catch (Exception $e) {
                throw $e;
                return FALSE;
            }
        }
    }
}

if ( ! function_exists('getListCategoryName')) {
    function getListCategoryName($categories = NULL, $comma = ', ')
    {
        $CI =& get_instance();
        $mod = $CI->load->model('skills_model');
        $cat = explode(",", $categories);
        $fields = array('categories.id', 'categories.category_name');
        $condition = array('categories.is_deleted' => 0);
        $list_categories = $CI->skills_model->getCategories($condition, $fields);
        $cnt = count($cat);
        $i = 1;
        $links = "";
        if ($list_categories->num_rows() > 0) {
            foreach ($list_categories->result() as $item) {
                if (in_array($item->id, $cat)) {
                    if ($i != $cnt)
                        $comma = $comma;
                    else
                        $comma = "";
                    $links .= $item->category_name . $comma;
                    $i++;
                }
            }
        }
        return $links;
    }
}

if ( ! function_exists('get_html_order')) {
    function get_html_order($invoice, $invoiceDetail)
    {
        $CI = &get_instance();
        $result = '';

        if (is_object($invoice)) {
            $invoice = get_object_vars($invoice);
        }
        if (is_object($invoiceDetail)) {
            $invoiceDetail = get_object_vars($invoiceDetail);
        }

        if($invoice != null){
            $result = '<table align="center" width="620" style="margin: 0 auto" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="left" height="80">
                                    <table cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td width="200">
                                                    <a href="#" target="_blank">
                                                        <img src="'.image_url('logo_new.png').'" alt="'.site_url().'" border="0" style="float: left; margin-top: 0px; display: block">
                                                    </a>
                                                </td>
                                                <td width="420" style="text-align: right; font-size: 13px">
                                                    <a href="'.site_url().'" style="text-decoration: none; color: #e24b31; font-weight: bold" target="_blank">'.site_url().'</a>
                                                    <br>Dịch vụ khách hàng - Hotline: <strong>(08) 62959925</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center" style="text-align: left; line-height: 40px; font-size: 18px; font-weight: bold; border-bottom: #58585a dotted 1px;">Thông báo đơn hàng từ '.site_url().'</td>
                            </tr>
                            <tr>
                                <td align="center" style="text-align: left; line-height: 40px; font-size: 12px; padding: 14px 0px">
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; line-height: 16px">
                                        Chào <span style="font-weight: bold">'.$invoice["user_name"].'</span>,
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px">
                                        Cảm ơn bạn đã đặt hàng và sử dụng dịch vụ của chúng tôi, dưới đây là thông tin đơn hàng:
                                    </p>

                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">
                                        - Mã đơn hàng:<span style="color: #e24b31; font-weight: bold"> #'. $invoice["id"].'</span>
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Ngày mua hàng: '.date('d/m/Y H:s:i', strtotime($invoice["created_at"])).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Phương thức thanh toán: '. get_payment_method ($invoice["payment_id"]).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Trạng thái đơn hàng: '.get_invoice_status($invoice["status"]).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; margin-top: 20px; line-height: 16px; color: #333; font-size: 16px; font-weight: bold">Chi tiết đơn hàng:</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px"></p>
                                    <table cellpadding="1" cellspacing="1" width="620" style="background: #999999">
                                        <tbody>
                                            <tr height="30">
                                                <td style="background: #ccc; line-height: 16px; width: 320px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Dịch Vụ</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Số lượng</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Đơn giá</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    VAT (10%)</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: right; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Thành tiền</td>
                                            </tr>';

                            foreach($invoiceDetail as $key => $item){
                                $price = $item->price * $item->quantity;
                                $price_vat = $item->fee;
                                $subtotal = $price + $price_vat;

                                $result .= '<tr>
                                                <td style="background: #fff; line-height: 26px; width: 280px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.$item->title.'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: right; margin: 0px; font-size: 12px; padding: 0px 5px">'.$item->quantity.'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($price, "").'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($price_vat, "").'</td>
                                                <td style="background: #fff; color: #e24b31; line-height: 26px; width: 100px; text-align: right; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($subtotal, "").'</td>
                                            </tr>';
                            }

                                $result .= '<tr>
                                                <td colspan="4" style="background: #fff; line-height: 26px; text-align: right; font-weight: bold; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">Tổng tiền</td>
                                                <td style="background: #fff; color: #e24b31; line-height: 26px; width: 100px; text-align: right; font-weight: bold; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($invoice['total'], '').'</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p></p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px">
                                        Nếu quý khách hàng chọn phương thức thanh toán qua chuyển khoản, xin vui lòng thanh toán tại:
                                    </p>
									<p style="padding: 0px; margin: 0px; margin-bottom: 12px; margin-top: 20px; line-height: 16px; color: #333; font-size: 16px; font-weight: bold">CÔNG TY CỔ PHẦN APPLANCER</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">
                                        * Ngân hàng Techcombank chi nhánh Đông Sài Gòn - Số TK: 19128794119012
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">
                                        * Ngân hàng Vietcombank chi nhánh Phú Thọ,TPHCM - Số TK: 0421000462948
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">
                                    <span style="color: #e24b31; font-weight: bold">*Lưu ý</span>: sau khi chuyển khoản vui lòng liên hệ mail: ngoc.do@applancer.net hoặc hotline: +84-122 711 2279 Hoặc +84-944 685 243 để được hỗ trợ tốt nhất.

                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; line-height: 16px;margin-top: 30px">
                                        Mọi chi tiết xin vui lòng tham khảo tại website <a href="'.site_url().'" target="_blank">'.site_url().'</a> hoặc liên hệ bộ phận hỗ trợ trực tuyến qua số điện thoại (08) 62959925 để được hỗ trợ.
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 10px; line-height: 12px; font-style: italic">Rất hân hạnh được phục vụ.</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 10px; line-height: 12px; margin-top: 30px">
                                        <span style="display: block; line-height: 24px">Trân trọng,</span>Bộ phận hỗ trợ khách hàng.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
        }

        return $result;
    }
}


if ( ! function_exists('get_html_order_admin')) {
    function get_html_order_admin($invoice, $invoiceDetail)
    {
        $CI = &get_instance();
        $result = '';

        if (is_object($invoice)) {
            $invoice = get_object_vars($invoice);
        }
        if (is_object($invoiceDetail)) {
            $invoiceDetail = get_object_vars($invoiceDetail);
        }

        if($invoice != null){
            $result = '<table align="center" width="620" style="margin: 0 auto" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="left" height="80">
                                    <table cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td width="200">
                                                    <a href="#" target="_blank">
                                                        <img src="'.image_url('logo_new.png').'" alt="'.site_url().'" border="0" style="float: left; margin-top: 0px; display: block">
                                                    </a>
                                                </td>
                                                <td width="420" style="text-align: right; font-size: 13px">
                                                    <a href="'.site_url().'" style="text-decoration: none; color: #e24b31; font-weight: bold" target="_blank">'.site_url().'</a>
                                                    <br>Dịch vụ khách hàng - Hotline: <strong>(08) 62959925</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center" style="text-align: left; line-height: 40px; font-size: 18px; font-weight: bold; border-bottom: #58585a dotted 1px;">Thông báo đơn hàng từ '.site_url().'</td>
                            </tr>
                            <tr>
                                <td align="center" style="text-align: left; line-height: 40px; font-size: 12px; padding: 14px 0px">
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; line-height: 16px">
                                        Chào <span style="font-weight: bold">Admin</span>,
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px">
                                        '.$invoice["user_name"].' đã đặt hàng, dưới đây là thông tin đơn hàng:
                                    </p>

                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">
                                        - Mã đơn hàng:<span style="color: #e24b31; font-weight: bold"> #'. $invoice["id"].'</span>
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Ngày mua hàng: '.date('d/m/Y H:s:i', strtotime($invoice["created_at"])).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Phương thức thanh toán: '. get_payment_method ($invoice["payment_id"]).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 6px; line-height: 16px; margin-left: 20px">-
                                        Trạng thái đơn hàng: '.get_invoice_status($invoice["status"]).'</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; margin-top: 20px; line-height: 16px; color: #333; font-size: 16px; font-weight: bold">Chi tiết đơn hàng:</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px"></p>
                                    <table cellpadding="1" cellspacing="1" width="620" style="background: #999999">
                                        <tbody>
                                            <tr height="30">
                                                <td style="background: #ccc; line-height: 16px; width: 320px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Dịch Vụ</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Số lượng</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Đơn giá</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    VAT (10%)</td>
                                                <td style="background: #ccc; line-height: 16px; width: 100px; text-align: right; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px; font-weight: bold">
                                                    Thành tiền</td>
                                            </tr>';

            foreach($invoiceDetail as $key => $item){
                $price = $item->price * $item->quantity;
                $price_vat = $item->fee;
                $subtotal = $price + $price_vat;

                $result .= '<tr>
                                                <td style="background: #fff; line-height: 26px; width: 280px; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.$item->title.'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: right; margin: 0px; font-size: 12px; padding: 0px 5px">'.$item->quantity.'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($price, "").'</td>
                                                <td style="background: #fff; line-height: 26px; width: 100px; text-align: center; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($price_vat, "").'</td>
                                                <td style="background: #fff; color: #e24b31; line-height: 26px; width: 100px; text-align: right; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($subtotal, "").'</td>
                                            </tr>';
            }

            $result .= '<tr>
                                                <td colspan="4" style="background: #fff; line-height: 26px; text-align: right; font-weight: bold; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">Tổng tiền</td>
                                                <td style="background: #fff; color: #e24b31; line-height: 26px; width: 100px; text-align: right; font-weight: bold; height: 10px; margin: 0px; font-size: 12px; padding: 0px 5px">'.formatPrice($invoice['total'], '').'</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p></p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 12px; line-height: 16px">
                                        Mọi chi tiết xin vui lòng tham khảo tại website <a href="'.site_url().'" target="_blank">'.site_url().'</a> hoặc liên hệ bộ phận hỗ trợ trực tuyến qua số điện thoại (08) 62959925 để được hỗ trợ.
                                    </p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 10px; line-height: 12px; font-style: italic">Rất hân hạnh được phục vụ.</p>
                                    <p style="padding: 0px; margin: 0px; margin-bottom: 10px; line-height: 12px; margin-top: 30px">
                                        <span style="display: block; line-height: 24px">Trân trọng,</span>Bộ phận hỗ trợ khách hàng.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
        }

        return $result;
    }
}


if ( ! function_exists('isFavouritesResume')) {
    function isFavouritesResume($user_id, $resume_id)
    {
        $CI =& get_instance();
        $CI->load->model('resume_favourites_model');
        $fields = array('resume_favourites.id');
        $condition = array(
            'resume_favourites.user_id' => $user_id,
            'resume_favourites.resume_id' => $resume_id
        );
        $resumeFavourites = $CI->resume_favourites_model->getResumeFavourites($condition, $fields);
        if($resumeFavourites->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}


if ( ! function_exists('check_profile_company')) {
    function check_profile_company($user_id)
    {
        $CI =& get_instance();
        $CI->load->model('m_jobs');
        $fields = array('user_employers.id');
        $condition = array(
            'user_employers.user_id' => $user_id
        );
        $resumeFavourites = $CI->m_jobs->getUserEmployers($condition, $fields);
        if($resumeFavourites->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}

if ( ! function_exists('check_job_expiration')) {
    function check_job_expiration($job_id, $date_expiration = '')
    {
        $CI =& get_instance();
        $CI->load->model('m_jobs');

        $date_cur = date('Y-m-d', time());

        if($date_expiration == '') {
            $fields = 'jobs.date_expiration, jobs.date_created';
            $condition = array(
                'jobs.id' => $job_id
            );
            $job = $CI->m_jobs->getJobs($condition, $fields)->row();

            $date_expiration = date('Y-m-d', strtotime($job->date_expiration));
            if(strtotime($date_cur) > strtotime($date_expiration)){
                $CI->m_jobs->updateJob(array('jobs.id' => $job_id), array('jobs.status' => 2));
            }
        }else{
            $date_expiration = date('Y-m-d', strtotime($date_expiration));
            if(strtotime($date_cur) > strtotime($date_expiration)){
                $CI->m_jobs->updateJob(array('jobs.id' => $job_id), array('jobs.status' => 2));
            }
        }
    }
}

if ( ! function_exists('add_service_extension')) {
    function add_service_extension($job_id, $package_id = '')
    {
        $CI =& get_instance();
        $CI->load->model('m_jobs');
        $CI->load->model('common_model');
        $data_service_ext = null;

        $condition = array('job_services.type' => 0);
        if($package_id != ''){
            $condition["FIND_IN_SET({$package_id}, package_ids) !="] = 0;
        }
        $services = $CI->m_jobs->getServices($condition);
        $date_exp = ($CI->config->item('limit_day') * 24 * 60 * 60) + time();
        foreach($services->result() as $item){
            $data_service_ext = array(
                'job_id' => $job_id,
                'service_id' => $item->id,
                'expired_at' => date(DATETIME_FORMAT_DB, $date_exp)
            );
            $CI->m_jobs->addJobServiceExtension($data_service_ext);
        }
    }
}