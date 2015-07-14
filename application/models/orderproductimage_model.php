<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class orderproductimage_model extends CI_Model
{
    public function create($orderproduct,$image,$order)
    {
        $data=array("orderproduct" => $orderproduct,"image" => $image,"order" => $order);
        $query=$this->db->insert( "pillow_orderproductimage", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_orderproductimage")->row();
        return $query;
    }
    function getsingleorderproductimage($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_orderproductimage")->row();
        return $query;
    }
    public function edit($id,$orderproduct,$image,$order)
    {
        $data=array("orderproduct" => $orderproduct,"image" => $image,"order" => $order);
        $this->db->where( "id", $id );
        $query=$this->db->update( "pillow_orderproductimage", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `pillow_orderproductimage` WHERE `id`='$id'");
        return $query;
    }
}
?>
