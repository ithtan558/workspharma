<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('PRODUCT','product');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
/*right*/
/*payment*/

define('Customer_information','Thông tin khách hàng');

define('Payment','Thanh toán');

define('Full_name','Họ tên');

define('Email','Email');
define('Country','Đất nước');
define('Address_1','Địa chỉ thứ nhất');
define('Address_2','Địa chỉ thứ hai');
define('Phone','Điện thoại');

define('Methods_payment','Phương thức thanh toán');
define('Reset','Làm lại');
define('Info_order','Mô tả');

define('view','Lượt xem');
/*define payment*/
/*detail products*/

define('code_products','Mã sản phẩm');

define('color','Màu sắc');

define('manufacture','Nhà sản xuất');

define('price','Giá');

/*define detail products*/



define('detail_products','Chi tiết sản phẩm');

define('sale','Khuyến mãi');

define('news','Mới');

define('share','Chia sẽ');

define('Products_categories','loai-san-pham');

define('products_categories','Loại sản phẩm');

define('Products_overview','tong-quan-san-pham');

define('products_overview','Tổng quan sản phẩm');

define('Technical_specifications','thong-so-ky-thuat');

define('technical_specifications','Thông số kỹ thuật');

define('Warranty_service','bao-hanh-dich-vu');

define('warranty_service','Bảo hành dịch vụ');

define('Document_products','tai-lieu-san-pham');

define('document_products','Tài liệu sản phẩm');

define('name_products','Tên sản phẩm');

define('description','Mô tả');

define('download','Tải về');

define('Product','Dịch vụ');

define('products','san-pham');
#####################public
define("STT","Stt");
define("PHONE","Điện thoại");
define("NAME_PRODUCTS","Tên sản phẩm");
define("VIEW","Lượt xem");
define("DATE","Ngày");
define("ENABLE","Trạng thái");
define("ADDRESS","Địa chỉ");
define("NAME","Tên");
##########3333button

define("UPDATE","Cập nhật");
define("ADD","Thêm");
define("DELETE","Xóa");
define("other_articles","Other articles");

############đăng ký đăng nhập
define("Login","Đăng nhập");
define("Register","Đăng ký");
define("Hi","Hi");
define("Empty1","Trống");
define("Cart","Giỏ hàng");
define("Logout","Thoát");
############quên mật khẩu
define("Input_address_Email","Nhập vào Email");
define("Request_get_password","Yêu cầu lấy lại mật khẩu");
############search
define("result_search","kết quả tìm kiếm");
#############Admin

define("A_SLOGAN","Hệ thống quản trị");
define("A_PREVIEW","Xem trước");
define("A_EXIT","Thoát");


define("A_ORDER","Đơn hàng");
define("A_LIST","Danh sách");
define("A_ADD","Thêm");

define("A_CONFIG","Cấu hình");
define("A_LANGUGES","Ngôn ngữ");

define("A_ARTICLES","Bài viết");
define("A_ARTICLES_CATEGORIES","Danh mục bài viết");

define("A_MENU","Menu");
define("A_MENU_ALL","Tất cả Menu");

define("A_USERS","Users");
define("A_USERS_GROUP","Nhóm người dùng");

define("A_CONTACT","Liên hệ");
define("A_CONTACT_CONFIG","Cấu hình liên hệ");

define("A_PRODUCTS","Sản phẩm");
define("A_PRODUCTS_CONFIG","Cấu hình sản phẩm");
define("A_PRODUCTS_CATEGORIES","Danh mục sản phẩm");
define("A_PRODUCTS_MANUFACTURE","Nhà sản xuất");
define("A_PRODUCTS_TOOL","Công cụ");
define("A_LIST_PRODUCTS","Danh sách sản phẩm");

define("A_BLOCKS","Blocks");
define("A_BLOCKS_PUBLIC","Blocks public");
define("A_BLOCKS_SLIDESHOW","Slideshow");
define("A_BLOCKS_SUPPORT","Support online");
define("A_BLOCKS_BANNER","Banners");
define("A_BLOCKS_PRODUCTS_TYPICAL","Sản phẩm nổi bật");
define("A_BLOCKS_PRODUCTS_DEFAULT","Sản phẩm trang chủ");
define("A_BLOCKS_NEWS_NEW","Tin tức mới");
define("A_BLOCKS_PROJECTS","Projects");

define("A_MEDIA","Phương tiện");
define("A_LOG","Đăng nhập thành công");
define("A_LOG_UN","Đăng nhập không thành công");

define("A_EMAIL","Email");
define("A_CLEAR","Clear");
define("A_TOOL","Công cụ");
define("A_TOOL_EXPORT","Xuất database");


/* SẢN PHẨM */
define("SP_MAU","Color");
define("SP_GIATT","Price old");
define("SP_GIABAN","Price new");
define("SP_INFO","Infomation detail");
define("SP_PRODUCTINFO","Infomation products");
define("SP_CUNGLOAI","Other products");
define("SP_ERROR_LOGIN","You need login for buy it");
define("SP_ERROR_QUANTILY","Excess inventory number!");
define("SP_ERROR_QUANTILY_20","The remaining number 20, please carefully consider when shopping!");
define("SP_BUYED","You bought it!");
define("SP_NOT_PRICE","Products not price!");
define("SP_BUYED_BEFORE","You bought it before, number will update!");

#########users
define("CHANGE_AVATAR","Thay đổi avatar");
define("CHANGE_PASS","Thay đổi mật khẩu");
define("INFO","Thông tin người dùng");
define("HISTORY_ORDER","Lịch sử đơn hàng");
define("EXIT_ORDER","Thoát");
###########forgot
define("NOT_FORGOT","Email không tồn tại");
define("SUCCESS_FORGOT","Mật khẩu mới đã được gửi đến Email của bạn, hãy kiểm tra lại Email.");
###########login
define("NOT_ACCOUNT","Tài khoản không tồn tại");
##############change avatar
define("AVATAR_CURRENT","Avatar hiện tại");
##############change pass
define("PASS","Mật khẩu");
define("REPASS","Nhắc lại mật khẩu");
/* cart */
define("PAYMENT",               "Giỏ hàng của bạn");
define("ADDCART",               "giohang.jpg");
define("CART_STT",              "No");
define("CART_TENSP",            "Tên sản phẩm");
define("CART_MASP",             "Mã SP");
define("CART_SL",               "Số lượng");
define("CART_DONGIA",           "Đơn giá");
define("CART_TONGTIEN",         "Tổng tiền");
define("CART_TONGCONG",         "Tổng thanh toán");
define("CART_DEL",              "Xóa");
define("CART_EMPTY",            "Empty shopcart");
define("CART_TIEPTUC",          "Tiếp tục mua hàng");
define("CART_CAPNHAT",          "Cập nhật");
define("CART_SUATTLL",          "Sửa thông tin liên lạc");
define("SP_MOTAKHAC",           "Mô tả khác");
define("CART_SUBMIT",           "Mua hàng");
define("CART_NEXT",             "Tiếp tục");
define('CART_XOACART',          'Xóa giỏ hàng');
define('CART_IMAGES',          'Hình ảnh');
define('CART_ADCART',          'Add to cart');
define('CART_INFOCUSTOMES',          'Thông tin khách hàng');
define("CODE_ORDER","Mã đơn hàng");
define("FULLNAME_ORDER","Tên khách hàng");
define("EMAIL","Email");

//---------
define("KH_HOTEN",              "Họ và tên");
define("KH_ADDTT",              "Địa chỉ thanh toán");
define("KH_ADDGH",              "Địa chỉ giao hàng");
define("KH_SDT",                "Số điện thoại");
define("KH_PTTT",               "Phương thức thanh toán");
define("KH_CHONPTTT",           "Chọn phương thức thanh toán");
define("KH_TTT",                "Ghi chú");
define("KH_TTBB",               "Là thông tin bắt buộc!");
define("KH_CHUYENKHOAN1",       "Chuyển khoản ngân hàng.");
define("KH_CHUYENKHOAN2",       "Chuyển tiền qua bưu điện.");
define("KH_CHUYENKHOAN3",       "Thanh toán trực tiếp.");
define("KH_THANHTOAN",       "Tiến hành thanh toán.");

define("KH_EMPTYHOTEN",         "Vui lòng nhập họ tên.");
define("KH_EMPTYEMAIL",         "Vui lòng nhập email.");
define("KH_WRONGEMAIL",         "Email nhập chưa đúng.");
define("KH_EMPTYADD",           "Vui lòng nhập địa chỉ");
define("KH_EMPTYTEL",           "Vui lòng nhập số điện thoại");
define("KH_EMPTYTT",            "Vui lòng chọn phương thức thanh toán");
define("KH_TITLEKH",            "Thông tin liên lạc");
define("KH_TITLEGH",            "Thông tin giỏ hàng");

/* hoi dap*/

define('GUIHOIDAP',             'Ý kiến khách hàng');
define('FR_HOTEN',              'Họ tên');
define('FR_TITLE',              'Tiêu đề');
define('FR_NOIDUNG',            'Nội dung');
define('FR_EMPTYNAME',          'Bạn chưa nhập họ tên');
define('FR_EMPTYEMAIL',         'Bạn chưa nhập email');
define('FR_ERROREMAIL',         'Email không đúng');
define('FR_EMPTYTITLE',         'Bạn chưa nhập tiểu đề');
define('FR_EMPTYCONTENT',       'Bạn chưa nhập nội dung');
define('FR_CAUHOI',             'Câu hỏi');
define('FR_DAP',                'Trả lời');

/* --- menu */
define("MN_HOME",               "Trang chủ");
define("TRANGDIEM",            "TRANG ĐIỂM");
define("TIMDAILY",             "TÌM ĐẠI LÝ");
define("LOPHOCTRANGDIEM",             "LỚP HỌC TRANG ĐIỂM");
define("MN_CONTACT",            "Liên hệ");
define('MN_TUYENDUNG',          'Tuyển dụng');

/*FOOTER*/
define("KETNOI",           "Kết Nối Với Chúng Tôi");

/*banner*/
define("SELECTLANGGUAGE",           "Chọn ngôn ngữ");
define("LOGIN",           			"Đăng Nhập");
define("REGISTER",           		"Đăng Ký");



/*trang chu */
define("MAP_DEFAULT",           "Sản phẩm");
define("H_DOCTIEP",             "Đọc tiếp");
define("H_PARTNER",             "Đối tác");

//define("ONLINE",              "Đang Online: ");
define("TOTAL",                 "Tổng truy cập: ");

/* lien he */
define("CONTACT","Liên hệ");
define("LIENHEUS","Liện hệ chúng tôi");
define("THONGTIN","Thông tin của bạn");
define("HOTEN","Họ tên");
define("COMPANY","Công ty");
define("DIACHI","Địa chỉ");
define("NOIDUNG","Nội dung");
define("GUI","Gửi");
define("RESET","Làm lại");
define("THANHCONG","Gửi thành công");
define("REPLY_SUBJECT","Gửi liên hệ");
define("REPLY_BODY","Cám ơn bạn đã gửi liên hệ cho chúng tôi. Chúng tôi sẽ hồi đáp bạn trong thời gian sớm nhất");
//----- validation lien he
define("CT_EMPTYNAME","Vui lòng điện họ & tên!");
define("CT_ERRORNAME","Sai họ tên");
define("CT_EMPTYTEL","Vui lòng điện số điện thoại !");
define("CT_ERRORTEL","Số điện thoại sai.!");
define("CT_EMPTYEMAIL","Vui lòng điền địa chỉ email!");
define("CT_ERROREMAIL","Sai địa chỉ email!");
define("CT_EMPTYCONTENT","Vui lòng nhập nội dung liên hệ!");

/* tin tuc */
define("TINTUC","Tin tức");
define("H_TRANG","Trang");
define("H_TROVE","Back");
define("H_PRINT","In trang");
define("H_CHITIET","Xem chi tiết");
define("OTHERNEWS","Tin khác");

/* SẢN PHẨM */
// define("SP_MAU","Màu");
// define("SP_GIATT","Price current");
// define("SP_GIABAN","Price");
// define("SP_INFO","Details");
// define("SP_PRODUCTINFO","Product Info");
// define("SP_CUNGLOAI","Same Products");

/* PHAN LEFT */
define("L_HOTRO","Hỗ trợ trực tuyến");

 
 /* PHAN RIGHT*/
define("DANGNHAP","ĐĂNG NHẬP");
//define("QUANGCAO","QUẢNG CÁO");
define("HOTROTRUCTUYEN","HỖ TRỢ TRỰC TUYẾN");

/* form login - REGISTER */
define("TAIKHOAN","Tài khoản");
define("QUENMATKHAU","Bạn quên mật khẩu?");
define("CHUAPHAITHANHVIEN","Bạn chưa phải là thành viên?");
define("CHUAKICHHOATTAIKHOAN","Bạn chưa kích hoạt tài khoản");
define("DANGKYTKMOI","Đăng ký tài khoản mới");
define("THONGTINCANHAN","Thông tin cá nhân");
define("FIRTNAME","Họ tên");
define("DIENTHOAI","Điện thoại");
define("THONGTINDANGNHAP","Thông tin đăng nhập");
define("MATKHAU","Mật khẩu");
define("REMATKHAU","Nhập lại mật khẩu");
define("GUIDANGKY","Đăng ký");
define("LOGIN_OR_REGISTER","Đăng nhập hoặc tạo tài khoản mới");
define("LOGIN_CUSTOMER","Đăng nhập vào hệ thống");
define("DANGKYMOI","Đăng ký mới");
define("DANGKY","Đăng ký");

//-------------
define("TRANGCHU","Trang chủ");
define("SANPHAM","Sản phẩm");
define("DICHVU","Dịch vụ");
define("THANHTOAN","Thanh toán");
define("LIENHE","Liên hệ");
define("GIOITHIEU","Giới thiệu");
define("DANHMUCSANPHAM","Danh mục sản phẩm");
define("SUKIEN","Tin tức & Sự kiện");
define("THONGTINCANBIET","Thông tin cần biết");

define("GIAVANG","Giá vàng hôm nay");
define("USD","Tỷ giá USD -  Tỷ giá ngọa tệ");
define("CHUNGKHOAN","Chứng khoán trực tuyến");
define("ATM","Điểm đặt ATM");
define("THOITIET","Thời tiết");
define("THONGKE","Thống kê truy cập");
define("TRUYCAP","Số lượt truy cập");
define("ONLINE","Số đang online");
define("TIMKIEMNHANH","Tìm kiếm nhanh");
define("SANPHAMMOI","Sản phẩm mới");
define("LIENKETWEBSITE","Liên kết website");
define("QUANGCAO","Quảng cáo");
define("GIOITHIEUVECONGTY","Giới thiệu về công ty");
define("SANPHAMNOIBAT","Sản phẩm nổi bật");
define("SANPHAMCUNGLOAI","Sản phẩm cùng loại");
define("TIM","Tìm");
define("DATHANG","Đặt hàng");
define("MASP","Mã sản phẩm");
define("GIA","Giá");
define("PHONGKINHDOANH","Phòng kinh doanh");
define("PHONGKETOAN","Phòng kế toán");
define("TUKHOA","Từ khóa"); 
define("CHONNHOMSANPHAM","Chọn nhóm sản phẩm");
define("CACBAIVIETKHAC","Same Categories");
define("HINHANHMOI","Hình ảnh mới");
define("GHICHU","Quý khách có thể liên hệ với chúng tôi bằng cách điền thông tin theo mẫu trên.");

define("DANGONLINE","Đang Online");
define("HOMNAY","Hôm nay");
define("HOMQUA","Hôm qua");
define("TRONGTUAN","Trong tuần");
define("TRONGTHANG","Trong tháng");
define("LUOTTRUYCAP","Lượt truy cập");