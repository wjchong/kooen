<?php
include("config.php");
// error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;


if(isset($_POST['update_ingredients'])){
    $words = $_POST['update_ingredients'];
    $id = $_SESSION['login'];
    if(!mysqli_query($conn,"UPDATE users SET preset_words='$words' WHERE id='$id'")){
        die(false);
    }
    die(true);
}
if(isset($_POST['method']) && ($_POST['method'] == "deductfund")){
	$mobile_num=$_POST['mobile_num'];
	if(strpos($mobile_num, "60") === 0) 
	{
		$sender_mobile=$_POST['mobile_num'];
	}
	else
	{
	   $sender_mobile="60".$_POST['mobile_num'];	
	}
	
	$merchant_id=$_POST['merchant_id'];
	$session_user_id=$_SESSION['login'];
	$paid_amount=$_POST['paid_wallet_amount'];
	$selected_invoice_id=$_POST['selected_invoice_id'];
	$selected_invoice_id=ltrim($selected_invoice_id,",");
	$selected_invoice_id=rtrim($selected_invoice_id,",");
	$sender_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE mobile_number='".$sender_mobile."'"));
	if($sender_detail)
	{
		 $user_balance=$sender_detail['balance_myr'];
		 $sender_id=$sender_detail['id'];
		// $merchant_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='".$merchant_id."'"));
		// $merchant_balance=$sender_detail['balance_myr'];
		 $new_bal=$user_balance-$paid_amount;
		
		$update=mysqli_query($conn, "UPDATE users SET balance_myr='$new_bal' WHERE mobile_number='$sender_mobile'");
		mysqli_query($conn, "UPDATE order_list SET status='1',wallet='ewallet',order_process_by='$session_user_id' WHERE id in($selected_invoice_id)");
		mysqli_query($conn,"INSERT INTO `wallet_history` (`sender_id`, `total_amount`,`order_ids`) VALUES ('$sender_id','$new_bal','$selected_invoice_id')");
		if($update)
			 $array_detail=array('status'=>true,'msg'=>'Order Completed');
		else
		 $array_detail=array('status'=>false,'msg'=>'Failed to Deduct Balance');	
	}
	else
	{
	  $array_detail=array('status'=>false,'msg'=>'Invalid Mobile No of Sender');
	}
	 echo json_encode($array_detail);
	 die;
}
if(isset($_POST['method']) && ($_POST['method'] == "favorite")){
    if($_POST['favorite'] == 1){
        mysqli_query($conn, "INSERT INTO favorities VALUES('', ".$_POST['user_id'].", ".$_POST['merchant_id'].")");
    } else {
        mysqli_query($conn, "DELETE FROM favorities WHERE user_id = ".$_POST['user_id']." AND favorite_id = ".$_POST['merchant_id']);
    }
}
if(isset($_POST['method']) && ($_POST['method'] == "getNoneImageProduct")){
    if($_POST['type'])
	{
		// $catparent=$_POST['mainclick'];
		
		$resultcat = mysqli_query($conn, "SELECT * FROM category WHERE user_id ='".$_POST['id']."' and catparent = '".$_POST['category']."' order by id limit 0,1");
		$resultdata=mysqli_fetch_array($resultcat,MYSQLI_ASSOC);
		$category_name=$resultdata['category_name'];
		$category_name = mysqli_real_escape_string($conn, $category_name);
		 $category_name = str_replace(' ', '-', $category_name);
		$result = mysqli_query($conn, "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$category_name."' and image='' and status=0");
		$resultdata=mysqli_fetch_array($resultcat,MYSQLI_ASSOC);
		
	}
	else
	{
		// echo "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$_POST['category']."' and image!='' and status=0";
		// die;
	   $result = mysqli_query($conn, "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$_POST['category']."' and image='' and status=0");
	
	}
	$array_product = array();
    while ($row=mysqli_fetch_row($result)){
		
        $item = array("image"=>$row[6],"product_name"=> $row[2], "category"=> $row[3], 'type'=> $row[4], 'price'=> $row[5], 'remark'=>$row[8], 'id' => $row[0]);
        array_push($array_product, $item);
    }

    echo json_encode($array_product);
}
if(isset($_POST['method']) && ($_POST['method'] == "getImageProduct")){
	
	if($_POST['type'])
	{
		// $catparent=$_POST['mainclick'];
		
		$resultcat = mysqli_query($conn, "SELECT * FROM category WHERE user_id ='".$_POST['id']."' and catparent = '".$_POST['category']."' and status='0' order by id limit 0,1");
		$resultdata=mysqli_fetch_array($resultcat,MYSQLI_ASSOC);
		   $category_name=$resultdata['category_name'];
		// die;
		// $category_name="Diam-Sum-点心";
		 $category_name = mysqli_real_escape_string($conn, $category_name);
		 $category_name = str_replace(' ', '-', $category_name);
	
		$result = mysqli_query($conn, "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$category_name."' and image!='' and status=0");
		$resultdata=mysqli_fetch_array($resultcat,MYSQLI_ASSOC);
		
	}
	else
	{
		// echo "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$_POST['category']."' and image!='' and status=0";
		// die;
	   $result = mysqli_query($conn, "SELECT * FROM products WHERE user_id ='".$_POST['id']."' and category = '".$_POST['category']."' and image!='' and status=0");
	
	}
    
    $array_product = array();
    while ($row=mysqli_fetch_row($result)){
		
        $item = array("image"=>$row[6],"product_name"=> $row[2], "category"=> $row[3], 'type'=> $row[4], 'price'=> $row[5], 'remark'=>$row[8], 'id' => $row[0]);
        array_push($array_product, $item);
    }

    echo json_encode($array_product);
}
if(isset($_POST['method']) && ($_POST['method'] == "getFavoriteByBusiness")){
    $id = $_POST['user_id'];
    $type = $_POST['type'];
    $result = mysqli_query($conn, "SELECT users.name, user_id, favorite_id, users.latitude, users.longitude, users.account_type
                             FROM favorities INNER JOIN users ON favorities.favorite_id = users.id
                             WHERE user_id='$id' AND (users.business1 = '$type' OR users.business2 = '$type')");

    $array_favorite = array();
    while ($row=mysqli_fetch_row($result)){

        $sql_transaction = "SELECT COUNT(id) ordered_num
							FROM order_list
							WHERE user_id = '".$id."' AND merchant_id = '". $row[2]."' AND STATUS='1'";
        $result_transaction = mysqli_fetch_assoc(mysqli_query($conn,$sql_transaction));
        $sql_favorite = "SELECT COUNT(id) favorite_num
    						FROM favorities
    						WHERE favorite_id = '".$row[2]."'";
        $result_favorite = mysqli_fetch_assoc(mysqli_query($conn,$sql_favorite));
        $account_type = $row['5'];
        if($row['5'] != "") $account_type = $row['5'].", ";

        $item = array("name"=> $row[0], "id"=> $row[1], 'favorite_id'=> $row[2], 'latitude'=>$row[3], 'longitude'=>$row[4], 'account_type'=>$account_type, 'order_num'=>$result_transaction['ordered_num'], 'favorite_num'=>$result_favorite['favorite_num']);
        array_push($array_favorite, $item);
    }

    echo json_encode($array_favorite);
}

if(isset($_POST['method']) && ($_POST['method'] == "getNearbyRestaurants")){
    $id = $_POST['user_id'];
    $type = $_POST['type'];
    $result = mysqli_query($conn, "SELECT users.name, users.id user_id, users.latitude, users.longitude, users.account_type
                             FROM users 
                             WHERE user_roles='2' AND (users.business1 = '$type' OR users.business2 = '$type')");

    $array_nearby = array();
    while ($row=mysqli_fetch_assoc($result)){
        $sql_transaction = "SELECT COUNT(id) ordered_num
							FROM order_list
							WHERE user_id = '".$id."' AND merchant_id = '". $row['user_id']."' AND STATUS='1'";
        $result_transaction = mysqli_fetch_assoc(mysqli_query($conn,$sql_transaction));
        $sql_favorite = "SELECT COUNT(id) favorite_num
    						FROM favorities
    						WHERE favorite_id = '".$row['user_id']."'";
        $result_favorite = mysqli_fetch_assoc(mysqli_query($conn,$sql_favorite));

        if($id == "") $transaction_num = 0;
        else $transaction_num = $result_transaction['ordered_num'];

        $account_type = $row['account_type'];
        if($row['account_type'] != "") $account_type = $row['account_type'].", ";

        $item = array("name"=> $row['name'], "id"=> $row['user_id'], 'account_type'=>$account_type, 'latitude'=>$row['latitude'], 'longitude'=>$row['longitude'], 'order_num'=>$transaction_num, 'favorite_num'=>$result_favorite['favorite_num']);
        array_push($array_nearby, $item);
    }

    echo json_encode($array_nearby);
}

if(isset($_POST['method']) && ($_POST['method'] == "k_type")){
    $id = $_POST['id'];
    $comment = $_POST['complain'];
    $image = $_POST['image'];
    $role = $_POST['role'];
    if($role == '1'){
        mysqli_query($conn, "UPDATE k1k2_history SET user_comment='$comment', user_complain='$image' where id='$id'");
    } else if($role == '2'){
        mysqli_query($conn, "UPDATE k1k2_history SET merchant_comment='$comment', merchant_complain='$image' where id='$id'");
    }
}

if(isset($_POST['method']) && ($_POST['method'] == "getUnreadMsg")){
    $id = $_POST['id'];

    $data = mysqli_query($conn, "SELECT sender, COUNT(id) num FROM chat_history WHERE STATUS = 'unread' and receiver='$id' GROUP BY sender");
    $array_unread = array();
    while ($row=mysqli_fetch_assoc($data)){
        $item = array("num"=> $row['num'], "sender"=>$row['sender']);
        array_push($array_unread, $item);
    }
    echo json_encode($array_unread);
}


if(isset($_POST['method']) && ($_POST['method'] == "getOrderDetail")){
    $id = $_POST['id'];

    $data = mysqli_query($conn, "SELECT * FROM order_list WHERE id='$id'");
    $array_detail = array();
    while ($row=mysqli_fetch_assoc($data)){
        $user_id = $row['user_id'];
        $merchant_id = $row['merchant_id'];
        $varient_type = $row['varient_type'];
        $product_ids = explode(",",$row['product_id']);
        $product_qty = explode(",", $row['quantity']);
        $product_amt = explode(",", $row['amount']);
        $product_code = explode(",", $row['product_code']);
        $remark_ids = explode("|",$row['remark']);
        $location = isset($row['location']) ? $row['location'] : '';
        $section_type = isset($row['section_type']) ? $row['section_type'] : '';
        $table_type = isset($row['table_type']) ? $row['table_type'] : '';
        $user_id = isset($row['user_id']) ? $row['user_id'] : '';
        $array_product_names;
        for($i = 0;  $i < count($product_ids); $i++){
            if(is_numeric($product_ids[$i])){
                $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name FROM products WHERE id ='".$product_ids[$i]."'"))['product_name'];
            } else {
                $product_name = $product_ids[$i];
            }
            $array_product_names[$i] = $product_name;
        }
        // $order_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users where id='$user_id'"))['name'];
		$order_name=$row['user_name'];
		$user_mobile=$row['user_mobile'];
        $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, gst, sst,register,address FROM users where id='$merchant_id'"));
        $register = $ref_result['register'];
        $merchant_name = $ref_result['name'];
        $sst = $ref_result['sst'];
        $gst = $ref_result['gst'];  
        $sstper = $ref_result['sstper'];  
		if($ref_result['address'])
		{
			$register=$ref_result['address'];
		}
		else
		{
			$register=$ref_result['register'];
		}
        $item = array('merchant_id'=>$merchant_id,'user_mobile'=>$user_mobile,'varient_type'=>$varient_type,'product_ids'=>$product_ids,'register' => $register, 'sst' => $sst, 'gst' => $gst, 'user_id' => $user_id, 'product_code' => $product_code, 'table_type' => $table_type,'section_type'=>$section_type,'location' => $location, 'remark' => $remark_ids, 'invoice_no' => $row['invoice_no'] , 'status' => $row['status'] , 'id' => $row['id'] , 'username' =>$order_name, 'merchantname' => $merchant_name, 'product_name' => $array_product_names, 'product_qty' => $product_qty, 'product_amt' => $product_amt);
        array_push($array_detail, $item);     
    }  
    echo json_encode($array_detail);
}
function getOrderDetail($id,$conn)
{
	 // $id = $_POST['id'];
   
    $data = mysqli_query($conn, "SELECT * FROM order_list WHERE id='$id'");
    $array_detail = array();
    while ($row=mysqli_fetch_assoc($data)){
        $user_id = $row['user_id'];
        $merchant_id = $row['merchant_id'];
        $varient_type = $row['varient_type'];
        $product_ids = explode(",",$row['product_id']);
        $product_qty = explode(",", $row['quantity']);
        $product_amt = explode(",", $row['amount']);
        $product_code = explode(",", $row['product_code']);
        $remark_ids = explode("|",$row['remark']);
        $location = isset($row['location']) ? $row['location'] : '';
        $section_type = isset($row['section_type']) ? $row['section_type'] : '';
        $table_type = isset($row['table_type']) ? $row['table_type'] : '';
        $user_id = isset($row['user_id']) ? $row['user_id'] : '';
        $array_product_names;
        for($i = 0;  $i < count($product_ids); $i++){
            if(is_numeric($product_ids[$i])){
                $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name FROM products WHERE id ='".$product_ids[$i]."'"))['product_name'];
            } else {
                $product_name = $product_ids[$i];
            }
            $array_product_names[$i] = $product_name;
        }
        // $order_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users where id='$user_id'"))['name'];
		$order_name=$row['user_name'];
		$user_mobile=$row['user_mobile'];
        $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, gst, sst, register,address FROM users where id='$merchant_id'"));
        $register = $ref_result['register'];
        $merchant_name = $ref_result['name'];
        $sst = $ref_result['sst'];
        $gst = $ref_result['gst'];  
		if($ref_result['address'])
		{
			$register=$ref_result['address'];
		}
		else
		{
			$register=$ref_result['register'];
		}
        $item = array('merchant_id'=>$merchant_id,'user_mobile'=>$user_mobile,'varient_type'=>$varient_type,'product_ids'=>$product_ids,'register' => $register, 'sst' => $sst, 'gst' => $gst, 'user_id' => $user_id, 'product_code' => $product_code, 'table_type' => $table_type,'section_type'=>$section_type,'location' => $location, 'remark' => $remark_ids, 'invoice_no' => $row['invoice_no'] , 'status' => $row['status'] , 'id' => $row['id'] , 'username' =>$order_name, 'merchantname' => $merchant_name, 'product_name' => $array_product_names, 'product_qty' => $product_qty, 'product_amt' => $product_amt);
        array_push($array_detail, $item);     
    }  
    $merchant_id=$array_detail['merchant_id'];
	$product_ids=$array_detail['product_ids'];
	
    $date = date("Y-m-d");
    $time = date("H:i");
	 $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sst_rate,id, print_ip_address,printer_style,printer_profile,usb_name FROM users WHERE id='".$merchant_id."'"));
	// print_R($ref_result);
	// die;
    $ref_result2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, print_ip_address_user FROM users WHERE id='".$_SESSION['login']."'"));
	// print_R($ref_result);
	// die;
	
	$ip_address = $ref_result2['print_ip_address_user'];
	if($ip_address)
	{
		$print_report=OrderCustomprintuser($ip_address,$order,$date,$time,$conn,$ref_result);
	}
}

if(isset($_POST['method']) && ($_POST['method'] == "getOrderDetailByIdAndInvoice")){
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $invoice_id = $_POST['invoice_no'];
    $id = $_POST['id'];
    $data = mysqli_query($conn, "SELECT * FROM order_list WHERE invoice_no='$invoice_id' AND id='$id'");
    $array_detail = array();
    while ($row=mysqli_fetch_assoc($data)){
        $user_id = $row['user_id'];
        $merchant_id = $row['merchant_id'];
		   $varient_type = $row['varient_type'];
        $product_ids = explode(",",$row['product_id']);
        $product_qty = explode(",", $row['quantity']);
        $product_amt = explode(",", $row['amount']);
        $remark_ids = explode("|",$row['remark']);
        $product_code = explode(",", $row['product_code']);
        $location = isset($row['location']) ? $row['location'] : '';
        $section_type = isset($row['section_type']) ? $row['section_type'] : '';
        $table_type = isset($row['table_type']) ? $row['table_type'] : '';
        $user_id = isset($row['user_id']) ? $row['user_id'] : '';
        for($i = 0;  $i < count($product_ids); $i++){
            if(is_numeric($product_ids[$i])){
                $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name FROM products WHERE id ='".$product_ids[$i]."'"))['product_name'];
            } else {
                $product_name = $product_ids[$i];
            } 
            $array_product_names[$i] = $product_name;
        }
        $order_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users where id='$user_id'"))['name'];
        $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, gst, sst,sst_rate,register FROM users where id='$merchant_id'"));
        $merchant_name = $ref_result['name'];
        $sst = $ref_result['sst'];
        $sst_rate = $ref_result['sst_rate'];
        $gst = $ref_result['gst'];
        $register = $ref_result['register'];
		// print_R($ref_result);
		// die;
		$total=array_sum($product_amt);
		// print_R($total);
		// die;
		$total=0;
		$c=0;
		foreach($product_amt as $p)
		{
			$total+=($p*$product_qty[$c]);
			$c++;
		}
		if($sst_rate>0)
		{
			$incsst = ($sst_rate / 100) * $total;
			$incsst=number_format($incsst, 2);
			$incsst=ceiling($incsst,0.05);
			$final_amount=number_format($total+$incsst, 2);
		}
		else
		{
			$product_amt=$product_amt;
			$final_amount=$total;
		}
		// print_R($incsst);
		// print_R($final_amount);
		// die;    
        $item = array('final_amount'=>$final_amount,'varient_type'=>$varient_type,'register' => $register, 'sst' => $sst, 'gst' => $gst, 'user_id' => $user_id, 'product_code' => $product_code, 'table_type' => $table_type,'section_type'=>$section_type, 'location' => $location, 'remark' => $remark_ids, 'invoice_no' => $row['invoice_no'] , 'status' => $row['status'] , 'id' => $row['id'] , 'username' =>$order_name, 'merchantname' => $merchant_name, 'product_name' => $array_product_names, 'product_qty' => $product_qty, 'product_amt' => $product_amt);
        array_push($array_detail, $item);
    }
    echo json_encode($array_detail);
}
function generatePIN($digits = 4){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}
function gw_send_sms($user,$pass,$sms_from,$sms_to,$sms_msg){           
    $query_string = "api.aspx?apiusername=".$user."&apipassword=".$pass;
    $query_string .= "&senderid=".rawurlencode($sms_from)."&mobileno=".rawurlencode($sms_to);
    $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
    $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
    $fd = @implode ('', file ($url));      
    if ($fd){                       
      if ($fd > 0) {
      //Print("MT ID : " . $fd);
      $ok = "success";
      }        
      else {
      print("Please refer to API on Error : " . $fd);
      $ok = "fail";
      }
    }else {                       
        // no contact with gateway                      
        $ok = "fail";       
    }           
    return $ok;  
} 
if( isset( $_POST['method']) && ( $_POST['method'] == "sendotp" )  ) {
	$otp = generatePIN();
    // $_SESSION['is_new_user'] = true;
    $_SESSION['otp_code'] = $otp;
    // $_SESSION['guest_mobile_number'] = $cm;
    $cm=$_POST['usermobile'];
    $_SESSION['step'] = 'otp';
    gw_send_sms("APIHKXVL33N5E", "APIHKXVL33N5EHKXVL", "9787136232", "$cm", "One time password for Koo Families is $otp");
	 $item = array('otp'=>$otp,'status'=>true);
      	 mysqli_query($conn,"UPDATE `users` SET `user_otp` = '$otp' WHERE `users`.`mobile_number` ='$cm'");
		echo json_encode($item);
		die;
}
if( isset( $_POST['method']) && ( $_POST['method'] == "forgotpass" )  ) {
	$cm=$_POST['usermobile'];
	// $cm="+919001025477";
	$user_role=1;
	$data = mysqli_query($conn, "SELECT  password,isLocked FROM users WHERE mobile_number='$cm' AND user_roles = '$user_role' ");
	//~ $data = mysqli_query($conn, "SELECT password,isLocked FROM users WHERE email='$email'");
	$count = mysqli_num_rows($data);
	if($count == 0)
	{
		$error .= "Account does not exists in our Database.<br>";
	}
	
	$row = mysqli_fetch_assoc($data);      
	$lock_status = $row['isLocked'];
	$password = $row['password'];
	
	if($lock_status == 1)
	{
		$error .= "Sorry, the user account blocked, please contact support.<br>";
	}
	if($error)
	{
	   $item = array('msg'=>$error,'status'=>false);	
	}
	else
	{
		$rand =mt_rand();
		$forgot_url = "https://".$_SERVER['HTTP_HOST']."/demo1/forgot_password.php?rand=".$rand."&mn=".$cm;
		 mysqli_query($conn, "UPDATE users SET rand_num='$rand',resetdate='".time()."' WHERE mobile_number='$cm' AND user_roles = '$user_role' ");
		 // $cm="+919001025477";
		   gw_send_sms("APIHKXVL33N5E", "APIHKXVL33N5EHKXVL", "9787136232", "$cm", "Password for your Account ($cm) : $forgot_url");
		 // gw_send_sms("APIHKXVL33N5E", "APIHKXVL33N5EHKXVL", "9787136232", "$cm", "Password for your Account ($cm) : $forgot_url");
		  
		 $item = array('msg'=>"Sms for resetting password has been sent to this mobile number",'status'=>true);
	}
	echo json_encode($item);
	die;
	
}
 if( isset( $_POST['method']) && ( $_POST['method'] == "startcash" )  ) {
	  $opening_balance=$_POST['opening_balance'];
	  $user_id=$_POST['user_id'];
	  $date = date('Y-m-d H:i:s');
	  $start_utc=strtotime($date);
	  $query="INSERT INTO cash_system (`user_id`, `login_time`,`opening`) VALUES ('$user_id', '$start_utc', '$opening_balance')";
	   $insert=mysqli_query($conn,$query);
	   if($insert)
	   {
		   $item = array('msg'=>"Insert",'status'=>true);
	   }
	   else
	   {
		   $item = array('msg'=>"fail",'status'=>false);
		   
	   }
	   echo json_encode($item);
		die;       
  }
   if( isset( $_POST['method']) && ( $_POST['method'] == "shiftclose" )  ) {
	  $cash_id=$_POST['cash_id'];
	  $user_id=$_POST['user_id'];
	 extract($_POST);
	  $date = date('Y-m-d H:i:s');
	  $start_utc=strtotime($date);
	    $query="UPDATE cash_system SET is_active= 'n',logout_time='$start_utc',sales='$sales',balance='$balance',cash_in='$cash_in',cash_out='$cash_out',void_tras='$void_tras' WHERE `cash_system`.`id`='$cash_id'";  
	   $insert=mysqli_query($conn,$query);
	   if($insert)
	   {
		   $item = array('msg'=>"Insert",'status'=>true);
	   }
	   else
	   {
		   $item = array('msg'=>"fail",'status'=>false);
		   
	   }
	   echo json_encode($item);
		die;       
  }
if( isset( $_POST['method']) && ( $_POST['method'] == "userjoin" )  ) {
	$user_id=$_POST['user_id'];
	$order_id=$_POST['order_id'];
	$usermobile=$_POST['usermobile'];
	$login_password=$_POST['login_password'];
	if($user_id)
	{
		  mysqli_query($conn, "UPDATE users SET password='$login_password', guest_user='active' where id='$user_id'");
		  mysqli_query($conn, "UPDATE order_list SET newuser='join' where id='$order_id'");
		  $item = array('status'=>true);
      
		echo json_encode($item);
		die;
	}
}
if( isset( $_POST['method']) && ( $_POST['method'] == "neworder" )  ) {
	$last_id=$_POST['last_id'];
	
	$merchant_id=$_POST['merchant_id'];

	$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id,order_place FROM order_list WHERE id>$last_id AND merchant_id='$merchant_id' ORDER BY ID DESC LIMIT 0,1"));
	
	if($data['id'])
	{
		$array_detail = array();
		 $item = array('id'=>$data['id'],'order_place'=>$data['order_place'],'status'=>true);
           // array_push($array_detail, $item);
		   // print_R($item);
		echo json_encode($item);
	}
	else
	{
		 // $array_detail ='';
        echo '';
	}
	
		
}
if( isset( $_POST['method']) && ( $_POST['method'] == "getUnPrintedOrder2" )  ) {
    $id = $_POST['id'];

    $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_roles,name, id, order_print_setting,order_print_live_setting, sst, gst, register FROM users WHERE id='".$id."'"));
    $user_roles=$ref_result['user_roles'];
	if($user_roles==2)
	{
	if( $ref_result['order_print_setting'] === 'on' ) {
        $sst = $ref_result['sst'];
        $gst = $ref_result['gst'];  
        $register = $ref_result['register'];
        $merchant_name = $ref_result['name'];
		  $varient_type = $row['varient_type'];
		  if($ref_result['order_print_live_setting']=='on')
		  {
			$data = mysqli_query($conn, "SELECT * FROM order_list WHERE  merchant_id='$id' AND auto_print!='1' and  created_on >= NOW() - INTERVAL 10 MINUTE ORDER BY ID DESC LIMIT 10");
        
		  }
		  else
		  {
			$data = mysqli_query($conn, "SELECT * FROM order_list WHERE status=0 AND merchant_id='$id' and  order_place='local' and auto_print!='1' and  created_on >= NOW() - INTERVAL 10 MINUTE ORDER BY ID DESC LIMIT 10");
          
		  }
		  
		  $array_detail = array();
        while ( $row=mysqli_fetch_assoc($data) ) {
            $user_id = $row['user_id'];
            $order_id = $row['id'];
            $merchant_id = $row['merchant_id'];
			
            $wallet = isset($row['wallet']) ? $row['wallet'] : '';
            $product_ids = explode(",",$row['product_id']);
            $product_qty = explode(",", $row['quantity']);
            $product_amt = explode(",", $row['amount']);
            $product_code = explode(",", $row['product_code']);
            $remark_ids = explode("|",$row['remark']);
            $location = isset($row['location']) ? $row['location'] : '';
            $section_type = isset($row['section_type']) ? $row['section_type'] : '';
            $table_type = isset($row['table_type']) ? $row['table_type'] : '';
            $user_id = isset($row['user_id']) ? $row['user_id'] : '';
            $array_product_names = [];
            for($i = 0;  $i < count($product_ids); $i++){
                if(is_numeric($product_ids[$i])){
                    $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name FROM products WHERE id ='".$product_ids[$i]."'"))['product_name'];
                } else {
                    $product_name = $product_ids[$i];
                }
                $array_product_names[$i] = $product_name;
            }
            // $order_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users where id='$user_id'"))['name'];
			$order_name=$row['user_name'];
			$user_mobile=$row['user_mobile'];
            $item = array('user_mobile'=>$user_mobile,'varient_type'=>$varient_type,'product_ids'=>$product_ids,'register' => $register, 'sst' => $sst, 'gst' => $gst, 'user_id' => $user_id, 'product_code' => $product_code, 'table_type' => $table_type,'section_type'=>$section_type,'location' => $location, "wallet" => $wallet, 'remark' => $remark_ids, 'invoice_no' => $row['invoice_no'] , 'status' => $row['status'] , 'id' => $row['id'] , 'username' =>$order_name, 'merchantname' => $merchant_name, 'product_name' => $array_product_names, 'product_qty' => $product_qty, 'product_amt' => $product_amt);
            array_push($array_detail, $item);
			
        }
        echo json_encode($array_detail);
    } else {
        $array_detail = array();
        echo json_encode($array_detail);
    }
	}
	else
	{
		   $array_detail = array();
        echo json_encode($array_detail);
	}
}
if( isset( $_POST['method']) && ( $_POST['method'] == "getUnPrintedOrder" )  ) {
    $id = $_POST['id'];

    $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, id, order_print_setting, sst, gst, register FROM users WHERE id='".$id."'"));
    if( $ref_result['order_print_setting'] === 'on' ) {
        $sst = $ref_result['sst'];
        $gst = $ref_result['gst'];  
        $register = $ref_result['register'];
        $merchant_name = $ref_result['name'];
		  $varient_type = $row['varient_type'];
        $data = mysqli_query($conn, "SELECT * FROM order_list WHERE status=0 AND merchant_id='$id' AND auto_print!='1' ORDER BY ID DESC LIMIT 10");
        $array_detail = array();
        while ( $row=mysqli_fetch_assoc($data) ) {
            $user_id = $row['user_id'];
            $order_id = $row['id'];
            $merchant_id = $row['merchant_id'];
			
            $wallet = isset($row['wallet']) ? $row['wallet'] : '';
            $product_ids = explode(",",$row['product_id']);
            $product_qty = explode(",", $row['quantity']);
            $product_amt = explode(",", $row['amount']);
            $product_code = explode(",", $row['product_code']);
            $remark_ids = explode("|",$row['remark']);
            $location = isset($row['location']) ? $row['location'] : '';
            $section_type = isset($row['section_type']) ? $row['section_type'] : '';
            $table_type = isset($row['table_type']) ? $row['table_type'] : '';
            $user_id = isset($row['user_id']) ? $row['user_id'] : '';
            $array_product_names = [];
            for($i = 0;  $i < count($product_ids); $i++){
                if(is_numeric($product_ids[$i])){
                    $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name FROM products WHERE id ='".$product_ids[$i]."'"))['product_name'];
                } else {
                    $product_name = $product_ids[$i];
                }
                $array_product_names[$i] = $product_name;
            }
            // $order_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users where id='$user_id'"))['name'];
			$order_name=$row['user_name'];
			$user_mobile=$row['user_mobile'];
            $item = array('user_mobile'=>$user_mobile,'varient_type'=>$varient_type,'product_ids'=>$product_ids,'register' => $register, 'sst' => $sst, 'gst' => $gst, 'user_id' => $user_id, 'product_code' => $product_code, 'table_type' => $table_type,'section_type'=>$section_type,'location' => $location, "wallet" => $wallet, 'remark' => $remark_ids, 'invoice_no' => $row['invoice_no'] , 'status' => $row['status'] , 'id' => $row['id'] , 'username' =>$order_name, 'merchantname' => $merchant_name, 'product_name' => $array_product_names, 'product_qty' => $product_qty, 'product_amt' => $product_amt);
            array_push($array_detail, $item);
			
        }
        echo json_encode($array_detail);
    } else {
        $array_detail = array();
        echo json_encode($array_detail);
    }
}
if( isset( $_POST['method']) && ( $_POST['method'] == "normalorderuser" ) ) {
	$print='n';
	
	$order = $_POST['order'];
	// print_R($order);
	// die;
	$merchant_id=$order['merchant_id'];
	$product_ids=$order['product_ids'];
	$mer_id=670;
    $date = $_POST['date'];
    $time = $_POST['time'];
	 $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, print_ip_address,printer_style,printer_profile,usb_name FROM users WHERE id='".$merchant_id."'"));
	// print_R($ref_result);
	// die;
    $ref_result2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, print_ip_address_user FROM users WHERE id='".$_SESSION['login']."'"));
	// print_R($ref_result);
	// die;
	
	$ip_address = $ref_result2['print_ip_address_user'];
	$print_report=OrderCustomprintuser($ip_address,$order,$date,$time,$conn,$ref_result);
	echo json_encode($print_report);
	die;
}
if( isset( $_POST['method']) && ( $_POST['method'] == "normalorder" ) ) {
	$print='n';
	
	$order = $_POST['order'];
	// print_R($order);
	// die;
	$product_ids=$order['product_ids'];
	$mer_id=670;
    $date = $_POST['date'];
    $time = $_POST['time'];
	
    $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT merchant_url,id,sst_rate,customer_print_ip_address,print_ip_address,printer_style,printer_profile,usb_name FROM users WHERE id='".$_SESSION['login']."'"));
	// print_R($ref_result);
	// die;
	
	if($ref_result['customer_print_ip_address'])
	$ip_address = $ref_result['customer_print_ip_address'];
	else
	$ip_address = $ref_result['print_ip_address'];
	$print_report=OrderCustomprint($ip_address,$order,$date,$time,$conn,$ref_result);
	echo json_encode($print_report);
	die;
}

if( isset( $_POST['method']) && ( $_POST['method'] == "pintOrder" ) ) {
	$print='n';
	
	$order = $_POST['order'];
	// print_R($order);
	// die;
	$product_ids=$order['product_ids'];
	$mer_id=670;
    $date = $_POST['date'];
    $time = $_POST['time'];
	
    $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT merchant_url,id,sst_rate,print_ip_address,printer_style,printer_profile,usb_name FROM users WHERE id='".$_SESSION['login']."'"));
    // $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, print_ip_address,printer_style FROM users WHERE id='".$mer_id."'"));
    // print_R($ref_result);
	// die;
	 $printer_style=$ref_result['printer_style'];
	
     if(($printer_style=="product") || ($printer_style=="combo"))
	{
		if($printer_style=="combo")
		{
			$ip_address = $ref_result['print_ip_address'];
			$print_report=OrderCustomprint($ip_address,$order,$date,$time,$conn,$ref_result);
		}
		// print_R($product_ids);
		// die;
		$prdouct_str=implode(",",$product_ids);
		  $prdouct_str=$order['product_id'];
		$p_array=explode(',',$prdouct_str);
	$product_result=[];
	foreach($product_ids as $p)
	{
		
		$product_result[] = mysqli_fetch_array(mysqli_query($conn, "SELECT products.id,products.print_ip_address,products.product_name,products.product_type,products.remark,products.printer_ip_2,products.printer_profile,products.usb_name FROM products WHERE products.id in($p)"));
		
	}
		//$product_result = mysqli_fetch_all(mysqli_query($conn, "SELECT products.id,products.print_ip_address,products.product_name,products.product_type,products.remark,products.printer_ip_2 FROM products WHERE products.id in($prdouct_str)"));
	 
	 // $prow=mysqli_fetch_array($product_result);
	  // print_R($order);
	  // die;
		$i=0;
		
		
		$remarkarray=$order['remark'];
		
		
		$product_qty=$order['product_qty'];
		foreach ($product_result as $key => $item) {
			$s_t=$item['printer_profile'];
			$s_name=$item['usb_name'];
			// print_R($item);
			// die;
			$printer_pro=$item['printer_profile'];
			if($printer_pro=="usb")
			{
				if($item['usb_name'])
				{
					$usb_name=$item['usb_name'];
					$d['product_id']=$item[0];
					$d['product_qty']=$product_qty[$i];
					$d['product_name']=$item[2];
					$d['remark']=$remarkarray[$i];
					$d['product_type']=$item[3];
					$d['p_remark']=$item[4];
					$d['printer_profile']=$item['printer_profile'];
					$d['usb_name']=$item['usb_name'];
					$arr[$usb_name][$key]=$d;
				}
			}  
			else
			{
				$usb_name='';
				if($item[1])
				{
					$d['product_id']=$item[0];
					$d['product_qty']=$product_qty[$i];
					$d['product_name']=$item[2];
					$d['remark']=$remarkarray[$i];
					$d['product_type']=$item[3];
					$d['p_remark']=$item[4];
					$d['printer_profile']=$item['printer_profile'];
					$d['usb_name']=$item['usb_name'];
					$arr[$item[1]][$key]=$d;
				}
				if($item[5])
				{
					
					$d['product_id']=$item[0];
					$d['product_qty']=$product_qty[$i];
					$d['product_name']=$item[2];
					$d['remark']=$remarkarray[$i];
					$d['product_type']=$item[3];
					$d['p_remark']=$item[4];
					$d['printer_profile']=$item['printer_profile'];
					$d['usb_name']=$item['usb_name'];
					$arr2[$item[5]][$key]=$d;
				}
			}
			$i++;
		}
		$section_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM sections WHERE id='".$order['section_type']."'"));
			$order['section_name']=$section_name=$section_data['name'];
		// print_R($arr);
		// die;
		foreach($arr as $kp=>$p)
		{
			if($kp)
			{
				$kp=$kp;
				
				$print_report=singleorderprint($kp,$p,$date,$time,$order,$conn,$s_t,$s_name);
			}
			// else
			// {
				// $kp = $ref_result['print_ip_address'];
			// }
			// $print_report=singleorderprint($kp,$p,$date,$time,$order,$conn,$printer_pro,$usb_name);
			// break;
		}
		// print_R($arr2);
		// die;   
		foreach($arr2 as $kp=>$p)
		{
			if($kp)
			{
				$kp=$kp;
			
				$print_report=singleorderprint($kp,$p,$date,$time,$order,$conn,$s_t,$s_name);
				//$print_report=singleorderprint($kp,$p,$date,$time,$order,$conn,$printer_pro,$usb_name);
			}
			// else
			// {
				// $kp = $ref_result['print_ip_address'];
			// }
			
			// break;
		}
		$order_id=$order['id'];
		mysqli_query($conn,"UPDATE `order_list` SET `auto_print` = '1' WHERE `order_list`.`id` ='$order_id'");
        
	}
	else if($printer_style=="section")
	{
		// section based printing 
		$section_type=$order['section_type'];
		$section_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, printer_ip FROM sections WHERE id='$section_type'"));
		 $ip_address = $section_result['printer_ip'];
		// $ref_result=[];
		$print_report=OrderCustomprint($ip_address,$order,$date,$time,$conn,$ref_result);
	}
	else
	{
		// if( ! isset( $ref_result['print_ip_address'] ) ) {
			// echo('print_setting_error');
			// die();
		// }
		$ip_address = $ref_result['print_ip_address'];
		$print_report=OrderCustomprint($ip_address,$order,$date,$time,$conn,$ref_result);
	}
    // echo $ip_address;
	// die;
	// die;
    //OrderCustomprint($ip_address,$order,$date,$time,$conn);
	echo json_encode($print_report);
	die;
	
}
if(isset($_POST['method']) && ($_POST['method'] == "subproduct")){
	$product_id = $_POST['product_id'];
	// $product_id =433;
	$result = array();
	$total_rows = mysqli_query($conn, "SELECT * FROM sub_products WHERE product_id='".$product_id."'");
	 $ref_result=mysqli_affected_rows($conn);

	if($ref_result)
	{
		$res['status']=200;
		while ($row=mysqli_fetch_assoc($total_rows)){
			$item = array("id" => $row['id'], "name" => $row['name'], 
        				'product_price' => $row['product_price']);
        
			array_push($result, $item);
		}
		 
		$res['data']=$result;
	}
	else
	{
		$res['status']=404;
		// $res['data']=ref_result;
	}
	echo json_encode($res);
	die;
}
function ceiling($number, $significance = 1)
{
	return ( is_numeric($number) && is_numeric($significance) ) ? (ceil(round($number/$significance))*$significance) : false;
}
function singleorderprint($ip_address,$data,$date,$time,$order,$conn,$s_t,$s_name)
{
	// echo $ip_address;
	// $ip_address=192.168.2.250;
	  
	   // die;  
		if( $data == null ) {
			$res['status']=false;
			$res['message']="Failed to make print Due to Order Blank";
			
			//echo( "empty" );
			}
		else
		{
			
			try {
				  if($s_t=="usb")
					{
						// echo "usb side";
						// $usb_name=$merchat_detail['usb_name'];
						$connector = new WindowsPrintConnector($s_name);
					}
					else
					{
						// echo "ip side";
						$connector = new NetworkPrintConnector($ip_address, 9100,5);
					}
				

			} catch( Exception $e ) {
				echo('print_setting_error');
				echo(print_r($e, true));
				// die();
				$res['status']=false;
				$res['message']="Printer is not connected";
			}
			// $profile = CapabilityProfile::load("default");
			$printer = new Printer($connector);
			$i=0;
			$size_number = 3; 
			$size_name = 15;
		    $size_qty = 3;
			$p_number=5;
			$size_remark=12;
			
			try {
				// $printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_CENTER);
				// $printer -> text("\n");
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text(  $order['id'] . '-' . $order['invoice_no'] . "\n" );
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				// $printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("\n");
				$printer -> setEmphasis(true);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text("  Section : " . $order['section_name'] . "       "."Table : " .$order['table_type']. "\n");
				// $printer -> textChinese("示例文本打印机!\n\n");
				 // $printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				// $printer -> text("  Section : " . $order['section_type'] . "\n");   
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				// $printer -> selectPrintMode(Printer::MODE_FONT_A);
				// $printer -> text("\n"); 
				$printer -> setEmphasis(false);
				$printer -> text( '  ' . $date . ' ' . $time . "\n");
				$printer -> text("\n");
				
				// $printer -> text( "  No  Name                                   Qty" . "\n");   
				// $printer -> text("\n"); 
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> setEmphasis(true);
					$size_name = 11;
					$dcount=0;
				$v_str=$order['varient_type'];
				$v_array=explode("|",$v_str);
				// print_R($v_array);
				// die;
				$dcount=0;
				$invoce_id=$order['invoice_no'];
				// $merchant_id=$order['merchant_id'];
				$v_order=1;
				foreach($data as $d)
				{
						// $pr_str=$p[0];
					// print_R($pr_str);
					// die;
					$product_id=$d['product_id'];
								$name=$d['product_name'];
								$qty=$d['product_qty'];
								$remark=$d['remark'];
								$p_code=$d['product_type']; 
								$product_remark=$d['p_remark'];
					$number = $i + 1;
					$j=0;
					
					$printer -> textChinese( ' '.$name."\n");  
					$printer -> textChinese( ' ( '.$p_code.' )          '. $qty ."\n");
					 // $printer -> text( '   '.  $p_code."\n");
					if(strlen($remark)>0)
						 {
						 $printer -> textChinese( '   '.$remark."\n"); 
						 }
						if(strlen($product_remark)>0)
						 {
						 $printer -> textChinese( '   '.$product_remark."\n"); 
						 }
					
					$v_data =mysqli_query($conn, "SELECT varient_id FROM order_varient WHERE product_id='$product_id' and invoice_no='$invoce_id' and v_order='$v_order'");
					while ($srow=mysqli_fetch_assoc($v_data)){
						$v_id=$srow['varient_id'];
						$sub_rows = mysqli_query($conn, "SELECT * FROM sub_products WHERE id='$v_id'");
						while ($srow1=mysqli_fetch_assoc($sub_rows)){  
							// print_R($srow1); 
							// die;
							  $v_name=$srow1['name'];
							// die;
							 // die;
							if($v_name)
							{
								$printer -> textChinese( '   '.$v_name."\n"); 
							}
						}
						$v_name='';
					}
					// print_R($varray);
					$dcount++;
					$v_order++;
						$printer -> text("\n");
					
				}
				// $printer -> text(  $order['id'] . '-' . $order['invoice_no'] . "\n" );
				
					$i++;
				
				$printer -> text("\n");
				// $printer -> text("\n");   
				$printer -> cut( Printer::CUT_FULL, 3 ); 

				 $res['status']=true;
				$res['message']="Print Successfully";
				// print_R($res);
				// die;
			}
			finally {
				$printer -> close();
			}
		}
		return  $res;
}
function OrderCustomprint($ip_address,$order,$date,$time,$conn,$merchat_detail)
	{     
	     // print_R($order);
		 // die;
	   	if( $order == null ) {
			$res['status']=false;
			$res['message']="Failed to make print Due to Order Blank";
			
			//echo( "empty" );
			} else {
				
				// $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT mobile_number FROM users WHERE id='".$order['user_id']."'"));
			// if( ! isset( $ref_result['mobile_number'] ) ) {
				// $res['status']=false;
			// $res['message']="User id Not found";
				
			// }
			// print_R($merchat_detail);
			 $printer_t=$merchat_detail['printer_profile'];
			 $sst_rate=$merchat_detail['sst_rate'];
			 $merchant_url=$merchat_detail['merchant_url'];
		      
			try {
					if($printer_t=="usb")
					{
						$usb_name=$merchat_detail['usb_name'];
						$connector = new WindowsPrintConnector($usb_name);
					}
					else
					{
						$connector = new NetworkPrintConnector($ip_address, 9100,5);
					}
				
				
			} catch( Exception $e ) {
				//echo('print_setting_error');
				//echo(print_r($e, true));
				// die();
				$res['status']=false;
				$res['message']="Printer is not connected";
			}
			// $res['status']=false;
			// $res['message']="Printer is not connected";
			//echo(print_r($connector, true));
			
			
			// 3 + 16 + 8 + 5 + 7 + 7
			$mobile = $order['user_mobile'];
			$section_id=$order['section_type'];
			$section_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM sections WHERE id='".$order['section_type']."'"));
			// print_R($section_data);
			// die;
			$section_name=$section_data['name'];
			$invoce_id=$order['invoice_no'];
			$order_id=$order['id'];
			$printer = new Printer($connector);
			$printer -> getPrintConnector() -> write(PRINTER::ESC . "B" . chr(4) . chr(1));
			try {
				
				$printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_CENTER);
				$printer -> text("\n");
				$printer -> setEmphasis(true);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text( $order['merchantname'] . "\n" );
				// $printer -> text("\n");
				if($order['register'])
				{
					$printer -> selectPrintMode(Printer::MODE_FONT_A);
					$printer -> setEmphasis(false);
					$printer -> text( '( ' . $order['register'] . ' )' . "\n" );
					// $printer -> text("\n");
				}
				if($order['username'])
				{
					$printer -> setEmphasis(true);
					$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
					$printer -> textChinese( "Customer : " . $order['username'] . "\n" );
					// $printer -> text("\n");
					// $printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
					 // $printer -> selectPrintMode(Printer::MODE_FONT_A);
				}
				if($mobile)
				{
					$printer -> setEmphasis(false);
					$printer -> text( 'Phone : ' . $mobile . "\n" );
					// $printer -> text("\n");
				}
				
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> setEmphasis(false);
				// $printer -> text("\n");
				if($merchant_url)
					$location=$merchant_url;
				else
				$location = $order['location'];
				$words = explode(" ", $location);
				$rows_locations = [];
				$rows_location = '';
				for( $i = 0 ; $i < sizeof( $words ) ; $i ++ ) {
					
					$word = $words[$i];
					$word .= ' ';
					if( strlen( $rows_location ) + strlen( $word ) < 30 ) {
						$rows_location .= $word;
						if( $i == sizeof( $words ) - 1 ) {
							array_push( $rows_locations, $rows_location);
						}
					} else {
						array_push( $rows_locations, $rows_location);
						$rows_location = $word;
						if( $i == sizeof( $words ) - 1 ) {
							array_push( $rows_locations, $rows_location);
						}
					}
				}
				foreach( $rows_locations as $item ) {
					$printer -> textChinese( ' ' . $item . "\n" );
					// $printer -> text("\n");
				}
				if($order['gst'])
				{
				 $printer -> text( 'GST ID : ' . $order['gst'] . "\n" );
				}
				// $printer -> text("\n");
				if($order['sst'])
				{
				 $printer -> text( 'SST NO : ' . $order['sst'] . "\n" );
				}
				// $printer -> text("\n");
				// $printer -> text("\n");
				
				if($order['invoice_no'])
				{
					$printer -> barcode( $order['id'] . '-' . $invoce_id, Printer::BARCODE_CODE39 );  
				}     
				// $printer -> text("\n");   
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text(  $order['id'] . '-' . $invoce_id . "\n" );
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				// $printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("\n");
				$printer -> setEmphasis(true);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text("  Table : " . $order['table_type'] . "  "."Section : " .$section_name. "\n");
				 // $printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				// $printer -> text("  Section : " . $order['section_type'] . "\n");   
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> text("\n"); 
				$printer -> setEmphasis(false);
				$printer -> text( '  ' . $date . ' ' . $time . "\n");
				$printer -> text("\n");
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> text( "  No  Name( Code )    Qty  Remark  Price  Amount " . "\n");
				$printer -> text("\n");
				$total = 0;
				$qty_total = 0;
				$v_order=1;
				
				for( $i = 0 ; $i < sizeof( $order['product_name'] ) ; $i ++ ) {
					
					if( $order['product_qty'][$i] && $order['product_amt'][$i] ) {
						$amount = $order['product_qty'][$i] * $order['product_amt'][$i];
					} else {
						$amount = 0;
					}
					$qty_total += $order['product_qty'][$i];
					$total += $amount;
					$amount=number_format($amount,2);
					$total=number_format($total,2);
					$remark = isset($order['remark'][$i]) ? $order['remark'][$i] : '';
					$product_code = isset($order['product_code'][$i]) ? $order['product_code'][$i] : '';
					$product_code  = '(' . $product_code . ')';
					$name = $order['product_name'][$i];
					$product_id = $order['product_ids'][$i];
					$qty = $order['product_qty'][$i];
					$price = $order['product_amt'][$i];
					$name .= $product_code;
					$number = $i + 1;
					$size_number = 3;
					$size_name = 12;
					$size_remark = 7;
					$size_qty = 4;
					$size_price = 6;
					$size_amount = 6;
					$lines = max(intval( strlen($number) / $size_number) , intval( strlen($name) / $size_name) , intval( strlen($remark) / $size_remark) , intval( strlen($qty) / $size_qty) , intval( strlen($price) / $size_price) , intval( strlen($amount) / $size_amount) );
					$lines ++;
					$v_data =mysqli_query($conn, "SELECT varient_id FROM order_varient WHERE product_id='$product_id' and invoice_no='$invoce_id' and v_order='$v_order'");
					for( $j = 0 ; $j < $lines ; $j++) {  
						$number_print = '';
						if( strlen($number) > ($j) * $size_number ) {
							$number_print = substr($number, $j * $size_number, min($size_number, strlen($number) - ($j) * $size_number));
						}
						$number_print = str_pad($number_print,  $size_number, "   ");
						$name_print = '';
						if( strlen($name) > ($j) * $size_name ) {
							$name_print = substr($name, $j * $size_name, min($size_name, strlen($name) - ($j) * $size_name));
						}
						$name_print = str_pad($name_print,  $size_name, "   ");
						$remark_print = '';
						if( strlen($remark) > ($j) * $size_remark ) {
							$remark_print = substr($remark, $j * $size_remark, min($size_remark, strlen($remark) - ($j) * $size_remark));
						}
						$remark_print = str_pad($remark_print,  $size_remark, "   ");
						$qty_print = '';
						if( strlen($qty) > ($j) * $size_qty ) {
							$qty_print = substr($qty, $j * $size_qty, min($size_qty, strlen($qty) - ($j) * $size_qty));
						}
						$qty_print = str_pad($qty_print,  $size_qty, "   ");
						$price_print = '';
						if( strlen($price) > ($j) * $size_price ) {
							$price_print = substr($price, $j * $size_price, min($size_price, strlen($price) - ($j) * $size_price));
						}
						$price_print = str_pad($price_print,  $size_price, "   ");
						$amount_print = '';
						if( strlen($amount) > ($j) * $size_amount ) {
							$amount_print = substr($amount, $j * $size_amount, min($size_amount, strlen($amount) - ($j) * $size_amount));
						}
						$amount_print = str_pad($amount_print,  $size_amount, "   ");
						$printer -> textChinese( '  ' . $number_print . ' ' .  $name_print . '    ' . $qty_print. ' ' . $remark_print . ' ' . $price_print . ' ' . $amount_print . "\n");
					    
					
					}
						while ($srow=mysqli_fetch_assoc($v_data)){
							
						$v_id=$srow['varient_id'];   
						$sub_rows = mysqli_query($conn, "SELECT * FROM sub_products WHERE id='$v_id'");
						while ($srow1=mysqli_fetch_assoc($sub_rows)){  
							// print_R($srow1); 
							// die;
							  $v_name=$srow1['name'];
							// die;
							 // die;
							if($v_name)
							{
								$printer -> textChinese( '   '.$v_name."\n"); 
							}
							$v_name='';
						}
						$v_name='';
					}
					// $varray=$order['varient'];
					
					// foreach($varray  as $vi)
					// {
						
						// $v_text=$vi['name']."( ".$vi['product_price'].")";
					    // $printer -> textChinese( '   '.$v_text."\n"); 
					// }
					$printer -> text("\n");
					$v_order++;
				}
				if($sst_rate>0)
				{
					$incsst = ($sst_rate / 100) * $total;
					$incsst=number_format($incsst, 2);
					$showincsst=ceiling($incsst,0.05);
					$rounding=$showincsst-$incsst;
					$rounding=number_format($rounding, 2);
					$total=number_format($showincsst+$total, 2);
				
					$printer -> text( "                      " . "SST (6 %)        $incsst" . "   " . "\n");
				   
					$printer -> text( "                      " . "Rounding         $rounding" . "   " . "\n");
				   // $printer -> text( "              " . "           	   $showincsst" . "   " . "\n");
					  
				}
				$printer->setJustification(Printer::JUSTIFY_RIGHT);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text( "------------ -------------" . "\n");
				$printer -> text( "Qty: " . $qty_total . "      " . "Total: RM $total" . "   " . "\n");
				$printer -> text( "============ =============" . "\n");
				$printer -> text("\n");
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				if($sst_rate>0)
				{
					// $printer -> text( "All above prices are subject to SST 6% " . "\n");
				}
				$printer -> text("\n");
				$printer -> cut( Printer::CUT_FULL, 3 );  
				$printer -> close();
				//echo('success');   
				$order_id=$order['id'];
				 mysqli_query($conn,"UPDATE `order_list` SET `auto_print` = '1' WHERE `order_list`.`id` ='$order_id'");
				$res['status']=true;
				$res['message']="Print Successfully";
			} finally {
				$printer -> close();
			}
		}
			return $res;
	}
   function OrderCustomprintuser($ip_address,$order,$date,$time,$conn,$merchat_detail)
	{     
	     // print_R($order);
		 // die;
	   	if( $order == null ) {
			$res['status']=false;
			$res['message']="Failed to make print Due to Order Blank";
			
			//echo( "empty" );
			} else {
				
				// $ref_result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT mobile_number FROM users WHERE id='".$order['user_id']."'"));
			// if( ! isset( $ref_result['mobile_number'] ) ) {
				// $res['status']=false;
			// $res['message']="User id Not found";
				
			// }
			// print_R($merchat_detail);
			 // $printer_t=$merchat_detail['printer_profile'];
		      
			try {
					$connector = new NetworkPrintConnector($ip_address, 9100,5);
				
				
			} catch( Exception $e ) {
				//echo('print_setting_error');
				//echo(print_r($e, true));
				// die();
				$res['status']=false;
				$res['message']="Printer is not connected";
			}
			// $res['status']=false;
			// $res['message']="Printer is not connected";
			//echo(print_r($connector, true));
			
			
			// 3 + 16 + 8 + 5 + 7 + 7
			$mobile = $order['user_mobile'];
			$section_id=$order['section_type'];
			$section_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM sections WHERE id='".$order['section_type']."'"));
			// print_R($section_data);
			// die;
			$section_name=$section_data['name'];
			$invoce_id=$order['invoice_no'];
			$order_id=$order['id'];
			$printer = new Printer($connector);
			$printer -> getPrintConnector() -> write(PRINTER::ESC . "B" . chr(4) . chr(1));
			try {
				
				$printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_CENTER);
				$printer -> text("\n");
				$printer -> setEmphasis(true);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text( $order['merchantname'] . "\n" );
				// $printer -> text("\n");
				if($order['register'])
				{
					$printer -> selectPrintMode(Printer::MODE_FONT_A);
					$printer -> setEmphasis(false);
					$printer -> text( '( ' . $order['register'] . ' )' . "\n" );
					// $printer -> text("\n");
				}
				if($order['username'])
				{
					$printer -> setEmphasis(true);
					$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
					$printer -> textChinese( "Customer : " . $order['username'] . "\n" );
					// $printer -> text("\n");
					// $printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
					 // $printer -> selectPrintMode(Printer::MODE_FONT_A);
				}
				if($mobile)
				{
					$printer -> setEmphasis(false);
					$printer -> text( 'Phone : ' . $mobile . "\n" );
					// $printer -> text("\n");
				}
				
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> setEmphasis(false);
				// $printer -> text("\n");
				$location = $order['location'];
				$words = explode(" ", $location);
				$rows_locations = [];
				$rows_location = '';
				for( $i = 0 ; $i < sizeof( $words ) ; $i ++ ) {
					
					$word = $words[$i];
					$word .= ' ';
					if( strlen( $rows_location ) + strlen( $word ) < 30 ) {
						$rows_location .= $word;
						if( $i == sizeof( $words ) - 1 ) {
							array_push( $rows_locations, $rows_location);
						}
					} else {
						array_push( $rows_locations, $rows_location);
						$rows_location = $word;
						if( $i == sizeof( $words ) - 1 ) {
							array_push( $rows_locations, $rows_location);
						}
					}
				}
				foreach( $rows_locations as $item ) {
					$printer -> text( ' ' . $item . "\n" );
					// $printer -> text("\n");
				}
				if($order['gst'])
				{
				 $printer -> text( 'GST ID : ' . $order['gst'] . "\n" );
				}
				// $printer -> text("\n");
				if($order['sst'])
				{
				 $printer -> text( 'SST NO : ' . $order['sst'] . "\n" );
				}
				// $printer -> text("\n");
				// $printer -> text("\n");
				
				if($order['invoice_no'])
				{
					$printer -> barcode( $order['id'] . '-' . $invoce_id, Printer::BARCODE_CODE39 );  
				}     
				// $printer -> text("\n");   
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text(  $order['id'] . '-' . $invoce_id . "\n" );
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				// $printer -> text("\n");
				$printer -> setJustification(Printer::JUSTIFY_LEFT);
				$printer -> text("\n");
				$printer -> setEmphasis(true);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text("  Table : " . $order['table_type'] . "  "."Section : " .$section_name. "\n");
				 // $printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				// $printer -> text("  Section : " . $order['section_type'] . "\n");   
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> text("\n"); 
				$printer -> setEmphasis(false);
				$printer -> text( '  ' . $date . ' ' . $time . "\n");
				$printer -> text("\n");
				$printer -> selectPrintMode(Printer::MODE_FONT_A);
				$printer -> text( "  No  Name( Code )    Qty  Remark  Price  Amount " . "\n");
				$printer -> text("\n");
				$total = 0;
				$qty_total = 0;
				$v_order=1;
				
				for( $i = 0 ; $i < sizeof( $order['product_name'] ) ; $i ++ ) {
					
					if( $order['product_qty'][$i] && $order['product_amt'][$i] ) {
						$amount = $order['product_qty'][$i] * $order['product_amt'][$i];
					} else {
						$amount = 0;
					}
					$qty_total += $order['product_qty'][$i];
					$total += $amount;
					$amount=number_format($amount,2);
					$total=number_format($total,2);
					$remark = isset($order['remark'][$i]) ? $order['remark'][$i] : '';
					$product_code = isset($order['product_code'][$i]) ? $order['product_code'][$i] : '';
					$product_code  = '(' . $product_code . ')';
					$name = $order['product_name'][$i];
					$product_id = $order['product_ids'][$i];
					$qty = $order['product_qty'][$i];
					$price = $order['product_amt'][$i];
					$name .= $product_code;
					$number = $i + 1;
					$size_number = 3;
					$size_name = 12;
					$size_remark = 7;
					$size_qty = 4;
					$size_price = 6;
					$size_amount = 6;
					$lines = max(intval( strlen($number) / $size_number) , intval( strlen($name) / $size_name) , intval( strlen($remark) / $size_remark) , intval( strlen($qty) / $size_qty) , intval( strlen($price) / $size_price) , intval( strlen($amount) / $size_amount) );
					$lines ++;
					$v_data =mysqli_query($conn, "SELECT varient_id FROM order_varient WHERE product_id='$product_id' and invoice_no='$invoce_id' and v_order='$v_order'");
					for( $j = 0 ; $j < $lines ; $j++) {  
						$number_print = '';
						if( strlen($number) > ($j) * $size_number ) {
							$number_print = substr($number, $j * $size_number, min($size_number, strlen($number) - ($j) * $size_number));
						}
						$number_print = str_pad($number_print,  $size_number, "   ");
						$name_print = '';
						if( strlen($name) > ($j) * $size_name ) {
							$name_print = substr($name, $j * $size_name, min($size_name, strlen($name) - ($j) * $size_name));
						}
						$name_print = str_pad($name_print,  $size_name, "   ");
						$remark_print = '';
						if( strlen($remark) > ($j) * $size_remark ) {
							$remark_print = substr($remark, $j * $size_remark, min($size_remark, strlen($remark) - ($j) * $size_remark));
						}
						$remark_print = str_pad($remark_print,  $size_remark, "   ");
						$qty_print = '';
						if( strlen($qty) > ($j) * $size_qty ) {
							$qty_print = substr($qty, $j * $size_qty, min($size_qty, strlen($qty) - ($j) * $size_qty));
						}
						$qty_print = str_pad($qty_print,  $size_qty, "   ");
						$price_print = '';
						if( strlen($price) > ($j) * $size_price ) {
							$price_print = substr($price, $j * $size_price, min($size_price, strlen($price) - ($j) * $size_price));
						}
						$price_print = str_pad($price_print,  $size_price, "   ");
						$amount_print = '';
						if( strlen($amount) > ($j) * $size_amount ) {
							$amount_print = substr($amount, $j * $size_amount, min($size_amount, strlen($amount) - ($j) * $size_amount));
						}
						$amount_print = str_pad($amount_print,  $size_amount, "   ");
						$printer -> textChinese( '  ' . $number_print . ' ' .  $name_print . '    ' . $qty_print. ' ' . $remark_print . ' ' . $price_print . ' ' . $amount_print . "\n");
					    
					
					}
						while ($srow=mysqli_fetch_assoc($v_data)){
							
						$v_id=$srow['varient_id'];   
						$sub_rows = mysqli_query($conn, "SELECT * FROM sub_products WHERE id='$v_id'");
						while ($srow1=mysqli_fetch_assoc($sub_rows)){  
							// print_R($srow1); 
							// die;
							  $v_name=$srow1['name'];
							// die;
							 // die;
							if($v_name)
							{
								$printer -> textChinese( '   '.$v_name."\n"); 
							}
							$v_name='';
						}
						$v_name='';
					}
					// $varray=$order['varient'];
					
					// foreach($varray  as $vi)
					// {
						
						// $v_text=$vi['name']."( ".$vi['product_price'].")";
					    // $printer -> textChinese( '   '.$v_text."\n"); 
					// }
					$printer -> text("\n");
					$v_order++;
				}
				if($order['sstper']>0)
				{
				   $sstper=$ordr['sstper'];
				   $incsst = ($sstper / 100) * $total;
				   
				  $incsst=number_format($incsst, 2);
				  $incsst=ceiling($incsst,0.05);
				  // $printer -> textChinese( '                                            SST TAX     '.$sstper."%      ".$incsst."\n"); 
				  $total=number_format($total+$incsst, 2);
				}
				$printer->setJustification(Printer::JUSTIFY_RIGHT);
				$printer -> selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
				$printer -> text( "------------ -------------" . "\n");
				$printer -> text( "Qty: " . $qty_total . "      " . "Total: RM $total" . "   " . "\n");
				$printer -> text( "============ =============" . "\n");
				$printer -> text("\n");
				$printer -> text("\n");
				$printer -> cut( Printer::CUT_FULL, 3 );  
				$printer -> close();
				//echo('success');   
				$order_id=$order['id'];
				 // mysqli_query($conn,"UPDATE `order_list` SET `auto_print` = '1' WHERE `order_list`.`id` ='$order_id'");
				$res['status']=true;
				$res['message']="Print Successfully";
			} finally {
				$printer -> close();
			}
		}
			return $res;
	}

