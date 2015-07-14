<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class product_model extends CI_Model
{
    public function create($xsize,$ysize,$status,$image,$name)
    {
        $data=array("xsize" => $xsize,"ysize" => $ysize,"status" => $status,"image" => $image,"name" => $name);
        $query=$this->db->insert( "pillow_product", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_product")->row();
        return $query;
    }
    function getsingleproduct($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("pillow_product")->row();
        return $query;
    }
    public function edit($id,$xsize,$ysize,$status,$image,$name)
    {
        $data=array("xsize" => $xsize,"ysize" => $ysize,"status" => $status,"image" => $image,"name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "pillow_product", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `pillow_product` WHERE `id`='$id'");
        return $query;
    }
    
	public function getstatusdropdown()
	{
		$status= array(
			 "0" => "Disable",
			 "1" => "Enable"
			);
		return $status;
	}
    
	public function getproductimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `pillow_product` WHERE `id`='$id'")->row();
		return $query;
	}
    
    public function getproductdropdown()
	{
		$query=$this->db->query("SELECT * FROM `pillow_product`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
}
?>
