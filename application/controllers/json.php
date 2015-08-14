<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{
    //apis by avinash
    
    public function checkdata()
    {
    
        $data = json_decode(file_get_contents('php://input'), true);
        print_r($data);
    }
    public function authenticate()
    {
        $data['message']=$this->user_model->authenticate();
		$this->load->view('json',$data);
    }
   
	public function logout( )
	{
        $this->session->sess_destroy();
		if($this->session->userdata('id')=="")
        {
            $data['message']=true;
        }
        else
        {
            $data['message']=false;
        }
        $this->load->view('json',$data);
//		redirect( base_url() . 'index.php/login', 'refresh' );
	}
    
    public function signup()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email=$data['email'];
        $password=$data['password'];
        $data['message']=$this->user_model->frontendsignup($email, $password);
        $this->load->view('json',$data);
    }
  
    public function getallproducts()
    {
        $data['message']=$this->product_model->getallproducts();
        $this->load->view('json',$data);
    }
    
    
    public function saveimageinuploads()
    {
//        $url = 'http://www.gettyimages.in/gi-resources/images/Homepage/Category-Creative/UK/UK_Creative_462809583.jpg';
        $url = 'https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/s640x640/sh0.08/e35/11351607_1477019669285380_343422983_n.jpg';
        /* parse file and get hostname*/
//        $parse = parse_url($url);
//        print $parse['host'];
//        echo substr($url, 0, 5);
        /* Extract the filename */
//        $timestamp=new DateTime();
//        $timestamp=$timestamp->format('Y-m-d_H.i.s');
//        
//        $filename = substr($url, strrpos($url, '/') + 1);
//        $filename=$timestamp.$filename;
        /* Save file wherever you want */
        $date = new DateTime();
        $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";
//        echo base_url() .'uploads/'.$filename;
        file_put_contents('uploads/'.$filename, file_get_contents($url));
        echo "<br>".$filename."<br>";
        echo base_url() .'uploads/'.$filename;
    }

    public function createpillow()
    {
        
        $data = json_decode(file_get_contents('php://input'), true);
        $files=$data['image'];
        $userid=$data['userid'];
        
        $orderid=$this->order_model->addorderonproceed($userid);
        $orderproductid=$this->order_model->addorderproductonproceed($orderid);
        foreach($files as $key=>$file)
        {
            $imageurl=$file['img'];
            $order=$key;
            $checkcharacters=substr($imageurl, 0, 5);
            if($checkcharacters=="https")
            {
                echo "in http".$key;
                $date = new DateTime();
                $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";
                
                file_put_contents('uploads/'.$filename, file_get_contents($imageurl));
                $this->order_model->addorderimageonproceed($orderproductid,$filename,$order);
            }
            else
            {
                echo "in normal".$key;
                $filename=$file['img'];
                $this->order_model->addorderimageonproceed($orderproductid,$filename,$order);
            }
        }
        return 1;
    
    }
    
    public function addtocart()
    {
    
        $data = json_decode(file_get_contents('php://input'), true);
        if(!empty($data))
        {
            $files=$data['image'];
            $userid=$data['userid'];
            $productid=$data['productid'];
            $price=$data['price'];
            $quantity=$data['quantity'];

    //        $orderid=$this->order_model->add($userid);
            $orderproductcartid=$this->order_model->addorderproductcartonaddtocart($userid,$productid,$price,$quantity);
            foreach($files as $key=>$file)
            {
                $imageurl=$file['img'];
                $left=$file['left'];
                $top=$file['top'];
                $order=$key;
                $checkcharacters=substr($imageurl, 0, 5);
                if($checkcharacters=="https")
                {
    //                echo "in http".$key;
                    $date = new DateTime();
                    $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";

                    file_put_contents('uploads/'.$filename, file_get_contents($imageurl));
                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
                }
                else
                {
    //                echo "in normal".$key;
                    $filename=$file['img'];
                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
                }
            }
            $data['message']=true;
        }
        else
        {
            $data['message']=false;
        }
        $this->load->view('json',$data);
//        return 1;
    }
    
    
    
    public function editcart()
    {
    
        $data = json_decode(file_get_contents('php://input'), true);
        if(!empty($data))
        {
            $files=$data['image'];
            $userid=$data['userid'];
            $productid=$data['productid'];
            $price=$data['price'];
            $quantity=$data['quantity'];
            $userproductcartid=$data['userproductcartid'];

    //        $orderid=$this->order_model->add($userid);
            $orderproductcartid=$this->order_model->addorderproductcartonaddtocartonedit($userid,$productid,$price,$quantity,$userproductcartid);
            $deleteuserproductimagecart=$this->order_model->deleteuserproductimagecart($userproductcartid);
            foreach($files as $key=>$file)
            {
                $imageurl=$file['img'];
                $left=$file['left'];
                $top=$file['top'];
                $order=$key;
                $checkcharacters=substr($imageurl, 0, 5);
                if($checkcharacters=="https")
                {
    //                echo "in http".$key;
                    $date = new DateTime();
                    $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";

                    file_put_contents('uploads/'.$filename, file_get_contents($imageurl));
                    $this->order_model->adduserproductimagecartonaddtocart($userproductcartid,$filename,$order,$left,$top);
                }
                else
                {
    //                echo "in normal".$key;
                    $filename=$file['img'];
                    $this->order_model->adduserproductimagecartonaddtocart($userproductcartid,$filename,$order,$left,$top);
                }
            }
            $data['message']=true;
        }
        else
        {
            $data['message']=false;
        }
        $this->load->view('json',$data);
//        return 1;
    }
    
    
    function login() 
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email=$data["email"];
        $password=$data["password"];
        $data["message"] = $this->user_model->loginuser($email, $password);
        $this->load->view("json", $data);
    }
    //cart functions
    
    
    function getusercart() {
        $user = $this->input->get_post('user');
        $data["message"] = $this->order_model->getusercart($user);
        $this->load->view("json", $data);
    }
//    function addcartsession() {
//        $cart = $this->input->get_post('cart');
//        $data["message"] = $this->order_model->addcartsession($cart);
//        $this->load->view("json", $data);
//    }
    function addtocartold() {
        $user = $this->input->get_post('user');
        $product = $this->input->get_post('product');
        $productname = $this->input->get_post('productname');
        $quantity = $this->input->get_post('quantity');
        $price = $this->input->get_post('price');
//        $image = $this->input->get_post('image');
        $data["message"] = $this->user_model->addtocart($product, $productname, $quantity, $price);
        //$data["message"]=$this->order_model->addtocart($user,$product,$quantity);
        $this->load->view("json", $data);
    }
    function destroycart() {
        $data["message"] = $this->user_model->destroycart();
        $this->load->view("json", $data);
    }
    function showcart() {
        $userid=$this->session->userdata("id");
        if($userid!="")
        {
            $data['message']=$this->user_model->getusercartdetails($userid);
            $this->load->view("json", $data);
        }
        else
        {
            $cart = $this->cart->contents();
            $newcart = array();
            foreach ($cart as $item) {
                array_push($newcart, $item);
            }
            $data["message"] = $newcart;
            $this->load->view("json", $data);
        }
    }
    function totalcart() {
        $data["message"] = $this->cart->total();
        $this->load->view("json", $data);
    }
    function totalitemcart() {
        $data["message"] = $this->cart->total_items();
        $this->load->view("json", $data);
    }
    
    function getorderproductbyuser()
    {
        $userid=$this->input->get("userid");
        $elements=array();
        
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_orderproduct`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";

        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_orderproduct`.`order`";
        $elements[1]->sort="1";
        $elements[1]->header="Order";
        $elements[1]->alias="order";

        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_orderproduct`.`product`";
        $elements[2]->sort="1";
        $elements[2]->header="Product";
        $elements[2]->alias="product";

        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_orderproduct`.`quantity`";
        $elements[3]->sort="1";
        $elements[3]->header="Quantity";
        $elements[3]->alias="quantity";

        $elements[4]=new stdClass();
        $elements[4]->field="`pillow_orderproduct`.`price`";
        $elements[4]->sort="1";
        $elements[4]->header="Price";
        $elements[4]->alias="price";

        $elements[5]=new stdClass();
        $elements[5]->field="`pillow_orderproduct`.`discount`";
        $elements[5]->sort="1";
        $elements[5]->header="Discount";
        $elements[5]->alias="discount";

        $elements[6]=new stdClass();
        $elements[6]->field="`pillow_orderproduct`.`finalprice`";
        $elements[6]->sort="1";
        $elements[6]->header="Final Price";
        $elements[6]->alias="finalprice";

        $elements[7]=new stdClass();
        $elements[7]->field="`pillow_orderproduct`.`thumbnail`";
        $elements[7]->sort="1";
        $elements[7]->header="Thumbnail";
        $elements[7]->alias="thumbnail";

        $elements[8]=new stdClass();
        $elements[8]->field="`pillow_order`.`email`";
        $elements[8]->sort="1";
        $elements[8]->header="email";
        $elements[8]->alias="email";

        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow="10";
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_orderproduct` LEFT OUTER JOIN `pillow_order` ON `pillow_order`.`id`=`pillow_orderproduct`.`order`","WHERE `pillow_order`.`user`='$userid'");
        $this->load->view("json",$data);
    }
    
    
    
    function getallorders()
    {
        $elements=array();
        
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_orderproduct`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";

        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_orderproduct`.`order`";
        $elements[1]->sort="1";
        $elements[1]->header="Order";
        $elements[1]->alias="order";

        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_orderproduct`.`product`";
        $elements[2]->sort="1";
        $elements[2]->header="Product";
        $elements[2]->alias="product";

        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_orderproduct`.`quantity`";
        $elements[3]->sort="1";
        $elements[3]->header="Quantity";
        $elements[3]->alias="quantity";

        $elements[4]=new stdClass();
        $elements[4]->field="`pillow_orderproduct`.`price`";
        $elements[4]->sort="1";
        $elements[4]->header="Price";
        $elements[4]->alias="price";

        $elements[5]=new stdClass();
        $elements[5]->field="`pillow_orderproduct`.`discount`";
        $elements[5]->sort="1";
        $elements[5]->header="Discount";
        $elements[5]->alias="discount";

        $elements[6]=new stdClass();
        $elements[6]->field="`pillow_orderproduct`.`finalprice`";
        $elements[6]->sort="1";
        $elements[6]->header="Final Price";
        $elements[6]->alias="finalprice";

        $elements[7]=new stdClass();
        $elements[7]->field="`pillow_orderproduct`.`thumbnail`";
        $elements[7]->sort="1";
        $elements[7]->header="Thumbnail";
        $elements[7]->alias="thumbnail";

        $elements[8]=new stdClass();
        $elements[8]->field="`pillow_order`.`email`";
        $elements[8]->sort="1";
        $elements[8]->header="email";
        $elements[8]->alias="email";

        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow="10";
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_orderproduct` LEFT OUTER JOIN `pillow_order` ON `pillow_order`.`id`=`pillow_orderproduct`.`order`");
        $this->load->view("json",$data);
    }
    
    
    
    
    function getallcartbyuser()
    {
        $userid=$this->input->get("userid");
        $elements=array();
        
        $elements[0]=new stdClass();
        $elements[0]->field="`userproductcart`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";

        $elements[1]=new stdClass();
        $elements[1]->field="`userproductcart`.`user`";
        $elements[1]->sort="1";
        $elements[1]->header="User";
        $elements[1]->alias="user";

        $elements[2]=new stdClass();
        $elements[2]->field="`userproductcart`.`product`";
        $elements[2]->sort="1";
        $elements[2]->header="Product";
        $elements[2]->alias="product";

        $elements[3]=new stdClass();
        $elements[3]->field="`userproductcart`.`quantity`";
        $elements[3]->sort="1";
        $elements[3]->header="Quantity";
        $elements[3]->alias="quantity";

        $elements[4]=new stdClass();
        $elements[4]->field="`userproductcart`.`price`";
        $elements[4]->sort="1";
        $elements[4]->header="Price";
        $elements[4]->alias="price";

        $elements[5]=new stdClass();
        $elements[5]->field="`userproductcart`.`discount`";
        $elements[5]->sort="1";
        $elements[5]->header="Discount";
        $elements[5]->alias="discount";

        $elements[6]=new stdClass();
        $elements[6]->field="`userproductcart`.`finalprice`";
        $elements[6]->sort="1";
        $elements[6]->header="Final Price";
        $elements[6]->alias="finalprice";

        $elements[7]=new stdClass();
        $elements[7]->field="`userproductcart`.`thumbnail`";
        $elements[7]->sort="1";
        $elements[7]->header="Thumbnail";
        $elements[7]->alias="thumbnail";

        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`email`";
        $elements[8]->sort="1";
        $elements[8]->header="email";
        $elements[8]->alias="email";

        $elements[9]=new stdClass();
        $elements[9]->field="`pillow_product`.`xsize`";
        $elements[9]->sort="1";
        $elements[9]->header="xsize";
        $elements[9]->alias="xsize";

        $elements[10]=new stdClass();
        $elements[10]->field="`pillow_product`.`ysize`";
        $elements[10]->sort="1";
        $elements[10]->header="ysize";
        $elements[10]->alias="ysize";

        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow="10";
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `userproductcart` LEFT OUTER JOIN `user` ON `user`.`id`=`userproductcart`.`user` LEFT OUTER JOIN `pillow_product` ON `pillow_product`.`id`=`userproductcart`.`product`","WHERE `userproductcart`.`user`='$userid'");
        $this->load->view("json",$data);
    }
    
    public function getorderproductbyid()
    {
        $orderproductid=$this->input->get_post('id');
        $data['message']=$this->order_model->getorderproductbyid($orderproductid);
        $this->load->view("json",$data);
    }
    
    public function getuserproductcartbyid()
    {
        $userproductcartid=$this->input->get_post('id');
        $data['message']=$this->order_model->getuserproductcartbyid($userproductcartid);
        $this->load->view("json",$data);
    }
    
    public function mergeimage()
    {
        $src1 = imagecreatefrompng('https://upload.wikimedia.org/wikipedia/commons/4/47/PNG_transparency_demonstration_1.png');
        $src2 = imagecreatefrompng('http://img15.deviantart.net/e2e6/i/2012/339/8/a/png_material_by_moonglowlilly-d5n4w1c.png');

        //Change the arguments below to suit your needs
        imagecopymerge($src1, $src2, 50, 50, 50, 50, 200, 200, 100); 

        header('Content-Type: image/png');
        imagepng($src1);

        imagedestroy($src1);
        imagedestroy($src2);
    }
    
    //payment gateway
    
    function placeorder() {
        $order = json_decode(file_get_contents('php://input'), true);
        //print_r($order);
        $user = $order['user'];
        $firstname = $order['firstname'];
        $lastname = $order['lastname'];
        $email = $order['email'];
        $phone = $order['phone'];
        $status = $order['status'];
//        $company = $order['company'];
//        $fax = $order['fax'];
        $billingaddress = $order['billingaddress'];
        $billingcity = $order['billingcity'];
        $billingstate = $order['billingstate'];
        $billingcountry = $order['billingcountry'];
        $shippingaddress = $order['shippingaddress'];
        $shippingcity = $order['shippingcity'];
        $shippingcountry = $order['shippingcountry'];
        $shippingstate = $order['shippingstate'];
        $shippingpincode = $order['shippingpincode'];
        $billingpincode = $order['billingpincode'];
        $shippingmethod = $order['shippingmethod'];
//        $carts = $order['cart'];
        $finalamount = $order['finalamount'];
        $shippingname = $order['shippingname'];
        $shippingtel = $order['shippingtel'];
//        $customernote = $order['customernote'];
        $data["message"] = $this->order_model->placeorder($user, $firstname, $lastname, $email, $billingaddress, $billingcity, $billingstate, $billingcountry, $shippingaddress, $shippingcity, $shippingcountry, $shippingstate, $shippingpincode, $billingpincode, $phone, $status,  $finalamount, $shippingmethod, $shippingname, $shippingtel);
//        $data["message"] = $this->order_model->placeorder($user, $firstname, $lastname, $email, $billingaddress, $billingcity, $billingstate, $billingcountry, $shippingaddress, $shippingcity, $shippingcountry, $shippingstate, $shippingpincode, $billingpincode, $phone, $status, $company, $fax, $carts, $finalamount, $shippingmethod, $shippingname, $shippingtel, $customernote);
        $this->load->view("json", $data);
    }
    
    
    function updateorderstatusafterpayment() {
        $orderid = $_POST["orderid"];
        $returnvalue = $this->order_model->updateorderstatusafterpayment($orderid);
        return $returnvalue;
    }
    
    
    //avinash apis end
    
    
    
    
    public function imageuploadproduct() 
    {
	    $date = new DateTime();
        $imageName = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";
        if(move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/".$imageName)){
       		$data["message"]=$imageName;
            	$this->load->view("json",$data); 
        }else{
        	$data["message"]="false";
            	$this->load->view("json",$data); 
        }
	    
//        $date = new DateTime();
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = 'gif|jpg|png|jpeg';
//        $config['max_size']	= '10000000';
//        $config['overwrite']	= true;
//        $config['file_name']	= "image-".rand(0, 100000)."".$date->getTimestamp();
//
//        $this->load->library('upload', $config);
//        //$image="file";
//        if (  $this->upload->do_upload("file"))
//        {
//            $uploaddata = $this->upload->data();
//            $image=$uploaddata['file_name'];
//
//            $obj = new stdClass();
//            $obj->value=$image;
//            $data["message"]=$obj;
//            $this->load->view("json2",$data); 
//        }
//       else
//        {
//            $obj = new stdClass();
//            $obj->value=$this->upload->display_errors();
//            $data["message"]=$obj;
//            $this->load->view("json2",$data); 
//        }
    }
    
    public function viewmergeimage() {
        
//        print_r($this->product_model->viewmergeimage());
//        
        header("Content-Type: image/jpeg");
        echo $this->menu_model->viewmergeimage();
    }

    public function viewmergeimage2() {
        
//        print_r($this->product_model->viewmergeimage());
//        
        
        $gotimages=array();
//        $data = json_decode(file_get_contents('php://input'), true);
//        if(!empty($data))
//        {
//            $files=$data['image'];
//            $userid=$data['userid'];
//            $productid=$data['productid'];
//            $price=$data['price'];
//            $quantity=$data['quantity'];
//
//    //        $orderid=$this->order_model->add($userid);
//            $orderproductcartid=$this->order_model->addorderproductcartonaddtocart($userid,$productid,$price,$quantity);
//            foreach($files as $key=>$file)
//            {
//                $imageurl=$file['img'];
//                $left=$file['left'];
//                $top=$file['top'];
//                $order=$key;
//                $checkcharacters=substr($imageurl, 0, 5);
//                if($checkcharacters=="https")
//                {
//    //                echo "in http".$key;
//                    $date = new DateTime();
//                    $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpeg";
//                    
//                    file_put_contents('uploads/'.$filename, file_get_contents($imageurl));
//                    $obj=new stdClass();
//                    $obj->image=$filename;
//                    $obj->left=$left;
//                    $obj->top=$top;
//                    array_push($gotimages,$obj);
//                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
//                }
//                else
//                {
//    //                echo "in normal".$key;
//                    $filename=$file['img'];
//                    $obj=new stdClass();
//                    $obj->image=$filename;
//                    $obj->left=$left;
//                    $obj->top=$top;
//                    array_push($gotimages,$obj);
//                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
//                }
//            }
            
            header("Content-Type: image/jpeg");
//            echo $this->product_model->viewmergeimage($gotimages);
            echo $this->menu_model->viewmergeimage();
//        header("Content-Type: image/jpeg");
//        echo $this->menu_model->viewmergeimage();
//    }
    }

    public function getproductbyid()
    {
        $id=$this->input->get_post('id');
        $data['message']=$this->product_model->getproductbyid($id);
        $this->load->view('json',$data);
    }
    
    
    public function addtocartthumb()
    {
        $gotimages=array();
         $gotimages2=array();
        $data = json_decode(file_get_contents('php://input'), true);
        if(1)
        {
            $files=$data['image'];
            $userid=$data['userid'];
            $productid=$data['productid'];
            $price=$data['price'];
            $quantity=$data['quantity'];

    //        $orderid=$this->order_model->add($userid);
            $orderproductcartid=$this->order_model->addorderproductcartonaddtocart($userid,$productid,$price,$quantity);
            $fileslength=count($files); 
            for($i=0;$i<$fileslength;$i++)
            {
                $file=$files[$i];
                $imageurl=$file['img'];
                $left=$file['left'];
                $top=$file['top'];
                $order=$key;
                $checkcharacters=substr($imageurl, 0, 5);
                if($checkcharacters=="https")
                {
    //                echo "in http".$key;
                    $date = new DateTime();
                    $filename = "image-".rand(0, 100000)."".$date->getTimestamp().".jpeg";
                    
                    file_put_contents('uploads/'.$filename, file_get_contents($imageurl));
                    $obj=new stdClass();
                    $obj->image=$filename;
                    $obj->left=$left;
                    $obj->top=$top;
                    array_push($gotimages,$obj);
                    array_push($gotimages2,$filename);
                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
                }
                else
                {
    //                echo "in normal".$key;
                    $filename=$file['img'];
                    $obj=new stdClass();
                    $obj->image=$filename;
                    $obj->left=$left;
                    $obj->top=$top;
                    array_push($gotimages,$obj);
                    array_push($gotimages2,$filename);
                    $this->order_model->adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top);
                }
            }
            
//            header("Content-Type: image/jpeg");
//            print_r( $this->product_model->viewmergeimage($gotimages));
//            echo $this->product_model->viewmergeimage($gotimages);
            $returnfromthumb=$this->product_model->viewmergeimage($gotimages);
           
            
           
            $date = new DateTime();
            $thmbnail = "image-".rand(0, 100000)."".$date->getTimestamp().".jpg";
            file_put_contents('uploads/'.$thmbnail, file_get_contents($returnfromthumb));
            $addthumbnailtotable=$this->order_model->addthumbnailtouserproductcart($thmbnail,$orderproductcartid);
            $data['message']=true;
        }
        else
        {
            $data['message']=false;
        }
        $this->load->view('json',$data);
    }
    
    public function getcountofcartbyuser()
    {
        $userid=$this->input->get_post('userid');
        $data['message']=$this->order_model->getcountofcartbyuser($userid);
        $this->load->view("json",$data);
    }
    
    public function deletecartbyid()
    {
        $userproductcartid=$this->input->get_post('id');
        $data['message']=$this->order_model->deletecartbyid($userproductcartid);
        $this->load->view("json",$data);
    }
    
    public function checkwithone()
    {
        header("Content-Type: image/jpeg");
        $image=imagecreatefromjpeg(base_url('uploads/image-853461439463918.jpg'));
        echo imagejpeg($image, NULL, 100);
    }
    
    
} ?>