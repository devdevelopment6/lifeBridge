	<?php include("../includes/application_top.php");

		require("../includes/phpmailer/class.phpmailer.php");

		if($_SESSION['user_id']==""){
		
		header("location: ".LINK_URL_HOME."login.php");
		
		}
		
		//echo  $_SESSION['mr_id'];die;
		$parameter_ids=str_replace(" ","+",$_REQUEST['id']);
		$parameter_id= decryptthis($parameter_ids, $keyy);
		
		$cust_para_ids=str_replace(" ","+",$_REQUEST['bid']);
		$cust_para_id= decryptthis($cust_para_ids, $keyy);
		
		date_default_timezone_set("America/New_York");
		
		$select_merchant = $db->prepare("select business_name,mer_user_name,txt_rate from  ".DB_EZEECHECK.".".TBL_MERCHANT_MASTER." where merchant_id=".$_SESSION['mr_id']);
		$select_merchant->execute();
		$merchant_det=$select_merchant->fetch(PDO::FETCH_ASSOC);
		$merchant_name=$merchant_det['business_name'];
		$email_send=$merchant_det['mer_user_name'];
		$txt_rate = $merchant_det['txt_rate'];



	$message1='';
	if($_REQUEST['submit']=='submit')
	{  
		

			//print_r($_REQUEST);die;
		$subscription5 = $db->prepare("select signature_package from  ".DB_EZEECHECK.".".TBL_MERCHANT_SUBSCRIPTION." where mer_id='".$_SESSION['mr_id']."'  order by sub_id desc limit 1");
		$subscription5->execute();
		$subscription_row5=$subscription5->fetch(PDO::FETCH_ASSOC);
		
		if($subscription_row5['signature_package']!='Yes') { $sig_check='yes'; } else { $sig_check = $_REQUEST['sig_check']; }



		$date=date('Y-m-d');
		$cust_detail = $_REQUEST['custid'];
		$accno = $_REQUEST['acc_no'];
		$accno = encryptthis($accno, $keyy);
		$checkno = $_REQUEST['acc_check_no'];
		$amt = $_REQUEST['acc_check_amt'] ;
		$eccheck_taxrate = $_REQUEST['eccheck_taxrate'] ;
		$eccheck_totalvalue = $_REQUEST['eccheck_totalvalue'] ;
		$routingno = encryptthis($_REQUEST['acc_routing_no'], $keyy);
		$business_name = $_REQUEST['txt_acc_hol_name'];
		$email = $_REQUEST['txt_acc_hol_email'];
		$phone = $_REQUEST['txt_acc_hol_phone'];
		//$echeck = $_REQUEST['email_check'];
		$addcheck = $_REQUEST['add_check'];
		$address = $_REQUEST['txt_acc_hol_address'];
		$city = $_REQUEST['txt_city'];
		$state = $_REQUEST['txt_acc_hol_state'];
		$zip = $_REQUEST['txt_acc_hol_zip'];
		$memo = $_REQUEST['acc_check_memo'];
		$basic_check = $_REQUEST['basic_check'];
		 $fund_check = $_REQUEST['fund_check'];		
		 $sig_check = $_REQUEST['sig_check'];	
		//$emailcheck = $_REQUEST['email_check'];
		$addcheck = $_REQUEST['add_check'];
		$customer_type = $_REQUEST['cust_bus_type'];
		$customer_fname1 = $_REQUEST['txt_acc_hol_name1'];
		$customer_lname1 = $_REQUEST['txt_acc_hol_name2'];
		$customer_fname2 = 	$_REQUEST['txt_acc_hol_name3'];
		$customer_lname2 = $_REQUEST['txt_acc_hol_name4'];


		/******* tbl_payment_details*****************/
		
		$payment_mode_type  = $_REQUEST['payment_mode_type'];
		$payment_fre  = $_REQUEST['payment_fre'];
		$currency  = $_REQUEST['currency'];
		$payment_id  = $_REQUEST['payment_id'];
		$paymentreqtype  = $_REQUEST['paymentreqtype'];
		$credit_card_no  = $_REQUEST['credit_card_no'];
		$credit_amount  = $_REQUEST['credit_amount']; 
		$credit_expiration_date  = $_REQUEST['credit_expiration_date'];
		$credit_cvv  = $_REQUEST['credit_cvv']; 
		$cc_name_of_card  = $_REQUEST['cc_name_of_card']; 
		$cc_zip_code  = $_REQUEST['cc_zip_code']; 
		$ach_payment_routing  = $_REQUEST['ach_payment_routing']; 
		$ach_payment_account  = $_REQUEST['ach_payment_account']; 
		$ach_payment_amount  = $_REQUEST['ach_payment_amount']; 
		$cash_invoice  = $_REQUEST['cash_invoice']; 
		$cash_amount  = $_REQUEST['cash_amount']; 
		$crypto_amount  = $_REQUEST['crypto_amount']; 
		$crypto_exp_date  = $_REQUEST['crypto_exp_date'];

		$cctaxrate  = $_REQUEST['cctaxrate'];
		$cctotalvalue  = $_REQUEST['cctotalvalue'];
		$achptaxrate  = $_REQUEST['achptaxrate'];
		$achptotalvalue  = $_REQUEST['achptotalvalue'];
		$cash_p_taxrate  = $_REQUEST['cash_p_taxrate'];
		$cash_p_totalvalue  = $_REQUEST['cash_p_totalvalue'];
		$crypto_taxrate  = $_REQUEST['crypto_taxrate'];
		$crypto_totalvalue  = $_REQUEST['crypto_totalvalue'];
		/*
		modify_date*/

		/*** Vailidation**************************/
		if(empty($_REQUEST['cust_bus_type'])){
			$error="Please Select Account Type Under Customer Type";
			$code = 1;	
		}else if(empty($customer_fname1) && $_REQUEST['cust_bus_type']=="Individual"){
		  $error = "Please Enter  Account Holder (1) First Name Under Customer Type!";
		  $code = 1;
		 }else if(empty($business_name) && $_REQUEST['cust_bus_type']=="Business"){
		  $error = "Please Enter Account Holder Business Name Under Customer Type!";
		  $code = 1;
		 }
		 else if(empty($customer_lname1) && $_REQUEST['cust_bus_type']=="Individual"){
		  $error = "Please Enter Account Holder (1) Last Name Under Customer Type!";
		  $code = 1;
		 }else if(empty($email) && $_REQUEST['cust_bus_type']=="Individual"){
		  $error = "Please Enter Email Under Customer Type!";
		  $code = 1;
		 }else if(empty($_REQUEST['currency']) && $_REQUEST['cust_bus_type']=="Individual"){
		  $error = "Please Enter Currency Under Customer Type!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['credit_card_no'])){
		  $error = "Please Enter Card no Under Credit Card Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['credit_amount']) ){
		  $error = "Please Enter Credit Card Amount Under Credit Card Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['credit_expiration_date']) ){
		  $error = "Please Enter Expiration Date Under Credit Card Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['credit_cvv']) ){
		  $error = "Please Enter Credit Card CVV Under Credit Card Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['cc_name_of_card']) ){
		  $error = "Please Enter Name on Card Under Credit Card Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='2' && empty($_REQUEST['cc_zip_code']) ){
		  $error = "Please Enter Zip Code Under Credit Card Payment!";
		  $code = 1;		  
		 }else if($_REQUEST['payment_mode_type']=='3' && empty($_REQUEST['acc_check_no']) ){
		  $error = "Please Enter Check Number Under E-Check!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='3' && empty($_REQUEST['acc_check_amt']) ){
		  $error = "Please Enter Check Amount Under E-Check!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='3' && empty($_REQUEST['acc_routing_no']) ){
		  $error = "Please Enter Routing Number  Under E-Check!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='3' && empty($_REQUEST['acc_no']) ){
		  $error = "Please Enter Account Number  Under E-Check!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='3' && empty($_REQUEST['re_acc_no']) ){
		  $error = "Please Enter Confirm Account Number  Under E-Check!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='4' && empty($_REQUEST['ach_payment_routing']) ){
		  $error = "Please Enter Routing No  Under ACH Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='4' && empty($_REQUEST['ach_payment_account']) ){
		  $error = "Please Enter Account No  Under ACH Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='4'&& empty($_REQUEST['ach_payment_amount']) ){
		  $error = "Please Enter Amount Under ACH Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='5' && empty($_REQUEST['cash_invoice']) ){
		  $error = "Please Enter Invoice/Voucher No Under Cash Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='5' && empty($_REQUEST['cash_amount']) ){
		  $error = "Please Enter Amount Under Cash Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='6' && empty($_REQUEST['crypto_amount']) ){
		  $error = "Please Enter Amount Under Crypto Payment!";
		  $code = 1;
		 }else if($_REQUEST['payment_mode_type']=='6' && empty($_REQUEST['crypto_exp_date']) ){
		  $error = "Please Enter Expiration Date Under Crypto Payment!";
		  $code = 1;
		 }
		
		else{			
		
		$url='https://www.routingnumbers.info/api/data.json?rn='.$_REQUEST['acc_routing_no'];
		$ch = curl_init("$url");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_getinfo($ch);
		if(curl_exec($ch) === FALSE) { die("Curl failed: " . curl_error($ch));  }
		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, TRUE);
		
		$routinginfo_name = $data[customer_name];
		$routinginfo_address = 	$data[address];
		$routinginfo_state = $data[city]." ".$data[state]." ".$data[zip];
		
		$cust_add1 = $_REQUEST['txt_acc_hol_address'];
		$cust_IP = $_SERVER['REMOTE_ADDR'];
		$cid = $ezee->getCountryByCode('US');

		
		$cust_other_city = '';
		$cust_country = $cid;
		$cust_zip = $_REQUEST['txt_acc_hol_zip'];
		$txt_phone = $_REQUEST['txt_acc_hol_phone'];
		$txt_phone =str_replace('-','',$txt_phone);
		$txt_phone =str_replace('(','',$txt_phone);
		$cust_contact_no =str_replace(')','',$txt_phone);
		$cust_email = $_REQUEST['txt_acc_hol_email'];
		$cust_dob = date('Y-m-d',strtotime($_REQUEST['txt_dob']));

		if($_REQUEST['custType']!='new'){
		$chk_value=array(
						'customer_id' => $cust_detail, 
						'email_chk' =>$emailcheck,
						'add_chk' =>$addcheck,
						'check_no' => $checkno,
						'check_amount' => $eccheck_totalvalue,
						'eccheck_taxrate' => $aeccheck_taxratemt,
						'eccheck_totalvalue' => $amt,
						'check_memo' => $memo,
						'routinginfo_name' => $routinginfo_name,
						'routinginfo_address' => $routinginfo_address,
						'routinginfo_state' => $routinginfo_state,
						'check_bank_name'=>'',
						'check_routing_no' => $routingno,
						'check_account_no' => $accno,
						'txt_auth_sig' => $_REQUEST['txt_auth_sig'],
						'comp_type' => $_REQUEST['comp_type'],
						'check_status'=>'Final'	,						
						'basic_check'=>$basic_check,
						'fund_check'=>$fund_check,
						'sig_check'=>$sig_check,
						'section_created_by'=>'create_payments.php'
					);	
		}

		$field_value=array(
					'merchant_id' => $_SESSION['mr_id'], 
					'customer_type' => $customer_type,
					'customer_fname1' => $customer_fname1,
					'customer_lname1' => $customer_lname1,
					'customer_fname2'=>$customer_fname2,
					'customer_lname2' => $customer_lname2,
					'business_name' => $business_name,
					
					'cust_add1' => $cust_add1,
					'cust_add2'=>$cust_add2,
					'cust_add3'=>$cust_add3,
					'cust_IP'=>$cust_IP,
					'cust_country' => $cust_country,
					'cust_state'=>$state,
					'cust_city'=>$city,
					'cust_other_city'=>'',
					'cust_zip'=>$zip,
					'cust_ac_no' => $accno,
					'cust_contact_no'=>$cust_contact_no,
					'cust_email'=>$cust_email,
					'cust_dob'=>$cust_dob,
					'cust_bank_name'=>'',				
					'cust_routing_no'=>$routingno,
					'section_created_by'=>'create_payments.php'	
				);	
		if(empty($_REQUEST['bid'])){	

			$resultCustomer = $ezee->addSection(DB_EZEECHECK.
				".".TBL_CUSTOMER_MASTER,$field_value,'cust_created_date');

			/*** if payment id new then insert both table 1=tbl_payment_genration 2=TBL_PAYMENT_DETAILS ^***/

			if($_REQUEST['payment_id_type']=='2'){
				$sqlResult = $db->prepare("select customer_fname1,customer_lname1 from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where customer_id=".$resultCustomer);
				$sqlResult->execute();
				$rowCustomer=$sqlResult->fetch(PDO::FETCH_ASSOC);
				$cName = $rowCustomer['customer_fname1'];
				$cLName = $rowCustomer['customer_lname1'];

			//$genratePaymentId=time();
			$datetimesec= date("mdyHis");//Ha02-20-21 11:26:52Wa	   
		    $merName=substr($merchant_name,0,2);
		    $cutFName=substr($cName,0,1);
		    $cutLName=substr($cLName,0,1);
		    $getName=$cutFName.$cutLName;

		    $genratePaymentId=strtoupper($merName).$datetimesec.strtoupper($getName);

			// $genratePaymentId=$_SESSION['mr_id'].$resultCustomer;
			
			}else{
				$genratePaymentId=$_REQUEST['payment_id'];
			}


		        if($_POST['payment_id_type']=='2'){

		        	$sqlPaymentGenration = $db->prepare("insert into  ".DB_EZEECHECK.".".tbl_payment_genration." (paymentId,customer_name,used, datetime) 
                                VALUES ('".$genratePaymentId."','".$resultCustomer."', '1', now())  ");
			        $sqlPaymentGenration->execute();           
			        $resultpaymentGenration = $sqlPaymentGenration->fetchAll();
		        //$lastInsertId = $db->lastInsertId();
				}

			/******* Insert TBL_CHECK*****************/
			
			$chk_value=array(
						'customer_id' => $resultCustomer, 
						'email_chk' =>$emailcheck,
						'add_chk' =>$addcheck,
						'check_no' => $checkno,
						'check_amount' => $eccheck_totalvalue,
						'eccheck_taxrate' => $aeccheck_taxratemt,
						'eccheck_totalvalue' => $amt,
						'check_memo' => $memo,
						'routinginfo_name' => $routinginfo_name,
						'routinginfo_address' => $routinginfo_address,
						'routinginfo_state' => $routinginfo_state,
						'check_bank_name'=>'',
						'check_routing_no' => $routingno,
						'check_account_no' => $accno,
						'txt_auth_sig' => $_REQUEST['txt_auth_sig'],
						'comp_type' => $_REQUEST['comp_type'],
						'check_status'=>'Final'	,						
						'basic_check'=>$basic_check,
						'fund_check'=>$fund_check,
						'sig_check'=>$sig_check,
						'section_created_by'=>'create_payments.php'
					);	

				$resultcheck = $ezee->addSection(DB_EZEECHECK.
				".".TBL_CHECK,$chk_value,'check_created_date');

			/******* tbl_payment_details*****************/
			

			$fieldPayDetails=array(
					'customer_id' => $resultCustomer,
					'payment_mode_type' => $payment_mode_type,
					'currency' =>$currency,
					'payment_fre' =>$payment_fre,
					'payment_id' =>$genratePaymentId,
					'paymentreqtype' =>$paymentreqtype,
					'credit_card_no' =>$credit_card_no,
					'credit_amount' =>$credit_amount, 
					'cctaxrate' =>$cctaxrate, 
					'cctotalvalue' =>$cctotalvalue, 
					'credit_expiration_date' =>$credit_expiration_date,
					'credit_cvv' => $credit_cvv,
					'cc_name_of_card' => $cc_name_of_card,
					'cc_zip_code' => $cc_zip_code,
					'ach_payment_routing' => $ach_payment_routing, 
					'ach_payment_account' => $ach_payment_account, 
					'ach_payment_amount' => $ach_payment_amount, 
					'achptaxrate' => $achptaxrate, 
					'achptotalvalue' => $achptotalvalue, 
					'cash_invoice' => $cash_invoice,
					'cash_amount' => $cash_amount, 
					'cash_p_taxrate' => $cash_p_taxrate, 
					'cash_p_totalvalue' => $cash_p_totalvalue, 
					'crypto_amount' => $crypto_amount, 
					'crypto_taxrate' => $crypto_taxrate, 
					'crypto_totalvalue' => $crypto_totalvalue, 
					'crypto_exp_date' => $crypto_exp_date
				);

			

			$resultPayDetail = $ezee->addSection(DB_EZEECHECK.
				".".TBL_PAYMENT_DETAILS,$fieldPayDetails,'create_date');

			$paymentGenration = $db->prepare("update ".DB_EZEECHECK.".".tbl_payment_genration." set used='1' where paymentId='".$payment_id."'");
		        $paymentGenration->execute();           
		        $resultpaymentGenration = $paymentGenration->fetchAll();
		

			if($resultPayDetail > 0 ){
				header('location:view-create-payments.php');
			}



		}else{
		/**
		*Update Part*
		*/	
		/**** Update TBL_CUSTOMER_MASTER************/
			
			$updateCustomer = $ezee->updateSection(DB_EZEECHECK.
				".".TBL_CUSTOMER_MASTER,'customer_id',$cust_para_id,$field_value,'cust_modified_date');	

		/**** Update TBL_CHECK************/	

			$updateCheck = $ezee->updateSection(DB_EZEECHECK.
				".".TBL_CHECK,'customer_id',$cust_para_id,$chk_value,'check_modified_date');

		/****Check if data not insert table tbl_check then insert this table****/	
			$check = $db->prepare("select customer_id from  ".DB_EZEECHECK.".".TBL_CHECK." where customer_id='".$cust_para_id."'");
			$check->execute();			
			if(empty($check -> rowCount() )){
				$resultcheck = $ezee->addSection(DB_EZEECHECK.
				".".TBL_CHECK,$chk_value,'check_created_date');
			}


			/******* tbl_payment_details*****************/
			if($_REQUEST['payment_id_type']=='2'){
			
			 //$genratePaymentId=$_SESSION['mr_id'].$cust_detail;
				
				$sqlResult = $db->prepare("select customer_fname1,customer_lname1 from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where customer_id=".$cust_detail);
				$sqlResult->execute();
				$rowCustomer=$sqlResult->fetch(PDO::FETCH_ASSOC);
				$cName = $rowCustomer['customer_fname1'];
				$cLName = $rowCustomer['customer_lname1'];

				
			//$genratePaymentId=time();
				$datetimesec= date("mdyHis");//Ha02-20-21 11:26:52Wa	   
			    $merName=substr($merchant_name,0,2);
			    $cutFName=substr($cName,0,1);
			    $cutLName=substr($cLName,0,1);
   				$getName=$cutFName.$cutLName;

			    $genratePaymentId=strtoupper($merName).$datetimesec.strtoupper($getName);

			
			}else{
				$genratePaymentId=$_REQUEST['payment_id'];
			}

			$fieldPayDetails=array(
					'customer_id' => $cust_detail,
					'payment_mode_type' => $payment_mode_type,
					'payment_fre' =>$payment_fre,
					'currency' =>$currency,
					'payment_id' =>$genratePaymentId,
					'paymentreqtype' =>$paymentreqtype,
					'credit_card_no' =>$credit_card_no,
					'credit_amount' =>$credit_amount, 
					'cctaxrate' =>$cctaxrate, 
					'cctotalvalue' =>$cctotalvalue,
					'credit_expiration_date' =>$credit_expiration_date,
					'credit_cvv' => $credit_cvv,
					'cc_name_of_card' => $cc_name_of_card,
					'cc_zip_code' => $cc_zip_code,
					'ach_payment_routing' => $ach_payment_routing, 
					'ach_payment_account' => $ach_payment_account, 
					'ach_payment_amount' => $ach_payment_amount,
					'achptaxrate' => $achptaxrate, 
					'achptotalvalue' => $achptotalvalue, 
					'cash_invoice' => $cash_invoice,
					'cash_amount' => $cash_amount,
					'cash_p_taxrate' => $cash_p_taxrate, 
					'cash_p_totalvalue' => $cash_p_totalvalue, 
					'crypto_amount' => $crypto_amount,
					'crypto_taxrate' => $crypto_taxrate, 
					'crypto_totalvalue' => $crypto_totalvalue, 
					'crypto_exp_date' => $crypto_exp_date
				);			

			$updatePayDetail = $ezee->updateSection(DB_EZEECHECK.
				".".TBL_PAYMENT_DETAILS,'customer_id',$cust_para_id,$fieldPayDetails,'modify_date');

			$paymentGenration = $db->prepare("update ".DB_EZEECHECK.".".tbl_payment_genration." set used='1' where paymentId='".$payment_id."'");
		        $paymentGenration->execute();           
		        $resultpaymentGenration = $paymentGenration->fetchAll();

		/****Check if data not insert table TBL_PAYMENT_DETAILS then insert this table****/	
			$check = $db->prepare("select customer_id from  ".DB_EZEECHECK.".".TBL_PAYMENT_DETAILS." where customer_id='".$cust_para_id."'");
			$check->execute();			
			if(empty($check -> rowCount() )){
				$resultPayDetail = $ezee->addSection(DB_EZEECHECK.
				".".TBL_PAYMENT_DETAILS,$fieldPayDetails,'create_date');
			}

			/*** if payment id new then insert both table 1=tbl_payment_genration 2=TBL_PAYMENT_DETAILS ^***/
		        if($_REQUEST['payment_id_type']=='2'){

					$sqlPaymentGenration = $db->prepare("insert into  ".DB_EZEECHECK.".".tbl_payment_genration." (paymentId,customer_name,used, datetime) 
                                VALUES ('".$genratePaymentId."','".$cust_detail."',  '1', now())  ");
			        $sqlPaymentGenration->execute();           
			        $resultpaymentGenration = $sqlPaymentGenration->fetchAll();
		        //$lastInsertId = $db->lastInsertId();
				}
		}
		
		} /// end else check vailidation			
	}
	/************Close Insert update*******************/

	$select = $db->prepare("select business_name,merchant_id from  ".DB_EZEECHECK.".".TBL_MERCHANT_MASTER." where user_id='".$_SESSION['user_id']."'");
	$select->execute();
	$row=$select->fetch(PDO::FETCH_ASSOC);
	$merId = $row['merchant_id'];
	

	if($_SESSION['user_id']==1)
	$comp ='Admin';
	else
	$comp =$row['business_name'];

	/*echo 'PARAMETER'.$parameter_id;
	echo 'ID'.$_REQUEST['id'];  die();
	$parameter_id=$_REQUEST['id'];
	*/

	if($parameter_id >0)
	{

	
		//echo $crow['check_routing_no'];die;
	$check = $db->prepare("select customer_id,email_chk,add_chk,check_no,check_amount,check_memo,check_bank_name,check_routing_no,check_account_no,eccheck_totalvalue,check_status,txt_auth_sig,comp_type,sig_check,check_created_date from  ".DB_EZEECHECK.".".TBL_CHECK." where check_id='".$parameter_id."'");
	
	$check->execute();
	$crow=$check->fetch(PDO::FETCH_ASSOC);	
	$customer_id = $crow['customer_id'];
	$email_chk = $crow['email_chk'];
	$add_chk = $crow['add_chk'];
	$chkNo = $crow['check_no'];
	$eccheck_totalvalue = $crow['eccheck_totalvalue'];
	$chkDt = date('m-d-Y',strtotime($crow[check_created_date]));
	$chkAmount = $crow['check_amount'];
	$memo = $crow['check_memo'];	
	$bankName = $crow['check_bank_name'];	
	$routingNo = decryptthis($crow['check_routing_no'], $keyy);
	$acNo = decryptthis($crow['check_account_no'], $keyy);	
	$chkstatus = $crow['check_status']; 
	$txt_auth_sig=$crow['txt_auth_sig'];
	$comp_type=$crow['comp_type'];

	if($chkstatus=='Final'){ $chkRead ="readonly"; $seldis = "";}
	else { $chkRead =""; $seldis=""; }


	$result = $db->prepare("select cust_ac_no,cust_routing_no,customer_type,cust_zip,cust_state,cust_city,cust_add3,cust_add2,cust_add1,cust_contact_no,cust_email,business_name,customer_lname1,customer_fname1,customer_lname2,customer_fname2 from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where customer_id=".$customer_id);		
	$result->execute();
	$rowc=$result->fetch(PDO::FETCH_ASSOC);
	if($rowc['customer_type']=='Business') {
	$acName = $rowc['business_name'];
	}
	else
	{
	$acName1 = $rowc['customer_fname1'];
	$acName2 = $rowc['customer_lname1'];
	$acName3 = $rowc['customer_fname2'];
	$acName4 = $rowc['customer_lname2'];		
	$acName.= $rowc['customer_fname1']." ".$rowc['customer_lname1'];	
	}
	$bName = $rowc['business_name'];	
	$email = $rowc['cust_email'];
	$txt_phone = $rowc['cust_contact_no'];
	$code = substr($txt_phone,0,1);
	$phone1 = substr($txt_phone,0,3);
	$phone2 = substr($txt_phone,3,4);
	$phone3 = substr($txt_phone,7,4);

	$phone ="(".$phone1.")".$phone2."-".$phone3;	
	$address =$rowc['cust_add1']."".$rowc['cust_add2']."".$rowc['cust_add3'];	
	$city = $ezee->getCityName($rowc['cust_city']);	
	$state = $ezee->getStateName($rowc['cust_state']);
	$state_id = $rowc['cust_state'];
	$zip = $rowc['cust_zip'];	
	$custType = $rowc['customer_type'];
	$cust_routing_no = decryptthis($rowc['cust_routing_no'], $keyy);	
	$cust_ac_no = decryptthis($rowc['cust_ac_no'], $keyy);

	$check1 = $db->prepare("select check_id from  ".DB_EZEECHECK.".".TBL_CHECK_TEMP." ");
	$check1->execute();
	$trow=$check1->fetch(PDO::FETCH_ASSOC);	
	$cid = $trow['check_id'];
	}

	/*************** view TBL_PAYMENT_DETAILS*********************/

	/*$sqlpyd = $db->prepare("select * from  ".DB_EZEECHECK.".".TBL_PAYMENT_DETAILS." where customer_id='".$customer_id."'  ");
	$sqlpyd->execute();
	$getPyd=$sqlpyd->fetch(PDO::FETCH_ASSOC);*/	


	else if($cust_para_id!='') { 

	$customer_id = $cust_para_id;
	

	$result = $db->prepare("select cust_ac_no,cust_routing_no,customer_type,cust_zip,cust_state,cust_city,cust_add3,cust_add2,cust_add1,cust_contact_no,cust_email,business_name,customer_lname1,customer_fname1,customer_lname2,customer_fname2 from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where customer_id=".$customer_id);		
	$result->execute();
	$rowc=$result->fetch(PDO::FETCH_ASSOC);
	
	$check = $db->prepare("select email_chk,add_chk,check_no,check_amount,check_memo,check_bank_name,check_routing_no,basic_check,fund_check,sig_check,eccheck_totalvalue,check_account_no,comp_type from  ".DB_EZEECHECK.".".TBL_CHECK." where customer_id='".$customer_id."'  ");
	$check->execute();
	$crow=$check->fetch(PDO::FETCH_ASSOC);	
	$add_chk = $crow['add_chk'];
	$chkNo = $crow['check_no'];
	$eccheck_totalvalue = $crow['eccheck_totalvalue'];
	$chkAmount = $crow['check_amount'];
	$memo = $crow['check_memo'];
	$comp_type=$crow['comp_type'];
	
	$bankName = $crow['check_bank_name'];	
	$routingNo = decryptthis($rowc['cust_routing_no'], $keyy);
	$acNo = decryptthis($rowc['cust_ac_no'], $keyy);
	if($rowc['customer_type']=='Business') {
	$acName = $rowc['business_name'];
	}
	else
	{
	$acName1 = $rowc['customer_fname1'];
	$acName2 = $rowc['customer_lname1'];
	$acName3 = $rowc['customer_fname2'];
	$acName4 = $rowc['customer_lname2'];		
	$acName.= $rowc['customer_fname1']." ".$rowc['customer_lname1'];	
	}
	$bName = $rowc['business_name'];	
	$email = $rowc['cust_email'];
	$txt_phone = $rowc['cust_contact_no'];
	$code = substr($txt_phone,0,1);
	$phone1 = substr($txt_phone,0,3);
	$phone2 = substr($txt_phone,3,4);
	$phone3 = substr($txt_phone,7,4);
	$phone ="(".$phone1.")".$phone2."-".$phone3;	
	if($rowc['cust_add1'] !='') {
	$address =$rowc['cust_add1']." ".$rowc['cust_add2']." ".$rowc['cust_add3'];
	} else { $address =''; }	
	$city = $ezee->getCityName($rowc['cust_city']);	
	$state = $ezee->getStateName($rowc['cust_state']);
	$state_id = $rowc['cust_state'];
	$zip = $rowc['cust_zip'];	
	$custType = $rowc['customer_type'];
	$cust_routing_no = decryptthis($rowc['cust_routing_no'], $keyy);	
	$cust_ac_no = decryptthis($rowc['cust_ac_no'], $keyy);

	/*************** view TBL_PAYMENT_DETAILS*********************/
	$sqlpyd = $db->prepare("select * from  ".DB_EZEECHECK.".".TBL_PAYMENT_DETAILS." where customer_id='".$customer_id."'  ");
	$sqlpyd->execute();
	$getPyd=$sqlpyd->fetch(PDO::FETCH_ASSOC);	

	$check1 = $db->prepare("select check_id from  ".DB_EZEECHECK.".".TBL_CHECK_TEMP." ");
	$check1->execute();

	$trow=$check1->fetch(PDO::FETCH_ASSOC);	
	$cid = $trow['check_id'];
	$chkDt = date('m-d-Y');
	}  else
	{
	$routingNo ='';
	$acNo ='';
	$chkDt = date('m-d-Y');
	}
	?>
	<!DOCTYPE HTML>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
	<meta name="description" content="Responsive page">
	<link rel="shortcut icon" href="https://premiumpymts.com/wp-content/uploads/2019/08/favicon.png" type="image/x-icon"/>
	<title>Premiumpymts Printing</title>
	<!-- Bootstrap -->
	<link href="<?php echo LINK_URL_HOME;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/bootstrap-select.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/jquery.mobile-menu.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/site-icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/video-popup.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo LINK_URL_HOME;?>css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/bootstrap-select.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

	<script type="text/javascript">
	
	$(document).ready(function($){
		$("#credit_card_no").mask("9999 9999 9999 9999", {placeholder:"xxxx xxxx xxxx xxxx"})
	})

	</script>

	<script type="text/javascript">
  $('.selectpicker').selectpicker('refresh');
</script>
	<script>


	<?php if($parameter_id!='') { ?>

	jQuery(document).ready(function(){		

	$( window ).load(function() {

	jQuery('label:has(input:checked)').addClass('active');

	jQuery('label:has(input:not(:checked))').removeClass('active');

	});

	});
	<?php  } ?>
	</script>
	<script type="text/javascript"><!--
		function selectCustomer(val){
			//Forward browser to new url create-payments.php
			window.location='create-payments.php?bid=' + val;
		}
		  function newCustomer(val){
			//Forward browser to new url
			window.location='create-payments.php';
		}
	--></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143461663-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-143461663-1');
	</script>
	<style type="text/css">
	.panel-title a:hover, a:focus{text-decoration: auto;cursor: all-scroll;}
	.panel-title > a {text-decoration: auto;cursor !important: all-scroll;}
	.form-group.white-bg { padding: 18px 5px 0px !important; }
	.form-group { margin-bottom: 0px !important; }
	.check-image-wrapper .sample-text {
    float: left;
    width: 100%;
    text-align: center;
    margin: -21px 0 0 !important;
}

</style>
	</head>
	<body onLoad="showbType('<?php echo $custType; ?>');">
	<div id="layout">
	  <header class="header">
		<?php include("login_header.php")  ?>
	  </header>
	  <div class="wrapper">
		<?php include("header.php")  ?>
		<div id="content" class="right-colum">
		  <div class="breadcrumbs">
			<div class="row">
			  <div class="col-sm-4">
				<div class="page-title float-left">
				  <div class="page-title">
					<h1>Create Payments</h1>
				  </div>
				</div>
			  </div>
			  <div class="col-sm-8">
				<div class="page-title float-right">
							 <div class="video-btn"><a class="hvr-icon-wobble-horizontal" href="javascript:void(0)" id="popup_open" onclick="lightbox_open();"><img src="<?php echo LINK_URL_HOME;?>images/video-icon.png" alt="video" class="hvr-icon"> <span>Tutorial Video</span></a></div>            

				  <div class="page-title">
					<ol class="breadcrumb text-right">
					  <li><a href="<?php echo LINK_URL_HOME; ?>">Home</a></li>
					  <li class="active">Create Payments</li>
					</ol>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="page-wrapper">
			<div class="tabbing open-tab">
			  <div id="parentHorizontalTab">
				<ul class="resp-tabs-list tabs-list">
				  <li class="resp-tab-active"><a href="create-payments.php">Create Payments</a></li>
				  <li><a href="view-create-payments.php"> Manage Payments</a></li>
				</ul>
				<div class="resp-tabs-container">
				  <div id="home" class="tab-panel">
					<div class="panel">
					  <form method="post" enctype="multipart/data" name="frm_signup" id="frm_signup" onSubmit="return validatefrm();" autocomplete="off">
					  	<div class="panel-title">
			            <div class="col-md-12">
			              <ul class="main-icons">
			                 <li class="add-icon">
			                  <?php	  if($parameter_id!='' || $customer_id!='') {?>
			                  <input type="hidden" name="submit" value="submit" />
			                  <input type="hidden" name="customer_id" id="cid" value="<?php echo $parameter_id; ?>">
			                       <button type="submit" class="save_button add-btn"><img src="<?php echo LINK_URL_HOME;?>images/save-icon.png" alt="Submit"> <span>Save</span></button>
			                  
			                  
			                  <?php }  else { ?>
			                  <input type="hidden" name="submit"  value="submit" />
			                   <button type="submit"  class="save_button add-btn"><img src="<?php echo LINK_URL_HOME;?>images/save-icon.png" alt="Submit"> <span>Save</span></button>
			                  <?php } ?>
			                </li>
			            <!--   <li class="add-icon">
			                
			                <a href="view-customers.php" title="Return" class="save_button add-btn"><img src="<?php echo LINK_URL_HOME;?>images/return-icon.png" alt="Submit"><span>Return</span></a> </li>-->
			               
			              </ul>
			            </div>
			          </div>
						<div class="panel-heading" style="padding:0">
						  <div class="col-md-12">
							<h3>Create Payments</h3>
							<ul class="main-icons">
							  <input type="hidden" name="id" value="<?php echo $parameter_id; ?>">
							  <input type="hidden" name="custid" value="<?php echo $customer_id; ?>">
							  <input type="hidden" name="chkstatus" value="<?php echo $chkstatus; ?>">
							  <input type="hidden" name="cid" value="<?php echo $cid; ?>">
							  <input type="hidden" name="merId" value="<?php echo $merId; ?>">
							</ul>
						  </div>
						</div>
						<?php  if($error!=''){ ?>
							<div class="panel-body">
			                  <div class="col-md-6 text-left p-3 mb-2 bg-danger text-white" align="left" style="padding: 10px; margin: 10px;">
			                      <!--breadcrumbs start -->
			                      <p class="error"> <span style="color: red;">X</span>&nbsp;&nbsp;
								 <span style="color: red;"> Error! </span> <?php echo $error?>
								  <button type="button" onClick="document.location.href='create-payments.php'" class="close" data-dismiss="alert" aria-hidden="true">X</button><p>
			                      </ul>
			                      <!--breadcrumbs end -->
			                  </div>
			              </div>
						    <?php   } ?>
						<div class="panel-body">
						  <div class="form-group" style="display:none">
							<div class="col-md-6 col-sm-6">
							  <div class="form-control-wrap"> </div>
							</div>
						   
						  </div>
						  <div class="col-md-6 col-sm-6">
						  <?php if($message1!='') { ?>
						  <div id="myModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h4 class="modal-title"></h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								  </div>
								  <div class="modal-body">
									<div style="text-align: center">
									
									  <?php  if($message1!='') { echo $message1; } ?>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								</div>
							  </div>
							</div>
						  <?php } ?>
						 


							<div class="form-control-wrap text-danger" align="center">
								<?php /*foreach ($errors as $error)
									print $error."<br />";
									if($message1!='') echo $message1; */
								?>
								<?php 
									if($message1!='') echo $message1;
								?>	
							</div>
						  </div>
						  </div>
						  

	<!---=========================Start Customer type ============================--->

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<!--------------------------------------------------------------------------->	
		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingThree">
					<h4 class="panel-title">
						<?php if(empty($_REQUEST['bid'])){ ?>
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-decoration: auto;">
						<?php }else{ ?>		
							<a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="text-decoration: auto;">
						<?php } ?>		
							<i class="more-less glyphicon glyphicon-plus"></i>
							Customer type
						</a>
					</h4>
				</div>
				<?php if(empty($_REQUEST['bid'])){ ?>
				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				<?php }else{ ?>	
				<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree" aria-expanded="true" style="">
				<?php } ?>		
					
					<div class="panel-body">		
                      <div class="form-group white-bg">
                        <div class="col-md-12">
                           
                          <div class="form-control-wrap">
                            <div class="radio">
                              <label class="radio-label">New Customer
                              <input name="custType" id="cust_type" type="radio" value="new" <?php if($parameter_id!='') { echo " $seldis";} ?> checked="checked" onChange="newCustomer(this.value);">
                              <span class="cr"><i class="cr-icon fa fa-circle"></i></span> </label>

                               <label class="radio-label">Existing Customer
                              <input name="custType" id="exist_type" type="radio" value="existing" <?php if($parameter_id!='' || $cust_para_id!='') { echo 'checked="checked"';  echo " $seldis";} ?> onclick="showAllPaymentId()">
                              <span class="cr"><i class="cr-icon fa fa-circle"></i></span> </label>
                            </div>
                           
                            <label>
                            <div id="bussdetail" <?php if($cust_para_id=='') { ?> style="display:none;" <?php }?>>
                              <input type="hidden" name="custId" id="custId">
			                    <select name="buss_detail" id="existing_id" class="form-control selectpicker show-tick custom-margin-left" onChange="selectCustomer(this.value);" data-live-search="true">
                                <option value="">------Select Customer -----</option>
                                <?php	@$select = $db->prepare("select customer_type,customer_id,business_name,customer_fname1,customer_lname1 from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where merchant_id='".$merId."' order by customer_id desc");

							$select->execute();
							
							while($rows=$select->fetch())
							
							{
								$cust_id_parameter = encryptthis($rows[customer_id], $keyy);
							?>
                           <option value="<?php echo $cust_id_parameter;?>" <?php if($parameter_id==$rows[customer_id] || $cust_para_id==$rows[customer_id]) echo 'selected="selected"'; echo $seldis; ?>>
                                <?php  if($rows[customer_type]=='Individual') { echo $rows[customer_fname1].' '.$rows[customer_lname1].' ( I-'.$rows[customer_id].' )' ; } else { echo $rows[business_name].' ( B-'.$rows[customer_id].' )' ; } ?>
                                </option>
                                <?php  }  ?>
                              </select>
                            </div>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="existing_data">
                        <div class="form-control-wrap">
                          <div class="form-group gray-bg">
                            <div class="col-md-4 col-sm-4">
                              <label class="control-label">Account Type <span style="color:red;">*</span></label>
                              <div class="form-control-wrap select-box icon11">
                                <select name="cust_bus_type" id="bustype" class="form-control" onChange="showbType(this.value);">
                                  <option value="">--Select Customer--</option>
                                  <option value="Individual" <?php if($rowc['customer_type']=='Individual'){ echo 'selected="selected"';  echo $seldis;} ?>>Individual</option>
                                  <option value="Business" <?php if($rowc['customer_type']=='Business'){ echo 'selected="selected"'; echo $seldis; }?>>Business</option>
                                </select>
                              </div>
                            </div>
        <?php 
			$subscription = $db->prepare("select sub_id,multi_merchant_package from  ".DB_EZEECHECK.".".TBL_MERCHANT_SUBSCRIPTION." where mer_id='".$_SESSION['mr_id']."'  order by sub_id desc limit 1");
			$subscription->execute();
			$subscription_row=$subscription->fetch(PDO::FETCH_ASSOC);
			if($subscription_row['multi_merchant_package']=='Yes') {
		?>
                            <div class="col-md-4 col-sm-4">
                              <label class="control-label">Company Name </label>
                            <?php  
								//$select2 = $db->prepare("select business_name,mer_user_name from  ".DB_EZEECHECK.".".TBL_MERCHANT_COMPANY." where user_id='".$_SESSION['user_id']."' and merchant_id='".$_SESSION['mr_id']."' and comp='comp' ");
                           
								$select2 = $db->prepare("select business_name,mer_user_name from  ".DB_EZEECHECK.".".TBL_MERCHANT_COMPANY." where user_id='".$_SESSION['user_id']."' and merchant_id='".$_SESSION['mr_id']."'  ");
								$select2->execute(); 
							?>
                              <div class="form-control-wrap select-box icon11">
                                <select name="comp_type" id="comp_type" class="form-control" onChange="getcompanyType(this.value)"  >
                                  <option value="">--Select Company--</option>
                                  <?php  while($rows2=$select2->fetch()) {  ?>
                                  <option value="<?php echo $rows2['business_name']; ?>" <?php if($comp_type==$rows2['business_name']) echo 'selected="selected"';  ?>>
                                  <?php if($rows2['business_name']!='') { echo $rows2['business_name']; } else { echo $rows2['mer_user_name']; } ?>
                                  </option>
                                  <?php  }  ?>
                                </select>
                              </div>
                            </div>
                            <?php }?>
                          </div>
                        </div>
                        <div class="form-group white-bg">
                          <?php if(($rowc['customer_type']== 'Individual') || ($parameter_id=='')) { ?>
                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Account Holder (1) First Name <span style="color:red;">*</span></label>
                            <div class="form-control-wrap  text-box icon15">
                              <input name="txt_acc_hol_name1" id="txt_acc_hol_name1" autocomplete="off" type="text" class="form-control required"  onKeyUp="showonCheck2('txt_acc_hol_name1','user_name','user_name2',event,this);" value="<?php echo $acName1; ?>"  <?php echo $chkRead; ?> <?php echo $chkRead; ?> <?php if($parameter_id >0)  { ?> readonly <?php } ?>  >
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4" id="cId2">
                            <label class="control-label">Account Holder (1) Last Name <span style="color:red;">*</span></label>
                            <div class="form-control-wrap text-box icon16">
                              <input name="txt_acc_hol_name2" id="txt_acc_hol_name2" autocomplete="off" type="text" class="form-control required" onKeyUp="showonCheck2('txt_acc_hol_name2','user_name','user_name2',event,this);" value="<?php echo $acName2; ?>" <?php echo $chkRead; ?> <?php echo $chkRead; ?> <?php if($parameter_id >0)  { ?> readonly <?php } ?>   >
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4" id="cId3">
                            <label class="control-label">Account Holder (2) First Name </label>
                            <div class="form-control-wrap text-box icon15">
                              <input name="txt_acc_hol_name3" id="txt_acc_hol_name3" type="text" class="form-control" onKeyUp="showonCheck2('txt_acc_hol_name3','user_name','user_name2',event,this);" value="<?php echo $acName3; ?>" <?php echo $chkRead; ?> <?php echo $chkRead; ?> <?php if($parameter_id >0)  { ?> readonly <?php } ?> >
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4" id="cId4">
                            <label class="control-label">Account Holder(2) Last Name</label>
                            <div class="form-control-wrap text-box icon16">
                              <input name="txt_acc_hol_name4" id="txt_acc_hol_name4" type="text" class="form-control" onKeyUp="showonCheck2('txt_acc_hol_name4','user_name','user_name2',event,this);" value="<?php echo $acName4; ?>" <?php echo $chkRead; ?> <?php echo $chkRead; ?> <?php if($parameter_id >0)  { ?> readonly <?php } ?>  >
                            </div>
                          </div>
                          <?php } ?>
                          <div class="col-md-4 col-sm-4" id="bId" style="<?php if($rowc['customer_type']=='Business') { echo 'display:block';} else { echo 'display:none';}?>">
                            <label class="control-label">Account Holder Business Name <span style="color:red;">*</span></label>
                            <div class="form-control-wrap text-box icon13">
                              <input name="txt_acc_hol_name" id="txt_acc_hol_name" type="text" class="form-control" onKeyUp="showonCheck2('txt_acc_hol_name','user_name','user_name2',event,this);" value="<?php echo $acName; ?>" <?php echo $chkRead;?> <?php echo chkRead; ?> <?php if($parameter_id >0)  { ?> readonly <?php } ?> >
                            </div>
                          </div>
                          <?php /*?><div class="col-md-4 col-sm-4" id="auth_sig" style="<?php if($rowc['customer_type']=='Business') { echo 'display:block';} else { echo 'display:none';} ?>"> <?php */?>
                          <div class="col-md-4 col-sm-4">
                            <label class="control-label">Authorized Signatory <span style="color:red;">*</span></label>
                            <div class="form-control-wrap text-box icon2">
                              <input name="txt_auth_sig" id="txt_auth_sig" type="text" class="form-control required" placeholder="" onKeyUp="showonCheck2('txt_auth_sig','user_name','user_name2',event,this);" value="<?php if($txt_auth_sig!='') { echo $txt_auth_sig; } else { echo $acName; }?>"  >
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4">
                            <label class="control-label">Phone </label>
                            <div class="form-control-wrap text-box icon3">
                              <input name="txt_acc_hol_phone" id="txt_acc_hol_phone" type="text" class="form-control" placeholder="(XXX) XXX-XXXX"  onKeyUp="showonCheck2('txt_acc_hol_phone','user_phone','user_phone1',event,this);"  value="<?php echo $phone;?>" <?php echo $chkRead; ?> onBlur="checkLength(this)" maxlength='14' >
                            </div>
                          </div>


                        </div>
                      </div>
                      <div class="form-group gray-bg">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-control-wrap-1">
                            <!--    <div class="checkbox">
							  <label class="checkbox-label">Email and / or
							<input name="email_check" id="email_check" type="checkbox" value="yes" <?php  if($email_chk=='yes'){ echo "checked=checked ";} echo " $seldis"; ?> onClick="ShowEmail();">
							<span class="cr"><i class="cr-icon fa fa-check" aria-hidden="true"></i></span> </label>
							</div> -->
                            <div class="checkbox">
                              <label class="checkbox-label">Address
                              <input name="add_check" id="add_check" type="checkbox" value="yes" <?php  if($add_chk=='yes'){ echo "checked=checked ";} echo " $seldis" ; ?> onClick="ShowAddress();">
                              <span class="cr"><i class="cr-icon fa fa-check" aria-hidden="true"></i></span> </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group white-bg">
                        <div class="col-md-4 col-sm-4" id="emailId" >
                          <label class="control-label">Email <span style="color:red;">*</span></label>
                          <div class="form-control-wrap text-box icon4">
                            <input name="txt_acc_hol_email" id="txt_acc_hol_email" type="email" class="form-control required" autocomplete="off" placeholder="" required="" value="<?php echo $email;?>" <?php echo $chkRead; ?>>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Currency*</span></label>
                            <div class="form-control-wrap select-box icon10">
                              <select name="currency" id="currency" class="form-control"  >
                                  <option value="">--Select Currency--</option>
                                  <option value="1" <?php if($getPyd['currency']=='1'){ echo 'selected=selected';} ?>>USD</option>
                                  <option value="2" <?php if($getPyd['currency']=='2'){ echo 'selected=selected';} ?>>CAD</option>
                                  <option value="3" <?php if($getPyd['currency']=='3'){ echo 'selected=selected';} ?>>GBP</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4" id="addId" <?php  if($add_chk!='yes'){ ?> style="display:none;" <?php } ?>>
                          <label class="control-label">Address <span style="color:red;">*</span></label>
                          <div class="form-control-wrap text-box icon5">
                            <input name="txt_acc_hol_address" id="txt_acc_hol_address" type="text" class="form-control" placeholder="" onKeyUp="showonCheck2('txt_acc_hol_address','user_address','user_address1',event,this);" value="<?php echo $address;?>" <?php echo $chkRead; ?>>
                          </div>
                        </div>
                      </div>
                      <div class="form-group gray-bg" id="add_id" <?php  if($add_chk!='yes'){ ?> style="display:none;" <?php } ?> >
						<div class="col-md-4 col-sm-6">
                          <label class="control-label">State <span style="color:red;">*</span></label>
						   <div class="form-control-wrap select-box icon7">
                          
                        <select name="txt_acc_hol_state" id="txt_acc_hol_state" class="form-control" onChange="showCity(this.value)">
						  <option value="">--Select State--</option>
						  <?php 
						$select = $db->prepare("select state_id,state_name from  ".DB_EZEECHECK.".".TBL_STATE." where country_id='1' order by state_name asc");
						$select->execute();
						while($row = $select->fetch()){ ?>
						  <option value="<?php echo $row[state_id]; ?>" <?php if($state==$row[state_name]) echo "selected='selected'"; ?>><?php echo $row[state_name]; ?></option>
						  <?php  } ?>
						</select>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                          <label class="control-label">City <span style="color:red;">*</span></label>
                          <div class="form-control-wrap select-box icon6" id="clist">
                            
						<select name="txt_city" id="txt_city" class="form-control" onChange="showCity();">
                      <option value="">--Select City--</option>
                      <?php  
				
				$select = $db->prepare("select city_id,city_name from  ".DB_EZEECHECK.".".TBL_CITY." where city_state_id='$state_id' order by city_name asc");
				$select->execute();
				while($row = $select->fetch()){ ?>
                      <option value="<?php echo $row[city_id]; ?>" <?php if($city==$row[city_name]) echo "selected='selected'"; ?>><?php echo $row[city_name]; ?></option>
                      <?php  } ?>
                    
                    </select>
                          </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                          <label class="control-label">Zip <span style="color:red;">*</span></label>
                          <div class="form-control-wrap text-box icon8">
                            <input name="txt_acc_hol_zip" id="txt_acc_hol_zip" type="text" class="form-control"  placeholder="" onKeyUp="showonCheck2('txt_acc_hol_zip','zip','zip1',event,this);" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $zip;?>" <?php echo $chkRead; ?> maxlength="6">
                          </div>
                        </div>
                      </div>
                      </div>
                 </div>
			</div>
	<!--------------------------------------------------------------------------->							  
	<!---=========================End Customer type ============================--->

	<!---====================Start Create Payment=============================--->
					<div class="form-group white-bg">
						<div class="col-md-12">
							<label class="control-label">Payment type</label>
							<div class="form-control-wrap">
							  <div class="form-group gray-bg">
								<div class="col-md-3 col-sm-3">
								  <label class="control-label">Payment Mode <span style="color:red;">*</span></label>
								  <div class="form-control-wrap select-box icon11">
								  	<?php
									  	if($_REQUEST['bid']!=''){
									  		$disablePType='';
									  	}else{
									  		$disablePType='disabled=disabled';
									  	} 
								  	?>
									<select name="payment_mode_type" id="paytype" class="form-control required" required onchange="showHideDiv(this)" <?php echo $disablePType;?>>	
									   <option value="0" <?php if($getPyd['payment_mode_type']==0){ echo 'selected=selected';} ?>>--select--</option>
									   <option value="2" <?php if($getPyd['payment_mode_type']==2){ echo 'selected=selected';} ?>  >Credit/Debit Card</option>
									   <option value="3" <?php if($getPyd['payment_mode_type']==3){ echo 'selected=selected';} ?>>E-Check</option>
									   <option value="4" <?php if($getPyd['payment_mode_type']==4){ echo 'selected=selected';} ?>>ACH</option>
									   <option value="5" <?php if($getPyd['payment_mode_type']==5){ echo 'selected=selected';} ?>>Cash</option>
									   <option value="6" <?php if($getPyd['payment_mode_type']==6){ echo 'selected=selected';} ?>>Crypto</option>
									  
									</select>
								  </div>
								</div>
								<div class="col-md-3 col-sm-3">
								  <label class="control-label">Payment Frequency <span style="color:red;">*</span></label>
								  <div class="form-control-wrap select-box icon11">
									<select name="payment_fre" id="payfre" class="form-control required" required onChange="paymentfre(this.value);" <?php echo $disablePType;?>>
									   <option value="Onetime" <?php if($getPyd['payment_fre']=='Onetime'){ echo 'selected=selected';} ?> >One Time Payment</option>
									   <option value="Recurring" <?php if($getPyd['payment_fre']=='Recurring'){ echo 'selected=selected';} ?>>Recurring Payment</option>                                
									</select>
								  </div>
								</div>
								
								<div class="col-md-3 col-sm-3">
								  <label class="control-label">Payment ID <span style="color:red;">*</span></label>
								  <?php if($_REQUEST['bid']==''){?>
								  <div class="form-control-wrap select-box icon11" id="showDisable"  >
									<select name="payment_id_type" id="payment_id_type_new" class="form-control"  onChange="getPaymentId(this.value);" <?php echo $disablePType;?>>
										<option value="" > --select--</option>
									   <option value="1" disabled=""> Existing Payment ID</option>
									   <option value="2" selected="">Create New Payment ID</option>
									</select>
								  </div>
								<?php }else{ ?>
								  <div class="form-control-wrap select-box icon11" id="hideDisable">
									<select name="payment_id_type" id="payment_id_type_new" class="form-control required" required onChange="getPaymentId(this.value);" <?php echo $disablePType;?>>.
										<option value="" > --select--</option>
									   <option value="1" > Existing Payment ID</option>
									   <option value="2" selected="">Create New Payment ID</option>
									</select>
								  </div>
								<?php } ?>  
								  <div class="" id="showPaymentId">
								  
								</div>
								</div>
								
								<div class="col-md-3 col-sm-3">
								  <label class="control-label">Payment Request Type<span style="color:red;">*</span></label>
								  <div class="form-control-wrap select-box icon11">
									<select name="paymentreqtype" id="payrequest" class="form-control required" required onChange="payreq(this.value);" <?php echo $disablePType;?>>
									   <option value="Inperson" <?php if($getPyd['paymentreqtype']=='Inperson'){ echo 'selected=selected';} ?>>In Person</option>
									   <option value="Virtual" <?php if($getPyd['paymentreqtype']=='Virtual'){ echo 'selected=selected';} ?>>Virtual</option>
									   <option value="SMS" <?php if($getPyd['paymentreqtype']=='SMS'){ echo 'selected=selected';} ?>>SMS</option>
									   <option value="Email" <?php if($getPyd['paymentreqtype']=='Email'){ echo 'selected=selected';} ?>>Email</option>
									</select>
								  </div>
								</div>
							  </div>	
							 </div>
						  </div>
						</div>
	<!---=========================End Create Payment ============================--->		
	
	<!---=========================Start Payment Mode Credit/Debit Card===========================--->
	<!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> -->
		<?php if($getPyd['payment_mode_type']==2 && $_REQUEST['bid']!=''){
					$disabled2='block';
					$disabled3='none';
					$disabled4='none';
					$disabled5='none';
					$disabled6='none';
				}else if($getPyd['payment_mode_type']==3 && $_REQUEST['bid']!=''){
					$disabled2='none';
					$disabled3='block';
					$disabled4='none';
					$disabled5='none';
					$disabled6='none';
				}else if($getPyd['payment_mode_type']==4 && $_REQUEST['bid']!=''){
					$disabled2='none';
					$disabled3='none';
					$disabled4='block';
					$disabled5='none';
					$disabled6='none';
				}else if($getPyd['payment_mode_type']==5 && $_REQUEST['bid']!=''){
					$disabled2='none';
					$disabled3='none';
					$disabled4='none';
					$disabled5='block';
					$disabled6='none';
				}else if($getPyd['payment_mode_type']==6 && $_REQUEST['bid']!=''){
					$disabled2='none';
					$disabled3='none';
					$disabled4='none';
					$disabled5='none';
					$disabled6='block';
				}else{
					$disabled2='block';
					$disabled3='block';
					$disabled4='block';
					$disabled5='block';
					$disabled6='block';
				}	
		 ?>
			<div class="panel panel-default" id="creditdebitHs" style="display: <?php echo $disabled2;?>" >
				<div class="panel-heading" role="tab" id="headingFive">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" id="ccacrodtion" aria-expanded="false" aria-controls="collapseThree" style="text-decoration: auto;">
							<i class="more-less glyphicon glyphicon-plus"></i>
							Credit Card Payment
						</a>
					</h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
					<div class="panel-body">
					<div class="form-group white-bg">
					   

                        <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Card no*</span></label>
                            <div class="form-control-wrap  text-box icon37">
                              <input name="credit_card_no" id="credit_card_no" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['credit_card_no'];?>" placeholder="xxxx xxxx xxxx xxxx"   >
                            </div>
                        </div>
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Amount*</span></label>
                            <div class="form-control-wrap  text-box icon10">
                              <input name="credit_amount" id="credit_amount" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['credit_amount'];?>"  onkeyup="calculateTax()"   >
                            </div>
                          </div>
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Expiration Date*</span></label>
                            <div class="form-control-wrap  text-box icon38">
                              <input name="credit_expiration_date" id="credit_expiration_date" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['credit_expiration_date'];?>"   >
                            </div>
                          </div>
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">CVV*</span></label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="credit_cvv" id="credit_cvv" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['credit_cvv'];?>" maxlength="3" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"   >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Name on Card *</span></label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cc_name_of_card" id="cc_name_of_card" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['cc_name_of_card'];?>"   >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Zip code  *</span></label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cc_zip_code" maxlength="6" id="cc_zip_code" autocomplete="off" type="text" class="form-control number"value="<?php echo $getPyd['cc_zip_code'];?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'   >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Tax Rate  *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cctaxrate" id="cctaxrate" maxlength="6" autocomplete="off" type="text" class="form-control" value="<?php echo $txt_rate;?>" readonly=""   >
                            </div>
                          </div>
                          <?php 
							if($getPyd['cctotalvalue']!=''){
								$cctototalvalue = $getPyd['credit_amount'] + ($getPyd['credit_amount'] * ($txt_rate/100) );
							}else{
								$cctototalvalue='';
							}
							
							?>
                           <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Total Value *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cctotalvalue" id="cctotalvalue"  autocomplete="off" type="text" class="form-control" value="<?php echo $cctototalvalue;?>" readonly=""   >
                            </div>
                          </div>
					</div>
					</div>
				</div>
			</div>
		
	<!---=========================End Payment Mode Credit/Debit Card========================--->
	<!---=========================Start Payment Mode E-Check===========================--->
	<!--================================================     ----->

	<div class="panel panel-default" id="echeckHs" style="display: <?php echo $disabled3;?>" >
				<div class="panel-heading" role="tab" id="headingFoure">
					<h4 class="panel-title">
						<a class="collapsed" id="echeckaccordion" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefoure" aria-expanded="false" aria-controls="collapseThree" style="text-decoration: auto;">
							<i class="more-less glyphicon glyphicon-plus"></i>
							E-Check
						</a>
						
					</h4>
				</div>
				<div id="collapsefoure" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFoure">
					<div class="panel-body">
						<div class="form-group white-bg">
							<div class="col-md-4 col-sm-4">
							  <label class="control-label">Check Number <span style="color:red;">*</span></label>
							  <div class="form-control-wrap text-box icon9">
								<input name="acc_check_no" id="acc_check_no" type="text" class="form-control" placeholder="" onKeyUp="showonCheck2('acc_check_no','check-number','check-number1',event,this);" value="<?php echo $chkNo;?>" <?php //echo $chkRead; ?> maxlength="6">
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-4">
							  <label class="control-label">$ Check Amount <span style="color:red;">*</span></label>
							  <div class="form-control-wrap text-box icon10">
								<!-- <input name="acc_check_amt" id="acc_check_amt" type="text" class="form-control" placeholder="0.00" onKeyUp="showonCheck2('acc_check_amt','check-amount','check-amount1',event,this);" value="<?php echo $chkAmount;?>" <?php //echo $chkRead; ?> maxlength="10"> -->

								<input name="acc_check_amt" id="acc_check_amt" type="text" class="form-control" placeholder="0.00" onKeyUp="eCheckCalculateTax()"  value="<?php echo $eccheck_totalvalue;?>" maxlength="10">
							  </div>
							</div>

							<div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Tax Rate  *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="eccheck_taxrate" id="eccheck_taxrate" maxlength="6" autocomplete="off" type="text" class="form-control" value="<?php echo $txt_rate;?>" readonly=""   >
                            </div>
                          </div>
                          <?php 
							if($chkAmount!=''){
								$eccheck_totalvalue = $chkAmount + ($chkAmount * ($txt_rate/100) );
							}else{
								$eccheck_totalvalue='';
							}
							
							?>
                           <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Total Value *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="eccheck_totalvalue" id="eccheck_totalvalue" autocomplete="off" type="text" class="form-control" readonly=""  value="<?php echo $chkAmount;?>"   >
                            </div>
                          </div>

							<div class="col-md-4 col-sm-4">
							  <label class="control-label">Memo </label>
							  <div class="form-control-wrap text-box icon11">
								<input name="acc_check_memo" id="acc_check_memo" type="text" class="form-control" placeholder="" onKeyUp="showonCheck2('acc_check_memo','check_desc','check_desc1');" value="<?php echo $memo;?>" <?php echo $chkRead; ?>>
							  </div>
							</div>
						  </div>
						  <div class="form-group gray-bg">
							
							<div class="col-md-4 col-sm-6">
							  <label class="control-label">Routing Number <span style="color:red;">*</span></label>
							  <div class="form-control-wrap text-box icon12">
								<input name="acc_routing_no" id="acc_routing_no" type="text" class="form-control required" placeholder="" onchange="checkRoutingNo(event,this);" value="<?php echo $routingNo;?>" <?php echo $chkRead; ?> maxlength="9" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57">
							  </div>
							</div>
							<div class="col-md-4 col-sm-6">
							  <label class="control-label">Account Number <span style="color:red;">*</span></label>
							  <div class="form-control-wrap text-box icon13">
								<input name="acc_no" id="acc_no" type="text" class="form-control required" placeholder=""  value="<?php echo $acNo;?>" <?php echo $chkRead; ?> maxlength="15" onKeyUp="isNumberKeyNew(event,this,'acc_no');">
							  </div>
							</div>
							<div class="col-md-4 col-sm-6">
							  <label class="control-label">Confirm Account Number <span style="color:red;">*</span></label>
							  <div class="form-control-wrap text-box icon14">
								<input name="re_acc_no" id="re_acc_no" type="text" class="form-control" placeholder="" onKeyUp="showonCheck2('acc_no','chk_acc_no','chk_acc_no1',event,this);"  value="<?php echo $acNo;?>" <?php echo $chkRead; ?> maxlength="15">
							  </div>
							</div>
						  </div>
				<?php 
				$subscription = $db->prepare("select sub_id,check_verification_package,signature_package from  ".DB_EZEECHECK.".".TBL_MERCHANT_SUBSCRIPTION." where mer_id='".$_SESSION['mr_id']."'  order by sub_id desc limit 1");
				$subscription->execute();
				$subscription_row=$subscription->fetch(PDO::FETCH_ASSOC);
				
				
				$selectfound = $db->prepare("select check_id from ".DB_EZEECHECK.".".TBL_FUND_VERIFICATION_RESPONSE." where check_id='".$parameter_id."' ");
				$selectfound->execute();	
				$valdata=$selectfound->fetch(PDO::FETCH_ASSOC);
				
				?>
						  <div class="form-group white-bg">
							<div class="col-md-12 col-sm-12 wrapp-buttons-checkboxes">
							  <div class="form-control-wrap">
								<div class="row">
								  <div class="col-md-4">
									<div class="checkbox">
									  <label class="control-label one">
									  <input name="basic_check" id="basic_check" type="checkbox" value="yes" <?php if($crow['basic_check']=='yes'){ echo 'checked="checked"'; echo " $seldis" ;}  if(($subscription_row['check_verification_package']=='Yes') || ($valdata['check_id'] >0)){  ?>  disabled   <?php }   ?>  onClick="showFundConfirm();">
									  <span class="cr"><i class="cr-icon fa fa-check" aria-hidden="true"></i></span> Basic Fund Verification</label>
									</div>
								  </div>
			   
								  <div class="col-md-4">
									<div class="checkbox">
									  <label class="control-label two">
									  <input name="fund_check" id="fund_check" type="checkbox" value="yes" <?php if($crow['fund_check']=='yes'){ echo 'checked="checked"'; echo " $seldis" ; }   if(($subscription_row['check_verification_package']!='Yes') || ($valdata['check_id'] >0)){  ?>  disabled   <?php }   ?>  onClick="showFundConfirm();" >
									  <span class="cr"><i class="cr-icon fa fa-check" aria-hidden="true"></i></span> Enhanced Check Verification <span><a class="ng-scope" href="#/" title="Learn More">?</a></span></label>
									</div>
								  </div>
				
								  <div class="col-md-4">
									<div class="checkbox">
									  <label class="control-label three">
									  <input name="sig_check" id="sig_check" type="checkbox" value="yes" <?php if(($crow['sig_check']=='yes') || ($subscription_row['signature_package']!='Yes')){ echo 'checked="checked"'; ?>  disabled <?php }  ?> onClick="showMessage();">
									  <span class="cr"><i class="cr-icon fa fa-check" aria-hidden="true"></i></span> Signature not Required <span><a class="ng-scope" href="#/" title="Learn More">?</a></span></label>
									</div>
								  </div>
								 </div>
							  </div>
							</div>
						  </div>
						  
						<?php 
						$txt_phone = $rowc['cust_contact_no'];
						$code = substr($txt_phone,0,1);
						$phone1 = substr($txt_phone,0,3);
						$phone2 = substr($txt_phone,3,4);
						$phone3 = substr($txt_phone,7,4);
						$phone ="(".$phone1.")".$phone2."-".$phone3;
						 
							$result_type = $db->prepare("select customer_type from  ".DB_EZEECHECK.".".TBL_CUSTOMER_MASTER." where customer_id=".$cust_para_id);		
							$result_type->execute();
							$rowc_type=$result_type->fetch(PDO::FETCH_ASSOC);
						  ?>
						  <div class="col-sm-12 col-md-12 check-wrapper-admin" id="chkInd" <?php if(($rowc['customer_type']== 'Business') || ($rowc_type['customer_type']== 'Business')) { ?>style="display:none" <?php } else { ?>  style="display:block"  <?php } ?> >
							<div class="check-wrapper">
							  <div class="check-image-wrapper">
								<div class="UserInfo col-sm-5 col-md-5 no-padding">
								  <ul>
									<li>
									  <input name="user_name" id="user_name" disabled type="text" value="<?php echo $rowc['customer_fname1']." ".$rowc['customer_lname1']; ?>">
									</li>
									<?php  if($rowc['customer_fname2']!=''){ ?>
									<li>
									  <input name="user_name1" id="user_name1" disabled type="text" value="<?php echo $rowc['customer_fname2']." ".$rowc['customer_lname2']; ?>">
									</li>
									<?php } ?>
									<li class="ng-scope">
									  <input name="user_email" id="user_email" disabled type="email" value="<?php echo $rowc['cust_email']?>">
									</li>
									<li>
									  <input name="user_phone" id="user_phone" disabled type="text" value="<?php if($rowc['cust_contact_no'] !='') { echo $phone;}?>">
									</li>
									<li class="ng-scope">
									  <ul>
										<li class="ng-scope">
						 <input type="text" name="user_address" id="user_address" disabled="" value="<?php echo $rowc['cust_add1']." ".$rowc['cust_add2']." ".$rowc['cust_add3']?>">
										</li>
										<li class="city-state-zip ng-scope"><span class="ng-binding ng-scope check-city" id="city_state">
										  <?php if($rowc['cust_state']!='' && $rowc['cust_city']=='') 
										  { echo $state; }
											
											else if($state!='' && $city!='')
											
											{ echo $city.",".$state; }
											
											else if($rowc['cust_state']=='' && $rowc['cust_city']!='') 
											
											{ echo $city; }										
											
											?>
										  </span> <span class="ng-binding ng-scope check-zip" style="" id="zip">
										  <?php if($rowc['cust_zip']!='') echo $zip; ?>
										  </span></li>
									  </ul>
									</li>
								  </ul>
								</div>
							<?php
								if($routingNo!='') {
								$url='https://www.routingnumbers.info/api/data.json?rn='.$routingNo;
								$ch = curl_init("$url");
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_POSTFIELDS, '');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_getinfo($ch);
								if(curl_exec($ch) === FALSE) { die("Curl failed: " . curl_error($ch));  }
								$response = curl_exec($ch);
								curl_close($ch);
								$data = json_decode($response, TRUE);
								}
								
								
							?>
								<div class="RoutingNumberInfo col-sm-4 col-md-4 no-padding">
								  <ul>
								  <?php if($parameter_id !='') { ?>
									<li>
									  <input type="text" disabled="" name="routinginfo_name" id="routinginfo_name"  value="<?php echo $data[customer_name]; ?>">
									</li>
									<?php  } else { ?>
									<li class="routinginfo">
									  <input type="text" disabled="" name="routinginfo_name" id="routinginfo_name"  value="<?php echo $data[customer_name]; ?>">
									</li>
									<?php } ?>
									<li>
									  <input type="text" disabled="" name="routinginfo_address" id="routinginfo_address"  value="<?php echo $data[address]; ?>">
									</li>
									<li>
		 <input type="text" name="routinginfo_state" disabled="" id="routinginfo_state"  value="<?php if($data[city] !='') { echo $data[city]." ".$data[state]." ".$data[zip]; } ?>">
									</li>
								  </ul>
								</div>
								<div class="CheckNumberAndDate no-padding col-sm-2 col-md-2">
								  <div class="CheckNumberDiv">
									<input type="text" name="check-number" id="check-number" class="text-center check-number" disabled="" value="<?php echo $chkNo?>">
								  </div>
								  <br>
								  <div class="EnterCheckDateDiv ng-binding">
									<input type="text" name="check-date" id="check-date" class="text-left" disabled="" value="<?php echo $chkDt;?>">
								  </div>
								</div>
								<div class="clear"></div>
								<div class="CompanyNameAndAmount no-padding col-sm-10 pull-right">
								  <div class="col-sm-9 col-md-9 no-padding">
									<input type="text" disabled="" class="companyname" value="<?php if($comp_type!='') { echo $comp_type; } else { echo $comp; } ?>" name="comp_name" id="comp_name">
								  </div>
								  <div class="col-sm-3 col-md-3 no-padding">
									<input type="text" class="check-amount" disabled="" value="<?php echo $chkAmount;?>" id="check_amount" name="check-amount" >
								  </div>
								</div>
								<div class="clear"></div>
								<div class="AmountInWords col-sm-9 col-md-9 no-padding ng-binding custom-margin-top-bottom" id="amt_word"><?php echo display_number($chkAmount); ?></div>
							<div class="custom-authorization col-sm-9 col-md-9 no-padding ng-binding"id="cust_date">Customer authorization obtained: <?php echo $chkDt;?></div>
								<div class="clear"></div>
								<div class="CheckDescription col-sm-5 col-md-5 no-padding">
								  <input type="text" class="Description" disabled="" value="<?php echo $memo;?>" name="check_desc" id="check_desc">
								</div>
								
								
								<div class="CheckSignature NotReqired col-sm-5 col-md-5 no-padding ng-scope signature-name custom-margin-top-bottom-2" id="sign22"  <?php if(($subscription_row['signature_package']=='Yes') && ($crow['sig_check']!='yes')) {  ?> style="display:block;" <?php }else { ?> style="display:none;"  <?php } ?> >
								
								<?php if($txt_auth_sig!='') { $auth_sig= $txt_auth_sig; } else { $auth_sig= $acName; } ?>
								  
								  <input name="sign2" id="sign2" type="text" disabled="" value="<?php if(($subscription_row['signature_package']=='Yes') && ($crow['sig_check']!='yes')) { echo $auth_sig; }?>">
								</div>

								
		<div class="CheckSignature NotReqired col-sm-5 col-md-5 no-padding ng-scope signature-require" id="signMsg2" <?php if(($crow['sig_check']=='yes') || ($subscription_row['signature_package']!='Yes')) {  ?> style="display:block;" <?php }else { ?> style="display:none;"  <?php } ?> ><strong>SIGNATURE NOT REQUIRED</strong>
								  <p>Payment has been authorized by the depositor.<br>
									Payee to hold you harmless for payment of this document.<br>
									This document shall be deposited only to credit of payee.<br>
									Absence of endorsement is guaranteed by payee's bank.</p>
								</div>
								<div class="clear"></div>
								<div class="CheckSecurityNumbers">
								  <div class="RoutingDiv col-sm-4 col-md-4 no-padding" style="text-align:center">
									<input type="text" class="text-center check-routing gnumicr" disabled="" value="<?php echo $routingNo;?>" name="micr_code" id="micr_code">
								  </div>
								  <div class="CheckingAccountDiv col-sm-4 col-md-4 no-padding" style="text-align:center">
									<input type="text" class="text-center checking-account gnumicr" disabled="" value="<?php echo $acNo;?>" name="chk_acc_no" id="chk_acc_no">
								  </div>
								  <div class="ConfirmAccountDiv col-sm-4 col-md-4 no-padding">
									<input type="text" class="text-center confirm-account gnumicr" disabled="" value="<?php echo $chkNo;?>" name="chk_no" id="chk_no">
								  </div>
								</div>
								<div class="sample-text">
								<p style="text-align:center;">THIS1 IS A SAMPLE CHECK&nbsp;|&nbsp;NOT FOR DEPOSIT</p>
								 </div>
								<div class="clear"></div>
							  </div>
							</div>
						  </div>
						  <div class="col-sm-12 col-md-12 check-wrapper-admin" id="chkBus" <?php if(($rowc['customer_type']== 'Business') || ($rowc_type['customer_type']== 'Business')) { ?>style="display:block" <?php } else { ?> style="display:none"  <?php } ?>>
							<div class="check-wrapper">
							  <div class="check-image-wrapper">
								<div class="UserInfo col-sm-5 col-md-5 no-padding">
								  <ul>
									<li>
									  <input name="user_name" id="user_name2" disabled type="text" value="<?php echo $bName; ?>">
									</li>
									<li class="ng-scope">
									  <input name="user_email" id="user_email1" disabled type="email" value="<?php echo $rowc['cust_email']?>">
									</li>
									<li>
									  <input name="user_phone" id="user_phone1" disabled type="text" value="<?php if($rowc['cust_contact_no'] !='') { echo $phone;}?>">
									</li>
									<li class="ng-scope">
									  <ul>
										<li class="ng-scope">
				 <input type="text" name="user_address" id="user_address1" disabled="" value="<?php echo $rowc['cust_add1']." ".$rowc['cust_add2']." ".$rowc['cust_add3']?>">
										</li>
										<li class="city-state-zip ng-scope"><span class="ng-binding ng-scope check-city" id="city_state1">
										<?php if($rowc['cust_state']!='' && $rowc['cust_city']=='') 
											{ echo $state; }
											
											else if($state!='' && $city!='')
											
											{ echo $city.",".$state; }
											
											else if($rowc['cust_state']=='' && $rowc['cust_city']!='') 
											
											{ echo $city; }										
											
											?>
										  </span> <span class="ng-binding ng-scope check-zip" style="" id="zip1">
										  <?php if($rowc['cust_zip']!='') echo $zip; ?>
										  </span></li>
									  </ul>
									</li>
								  </ul>
								</div>
								<?php
								if($routingNo!='') {
								$url='https://www.routingnumbers.info/api/data.json?rn='.$routingNo;
								$ch = curl_init("$url");
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_POSTFIELDS, '');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_getinfo($ch);
								if(curl_exec($ch) === FALSE) { die("Curl failed: " . curl_error($ch));  }
								$response = curl_exec($ch);
								curl_close($ch);
								$data = json_decode($response, TRUE);
								}
								?>
								<div class="RoutingNumberInfo col-sm-4 col-md-4 no-padding">
								  <ul>
									<li>
									  <input type="text" name="routinginfo_name" id="routinginfo_name1"  value="<?php echo $data[customer_name]; ?>">
									</li>
									<li>
									  <input type="text" name="routinginfo_address" id="routinginfo_address1" value="<?php echo $data[address]; ?>">
									</li>
									<li>
	   <input type="text" name="routinginfo_state" id="routinginfo_state1"  value="<?php if($data[city] !='') { echo $data[city]." ".$data[state]." ".$data[zip]; } ?>">
									</li>
								  </ul>
								</div>
								<div class="CheckNumberAndDate no-padding col-sm-2 col-md-2">
								  <div class="CheckNumberDiv">
									<input type="text" name="check-number" id="check-number1" class="text-center check-number" disabled="" value="<?php echo $chkNo?>">
								  </div>
								  <br>
								  <div class="EnterCheckDateDiv ng-binding">
									<input type="text" name="check-date" id="check-date" class="text-left" disabled="" value="<?php echo $chkDt;?>">
								  </div>
								</div>
								<div class="clear"></div>
								<div class="CompanyNameAndAmount no-padding col-sm-10 pull-right">
								  <div class="col-sm-9 col-md-9 no-padding">
									<input type="text" class="companyname" disabled="" value="<?php if($comp_type!='') { echo $comp_type; } else { echo $comp; }; ?>" name="comp_name" id="comp_name1">
									
									
								  </div>
								  <div class="col-sm-3 col-md-3 no-padding">
									<!--  <input type="text" class="check-amount" disabled="" value="<?php echo $chkAmount;?> 11111" id="check-amount1" name="check-amount">  -->

									<input name="check-amount" id="acc_check_amt_busness" type="text" class="form-control check-amount" placeholder="0.00"  value="<?php echo $chkAmount;?>" maxlength="10" style="padding-bottom: 26px;">

								  </div>
								</div>
								<div class="clear"></div>
								<div class="AmountInWords col-sm-9 col-md-9 no-padding ng-binding custom-margin-top-bottom" id="amt_word1"><?php echo display_number($chkAmount); ?></div>
							<div class="custom-authorization col-sm-9 col-md-9 no-padding ng-binding"id="cust_date">Customer authorization obtained: <?php echo $chkDt;?></div>
								<div class="clear"></div>
								<div class="CheckDescription col-sm-5 col-md-5 no-padding">
								  <input type="text" class="Description" disabled="" value="<?php echo $memo;?>" name="check_desc" id="check_desc1">
								</div>
							 <!--   <div class="CheckSignature NotReqired col-sm-5 col-md-5 no-padding ng-scope signature-name custom-margin-top-bottom-2" <?php if(($subscription_row['signature_package']=='Yes') && ($crow['sig_check']!='yes')) {  ?> style="display:block;" <?php }else { ?> style="display:none;"  <?php } ?> >-->
								
								<div class="CheckSignature NotReqired col-sm-5 col-md-5 no-padding ng-scope custom-margin-top-bottom-3" id="sign11" <?php if(($subscription_row['signature_package']=='Yes') && ($crow['sig_check']!='yes')) {  ?> style="display:block;" <?php }else { ?> style="display:none;"  <?php } ?> >
								<?php if($txt_auth_sig!='') { $auth_sig= $txt_auth_sig; } else { $auth_sig= $acName; } ?>
							   
								  <input name="sign1" id="sign1" type="text" value="<?php if(($subscription_row['signature_package']=='Yes') && ($crow['sig_check']!='yes')) { echo $auth_sig; }?>">
								</div>
								
								
								
								<div class="CheckSignature NotReqired col-sm-5 col-md-5 no-padding ng-scope signature-require" id="signMsg1" <?php if(($crow['sig_check']=='yes') || ($subscription_row['signature_package']!='Yes')) {  ?> style="display:block;" <?php  }else { ?> style="display:none;"  <?php } ?>><strong>SIGNATURE NOT REQUIRED</strong>
								  <p>Payment has been authorized by the depositor.<br>
									Payee to hold you harmless for payment of this document.<br>
									This document shall be deposited only to credit of payee.<br>
									Absence of endorsement is guaranteed by payee's bank.</p>
								</div>
								<div class="clear"></div>
								<div class="CheckSecurityNumbers">
								  <div class="RoutingDiv col-sm-4 col-md-4 no-padding" style="text-align:center">
									<input type="text" class="text-center check-routing gnumicr" disabled="" value="<?php echo $routingNo;?>" name="micr_code" id="micr_code1">
								  </div>
								  <div class="CheckingAccountDiv col-sm-4 col-md-4 no-padding" style="text-align:center">
									<input type="text" class="text-center checking-account gnumicr" disabled="" value="<?php echo $acNo;?>" name="chk_acc_no" id="chk_acc_no1">
								  </div>
								  <div class="ConfirmAccountDiv col-sm-4 col-md-4 no-padding">
									<input type="text" class="text-center confirm-account gnumicr" disabled="" value="<?php echo $chkNo;?>" name="chk_no" id="chk_no1">
								  </div>
								</div>
								<div class="sample-text">
								<p style="text-align:center;">THIS IS A SAMPLE CHECK&nbsp;|&nbsp;NOT FOR DEPOSIT</p>
								 </div>
								<div class="clear"></div>
							  </div>
							</div>
						  </div>
						  <?php /* ?> <div class="button-row">
			<?php if(($chkstatus!='Final') || ($parameter_id=='')) { 
			$cur_date=date("Y-m-d");		
			$select2 = $db->prepare("select used_checks,total_checks from  ".DB_EZEECHECK.".".TBL_MERCHANT_AVAIL_PACKAGE." where mer_id='".$_SESSION['mr_id']."' and status='active' and sub_id in(select sub_id from ".DB_EZEECHECK.".".TBL_MERCHANT_SUBSCRIPTION." where sub_end_date >='".$cur_date."' )");
			$select2->execute();
			$pRow2=$select2->fetch(PDO::FETCH_ASSOC);
			$used_checks=$pRow2['used_checks'];
			if($pRow2['total_checks']>$used_checks) {
			
			?>
							<input name="Draft" value="Draft Check" class="button black" type="submit" onClick="return chkData();" />
						
							<input name="Create" value="Generate Check" class="button black" type="submit" id="createChk" onClick="return chkData();" />
							<?php if($parameter_id=='') { ?>
							<input name="" value="Cancel" class="button black" type="button" onClick="clearForm(form);">
							<?php } else { ?>
							<input name="" value="Cancel" class="button black" type="button" onClick="window.location='enter_check_list.php'">
							<?php } ?>
							<?php } else { ?>
							
							<a class="button black" style="padding: 10px 20px; !important" href="signup_update.php#parentHorizontalTab3" >Upgrade Package <i class="fa fa-level-up" aria-hidden="true"></i>
	</a>
			<?php } 
					}  elseif($chkstatus=='Final') { ?>
					
					 <input name="Create" value="Generate Check" class="button black" type="submit" id="createChk" onClick="return chkData();" />
					
					<?php } ?>
							
						  </div> <?php */ ?>
					</div>
				</div>
			</div>

	<!--================================================     ----->
	<!---=========================End Payment Mode E-Check========================--->

	<!---=========================Start Payment Mode ACH===========================--->
			<div class="panel panel-default" id="achHs" style="display: <?php echo $disabled4;?>" >
				<div class="panel-heading" role="tab" id="headingThreeAch">
					<h4 class="panel-title">
						<a class="collapsed" id="accordion4" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThreeAch" aria-expanded="false" aria-controls="collapseThreeAch" style="text-decoration: auto;">
							<i class="more-less glyphicon glyphicon-plus"></i>
							ACH Payment
						</a>
					</h4>
				</div>
				<div id="collapseThreeAch" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeAch">
					<div class="panel-body">
					<div class="form-group white-bg">
					<div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Routing No*</span></label>
                            <div class="form-control-wrap  text-box icon12">
                              <input name="ach_payment_routing" id="ach_payment_routing" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['ach_payment_routing'];?>"  onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="9" >
                            </div>
                          </div>
						<div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Account No*</span></label>
                            <div class="form-control-wrap  text-box icon15">
                              <input name="ach_payment_account" id="ach_payment_account" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['ach_payment_account'];?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"   >
                            </div>
                          </div>
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Amount*</span></label>
                            <div class="form-control-wrap  text-box icon10">
                              <input name="ach_payment_amount" id="ach_payment_amount" autocomplete="off" type="text" class="form-control" value="<?php echo $getPyd['ach_payment_amount'];?>" onkeyup="aChPayMentCalculateTax()"  >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Tax Rate  *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="achptaxrate" id="achptaxrate" maxlength="6" autocomplete="off" type="text" class="form-control" value="<?php echo $txt_rate;?>" readonly=""   >
                            </div>
                          </div>
                          <?php 
							if($getPyd['achptotalvalue']!=''){
								$achtotalvalue = $getPyd['ach_payment_amount'] + ($getPyd['ach_payment_amount'] * ($txt_rate/100) );
							}else{
								$achtotalvalue='';
							}
							
							?>
                           <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Total Value *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="achptotalvalue" id="achptotalvalue"  autocomplete="off" type="text" class="form-control" readonly=""
                               value="<?php echo $achtotalvalue;?>"  >
                            </div>
                          </div>
					</div>
					</div>
				</div>
			</div>

	<!---=========================End Payment Mode ACH========================--->
	<!---=========================Start Payment Mode Cash========================--->
	<div class="panel panel-default" id="cashHs" style="display: <?php echo $disabled5;?>" >
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" id="accordion5" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: auto;">
							<i class="more-less glyphicon glyphicon-plus"></i>
							Cash Payment
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
					<div class="form-group white-bg">
					    <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Invoice/Voucher No*</span></label>
                            <div class="form-control-wrap  text-box icon11">
                              <input name="cash_invoice" id="cash_invoice" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['cash_invoice'];?>"   >
                            </div>
                          </div>
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Amount*</span></label>
                            <div class="form-control-wrap  text-box icon10">
                              <input name="cash_amount" id="cash_amount" autocomplete="off" type="text" class="form-control" value="<?php echo $getPyd['cash_amount'];?>" onkeyup="cashPayMentCalculateTax()"   >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Tax Rate  *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cash_p_taxrate" id="cash_p_taxrate" maxlength="6" autocomplete="off" type="text" class="form-control" value="<?php echo $txt_rate;?>" readonly=""   >
                            </div>
                          </div>
                          <?php 
							if($getPyd['cash_p_totalvalue']!=''){
								$cashtotalvalue = $getPyd['cash_amount'] + ($getPyd['cash_amount'] * ($txt_rate/100) );
							}else{
								$cashtotalvalue='';
							}
							
							?>
                           <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Total Value *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="cash_p_totalvalue" id="cash_p_totalvalue"  autocomplete="off" type="text" class="form-control"  readonly=""  value="<?php echo $cashtotalvalue;?>"  >
                            </div>
                          </div>

					</div>
					</div>
				</div>
			</div>
	<!---=========================End Payment Mode Cash========================--->
	<!---=========================Start Crypto Payment Accordion ==========--->
	<div class="panel panel-default" id="cryptoHs" style="display: <?php echo $disabled6;?>" >
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a role="button" id="accordion6" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: auto;">
							<i class="more-less glyphicon glyphicon-plus"></i>
							Crypto Payment 
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
					<div class="form-group white-bg">
						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Amount*</span></label>
                            <div class="form-control-wrap  text-box icon10">
                              <input name="crypto_amount" id="crypto_amount" autocomplete="off" type="text" class="form-control" value="<?php echo $getPyd['crypto_amount'];?>" onkeyup="crypToPayMentCalculateTax()"  >
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Tax Rate  *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="crypto_taxrate" id="crypto_taxrate" maxlength="6" autocomplete="off" type="text" class="form-control" value="<?php echo $txt_rate;?>" readonly=""   >
                            </div>
                          </div>
                          <?php 
							if($getPyd['crypto_totalvalue']!=''){
								$cryptototalvalue = $getPyd['crypto_amount'] + ($getPyd['crypto_amount'] * ($txt_rate/100) );
							}else{
								$cryptototalvalue='';
							}
							
							?>
                           <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label">Total Value *</label>
                            <div class="form-control-wrap  text-box icon39">
                              <input name="crypto_totalvalue" id="crypto_totalvalue" autocomplete="off" type="text" class="form-control"  readonly="" value="<?php echo $cryptototalvalue;?>"   >
                            </div>
                          </div>

						  <div class="col-md-4 col-sm-4" id="cId1">
                            <label class="control-label"><span style="color:red;">Expiration Date*</span></label>
                            <div class="form-control-wrap  text-box icon38">
                              <input name="crypto_exp_date" id="crypto_exp" autocomplete="off" type="text" class="form-control"value="<?php echo $getPyd['crypto_exp_date'];?>"   >
                            </div>
                          </div>
					</div>
					</div>
				</div>
			</div>


	<!---=========End Payment Mode Crypto Payment Accordion========================--->
						  
						  
				 
						
			</div>
			</div>
			

		  </form>
		</div>
	  </div>
				  
	  </div>
	</div>
	</div>


	<style>
	.labelerror
	{
	color: #ff0000;
	font-weight: bold;
	}

	/*******************************
	* Does not work properly if "in" is added after "collapse".
	* Get free snippets on bootpen.com
	*******************************/
		.panel-group .panel {
			border-radius: 0;
			box-shadow: none;
			border-color: #EEEEEE;
		}

		.panel-default > .panel-heading {
			padding: 0;
			border-radius: 0;
			color: #212121;
			background-color: #FAFAFA;
			border-color: #EEEEEE;
		}

		.panel-title {
			font-size: 14px;
		}

		.panel-title > a {
			display: block;
			padding: 15px;
			text-decoration: none;
		}

		.more-less {
			float: left;
			color: #212121;
			margin-right: 2%;
		}

		.panel-default > .panel-heading + .panel-collapse > .panel-body {
			border-top-color: #EEEEEE;
		}

	/* ----- v CAN BE DELETED v ----- */
	body {
		background-color: #26a69a;
	}

	.demo {
		padding-top: 60px;
		padding-bottom: 60px;
	}
	.accordion .card-header:after {
		font-family: 'FontAwesome';  
		content: "\f068";
		float: left; 
	}
	.more-less .glyphicon .glyphicon-plus:after {
		/* symbol for "collapsed" panels */
		content: "\f067"; 
	}
	</style>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	
	</div>
	<footer class="footer">
	  <div class="container">
		  <?php include("footer.php")  ?>
	  </div>
	</footer>
	</div>
	<?php  include("../includes/ez_js/custom_js.php");  ?>

	</div>
	</div>

	<div id="light">
	  <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
	  <video id="VisaChipCardVideo" width="600" controls autostart="0">
		  <source src="<?php echo LINK_URL_HOME;?>video/Create-manage-check.mp4" type="video/webm">
		</video>
	</div>

	<div id="fade"></div>

	</body>
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/jquery.mobile-menu.min.js"></script>
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/custom.js"></script>
	


	<!--<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/bootstrap.min.js"></script>-->



	<script type="text/javascript">

		jQuery(window).on('load',function(){

			jQuery('#myModal').modal('show');

			setTimeout(function() {

		$('#myModal').modal('hide');

	}, 5000); 

		});

	</script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo LINK_URL_HOME;?>js/jquery.validate.min.js"></script>

<?php if(empty($_REQUEST['cust_bus_type'])){ ?>
<script type="text/javascript">
        $(document).ready(function()
        {
        	
          $("#frm_signup").validate({ })
        
        });
      </script>
<?php }?>
	<script>

	function ajaxFunction(str)
	{ 
	var httpxml;
	try
	  {
	  // Firefox, Opera 8.0+, Safari
	  httpxml=new XMLHttpRequest();
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
		{
		httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
	  catch (e)
		{
		try
		  {
		  httpxml=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		catch (e)
		  {
		  alert("Your browser does not support AJAX!");
		  return false;
		  }
		}
	  }
	function stateChanged() 
		{
		if(httpxml.readyState==4)
		  {
			  //alert(httpxml.responseText);
	document.getElementById("dataId").innerHTML=httpxml.responseText;
	document.getElementById("msg").style.display='none';

		  }
		}
		var url="check_search_ajax.php";
		

	url=url+"?txt="+str;
	httpxml.onreadystatechange=stateChanged;
	//alert(url);
	httpxml.open("GET",url,true);
	httpxml.send(null);
	document.getElementById("msg").innerHTML="Please Wait ...";
	document.getElementById("msg").style.display='inline';

	  }

	  function showMessage()

		{  

			if(document.getElementById('sig_check').checked==true)

			{

			document.getElementById('sign1').style.display="none";
			document.getElementById('sign11').style.display="none";

			document.getElementById('signMsg1').style.display="block";

			document.getElementById('sign2').style.display="none";
			document.getElementById('sign22').style.display="none";

			document.getElementById('signMsg2').style.display="block";		 

			}

			else{

			document.getElementById('sign1').style.display="block";
			document.getElementById('sign11').style.display="block";

			document.getElementById('signMsg1').style.display="none";

			document.getElementById('sign2').style.display="block";
			document.getElementById('sign22').style.display="block";

			document.getElementById('signMsg2').style.display="none";			 

			}

		}
		function ShowAddress()
		{  

		if(document.getElementById('add_check').checked==true)

		{

		document.getElementById('addId').style.display="block";

		document.getElementById('add_id').style.display="block";

		}

		else

		{ 

		document.getElementById('addId').style.display="none";

		document.getElementById('add_id').style.display="none";



		}

		}
	</script>
	<script>

	<?php  if($parameter_id=='') { ?>  

	jQuery(document).ready(function(){		

	jQuery('label input[type=checkbox]').click(function() {

	jQuery('label:has(input:checked)').addClass('active');

	jQuery('label:has(input:not(:checked))').removeClass('active');

	});

	});

	<?php } ?>

	</script>
	<script type="text/javascript" language="javascript" class="init">

	$(document).ready(function(){ 

	$("#txt_dob").datepicker({

	changeYear: true,

	changeMonth: true,

	showWeek: true,

	dateFormat: "mm-dd-yy",

	});

	});

	function ShowEmail()

	{

	if(document.getElementById('email_check').checked==true)

	{

	document.getElementById('emailId').style.display="block";

	}

	else

	{

	document.getElementById('emailId').style.display="none";

	}

	}



	 




	function DeleteRecords(id)

	{

	var con = window.confirm("Are you sure want to delete this check?");

	if(con==true) {

	$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/delete_records.php?cid="+id+"&type=check",

	function(data) {

	document.getElementById("dataId").innerHTML=data;

	document.getElementById("msgId").innerHTML="Check deleted successfully";

	}

	);

	}		

	}  

	function chkVerify()

	{



	var checkboxesChecked = [];

	var idChecked = [];

	var x = document.getElementsByName("check_status[]");

	var y = document.getElementsByName("did[]");

	var i;



	for (i = 0; i < x.length; i++) {

	if(x[i].checked == true){

	checkboxesChecked.push('Draft');

	idChecked.push(y[i].value);

	}

	else

	{

	checkboxesChecked.push('');

	idChecked.push(y[i].value);

	}



	}



	//alert(checkboxesChecked);

	//alert(idChecked);

	$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/purge_check.php?cid="+checkboxesChecked+"&id="+idChecked+"&uid="+<?php echo $_SESSION['user_id'] ?>,

	function(data) {

	//alert(data);

	document.getElementById("dataId").innerHTML=data;

	document.getElementById("msgId").innerHTML='Check has been restored';

	}

	);

	}



	function alphanumericsonly(ob) 

	{

	var invalidChars = /([^a-z0-9])/gi

	if(invalidChars.test(ob.value)) 

	{

	ob.value = ob.value.replace(invalidChars,"");

	}

	}



	/*$('#txt_acc_hol_name1').keyup(function(){

	//alphanumericsonly(this);

	});*/



	/*$('#txt_acc_hol_name2').keyup(function(){

	//alphanumericsonly(this);

	});*/

	/*$('#txt_acc_hol_name3').keyup(function()

	{

	alphanumericsonly(this);

	});*/

	/*$('#txt_acc_hol_name4').keyup(function()

	{

	alphanumericsonly(this);

	});*/



	function checkLength(el) {

	if (el.value.length != 14) {

	alert("length must be exactly 14 characters")

	}

	}

	function getcompanyType(str)
	{

		$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/comapanyName.php?q=" +str,
				function(data) {

					$("#comp_name").val(data);
					$("#comp_name1").val(data);
				}
			);	
	}

	function getcheckStatus(valu,id)
	{
		$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/comapanyName.php?q="+valu+"&id="+id,

				function(data) {
					$("#checkstatusnew__"+id).html(data);
					$("#checkstatusnew__"+id).delay(3600).fadeOut(1500);
				}

			);	
	}

	</script>
	<?php  include("enter-check-js-new.php");  ?>

	<script>
	$(window).resize(function() {
	var height = $(window).height() -192; 
	$(".page-wrapper").css("min-height", height);
	});
	$(window).trigger('resize');
	</script>

	 <script type="text/javascript">
		   window.document.onkeydown = function(e) {
	  if (!e) {
		e = event;
	  }
	  if (e.keyCode == 27) {
		lightbox_close();
	  }
	}

	function lightbox_open() {
	  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
	  window.scrollTo(0, 0);
	  document.getElementById('light').style.display = 'block';
	  document.getElementById('fade').style.display = 'block';
	  lightBoxVideo.pause();
	}

	function lightbox_close() {
	  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
	  document.getElementById('light').style.display = 'none';
	  document.getElementById('fade').style.display = 'none';
	  lightBoxVideo.pause();
	}
		</script>
	<!--<script>
	//
	$(document).ready(function(){
			$("select").change(function(){
				$( "select option:selected").each(function(){
					if($(this).attr("value")=="creadt-debit-card"){
						$(".payment").hide();
						$(".credit-card").show();
					}
					if($(this).attr("value")=="ECheck"){
						$(".payment").hide();
						$(".echeck").show();
					}
					if($(this).attr("value")=="ACH"){
						$(".payment").hide();
						$(".ach").show();
					}
					if($(this).attr("value")=="Cash"){
						$(".payment").hide();
						$(".cash").show();
					}
					if($(this).attr("value")=="Crypto"){
						$(".payment").hide();
						$(".crypto").show();
					}
				});
			}).change();
		});
	</script> --->
	

<script type="text/javascript">
	function showHideDiv(select){
	   if(select.value==0){
		    document.getElementById('creditdebitHs').style.display = "block";
		    document.getElementById('echeckHs').style.display = "block";
		    document.getElementById('achHs').style.display = "block";
		    document.getElementById('cashHs').style.display = "block";
		    document.getElementById('cryptoHs').style.display = "block";
	   } else if(select.value==2){
	    	document.getElementById('creditdebitHs').style.display = "block";
		    document.getElementById('echeckHs').style.display = "none";
		    document.getElementById('achHs').style.display = "none";
		    document.getElementById('cashHs').style.display = "none";
		    document.getElementById('cryptoHs').style.display = "none";

		     $("#ccacrodtion").attr("class", "");
		     $("#ccacrodtion").attr("aria-expanded", "true");
		     $("#collapseFive").attr("class", "in");
		     $("#collapseFive").attr("aria-expanded", "true");
	   }else if(select.value==3){
	    	document.getElementById('creditdebitHs').style.display = "none";
		    document.getElementById('echeckHs').style.display = "block";
		    document.getElementById('achHs').style.display = "none";
		    document.getElementById('cashHs').style.display = "none";
		    document.getElementById('cryptoHs').style.display = "none";

		    $("#echeckaccordion").attr("class", "");
		    $("#echeckaccordion").attr("aria-expanded", "true");
		    $("#collapsefoure").attr("class", "in");
		    $("#collapsefoure").attr("aria-expanded", "true");

	   }else if(select.value==4){
	    	document.getElementById('creditdebitHs').style.display = "none";
		    document.getElementById('echeckHs').style.display = "none";
		    document.getElementById('achHs').style.display = "block";
		    document.getElementById('cashHs').style.display = "none";
		    document.getElementById('cryptoHs').style.display = "none";
		    $("#accordion4").attr("class", "");
		    $("#accordion4").attr("aria-expanded", "true");
		    $("#collapseThreeAch").attr("class", "in");
		    $("#collapseThreeAch").attr("aria-expanded", "true");
	   }else if(select.value==5){
	    	document.getElementById('creditdebitHs').style.display = "none";
		    document.getElementById('echeckHs').style.display = "none";
		    document.getElementById('achHs').style.display = "none";
		    document.getElementById('cashHs').style.display = "block";
		    document.getElementById('cryptoHs').style.display = "none";
		    $("#accordion5").attr("class", "");
		    $("#accordion5").attr("aria-expanded", "true");
		    $("#collapseTwo").attr("class", "in");
		    $("#collapseTwo").attr("aria-expanded", "true");
	   }else if(select.value==6){
	    	document.getElementById('creditdebitHs').style.display = "none";
		    document.getElementById('echeckHs').style.display = "none";
		    document.getElementById('achHs').style.display = "none";
		    document.getElementById('cashHs').style.display = "none";
		    document.getElementById('cryptoHs').style.display = "block";
		    $("#accordion6").attr("class", "");
		    $("#accordion6").attr("aria-expanded", "true");
		    $("#collapseOne").attr("class", "in");
		    $("#collapseOne").attr("aria-expanded", "true");
	   }
	} 

function getPaymentId(val){
	
		var cId=$("#existing_id").val();
		//var pId=$("#payment_id_type").val();
		var pId=$("#payment_id_type_new").val();
		//alert(cId);
		$("#showPaymentId").html('');
		
	 		$.ajax({
	 		
	 			url:"findPaymentId.php?cId="+cId+"&pId="+pId,
	 			type: 'get',
	 			
	   			cache: false, 
	 			success:function(result){
	 				$("#showPaymentId").html(result);
	 			}
	 		});
	 }	
</script>


<script type="text/javascript">
    
/*function disabledPaymentId(){
  document.getElementById('showDisable').style.display ='block';
  document.getElementById('hideDisable').style.display = 'none';
}
function showAllPaymentId(){
  document.getElementById('hideDisable').style.display = 'block';
  document.getElementById('showDisable').style.display = 'none';
}*/

$(document).ready(function(){ 
	

    $("#credit_expiration_date").datepicker({
        dateFormat: 'mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: -1,
        maxDate: "+1000M",
        yearRange: "-0:+100",

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm/y', new Date(year, month, 1)));
        }
    });

    $("#credit_expiration_date").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

$("#crypto_exp").datepicker({
        dateFormat: 'mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: -1,
        maxDate: "+1000M",
        yearRange: "-0:+100",

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm/y', new Date(year, month, 1)));
        }
    });

    $("#crypto_exp").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });


	 /*$("#crypto_exp").datepicker({
		changeYear: true,
		changeMonth: true,
		showWeek: true,
		dateFormat: "mm-dd-yy"
	})*/
});



        
</script>
	
 <script type="text/javascript">
    $(function () {
        $("#txt_acc_hol_email").keyup(function () {
            //Reference the Button.
            var paytype = $("#paytype");
            var payfre = $("#payfre");
            var payment_id_type_new = $("#payment_id_type_new");
            var payrequest = $("#payrequest");
 
            //Verify the TextBox value.
            if ($(this).val().trim() != "") {
                //Enable the TextBox when TextBox has value.
                paytype.removeAttr("disabled");
                payfre.removeAttr("disabled");
                payment_id_type_new.removeAttr("disabled");
                payrequest.removeAttr("disabled");
            } else {
                //Disable the TextBox when TextBox is empty.
                paytype.attr("disabled", "disabled");
                payfre.attr("disabled", "disabled");
                payment_id_type_new.attr("disabled", "disabled");
                payrequest.attr("disabled", "disabled");
            }
        });
    });


function calculateTax() {
  var price = $("#credit_amount").val() * 1;
  var taxRate = $("#cctaxrate").val();
  var calculateTax = price + (price * (taxRate/100) );    
  var total = calculateTax;
 
  document.frm_signup.cctotalvalue.value = total.toFixed(2);
  return taxRate;
}

function eCheckCalculateTax() {
  var price = $("#acc_check_amt").val() * 1;
  var taxRate = $("#eccheck_taxrate").val();
  var calculateTax = price + (price * (taxRate/100) );    
  var total = calculateTax;
 

  document.frm_signup.eccheck_totalvalue.value = total.toFixed(2);
  document.frm_signup.check_amount.value = total.toFixed(2);
  document.frm_signup.acc_check_amt_busness.value = total.toFixed(2);
var totalValue=document.frm_signup.eccheck_totalvalue.value = total.toFixed(2);
 //alert(totalValue);

		$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/convert_words.php?id=" + totalValue,
		function(data) {
			//alert(data);
			document.getElementById('amt_word').innerHTML =data;
		}
		);
		$.get( "<?php echo LINK_URL_HOME;?>includes/ez_js/convert_words.php?id=" + totalValue,
		function(data) {
			//alert(data);
			document.getElementById('amt_word1').innerHTML =data;
		}
		);

  return taxRate;
}

function aChPayMentCalculateTax() {
  var price = $("#ach_payment_amount").val() * 1;
  var taxRate = $("#achptaxrate").val();
  var calculateTax = price + (price * (taxRate/100) );    
  var total = calculateTax;
 
  document.frm_signup.achptotalvalue.value = total.toFixed(2);
  return taxRate;
}

function cashPayMentCalculateTax() {
  var price = $("#cash_amount").val() * 1;
  var taxRate = $("#cash_p_taxrate").val();
  var calculateTax = price + (price * (taxRate/100) );    
  var total = calculateTax;
 
  document.frm_signup.cash_p_totalvalue.value = total.toFixed(2);
  return taxRate;
}

function crypToPayMentCalculateTax() {
  var price = $("#crypto_amount").val() * 1;
  var taxRate = $("#crypto_taxrate").val();
  var calculateTax = price + (price * (taxRate/100) );    
  var total = calculateTax;
 
  document.frm_signup.crypto_totalvalue.value = total.toFixed(2);
  return taxRate;
}


</script>

 <script type="text/javascript">
    $(function () {
        $("#cc_name_of_card").keypress(function (e) {
            var keyCode = e.keyCode || e.which; 
            $("#lblError").html(""); 
            //Regex for Valid Characters i.e. Alphabets and Numbers.
            var regex = /^[A-Za-z0-9]+$/; 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Alphabets and Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script>
<script>
   function toggleIcon(e) {   	
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
	</html>