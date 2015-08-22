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
    
    function addorderproductcartonaddtocart($userid,$productid,$price,$quantity)
    {
        $total=floatval($price)*intval($quantity);
        $query=$this->db->query("INSERT INTO `userproductcart`(`id`, `user`,`product`,`quantity`,`finalprice`,`price`) VALUES (NULL,'$userid','$productid','$quantity','$total','$price')");
        $id=$this->db->insert_id();
        return $id;
    }
    
    function addorderproductcartonaddtocartonedit($userid,$productid,$price,$quantity,$userproductcartid)
    {
        $total=floatval($price)*intval($quantity);
        $query=$this->db->query("UPDATE `userproductcart` SET `user`='$userid',`product`='$productid',`quantity`='$quantity',`price`='$price',`finalprice`='$total' WHERE `id`='$userproductcartid'");
        $id=$this->db->insert_id();
        return $userproductcartid;
    }
    
    function addorderimageonproceed($orderproductid,$filename,$order)
    {
        $query=$this->db->query("INSERT INTO `pillow_orderproductimage`(`id`, `orderproduct`,`image`,`order`) VALUES (NULL,'$orderproductid','$filename','$order')");
        $id=$this->db->insert_id();
        return $id;
    }
    function adduserproductimagecartonaddtocart($orderproductcartid,$filename,$order,$left,$top)
    {
        $query=$this->db->query("INSERT INTO `userproductimagecart`(`id`, `userproductcart`,`image`,`order`,`left`,`top`) VALUES (NULL,'$orderproductcartid','$filename','$order','$left','$top')");
        $id=$this->db->insert_id();
        return $id;
    }
    
    function getorderproductbyid($orderproductid)
    {
        $query=$this->db->query("SELECT `pillow_orderproduct`.`id`, `pillow_orderproduct`.`order`, `pillow_orderproduct`.`product`,`pillow_orderproduct`. `quantity`,`pillow_orderproduct`. `price`,`pillow_orderproduct`. `discount`,`pillow_orderproduct`. `finalprice`,`pillow_orderproduct`. `thumbnail`
FROM `pillow_orderproduct` 
WHERE `id`='$orderproductid'")->row();
        $query->images=$this->db->query("SELECT `pillow_orderproductimage`.`id`, `pillow_orderproductimage`.`orderproduct`,`pillow_orderproductimage`. `image`,`pillow_orderproductimage`. `order`,`pillow_orderproductimage`. `left`,`pillow_orderproductimage`. `top`
FROM `pillow_orderproductimage` 
        WHERE `pillow_orderproductimage` .`orderproduct`='$orderproductid'")->result();
        return $query;
    }
    
    function getuserproductcartbyid($userproductcartid)
    {
        $query=$this->db->query("SELECT `userproductcart`.`id`,`userproductcart`. `user`,`userproductcart`. `product`,`userproductcart`. `quantity`,`userproductcart`. `price`,`userproductcart`. `discount`,`userproductcart`. `finalprice`,`userproductcart`. `thumbnail`,`user`.`email`
FROM `userproductcart` LEFT OUTER JOIN `user` ON `user`.`id`=`userproductcart`.`user`
WHERE `userproductcart`.`id`='$userproductcartid'")->row();
        $query->images=$this->db->query("SELECT `userproductimagecart`.`id`,`userproductimagecart`. `userproductcart`,`userproductimagecart`. `image`,`userproductimagecart`. `order`,`userproductimagecart`. `left`,`userproductimagecart`. `top`
FROM `userproductimagecart` 
        WHERE `userproductimagecart` .`userproductcart`='$userproductcartid'")->result();
        return $query;
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
    
    function deleteuserproductimagecart($userproductcartid)
    {
        $deletequery=$this->db->query("DELETE FROM `userproductimagecart` WHERE `userproductcart`='$userproductcartid'");
        if($deletequery)
            return 1;
        else
            return 0;
    }
    
    
//    function placeorder($user,$firstname,$lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingcountry,$shippingstate,$shippingpincode,$billingpincode,$phone,$status,$company,$fax,$carts,$finalamount,$shippingmethod,$shippingname,$shippingtel,$customernote)
    
    function placeorder($user, $firstname, $lastname, $email, $billingaddress, $billingcity, $billingstate, $billingcountry, $shippingaddress, $shippingcity, $shippingcountry, $shippingstate, $shippingpincode, $billingpincode, $phone, $status,  $finalamount, $shippingmethod, $shippingname, $shippingtel)
	{
        
        $mysession=$this->session->all_userdata();
        
        $query=$this->db->query("INSERT INTO `pillow_order`(`user`, `firstname`, `lastname`, `email`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `finalamount`, `billingpincode`,`shippingmethod`,`orderstatus`,`shippingname`,`shippingtel`,`billingcontact`) VALUES ('$user','$firstname','$lastname','$email','$billingaddress','$billingcity','$billingstate','$billingcountry','$shippingaddress','$shippingcity','$shippingcountry','$shippingstate','$shippingpincode','$finalamount','$billingpincode','$shippingmethod','1','$shippingname','$shippingtel','$phone')");
        
//        $billingaddressforuser=$billingaddress;
//        $shippingaddressforuser=$shippingaddress;
        
        $order=$this->db->insert_id();
        $returnorderid=$order;
        $mysession["orderid"]=$order;
        $this->session->set_userdata($mysession);
//        print_r($this->session->all_userdata());
        
        $userproductcartdetails=$this->db->query("SELECT `userproductcart`.`id`,`userproductcart`. `user`,`userproductcart`. `product`,`userproductcart`. `quantity`,`userproductcart`. `price`,`userproductcart`. `discount`,`userproductcart`. `finalprice`,`userproductcart`. `thumbnail`,`user`.`email`
FROM `userproductcart` LEFT OUTER JOIN `user` ON `user`.`id`=`userproductcart`.`user`
WHERE `userproductcart`.`user`='$user'")->result();
        
        foreach($userproductcartdetails as $key=>$value)
        {
            $userproductcartid=$value->id;
//            $orderid=$value->order;
            $userid=$value->user;
            $productid=$value->product;
            $quantity=$value->quantity;
            $price=$value->price;
            $discount=$value->discount;
            $finalprice=$value->finalprice;
            $thumbnail=$value->thumbnail;
            
            $insertqueryforuserproductcart=$this->db->query("INSERT INTO `pillow_orderproduct`(`order`, `product`, `quantity`, `price`, `discount`, `finalprice`, `thumbnail`) VALUES ('$order','$productid','$quantity','$price','$discount','$finalprice','$thumbnail')");
            $orderproductid=$this->db->insert_id();
            $userproductcartid=$value->id;
            $userproductimagecartdetails=$this->db->query("SELECT `userproductimagecart`.`id`,`userproductimagecart`. `userproductcart`,`userproductimagecart`. `image`,`userproductimagecart`. `order`,`userproductimagecart`. `left`,`userproductimagecart`. `top`
FROM `userproductimagecart` 
        WHERE `userproductimagecart` .`userproductcart`='$userproductcartid'")->result();
            
            foreach($userproductimagecartdetails as $value2)
            {
                $userproductimagecartid=$value2->id;
                $image=$value2->image;
                $order=$value2->order;
                $left=$value2->left;
                $top=$value2->top;
                $queryinsertorderproductimage=$this->db->query("INSERT INTO `pillow_orderproductimage`(`orderproduct`, `image`, `order`, `left`, `top`) VALUES ('$orderproductid','$image','$order','$left','$top')");
                $deletecartdataquery2=$this->db->query("DELETE FROM `userproductimagecart` WHERE `id`='$userproductimagecartid'");
            }
            
        }
        
            //delete all userproductcart and userproductcartimages
        
            $deletecartdataquery1=$this->db->query("DELETE FROM `userproductcart` WHERE `user`='$user'");
        
        if($returnorderid<=0)
        {
            return 0;
        }
        else
        {
            return intval($returnorderid);
        }
	}
	
    function updateorderstatusafterpayment($orderid)
    {
        $query=$this->db->query("UPDATE `pillow_order` SET `orderstatus`=2 WHERE `id`='$orderid'");
        return $query;
    }
    
    function getcountofcartbyuser($userid)
    {
        $query=$this->db->query("SELECT COUNT(`id`) AS `count1` FROM `userproductcart` WHERE `user`='$userid'")->row();
        $count=$query->count1;
        return intval($count);
    }
    function deletecartbyid($userproductcartid)
    {
        $query=$this->db->query("DELETE FROM `userproductcart` WHERE `id`='$userproductcartid'");
        $querydeleteimages=$this->db->query("DELETE FROM `userproductimagecart` WHERE `userproductcart`='$userproductcartid'");
        return $query;
    }
    
    function addthumbnailtouserproductcart($thmbnail,$userproductcartid)
    {
        $queryupdate=$this->db->query("UPDATE `userproductcart` SET `thumbnail`='$thmbnail' WHERE `id`='$userproductcartid'");
        return $queryupdate;
    }
    
    function pendingaddtocart($orderproductid)
    {
        $queryselect=$this->db->query("SELECT `pillow_orderproduct`.`id`,`pillow_orderproduct`. `order`,`pillow_orderproduct`. `product`,`pillow_orderproduct`. `quantity`, `pillow_orderproduct`.`price`,`pillow_orderproduct`. `discount`,`pillow_orderproduct`. `finalprice`,`pillow_orderproduct`. `thumbnail` ,`pillow_order`.`user`
FROM `pillow_orderproduct` LEFT OUTER JOIN `pillow_order` ON `pillow_orderproduct`.`order`=`pillow_order`.`id` WHERE `pillow_orderproduct`.`id`='$orderproductid'")->row();
        $userid=$queryselect->user;
        $productid=$queryselect->product;
        $quantity=$queryselect->quantity;
        $price=$queryselect->price;
        $discount=$queryselect->discount;
        $total=$queryselect->finalprice;
        $thumbnail=$queryselect->thumbnail;
        
        $queryinsertincart=$this->db->query("INSERT INTO `userproductcart`(`id`, `user`,`product`,`quantity`,`finalprice`,`price`,`thumbnail`) VALUES (NULL,'$userid','$productid','$quantity','$total','$price','$thumbnail')");
        $userproductcartid=$this->db->insert_id();
        
        $queryselectorderproductimage=$this->db->query("SELECT * FROM `pillow_orderproductimage` WHERE `orderproduct`='$orderproductid'")->result();
        foreach($queryselectorderproductimage as $key=>$row)
        {
            $image=$row->image;
            $order=$row->order;
            $left=$row->left;
            $top=$row->top;
            $insertqueryforimages=$this->db->query("INSERT INTO `userproductimagecart`(`id`, `userproductcart`,`image`,`order`,`left`,`top`) VALUES (NULL,'$userproductcartid','$image','$order','$left','$top')");
        }
        
        if($queryinsertincart)
        {
            $this->db->query("DELETE FROM `pillow_orderproduct` WHERE `id`='$orderproductid'");
            $this->db->query("DELETE FROM `pillow_orderproductimage` WHERE `orderproduct`='$orderproductid'");
            return $userproductcartid;
        }
        else
        {
            return 0;
        }
        
    }
}
?>
