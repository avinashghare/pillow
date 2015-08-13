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
    
    public function getallproducts()
    {
        $query=$this->db->query("SELECT * FROM `pillow_product`")->result();
        return $query;
    }
    public function getproductbyid($id)
    {
        $query=$this->db->query("SELECT * FROM `pillow_product` WHERE `id`='$id'")->row();
        return $query;
    }
    
    public function viewmergeimage($gotimages) {
        
        $jagzimagesize=240;
        
        $mainimage = imagecreatetruecolor(1200, 1200);
        
        $multiplefactor=1200/240;
        
//        $gotimages=array();
//        array_push($gotimages,"1.jpg");
//        array_push($gotimages,"2.jpg");
//        array_push($gotimages,"3.jpg");
//        array_push($gotimages,"1.jpg");
        
//        return $gotimages;
        
        $images=array();
        
        for($i=0;$i<count($gotimages);$i++)
        {
            $obj=array();
            $obj["image"]=imagecreatefromjpeg(base_url('img/'.$gotimages[$i]));
            $obj["width"]=imagesx($obj["image"]);
            $obj["height"]=imagesy($obj["image"]);
            $obj["top"]=0;
            $obj["left"]=0;
            $obj["newtop"]=$obj["top"]*$multiplefactor;
            $obj["newleft"]=$obj["left"]*$multiplefactor;
            array_push($images,$obj);
        }
        
        
        
        
        {
        //for box 1
        $boxes=array();
        $box1=array();
        $box2=array();
        $box2["width"]=1200;
        $box2["heigth"]=1200;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        array_push($boxes,$box1);
        
        //for box 2
        $box1=array();
        $box2=array();
        
        $box2["width"]=1200;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=1200;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        
        array_push($boxes,$box1);
        
        
        //for box 3
        $box1=array();
        $box2=array();
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=600;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=1200;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        
        array_push($boxes,$box1);
        
        
        //for box 4
        $box1=array();
        $box2=array();
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=600;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=600;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        
        
        //for box 5
        $box1=array();
        $box2=array();
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=400;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=800;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=600;
        $box2["xaxis"]=600;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        
        
        //for box 6
        $box1=array();
        $box2=array();
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=400;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=800;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=0;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=400;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=600;
        $box2["xaxis"]=800;
        $box2["yaxis"]=600;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        
        
        //for box 7
        $box1=array();
        $box2=array();
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=1200;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        
        
        //for box 8
        $box1=array();
        $box2=array();
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        $box2["width"]=600;
        $box2["heigth"]=400;
        $box2["xaxis"]=600;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        
        //for box 9
        $box1=array();
        $box2=array();
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=0;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=400;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=0;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=400;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        $box2["width"]=400;
        $box2["heigth"]=400;
        $box2["xaxis"]=800;
        $box2["yaxis"]=800;
        array_push($box1,$box2);
        
        array_push($boxes,$box1);
        }
        
        
//        $box2["width"]=400;
//        $box2["heigth"]=400;
//        $box2["xaxis"]=800;
//        $box2["yaxis"]=800;
//        array_push($box1,$box2);
        
        $imagescount=count($images);
        
        
//        return $boxes[1][0]["width"];
        
        for($i=0;$i<$imagescount;$i++)
        {
            $image=$images[$i];
            $image["boxwidth"]=$boxes[$imagescount-1][$i]["width"];
            $image["boxheight"]=$boxes[$imagescount-1][$i]["heigth"];
            $image["xaxis"]=$boxes[$imagescount-1][$i]["xaxis"];
            $image["yaxis"]=$boxes[$imagescount-1][$i]["yaxis"];
            
            $image["ratio"]=$image["width"]/$image["height"];
            $image["ratiobox"]=$image["boxwidth"]/$image["boxheight"];
            
            if($image["ratio"]>=$image["ratiobox"])
            {
                $image["newheight"]=$image["boxheight"];
                $image["newwidth"]=$image["ratio"]*$image["newheight"];
            }
            else
            {
                $image["newwidth"]=$image["boxwidth"];
                $image["newheight"]=$image["newwidth"]/$image["ratio"];
            }
            $thumb = imagecreatetruecolor($image["newwidth"],$image["newheight"]);
            imagecopyresized($thumb, $image["image"], 0, 0, 0, 0, $image["newwidth"], $image["newheight"], $image["width"], $image["height"]);
            
            
            $image["thumbwidth"]=imagesx($thumb);
            $image["thumbheight"]=imagesy($thumb);
            
            
            
            
            imagecopymerge($mainimage, $thumb, $image["xaxis"], $image["yaxis"], $image["newleft"], $image["newtop"], $image["boxwidth"], $image["boxheight"], 100); 
        }
        
        return imagejpeg($mainimage, NULL, 85);
    }
    
    
    
}
?>
