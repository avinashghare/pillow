<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class orderproduct_model extends CI_Model
{
    public function create($order,$product,$quantity,$price,$discount,$finalprice)
    {
        $data=array("order" => $order,"product" => $product,"quantity" => $quantity,"price" => $price,"discount" => $discount,"finalprice" => $finalprice);
        $query=$this->db->insert( "pillow_orderproduct", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_orderproduct")->row();
        return $query;
    }
    function getsingleorderproduct($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_orderproduct")->row();
        return $query;
    }
    public function edit($id,$order,$product,$quantity,$price,$discount,$finalprice)
    {
        $data=array("order" => $order,"product" => $product,"quantity" => $quantity,"price" => $price,"discount" => $discount,"finalprice" => $finalprice);
        $this->db->where( "id", $id );
        $query=$this->db->update( "pillow_orderproduct", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `pillow_orderproduct` WHERE `id`='$id'");
        return $query;
    }
}
?>
