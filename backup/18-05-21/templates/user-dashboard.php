<?php 
/* Template Name: User Dashboard Template
*/ 
?>
<?php get_header(); 

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
    
      
<div class="inner-page faq-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp simdetail" data-wow-offset="10" data-wow-duration="1.5s">
        <?php if(!is_user_logged_in() ){
          echo 'You must be <a href="/login">logged<a> in view this';
        } else {
        ?>
        <div class="left-column">
          <?php include 'page-sidebar.php'; ?>
        </div>
        <div class="right-column">
         

<?php 
 
 $cuid = get_current_user_id(); ?>
  
  
      <?php } ?>
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript">
       jQuery('body').on('click', '.rowbutt', function() {
      var simid = jQuery(this).attr('data-all');
      var uid = jQuery(this).attr('data-sub');
      var alt = jQuery(this).attr('data-alt');
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(uid != ''){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/user-request.php",
        type: "post",
        data: {"simid" : simid , "uid": uid , "alt": alt , "utype":'sub' },

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
       </script>


<?php get_footer(); ?>