<?php 
/* Template Name: Sim Detail Template
*/ 
?>
<?php get_header(); 
$simid = $_GET['simid'];
?>

<div class="inner-banner">
      <div class="container">
            <div class="row">
              <div class="col-lg-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">
                 <h1 class="page-title"><?php the_title();?></h1>
              </div>
            </div>
                        
        </div>
  </div>
<style type="text/css">
  .simdetail label{
    font-weight: bold;
    width:25%;
  }
</style>
      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp simdetail" data-wow-offset="10" data-wow-duration="1.5s">
 <?php $security = get_post_meta($simid, 'security', true);

 
if($security=='private' && !is_user_logged_in()){
  
  echo 'You must be logged in view this';
}
else {
  $ccc = get_post_meta($simid, 'creative_commons_license', true);
  if($ccc == '6'){
    $ccap = 'Attribution, ShareAlike';
  } elseif ($ccc == '5') {
    $ccap = 'Attribution, Non-commercial, ShareAlike';
  } elseif ($ccc == '1') {
    $ccap = 'Attribution';
  } elseif ($ccc == '4') {
    $ccap = 'Attribution, Non-commercial';
  }

?>
<p><label>Title: </label> <?php echo get_the_title($simid); ?></p>
<p><label>Author: </label><?php echo get_post_meta($simid, 'author', true); ?></p>
<p><label>Institution: </label><?php echo get_post_meta($simid, 'institutions', true); ?></p>
<p><label>Creative Commons License: </label><?php echo $ccap; ?></p>
<p><label>Subject Classification: </label><?php echo get_post_meta($simid, 'subject_classifications', true); ?></p>
<p><label>Keywords: </label><?php echo get_post_meta($simid, 'keywords', true); ?></p>
<p><label>Simulation Files: </label></p>
 <?php //$security = get_post_meta($simid, 'security', true);


 $stat = get_post_meta($simid, 'files', true); 
 //echo "$stat";
 $cid = get_current_user_id();
  $views =  get_post_meta( $simid, 'views', true );
  $views = explode(",",$views);
  $views = array_filter($views);
$viewid = $simid.':'.$cid;
if(in_array($viewid, $views)){
  //echo "Already Present";
 }
 else{
array_push($views, $viewid);
  $views = implode(",",$views);
    update_post_meta( $simid, 'views',  $views  );
 }
 $statd = explode(",",$stat);
 $statd = array_filter($statd);
 // echo "$stat";
 $cid = get_current_user_id();
 $aid = get_post_field( 'post_author', $simid );
 $ureq =  get_post_meta( $simid, 'ureq', true );
 $ureq = explode(",",$ureq);
 $ureq = array_filter($ureq);

 $ureqa =  get_post_meta( $simid, 'ureqa', true );
 $ureqad =  get_post_meta( $simid, 'ureqad', true );
 $ureqad = explode(",",$ureqad);
 $ureqad = array_filter($ureqad);
 //echo "$ureqa";
  $ureqa = explode(",",$ureqa);
 $ureqa = array_filter($ureqa);
 //print_r($ureq);
 if($cid == $aid || $security=='public'){
 foreach ($statd as $key) {
   # code...
  $tit = get_the_title($key);
  $urls = wp_get_attachment_url($key);
  //echo $tit;
//  echo "$key"."<br>";
  if($tit !== ''){
  echo "<div class='divf' data-attr=".$key."><div class='filename' style='display:inline-block'><a data-simid=".$simid." data-uid=".$cid." data-did=".$key." class='downloadbtn' download='".$tit."' href='".$urls."'>".get_the_title($key)."</a></div></div>";
}
}
} else {
 if(in_array($cid, $ureqa)){
  foreach ($statd as $key) {
   # code...
  $tit = get_the_title($key);
  $urls = wp_get_attachment_url($key);
  //echo $tit;
//  echo "$key"."<br>";
  if($tit !== ''){
  echo "<div class='divf' data-attr=".$key."><div class='filename' style='display:inline-block'><a data-simid=".$simid." data-uid=".$cid." data-did=".$key." class='downloadbtn' download='".$tit."' href='".$urls."'>".get_the_title($key)."</a></div></div>";
}
} } elseif(in_array($cid, $ureq) ){
 ?>
<button class="reqacc" disabled="disabled">Request Already Sent</button>

<?php }
elseif (in_array($cid, $ureqad )) { ?>
  <button class="reqacc" disabled="disabled">Request Denied !</button>


<?php }
 else { ?>
<button class="reqacc" data-uid="<?php echo $cid ?>" data-idr="<?php echo $simid; ?>">Request Access</button>
  
 <?php
}   
}} 
 ?>

     </div>
     <script type="text/javascript">
       jQuery('body').on('click', '.reqacc', function() {
      var simid = jQuery(this).attr('data-idr');
      var uid = jQuery(this).attr('data-uid');
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(uid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "uid": uid , "utype":'request' },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
        console.log('hi');
        location.reload();
      }
  });
}

    });

        jQuery('body').on('click', '.downloadbtn', function() {
      var simid = jQuery(this).attr('data-simid');
      var uid = jQuery(this).attr('data-uid');
        var did = jQuery(this).attr('data-did');
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(uid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "uid": uid ,  "utype":'download', "did":did },

      success: function(result){
        console.log(result);
       
      }
  });
}

    });
       </script>
    </div>
  </div>
  </div>
  


<?php get_footer(); ?>