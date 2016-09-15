<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends MX_Controller {
  public $auth;
  public $data_cart;
	public function __construct(){
      parent::__construct();
      if($this->session->has_userdata('customer_login')){
        $this->auth = $this->session->userdata('customer_login');
      }
      /*Shopping cart*/
      $this->load->library("cart");
      $this->data_cart = $this->cart->contents();
      // print_r($this->cart->total());die;
  }

  public function get_menu_page_customer(){
    $menu_account = array();
    $menu_account[0]['name'] = 'Tài khoản của tôi';
    $menu_account[0]['link'] = 'khach-hang/tai-khoan';
    $menu_account[1]['name'] = 'Theo dõi đơn hàng';
    $menu_account[1]['link'] = 'khach-hang/don-dat-hang';
    $menu_account[2]['name'] = 'Đăng xuất';
    $menu_account[2]['link'] = 'dang-xuat';

    $menu_statispage = array();
    $menu_statispage[0]['name'] = 'Giới thiệu về Roshop';
    $menu_statispage[0]['link'] = 'thong-tin/gioi-thieu-roshop';
    $menu_statispage[1]['name'] = 'Tại sao chọn chúng tôi';
    $menu_statispage[1]['link'] = 'thong-tin/tai-sao-chon-chung-toi';
    $menu_statispage[2]['name'] = 'Hướng dẫn đặt hàng';
    $menu_statispage[2]['link'] = 'thong-tin/huong-dan-dat-hang';
    $menu_statispage[3]['name'] = 'Chính sách giao nhận';
    $menu_statispage[3]['link'] = 'thong-tin/chinh-sach-giao-nhan';
    $menu_statispage[4]['name'] = 'Chính sách bảo mật';
    $menu_statispage[4]['link'] = 'thong-tin/chinh-sach-bao-mat';
    $menu_statispage[5]['name'] = 'Chính sách đổi trả';
    $menu_statispage[5]['link'] = 'thong-tin/chinh-sach-doi-tra';
    $menu_statispage[6]['name'] = 'Phí vận chuyển';
    $menu_statispage[6]['link'] = 'thong-tin/phi-van-chuyen';
    $menu_statispage[7]['name'] = 'Quyền riêng tư';
    $menu_statispage[7]['link'] = 'thong-tin/quyen-rieng-tu';
    $menu_statispage[8]['name'] = 'Liên hệ';
    $menu_statispage[8]['link'] = 'thong-tin/lien-he';

    $menu['menu_account']    = $menu_account;
    $menu['menu_statispage'] = $menu_statispage;
    return $menu;
  }
  
	public function url_slug($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode => $uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            $str = str_replace(" ","-",$str);
            $str = str_replace("--"," ",$str);
            $str = str_replace(",","-",$str);
            $str = str_replace("+","-",$str);
            $str = str_replace("_","-",$str);
            $str = str_replace(")","-",$str);
            $str = str_replace("(","-",$str);
            $str = str_replace("!","-",$str);
            $str = str_replace("@","-",$str);
            $str = str_replace("#","-",$str);
            $str = str_replace("$","-",$str);
            $str = str_replace("%","-",$str);
            $str = str_replace("^","-",$str);
            $str = str_replace("-","-",$str);
            $str = str_replace("*","-",$str);
            $str = str_replace("/","-",$str);
            $str = str_replace("","-",$str);
            $str = str_replace("'","",$str);
            $str = str_replace(":","",$str);
            $str = str_replace(".","",$str);
       }
        return strtolower($str);
    }

    public function remove_double_space($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode => $uni){
            $str = str_replace("  "," ",$str);
        }
        return $str;
    }

    public function message_action($message = '' ,$status = ''){
        if($status == 1){
            $rs_message = array('message' => $message , 'class' => 'alert alert-success');
            $this->session->set_flashdata('item' ,$rs_message);
        }else{
            $rs_message = array('message' => $message , 'class' => 'alert alert-danger');
            $this->session->set_flashdata('item' ,$rs_message);
        }
        return ;
    }
	

  protected $_config_pagi = array(
        'current_page'  => 1, // Trang hiện tại
        'total_record'  => 1, // Tổng số record
        'total_page'    => 1, // Tổng số trang
        'limit'         => 10,// limit
        'start'         => 0, // start
        'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '',// Link trang đầu tiên
        'range'         => 5, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0  // tham số max, min và max là 2 tham số private
    );
     
    public function get_config_pagi($name_model, $link_full = '' , $link_first = '' ,$condition = '' , $type_select = '' , $type_gender = ''){
      $limit = 8;
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      if($type_select == 'categories_child'){
        $total_record = $this->$name_model->countAll_products_pagi($condition);
      }else if($type_select == 'categories_parent'){
        $total_record = $this->$name_model->countAll_products_pagi_more($condition);
      }else{
        $total_record = $this->$name_model->countAll_products_pagi_search($condition , $type_gender);
      }
      $total_page = ceil($total_record / $limit);
      if($total_page < $current_page){
        $current_page = $total_page;
      }
      if($current_page < 1){
        $current_page = 1;
      }
      $start = (($current_page - 1) * $limit);
      $range_page   = 5;
      /*---Pagination---*/
      $pagination = array(
          'current_page'  => $current_page, // Trang hiện tại
          'total_record'  => $total_record, // Tổng số record
          'start'         => $start,
          'limit'         => $limit,// limit
          'link_full'     => $link_full,// Link full có dạng như sau: domain/com/page/{page}
          'link_first'    => $link_first,// Link trang đầu tiên
          'range'         => $range_page, // Số button trang bạn muốn hiển thị 
      );
      return $pagination;
    } 
    /*
     * Hàm khởi tạo ban đầu để sử dụng phân trang
     */
    function pagination($config = array()){
        /*
         * Lặp qua từng phần tử config truyền vào và gán vào config của đối tượng
         * trước khi gán vào thì phải kiểm tra thông số config truyền vào có nằm
         * trong hệ thống config không, nếu có thì mới gán
         */
        foreach ($config as $key => $val){
            if (isset($this->_config_pagi[$key])){
                $this->_config_pagi[$key] = $val;
            }
        }
        /*
         * Kiểm tra thông số limit truyền vào có nhỏ hơn 0 hay không?
         * Nếu nhỏ hơn thì gán cho limit = 0, vì trong mysql không cho limit bé hơn 0
         */
        if ($this->_config_pagi['limit'] < 0){
            $this->_config_pagi['limit'] = 0;
        }
         
        /*
         * Tính total page, công tức tính tổng số trang như sau: 
         * total_page = ciel(total_record/limit).
         * Tại sao lại như vậy? Đây là công thức tính trung bình thôi, ví
         * dụ tôi có 1000 record và tôi muốn mỗi trang là 100 record thì 
         * đương nhiên sẽ lấy 1000/100 = 10 trang đúng không nào :D
         */
        $this->_config_pagi['total_page'] = ceil($this->_config_pagi['total_record'] / $this->_config_pagi['limit']);
         
        /*
         * Sau khi có tổng số trang ta kiểm tra xem nó có nhỏ hơn 0 hay không
         * nếu nhỏ hơn 0 thì gán nó băng 1 ngay. Vì mặc định tổng số trang luôn bằng 1
         */
        if (!$this->_config_pagi['total_page']){
            $this->_config_pagi['total_page'] = 1;
        }
         
        /*
         * Trang hiện tại sẽ rơi vào một trong các trường hợp sau:
         *  - Nếu người dùng truyền vào số trang nhỏ hơn 1 thì ta sẽ gán nó = 1 
         *  - Nếu trang hiện tại người dùng truyền vào lớn hơn tổng số trang
         *    thì ta gán nó bằng tổng số trang
         * Đây là vấn đề giúp web chạy trơn tru hơn, vì đôi khi người dùng cố ý
         * thay đổi tham số trên url nhằm kiểm tra lỗi web của chúng ta
         */
        if ($this->_config_pagi['current_page'] < 1){
            $this->_config_pagi['current_page'] = 1;
        }
         
        if ($this->_config_pagi['current_page'] > $this->_config_pagi['total_page']){
            $this->_config_pagi['current_page'] = $this->_config_pagi['total_page'];
        }
         
        /* 
         * Tính start, Như bạn biết trong mysql truy vấn sẽ có limit và start
         * Muốn tính start ta phải dựa vào số trang hiện tại và số limit trên mỗi trang
         * và áp dụng công tức start = (current_page - 1)*limit
        */
        $this->_config_pagi['start'] = ($this->_config_pagi['current_page'] - 1) * $this->_config_pagi['limit'];
         
        /* 
         * Bây giờ ta tính số trang ta show ra trang web
         * Như bạn biết với những website có data lớn thì số trang có thể
         * lên tới hàng trăm trang, chẵng nhẽ ta show hết cả 100 trang?
         * Nên trong bài này tôi hướng dẫn bạn show trong một khoảng nào đó (range)
         * giống website freetuts.net vậy
        */
         
        // Trước tiên tính middle, đây chính là số nằm giữa trong khoảng tổng số trang
        // mà bạn muốn hiển thị ra màn hình
        $middle = ceil($this->_config_pagi['range'] / 2);
 
        // Ta sẽ lâm vào các trường hợp như bên dưới
        // Trong trường hợp này thì nếu tổng số trang mà bé hơn range
        // thì ta show hết luôn, không cần tính toán làm gì
        // tức là gán min = 1 và max = tổng số trang luôn
        if ($this->_config_pagi['total_page'] < $this->_config_pagi['range']){
            $this->_config_pagi['min'] = 1;
            $this->_config_pagi['max'] = $this->_config_pagi['total_page'];
        }
        // Trường hợp tổng số trang mà lớn hơn range
        else
        {
            // Ta sẽ gán min = current_page - (middle + 1)
            $this->_config_pagi['min'] = $this->_config_pagi['current_page'] - $middle + 1;
             
            // Ta sẽ gán max = current_page + (middle - 1)
            $this->_config_pagi['max'] = $this->_config_pagi['current_page'] + $middle - 1;
             
            // Sau khi tính min và max ta sẽ kiểm tra
            // nếu min < 1 thì ta sẽ gán min = 1  và max bằng luôn range
            if ($this->_config_pagi['min'] < 1){
                $this->_config_pagi['min'] = 1;
                $this->_config_pagi['max'] = $this->_config_pagi['range'];
            }
             
            // Ngược lại nếu min > tổng số trang
            // ta gán max = tổng số trang và min = (tổng số trang - range) + 1 
            else if ($this->_config_pagi['max'] > $this->_config_pagi['total_page']) {
                $this->_config_pagi['max'] = $this->_config_pagi['total_page'];
                $this->_config_pagi['min'] = $this->_config_pagi['total_page'] - $this->_config_pagi['range'] + 1;
            }
        }
    }
     
    /*
     * Hàm lấy link theo trang
     */
    private function __link($page){
        // Nếu trang < 1 thì ta sẽ lấy link first
        if ($page <= 1 && $this->_config_pagi['link_first']){
            return $this->_config_pagi['link_first'];
        }
        // Ngược lại ta lấy link_full
        // Như tôi comment ở trên, link full có dạng domain.com/page/{page}.
        // Trong đó {page} là nơi bạn muốn số trang sẽ thay thế vào
        return str_replace('{page}', $page, $this->_config_pagi['link_full']);
    }
     
    /*
     * Hàm lấy mã html
     * Hàm này ban tạo giống theo giao diện của bạn
     * tôi không có config nhiều vì rất rối
     * Bạn thay đổi theo giao diện của bạn nhé
     */
    function get_pagination_html(){   
        $p = '';
        if ($this->_config_pagi['total_record'] > $this->_config_pagi['limit']){
            $p = '<ul class="paging">';
            // Nút prev và first
            if ($this->_config_pagi['current_page'] > 1){
                $p .= '<li><a href="'.$this->__link('1').'">First</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config_pagi['current_page']-1).'">Prev</a></li>';
            }
            // lặp trong khoảng cách giữa min và max để hiển thị các nút
            for ($i = $this->_config_pagi['min']; $i <= $this->_config_pagi['max']; $i++){
                // Trang hiện tại
                if ($this->_config_pagi['current_page'] == $i){
                    $p .= '<li class="active"><a href="javascript:void(0)">'.$i.'</a></li>';
                }else{
                    $p .= '<li><a href="'.$this->__link($i).'">'.$i.'</a></li>';
                }
            }
            // Nút last và next
            if ($this->_config_pagi['current_page'] < $this->_config_pagi['total_page']){
                $p .= '<li><a href="'.$this->__link($this->_config_pagi['current_page'] + 1).'">Next</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config_pagi['total_page']).'">Last</a></li>';
            }
             
            $p .= '</ul>';
        }
        return $p;
    }
}
