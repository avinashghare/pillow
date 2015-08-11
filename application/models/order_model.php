<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class order_model extends CI_Model
{
    public function create($user,$firstname,$Lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingcountry,$shippingstate,$shippingpincode,$defaultcurrency,$totalamount,$discountamount,$finalamount,$discountcoupon,$paymentmethod,$orderstatus,$currancy,$trackingcode,$billingpincode,$shippingmethod,$shippingname,$shippingtel,$iscushion)
    {
        $data=array("user" => $user,"firstname" => $firstname,"Lastname" => $Lastname,"email" => $email,"billingaddress" => $billingaddress,"billingcity" => $billingcity,"billingstate" => $billingstate,"billingcountry" => $billingcountry,"shippingaddress" => $shippingaddress,"shippingcity" => $shippingcity,"shippingcountry" => $shippingcountry,"shippingstate" => $shippingstate,"shippingpincode" => $shippingpincode,"defaultcurrency" => $defaultcurrency,"totalamount" => $totalamount,"discountamount" => $discountamount,"finalamount" => $finalamount,"discountcoupon" => $discountcoupon,"paymentmethod" => $paymentmethod,"orderstatus" => $orderstatus,"currancy" => $currancy,"trackingcode" => $trackingcode,"billingpincode" => $billingpincode,"shippingmethod" => $shippingmethod,"shippingname" => $shippingname,"shippingtel" => $shippingtel,"iscushion" => $iscushion);
        $query=$this->db->insert( "pillow_order", $data );
        $id=$this->db->insert_id();
        if(!$query)
            return  0;
        else
            return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_order")->row();
        return $query;
    }
    function getsingleorder($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_order")->row();
        return $query;
    }
    public function edit($id,$user,$firstname,$Lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingcountry,$shippingstate,$shippingpincode,$defaultcurrency,$totalamount,$discountamount,$finalamount,$discountcoupon,$paymentmethod,$orderstatus,$currancy,$trackingcode,$billingpincode,$shippingmethod,$shippingname,$shippingtel,$iscushion)
    {
        $data=array("user" => $user,"firstname" => $firstname,"Lastname" => $Lastname,"email" => $email,"billingaddress" => $billingaddress,"billingcity" => $billingcity,"billingstate" => $billingstate,"billingcountry" => $billingcountry,"shippingaddress" => $shippingaddress,"shippingcity" => $shippingcity,"shippingcountry" => $shippingcountry,"shippingstate" => $shippingstate,"shippingpincode" => $shippingpincode,"defaultcurrency" => $defaultcurrency,"totalamount" => $totalamount,"discountamount" => $discountamount,"finalamount" => $finalamount,"discountcoupon" => $discountcoupon,"paymentmethod" => $paymentmethod,"orderstatus" => $orderstatus,"currancy" => $currancy,"trackingcode" => $trackingcode,"billingpincode" => $billingpincode,"shippingmethod" => $shippingmethod,"shippingname" => $shippingname,"shippingtel" => $shippingtel,"iscushion" => $iscushion);
        $this->db->where( "id", $id );
        $query=$this->db->update( "pillow_order", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `pillow_order` WHERE `id`='$id'");
        return $query;
    }
    
    public function getorderstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `orderstatus`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	public function getiscushiondropdown()
	{
		$status= array(
			 "0" => "No",
			 "1" => "Yes"
			);
		return $status;
	}
    
    
	//frontend apis
    
    function addorderonproceed($userid)
    {
        $query=$this->db->query("INSERT INTO `pillow_order`(`id`, `user`,`orderstatus`) VALUES (NULL,'$userid',1)");
        $id=$this->db->insert_id();
        return $id;
    }
    
    function addorderproductonproceed($orderid)
    {
        $query=$this->db->query("INSERT INTO `pillow_orderproduct`(`id`, `order`) VALUES (NULL,'$orderid')");
        $id=$this->db->insert_id();
        return $id;
    }
    function addorderimageonproceed($orderproductid,$filename,$order)
    {
        $query=$this->db->query("INSERT INTO `pillow_orderproductimage`(`id`, `orderproduct`,`image`,`order`) VALUES (NULL,'$orderproductid','$filename','$order')");
        $id=$this->db->insert_id();
        return $id;
    }
    //cart functions
    
    
	function getusercart($user)
	{
		$query="SELECT `product`.`name`,`product`.`price`, `product`.`wholesaleprice`,`product`.`firstsaleprice`,`usercart`.`user`,`usercart`.`product`,`usercart`.`quantity`,`product`.`id` FROM `product` LEFT JOIN `usercart` ON `product`.`id`=`usercart`.`product` WHERE `usercart`.`user`='$user'";   
		$query=$this->db->query($query)->result();
		return $query;
	}
    function addtocart($user,$product,$quantity)
    {
        $query=$this->db->query("SELECT `user`, `product`, `quantity`, `status`, `timestamp` FROM `usercart` WHERE `user`='$user' AND `product`='$product'");
        if($query->num_rows > 0)
        {
            $query=$this->db->query("UPDATE `usercart` SET `quantity`='$quantity' WHERE '$user'");
        }
        else
        {
            $query=$this->db->query("INSERT INTO `usercart`(`user`, `product`, `quantity`) VALUES ('$user','$product','$quantity')");
        }
    }
}
?>
