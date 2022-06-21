<?php
    session_start();
    include "../../Connection.php";
    error_reporting(0);
    
    $msg =mysqli_real_escape_string($conn,$_POST['msg']);
    
    //general questions
    $sql="SELECT response FROM knowledge WHERE phrase LIKE '%{$msg}%'";
    $query = mysqli_query($conn,$sql);

    if(mysqli_num_rows($query)>0){
        $res=mysqli_fetch_assoc($query);
        echo $res['response'];
    }
    else
    {    
            
        executeUserRequest();
    }

    //further execute with respect to available products, varieties and quantities
    function executeUserRequest(){
        $productResult='';
        $varietyName = '';
        $quantityResult='';
        $output='';
        $productIsNull = TRUE;
        $varietyIsNull = TRUE;
        $quantityIsNull = TRUE;
        $msgs= explode (" ", $msg);
        
        
        foreach($msgs as $m){
            list($productResult,$productIsNull) = getProducts($conn,$m); 
            if(!$productIsNull){
                break;
            }
        }
        foreach($msgs as $m){
            list($varietyName,$varietyIsNull) = getVarieties($conn,$m); 
            if(!$varietyIsNull){
                $_SESSION['variety'] ='';
                $_SESSION['variety'] = $varietyName;
                break;
            }
        }
        if($_SESSION['variety']!=''){
            $varietyName =  $_SESSION['variety'];
            $varietyIsNull =  FALSE;
        }
        if(!$varietyIsNull){          
           foreach($msgs as $m){
            list($quantityResult,$quantityIsNull) = getQuanties($conn,$m,$varietyName); 
            if(!$quantityIsNull){
                break;
            }
           }
        }
        if(!$quantityIsNull){
            echo $quantityResult;
        }else if($quantityIsNull && !$productIsNull){
            echo $productResult;
        }elseif($quantityIsNull && !$varietyIsNull){
            echo 'Specify the quantity of '. $_SESSION['variety'];
        }
        else{  
            echo " Please,I can not understand. Please try again"; 
        }
    }
//further execute with respect to available products
function getProducts($conn,$msg){
    $sql="SELECT name FROM products WHERE name LIKE '%{$msg}%'";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)>0){
        $sql="SELECT  DISTINCT(v.name) as variety
                from  variety v 
                join products p 
                on v.productId = p.id WHERE p.name LIKE '%{$msg}%'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
            $results='<p>We have the following varieties of '. $msg .': ';
            while($data=mysqli_fetch_assoc($query)){
                $results .= $data['variety'].',';
            }
            $results=substr($results, 0, -1);
            $results .='. Specify the variety of '. $msg;
            return array($results,FALSE);
        }
    }else{
        return array('',TRUE);
    }
}
//further execute with respect to available varieties
function getVarieties($conn,$msg){
    $sql="SELECT name FROM variety WHERE name LIKE '%{$msg}%'";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)>0){
        $res=mysqli_fetch_assoc($query);
        return array($res['name'],FALSE);
    }else{
        return array('',TRUE);
    }
       
}
//further execute with respect to available quantities
function getQuanties($conn,$msg,$varietyName){
    $sql="SELECT 
            c.cost as cost,c.qnty as qnty, c.isavailable as status
            FROM price c 
            join  variety v 
            on c.varietyId = v.id 
            WHERE c.qnty LIKE '%{$msg}%' and v.name='{$varietyName}'";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)>0){
        $res=mysqli_fetch_assoc($query);
        $results='Hello, The price of '.$varietyName.' is as follows:';
        $results .='<p>'.$msg.' @ '.$res['cost'].'</p>';
        if($res['status']==0)
        {
            $results .='However, it is out of stock' ;
        }
        return array($results,FALSE);
        
    }else{
        return array('',TRUE);
    }
       
}
 
   
   
?>