<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;
$utype = $_POST['utype'];
 if($utype == 'request'){
 $simid = $_POST['simid'];
 $simtit = get_the_title($simid);
 $uid = $_POST['uid'];
 $simurl = home_url().'/dashboard/';
  $ureq =  get_post_meta( $simid, 'ureq', true );
  $ureq = explode(",",$ureq);
   $postauth = get_post_field( 'post_author', $simid );
   //echo "$postauth";
 $ureq = array_filter($ureq);
 if(in_array($uid, $ureq)){
  echo "Already Present";
 }
 else{

  array_push($ureq, $uid);
  $ureq = implode(",",$ureq);
  update_post_meta( $simid, 'ureq',  $ureq  );
  $user = get_userdata($postauth);
  $userid =  $user->ID;
  $rall = get_the_author_meta( 'uemailra', $userid );
  if($rall != 'unset'){
  $user_email =  $user->user_email;
   $subject = "Sim access request";
    $body = "
              <p>Hi, a user has requested access to your sim  '".$simtit."' </p></br></br>
              <p><a href='".$simurl."'>Click here to approve the request</a></p></br></br>
              <p>Regards,</p></br>
              <p>Sim Share</p></br>
             ";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($user_email, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
  }
 }
}

if($utype == 'download'){
 $simid = $_POST['simid'];
 $uid = $_POST['uid'];
 $did = $_POST['did'];
 $ddate = date("d/m/Y");
 $de = $simid.':'.$did.':'.$ddate ;
  $dtrack =  get_the_author_meta(  'dtrack', $uid );
 $postauth = get_post_field( 'post_author', $simid );
  $dtrack = explode(",",$dtrack);
 $dtrack = array_filter($dtrack);
 if(in_array($de, $dtrack)){
  echo "Already Present";
 }
 else{

  array_push($dtrack, $de);
  $dtrack = implode(",",$dtrack);
     update_user_meta( $uid, 'dtrack',  $dtrack  );
  //update_post_meta( $simid, 'dtrack',  $dtrack  );
     $user = get_userdata($postauth);
  $user_email =  $user->user_email;
  $userid =  $user->ID;
  $uall = get_the_author_meta( 'uemailda', $userid );
  if($uall != 'unset'){
  $user_full_name = $user->user_firstname . $user->user_lastname;
  $subject = "Sim downloaded";
    $body = '
              <p>Hi, your sim has been downloaded by '.$user_full_name.' </p></br></br>
             
              <p>Regards,</p></br>
              <p>Sim Share</p></br>
             ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($user_email, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
  }
  echo 'Updated';
 }
}

if($utype == 'delete'){
 $simid = $_POST['simid'];
 wp_delete_post( $simid);
 echo 'deleted';
 
}

if($utype == 'emaild' ){
 $uid = $_POST['cid'];
 $uallow = $_POST['uallow'];
  update_user_meta( $uid, 'uemailda',  $_POST['uallow']  );
 echo $uallow;
 
}
if($utype == 'requestse'){
 $uid = $_POST['cid'];
 $uallow = $_POST['uallow'];
  update_user_meta( $uid, 'uemailra',  $_POST['uallow']  );
 echo $uallow;
 
}


if($utype == 'sub'){
  $alt = $_POST['alt'];
  if($alt == 'allow'){
 $simid = $_POST['simid'];
 $uid = $_POST['uid'];
 $simurl = home_url().'/sim-details/?simid='.$simid;
 $simtit = get_the_title($simid);
  $ureq =  get_post_meta( $simid, 'ureq', true );
  $ureq = explode(",",$ureq);
 $ureq = array_filter($ureq);
 if(in_array($uid, $ureq)){
  echo "Already Present";
 }
 if (($key = array_search($uid, $ureq)) !== false) {
    unset($ureq[$key]);
   $ureq = implode(",",$ureq);
   update_post_meta( $simid, 'ureq',  $ureq  );
}

$ureqa =  get_post_meta( $simid, 'ureqa', true );
  $ureqa = explode(",",$ureqa);
 $ureqa = array_filter($ureqa);
 if(in_array($uid, $ureqa)){
  echo "Already Present";
 }
else{

  array_push($ureqa, $uid);
  $ureqa = implode(",",$ureqa);
  update_post_meta( $simid, 'ureqa',  $ureqa  );
  $user = get_userdata($uid);
   $userid =  $user->ID;
  $rall = get_the_author_meta( 'uemailra', $userid );
  if($rall != 'unset'){
  $user_email =  $user->user_email;
   $subject = "Sim access request approved";
    $body = '
              <p>Hi, your request to access the sim '.$simtit.' has been approved</p></br></br>
              <p><a href="'.$simurl.'">Click here to view the Request</a></p></br></br>
              <p>Regards,</p></br>
              <p>Sim Share</p></br>
             ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($user_email, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
 }
}
} else {
  //deny request
  $simid = $_POST['simid'];
 $uid = $_POST['uid'];
  $ureq =  get_post_meta( $simid, 'ureq', true );
  $ureq = explode(",",$ureq);
 $ureq = array_filter($ureq);
 if(in_array($uid, $ureq)){
  echo "Already Present";
 }
 if (($key = array_search($uid, $ureq)) !== false) {
    unset($ureq[$key]);
   $ureq = implode(",",$ureq);
   update_post_meta( $simid, 'ureq',  $ureq  );
}

$ureqad =  get_post_meta( $simid, 'ureqad', true );
  $ureqad = explode(",",$ureqad);
 $ureqad = array_filter($ureqad);
 if(in_array($uid, $ureqad)){
  echo "Already Present";
 }
else{

  array_push($ureqad, $uid);
  $ureqad = implode(",",$ureqad);
  update_post_meta( $simid, 'ureqad',  $ureqad  );
 }
}
}

  ?>

 
 