<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function vieworder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieworder";
        $data["base_url"]=site_url("site/vieworderjson");
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function vieworderjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_order`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_order`.`user`";
        $elements[1]->sort="1";
        $elements[1]->header="User";
        $elements[1]->alias="user";
        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_order`.`firstname`";
        $elements[2]->sort="1";
        $elements[2]->header="Firstname";
        $elements[2]->alias="firstname";
        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_order`.`Lastname`";
        $elements[3]->sort="1";
        $elements[3]->header="Lastname";
        $elements[3]->alias="Lastname";
        $elements[4]=new stdClass();
        $elements[4]->field="`pillow_order`.`email`";
        $elements[4]->sort="1";
        $elements[4]->header="Email";
        $elements[4]->alias="email";
        $elements[5]=new stdClass();
        $elements[5]->field="`pillow_order`.`billingaddress`";
        $elements[5]->sort="1";
        $elements[5]->header="Billing Address";
        $elements[5]->alias="billingaddress";
        $elements[6]=new stdClass();
        $elements[6]->field="`pillow_order`.`billingcity`";
        $elements[6]->sort="1";
        $elements[6]->header="Billing City";
        $elements[6]->alias="billingcity";
        $elements[7]=new stdClass();
        $elements[7]->field="`pillow_order`.`billingstate`";
        $elements[7]->sort="1";
        $elements[7]->header="Billing State";
        $elements[7]->alias="billingstate";
        $elements[8]=new stdClass();
        $elements[8]->field="`pillow_order`.`billingcountry`";
        $elements[8]->sort="1";
        $elements[8]->header="Billing Country";
        $elements[8]->alias="billingcountry";
        $elements[9]=new stdClass();
        $elements[9]->field="`pillow_order`.`shippingaddress`";
        $elements[9]->sort="1";
        $elements[9]->header="Shipping Address";
        $elements[9]->alias="shippingaddress";
        $elements[10]=new stdClass();
        $elements[10]->field="`pillow_order`.`shippingcity`";
        $elements[10]->sort="1";
        $elements[10]->header="Shipping City";
        $elements[10]->alias="shippingcity";
        $elements[11]=new stdClass();
        $elements[11]->field="`pillow_order`.`shippingcountry`";
        $elements[11]->sort="1";
        $elements[11]->header="Shipping Country";
        $elements[11]->alias="shippingcountry";
        $elements[12]=new stdClass();
        $elements[12]->field="`pillow_order`.`shippingstate`";
        $elements[12]->sort="1";
        $elements[12]->header="Shipping State";
        $elements[12]->alias="shippingstate";
        $elements[13]=new stdClass();
        $elements[13]->field="`pillow_order`.`shippingpincode`";
        $elements[13]->sort="1";
        $elements[13]->header="Shipping Pincode";
        $elements[13]->alias="shippingpincode";
        $elements[14]=new stdClass();
        $elements[14]->field="`pillow_order`.`defaultcurrency`";
        $elements[14]->sort="1";
        $elements[14]->header="Default Currency";
        $elements[14]->alias="defaultcurrency";
        $elements[15]=new stdClass();
        $elements[15]->field="`pillow_order`.`totalamount`";
        $elements[15]->sort="1";
        $elements[15]->header="Total Amount";
        $elements[15]->alias="totalamount";
        $elements[16]=new stdClass();
        $elements[16]->field="`pillow_order`.`discountamount`";
        $elements[16]->sort="1";
        $elements[16]->header="Discount Amount";
        $elements[16]->alias="discountamount";
        $elements[17]=new stdClass();
        $elements[17]->field="`pillow_order`.`finalamount`";
        $elements[17]->sort="1";
        $elements[17]->header="Final Amount";
        $elements[17]->alias="finalamount";
        $elements[18]=new stdClass();
        $elements[18]->field="`pillow_order`.`discountcoupon`";
        $elements[18]->sort="1";
        $elements[18]->header="Discount Coupon";
        $elements[18]->alias="discountcoupon";
        $elements[19]=new stdClass();
        $elements[19]->field="`pillow_order`.`paymentmethod`";
        $elements[19]->sort="1";
        $elements[19]->header="Payment Method";
        $elements[19]->alias="paymentmethod";
        $elements[20]=new stdClass();
        $elements[20]->field="`pillow_order`.`orderstatus`";
        $elements[20]->sort="1";
        $elements[20]->header="Order Status";
        $elements[20]->alias="orderstatus";
        $elements[21]=new stdClass();
        $elements[21]->field="`pillow_order`.`currancy`";
        $elements[21]->sort="1";
        $elements[21]->header="Currency";
        $elements[21]->alias="currancy";
        $elements[22]=new stdClass();
        $elements[22]->field="`pillow_order`.`trackingcode`";
        $elements[22]->sort="1";
        $elements[22]->header="Tracking Code";
        $elements[22]->alias="trackingcode";
        $elements[23]=new stdClass();
        $elements[23]->field="`pillow_order`.`billingpincode`";
        $elements[23]->sort="1";
        $elements[23]->header="Billing Code";
        $elements[23]->alias="billingpincode";
        $elements[24]=new stdClass();
        $elements[24]->field="`pillow_order`.`shippingmethod`";
        $elements[24]->sort="1";
        $elements[24]->header="Shipping Method";
        $elements[24]->alias="shippingmethod";
        $elements[25]=new stdClass();
        $elements[25]->field="`pillow_order`.`shippingname`";
        $elements[25]->sort="1";
        $elements[25]->header="Shipping Name";
        $elements[25]->alias="shippingname";
        $elements[26]=new stdClass();
        $elements[26]->field="`pillow_order`.`shippingtel`";
        $elements[26]->sort="1";
        $elements[26]->header="Shipping Tel";
        $elements[26]->alias="shippingtel";
        $elements[27]=new stdClass();
        $elements[27]->field="`pillow_order`.`iscushion`";
        $elements[27]->sort="1";
        $elements[27]->header="Is Cushion";
        $elements[27]->alias="iscushion";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_order`");
        $this->load->view("json",$data);
    }

    public function createorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createorder";
        $data["title"]="Create order";
        $data['user']=$this->user_model->getuserdropdown();
        $data['orderstatus']=$this->order_model->getorderstatusdropdown();
        $data['iscushion']=$this->order_model->getiscushiondropdown();
        $this->load->view("template",$data);
    }
    public function createordersubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("firstname","Firstname","trim");
        $this->form_validation->set_rules("Lastname","Lastname","trim");
        $this->form_validation->set_rules("email","Email","trim");
        $this->form_validation->set_rules("billingaddress","Billing Address","trim");
        $this->form_validation->set_rules("billingcity","Billing City","trim");
        $this->form_validation->set_rules("billingstate","Billing State","trim");
        $this->form_validation->set_rules("billingcountry","Billing Country","trim");
        $this->form_validation->set_rules("shippingaddress","Shipping Address","trim");
        $this->form_validation->set_rules("shippingcity","Shipping City","trim");
        $this->form_validation->set_rules("shippingcountry","Shipping Country","trim");
        $this->form_validation->set_rules("shippingstate","Shipping State","trim");
        $this->form_validation->set_rules("shippingpincode","Shipping Pincode","trim");
        $this->form_validation->set_rules("defaultcurrency","Default Currency","trim");
        $this->form_validation->set_rules("totalamount","Total Amount","trim");
        $this->form_validation->set_rules("discountamount","Discount Amount","trim");
        $this->form_validation->set_rules("finalamount","Final Amount","trim");
        $this->form_validation->set_rules("discountcoupon","Discount Coupon","trim");
        $this->form_validation->set_rules("paymentmethod","Payment Method","trim");
        $this->form_validation->set_rules("orderstatus","Order Status","trim");
        $this->form_validation->set_rules("currancy","Currency","trim");
        $this->form_validation->set_rules("trackingcode","Tracking Code","trim");
        $this->form_validation->set_rules("billingpincode","Billing Code","trim");
        $this->form_validation->set_rules("shippingmethod","Shipping Method","trim");
        $this->form_validation->set_rules("shippingname","Shipping Name","trim");
        $this->form_validation->set_rules("shippingtel","Shipping Tel","trim");
        $this->form_validation->set_rules("iscushion","Is Cushion","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorder";
            $data["title"]="Create order";
            $data['user']=$this->user_model->getuserdropdown();
            $data['orderstatus']=$this->order_model->getorderstatusdropdown();
            $data['iscushion']=$this->order_model->getiscushiondropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $firstname=$this->input->get_post("firstname");
            $Lastname=$this->input->get_post("Lastname");
            $email=$this->input->get_post("email");
            $billingaddress=$this->input->get_post("billingaddress");
            $billingcity=$this->input->get_post("billingcity");
            $billingstate=$this->input->get_post("billingstate");
            $billingcountry=$this->input->get_post("billingcountry");
            $shippingaddress=$this->input->get_post("shippingaddress");
            $shippingcity=$this->input->get_post("shippingcity");
            $shippingcountry=$this->input->get_post("shippingcountry");
            $shippingstate=$this->input->get_post("shippingstate");
            $shippingpincode=$this->input->get_post("shippingpincode");
            $defaultcurrency=$this->input->get_post("defaultcurrency");
            $totalamount=$this->input->get_post("totalamount");
            $discountamount=$this->input->get_post("discountamount");
            $finalamount=$this->input->get_post("finalamount");
            $discountcoupon=$this->input->get_post("discountcoupon");
            $paymentmethod=$this->input->get_post("paymentmethod");
            $orderstatus=$this->input->get_post("orderstatus");
            $currancy=$this->input->get_post("currancy");
            $trackingcode=$this->input->get_post("trackingcode");
            $billingpincode=$this->input->get_post("billingpincode");
            $shippingmethod=$this->input->get_post("shippingmethod");
            $shippingname=$this->input->get_post("shippingname");
            $shippingtel=$this->input->get_post("shippingtel");
            $iscushion=$this->input->get_post("iscushion");
            if($this->order_model->create($user,$firstname,$Lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingcountry,$shippingstate,$shippingpincode,$defaultcurrency,$totalamount,$discountamount,$finalamount,$discountcoupon,$paymentmethod,$orderstatus,$currancy,$trackingcode,$billingpincode,$shippingmethod,$shippingname,$shippingtel,$iscushion)==0)
                $data["alerterror"]="New order could not be created.";
            else
                $data["alertsuccess"]="order created Successfully.";
            $data["redirect"]="site/vieworder";
            $this->load->view("redirect",$data);
        }
    }
    public function editorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editorder";
        $data["page2"]="block/orderblock";
        $data["title"]="Edit order";
        $data['user']=$this->user_model->getuserdropdown();
        $data['orderstatus']=$this->order_model->getorderstatusdropdown();
        $data['iscushion']=$this->order_model->getiscushiondropdown();
        $data["before"]=$this->order_model->beforeedit($this->input->get("id"));
        $this->load->view("templatewith2",$data);
    }
    public function editordersubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("firstname","Firstname","trim");
        $this->form_validation->set_rules("Lastname","Lastname","trim");
        $this->form_validation->set_rules("email","Email","trim");
        $this->form_validation->set_rules("billingaddress","Billing Address","trim");
        $this->form_validation->set_rules("billingcity","Billing City","trim");
        $this->form_validation->set_rules("billingstate","Billing State","trim");
        $this->form_validation->set_rules("billingcountry","Billing Country","trim");
        $this->form_validation->set_rules("shippingaddress","Shipping Address","trim");
        $this->form_validation->set_rules("shippingcity","Shipping City","trim");
        $this->form_validation->set_rules("shippingcountry","Shipping Country","trim");
        $this->form_validation->set_rules("shippingstate","Shipping State","trim");
        $this->form_validation->set_rules("shippingpincode","Shipping Pincode","trim");
        $this->form_validation->set_rules("defaultcurrency","Default Currency","trim");
        $this->form_validation->set_rules("totalamount","Total Amount","trim");
        $this->form_validation->set_rules("discountamount","Discount Amount","trim");
        $this->form_validation->set_rules("finalamount","Final Amount","trim");
        $this->form_validation->set_rules("discountcoupon","Discount Coupon","trim");
        $this->form_validation->set_rules("paymentmethod","Payment Method","trim");
        $this->form_validation->set_rules("orderstatus","Order Status","trim");
        $this->form_validation->set_rules("currancy","Currency","trim");
        $this->form_validation->set_rules("trackingcode","Tracking Code","trim");
        $this->form_validation->set_rules("billingpincode","Billing Code","trim");
        $this->form_validation->set_rules("shippingmethod","Shipping Method","trim");
        $this->form_validation->set_rules("shippingname","Shipping Name","trim");
        $this->form_validation->set_rules("shippingtel","Shipping Tel","trim");
        $this->form_validation->set_rules("iscushion","Is Cushion","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editorder";
            $data["title"]="Edit order";
            $data['user']=$this->user_model->getuserdropdown();
            $data['orderstatus']=$this->order_model->getorderstatusdropdown();
            $data['iscushion']=$this->order_model->getiscushiondropdown();
            $data["before"]=$this->order_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $user=$this->input->get_post("user");
            $firstname=$this->input->get_post("firstname");
            $Lastname=$this->input->get_post("Lastname");
            $email=$this->input->get_post("email");
            $billingaddress=$this->input->get_post("billingaddress");
            $billingcity=$this->input->get_post("billingcity");
            $billingstate=$this->input->get_post("billingstate");
            $billingcountry=$this->input->get_post("billingcountry");
            $shippingaddress=$this->input->get_post("shippingaddress");
            $shippingcity=$this->input->get_post("shippingcity");
            $shippingcountry=$this->input->get_post("shippingcountry");
            $shippingstate=$this->input->get_post("shippingstate");
            $shippingpincode=$this->input->get_post("shippingpincode");
            $defaultcurrency=$this->input->get_post("defaultcurrency");
            $totalamount=$this->input->get_post("totalamount");
            $discountamount=$this->input->get_post("discountamount");
            $finalamount=$this->input->get_post("finalamount");
            $discountcoupon=$this->input->get_post("discountcoupon");
            $paymentmethod=$this->input->get_post("paymentmethod");
            $orderstatus=$this->input->get_post("orderstatus");
            $currancy=$this->input->get_post("currancy");
            $trackingcode=$this->input->get_post("trackingcode");
            $billingpincode=$this->input->get_post("billingpincode");
            $shippingmethod=$this->input->get_post("shippingmethod");
            $shippingname=$this->input->get_post("shippingname");
            $shippingtel=$this->input->get_post("shippingtel");
            $iscushion=$this->input->get_post("iscushion");
            if($this->order_model->edit($id,$user,$firstname,$Lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingcountry,$shippingstate,$shippingpincode,$defaultcurrency,$totalamount,$discountamount,$finalamount,$discountcoupon,$paymentmethod,$orderstatus,$currancy,$trackingcode,$billingpincode,$shippingmethod,$shippingname,$shippingtel,$iscushion)==0)
            $data["alerterror"]="New order could not be Updated.";
            else
            $data["alertsuccess"]="order Updated Successfully.";
            $data["redirect"]="site/vieworder";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->order_model->delete($this->input->get("id"));
        $data["redirect"]="site/vieworder";
        $this->load->view("redirect",$data);
    }
    public function viewproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewproduct";
        $data["base_url"]=site_url("site/viewproductjson");
        $data["title"]="View product";
        $this->load->view("template",$data);
    }
    function viewproductjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_product`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_product`.`xsize`";
        $elements[1]->sort="1";
        $elements[1]->header="X-Size";
        $elements[1]->alias="xsize";
        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_product`.`ysize`";
        $elements[2]->sort="1";
        $elements[2]->header="Y-Size";
        $elements[2]->alias="ysize";
        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_product`.`status`";
        $elements[3]->sort="1";
        $elements[3]->header="Status";
        $elements[3]->alias="status";
        $elements[4]=new stdClass();
        $elements[4]->field="`pillow_product`.`image`";
        $elements[4]->sort="1";
        $elements[4]->header="Image";
        $elements[4]->alias="image";
        $elements[5]=new stdClass();
        $elements[5]->field="`pillow_product`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="Name";
        $elements[5]->alias="name";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_product`");
        $this->load->view("json",$data);
    }

    public function createproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createproduct";
        $data["title"]="Create product";
        $data['status']=$this->product_model->getstatusdropdown();
        $this->load->view("template",$data);
    }
    public function createproductsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("xsize","X-Size","trim");
        $this->form_validation->set_rules("ysize","Y-Size","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createproduct";
            $data["title"]="Create product";
            $data['status']=$this->product_model->getstatusdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $xsize=$this->input->get_post("xsize");
            $ysize=$this->input->get_post("ysize");
            $status=$this->input->get_post("status");
            $name=$this->input->get_post("name");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    $image=$this->image_lib->dest_image;
                }
                
			}
            
            if($this->product_model->create($xsize,$ysize,$status,$image,$name)==0)
            $data["alerterror"]="New product could not be created.";
            else
            $data["alertsuccess"]="product created Successfully.";
            $data["redirect"]="site/viewproduct";
            $this->load->view("redirect",$data);
        }
    }
    public function editproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editproduct";
        $data["title"]="Edit product";
        $data['status']=$this->product_model->getstatusdropdown();
        $data["before"]=$this->product_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editproductsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("xsize","X-Size","trim");
        $this->form_validation->set_rules("ysize","Y-Size","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editproduct";
            $data["title"]="Edit product";
            $data['status']=$this->product_model->getstatusdropdown();
            $data["before"]=$this->product_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $xsize=$this->input->get_post("xsize");
            $ysize=$this->input->get_post("ysize");
            $status=$this->input->get_post("status");
//            $image=$this->input->get_post("image");
            $name=$this->input->get_post("name");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->product_model->getproductimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
            
            if($this->product_model->edit($id,$xsize,$ysize,$status,$image,$name)==0)
                $data["alerterror"]="New product could not be Updated.";
            else
                $data["alertsuccess"]="product Updated Successfully.";
            $data["redirect"]="site/viewproduct";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->product_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewproduct";
        $this->load->view("redirect",$data);
    }
    public function vieworderproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieworderproduct";
        $data["page2"]="block/orderblock";
        $order=$this->input->get('id');
        $data['order']=$this->input->get('id');
        $data['before']=$this->order_model->beforeedit($order);
        $data["base_url"]=site_url("site/vieworderproductjson?id=".$order);
        $data["title"]="View orderproduct";
        $this->load->view("templatewith2",$data);
    }
    function vieworderproductjson()
    {
        
        $order=$this->input->get('id');
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
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_orderproduct`","WHERE `pillow_orderproduct`.`order`='$order'");
        $this->load->view("json",$data);
    }

    public function createorderproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createorderproduct";
        $data["title"]="Create orderproduct";
        $data["page2"]="block/orderblock";
        $order=$this->input->get('id');
        $data['order']=$this->input->get('id');
        $data['product']=$this->product_model->getproductdropdown();
        $data['before']=$this->order_model->beforeedit($order);
        $this->load->view("templatewith2",$data);
    }
    public function createorderproductsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("order","Order","trim");
        $this->form_validation->set_rules("product","Product","trim");
        $this->form_validation->set_rules("quantity","Quantity","trim");
        $this->form_validation->set_rules("price","Price","trim");
        $this->form_validation->set_rules("discount","Discount","trim");
        $this->form_validation->set_rules("finalprice","Final Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorderproduct";
            $data["title"]="Create orderproduct";
            $order=$this->input->get('order');
            $data['order']=$this->input->get('order');
            $data['product']=$this->product_model->getproductdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $order=$this->input->get_post("order");
            $product=$this->input->get_post("product");
            $quantity=$this->input->get_post("quantity");
            $price=$this->input->get_post("price");
            $discount=$this->input->get_post("discount");
            $finalprice=$this->input->get_post("finalprice");
            if($this->orderproduct_model->create($order,$product,$quantity,$price,$discount,$finalprice)==0)
                $data["alerterror"]="New orderproduct could not be created.";
            else
                $data["alertsuccess"]="orderproduct created Successfully.";
            $data["redirect"]="site/vieworderproduct?id=".$order;
            $this->load->view("redirect2",$data);
        }
    }
    public function editorderproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editorderproduct";
        $data["page2"]="block/orderproductblock";
        $data["title"]="Edit orderproduct";
        $order=$this->input->get('id');
        $data['order']=$this->input->get('id');
        $data['id']=$this->input->get('orderproductid');
        $data['product']=$this->product_model->getproductdropdown();
        $data["before"]=$this->orderproduct_model->beforeedit($this->input->get("orderproductid"));
        $data["beforeorderproduct"]=$this->orderproduct_model->beforeedit($this->input->get("orderproductid"));
        $this->load->view("templatewith2",$data);
    }
    public function editorderproductsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("order","Order","trim");
        $this->form_validation->set_rules("product","Product","trim");
        $this->form_validation->set_rules("quantity","Quantity","trim");
        $this->form_validation->set_rules("price","Price","trim");
        $this->form_validation->set_rules("discount","Discount","trim");
        $this->form_validation->set_rules("finalprice","Final Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editorderproduct";
            $data["title"]="Edit orderproduct";
            $data["before"]=$this->orderproduct_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $order=$this->input->get_post("order");
            $product=$this->input->get_post("product");
            $quantity=$this->input->get_post("quantity");
            $price=$this->input->get_post("price");
            $discount=$this->input->get_post("discount");
            $finalprice=$this->input->get_post("finalprice");
            if($this->orderproduct_model->edit($id,$order,$product,$quantity,$price,$discount,$finalprice)==0)
                $data["alerterror"]="New orderproduct could not be Updated.";
            else
                $data["alertsuccess"]="orderproduct Updated Successfully.";
            $data["redirect"]="site/vieworderproduct?id=".$order;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteorderproduct()
    {
        $access=array("1");
        $this->checkaccess($access);
        $order=$this->input->get('id');
        $orderproductid=$this->input->get('orderproductid');
        $this->orderproduct_model->delete($this->input->get("orderproductid"));
        $data["redirect"]="site/vieworderproduct?id=".$order."&orderproductid=".$orderproductid;
        $this->load->view("redirect2",$data);
    }
    
    public function vieworderproductimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieworderproductimage";
        $data["page2"]="block/orderproductblock";
        
        
        $order=$this->input->get('id');
        $data['order']=$this->input->get('id');
//        $data['before']=$this->order_model->beforeedit($order);
        
        $orderproductid=$this->input->get('orderproductid');
        $data['orderproductid']=$this->input->get('orderproductid');
        $data['before']=$this->orderproduct_model->beforeedit($orderproductid);
        
        $data["base_url"]=site_url("site/vieworderproductimagejson?orderproductid=".$orderproductid);
        $data["title"]="View orderproductimages";
        $this->load->view("templatewith2",$data);
    }
    function vieworderproductimagejson()
    {
        $orderproductid=$this->input->get('orderproductid');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_orderproductimage`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_orderproductimage`.`orderproduct`";
        $elements[1]->sort="1";
        $elements[1]->header="Order Product";
        $elements[1]->alias="orderproduct";
        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_orderproductimage`.`image`";
        $elements[2]->sort="1";
        $elements[2]->header="Image";
        $elements[2]->alias="image";
        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_orderproductimage`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_orderproductimage`","WHERE `pillow_orderproductimage`.`orderproduct`='$orderproductid'");
        $this->load->view("json",$data);
    }


    public function vieworderproductimage2()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieworderproductimage2";
//        $data["page2"]="block/orderproductblock";
        
        
        $order=$this->input->get('id');
        $data['order']=$this->input->get('id');
//        $data['before']=$this->order_model->beforeedit($order);
        
        $orderproductid=$this->input->get('orderproductid');
        $data['orderproductid']=$this->input->get('orderproductid');
        $data['before']=$this->orderproduct_model->beforeedit($orderproductid);
        
        $data["base_url"]=site_url("site/vieworderproductimagejson2?orderproductid=".$orderproductid);
        $data["title"]="View orderproductimages";
        $this->load->view("template",$data);
    }
    function vieworderproductimagejson2()
    {
        $orderproductid=$this->input->get('orderproductid');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`pillow_orderproductimage`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`pillow_orderproductimage`.`orderproduct`";
        $elements[1]->sort="1";
        $elements[1]->header="Order Product";
        $elements[1]->alias="orderproduct";
        $elements[2]=new stdClass();
        $elements[2]->field="`pillow_orderproductimage`.`image`";
        $elements[2]->sort="1";
        $elements[2]->header="Image";
        $elements[2]->alias="image";
        $elements[3]=new stdClass();
        $elements[3]->field="`pillow_orderproductimage`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="order";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `pillow_orderproductimage`","WHERE `pillow_orderproductimage`.`orderproduct`='$orderproductid'");
        $this->load->view("json",$data);
    }

    public function createorderproductimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $order=$this->input->get('id');
        $orderproductid=$this->input->get('orderproductid');
        $data['order']=$order;
        $data['orderproductid']=$orderproductid;
        
        
        $orderproductid=$this->input->get('orderproductid');
        $data['orderproductid']=$this->input->get('orderproductid');
        $data['before']=$this->orderproduct_model->beforeedit($orderproductid);
        
        $data["page"]="createorderproductimage";
        $data["page2"]="block/orderproductblock";
        $data["title"]="Create orderproductimage";
        $this->load->view("templatewith2",$data);
    }
    public function createorderproductimagesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("orderproduct","Product Image","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorderproductimage";
            $data["title"]="Create orderproductimage";
            $this->load->view("template",$data);
        }
        else
        {
            $orderproduct=$this->input->get_post("orderproduct");
            $image=$this->input->get_post("image");
            $order=$this->input->get_post("order");
            $orderid=$this->input->get_post("orderid");
            
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    $image=$this->image_lib->dest_image;
                }
                
			}
            
            
            if($this->orderproductimage_model->create($orderproduct,$image,$order)==0)
            $data["alerterror"]="New orderproductimage could not be created.";
            else
            $data["alertsuccess"]="orderproductimage created Successfully.";
            $data["redirect"]="site/vieworderproductimage?id=".$orderid."&orderproductid=".$orderproduct;
            $this->load->view("redirect2",$data);
        }
    }
    public function editorderproductimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editorderproductimage";
        $data["title"]="Edit orderproductimage";
        $data["before"]=$this->orderproductimage_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editorderproductimagesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("orderproduct","Product Image","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editorderproductimage";
            $data["title"]="Edit orderproductimage";
            $data["before"]=$this->orderproductimage_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $orderproduct=$this->input->get_post("orderproduct");
            $image=$this->input->get_post("image");
            $order=$this->input->get_post("order");
            if($this->orderproductimage_model->edit($id,$orderproduct,$image,$order)==0)
            $data["alerterror"]="New orderproductimage could not be Updated.";
            else
            $data["alertsuccess"]="orderproductimage Updated Successfully.";
            $data["redirect"]="site/vieworderproductimage";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteorderproductimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $order=$this->input->get('id');
        $orderproductid=$this->input->get('orderproductid');
        $orderproductimageid=$this->input->get('orderproductimageid');
        $this->orderproductimage_model->delete($this->input->get("orderproductimageid"));
        $data["redirect"]="site/vieworderproductimage?id=".$order."&orderproductid=".$orderproductid;
        $this->load->view("redirect2",$data);
    }

}
?>
