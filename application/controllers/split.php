<?php
public function addtocart()
    {
        $gotimages=array();
         $gotimages2=array();
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
           
            $this->order_model->addthumbnailtouserproductcart($returnfromthumb,$orderproductcartid);
           
           
            $data['message']=true;
        }
        else
        {
            $data['message']=false;
        }
        $this->load->view('json',$data);
    }
    ?>