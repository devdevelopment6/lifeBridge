<?php 
/* Template Name: Find Sim Template
*/ 
?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">

<style type="text/css">
  td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd66;
}
</style>
<div class="sfie">
 <div class="sfields" style="margin-bottom: 25px">
  <div class="ssearch">
   <label style="width: 20%; margin-bottom: 25px">Search : </label>  <input id="searchh"   name="searchh" style="max-width: 400px; display: inline-block; min-width: 400px;" class="required form-control" type="text"/><input type="button" id="sbutton" value="Search">
 </div>
  <label style="width: 20%; margin-bottom: 25px">Institution(s) : </label>   <select multiple="multiple" name="share-institution"  style="max-width: 400px; display: inline-block;  min-width: 400px" id="institution" class="required form-control">


            <?php
             $args = array(
                   'post_type'   => 'institution',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args ); 
            foreach($latest_books as $post) {
              ?>
                        <option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                       <?php } ?>
                        <option value="other">Other</option>
                      </select>
</div>
<div class="sclass" style="margin-bottom: 25px">
 <label style="width: 20%">Subject Classification(s) : </label><select multiple="multiple" class="form-control" id="classification" name="classification"  style="max-width: 400px; display: inline-block; width:expression('400px'); min-width('400px');" >
                      <option value="Architecture, Building and Planning" >Architecture, Building and Planning</option>
                      <option value="Business and Administrative studies" >Business and Administrative studies</option>
                      <option value="Biological Science" >Biological Science</option>
                      <option value="Creative Arts and Design" >Creative Arts and Design</option>
                      <option value="Eastern, Asiatic, African, American and Australasian Languages, Literature and related subjects" >Eastern, Asiatic, African, American and Australasian Languages, Literature and related subjects</option>
                      <option value="Education" >Education</option>
                      <option value="Engineering" >Engineering</option>
                      <option value="European Languages, Literature and related subjects" >European Languages, Literature and related subjects</option>
                      <option value="Historical and Philosophical studies" >Historical and Philosophical studies</option>
                      <option value="Law" >Law</option>
                      <option value="Linguistics, Classics and related subjects" >Linguistics, Classics and related subjects</option>
                      <option value="Mass Communications and Documentation" >Mass Communications and Documentation</option>
                      <option value="Mathematical and Computer Sciences" >Mathematical and Computer Sciences</option>
                      <option value="Medicine and Dentistry" >Medicine and Dentistry</option>
                      <option value="Physical Sciences" >Physical Sciences</option>
                      <option value="Social studies" >Social studies</option>
                      <option value="Subjects allied to Medicine" >Subjects allied to Medicine</option>
                      <option value="Technologies" >Technologies</option>
                      <option value="Veterinary Sciences, Agriculture and related subjects" >Veterinary Sciences, Agriculture and related subjects</option>
                       <option value="other">Other</option>
                    </select>


</div></div>
<table class="find-sim">
   <thead>
  <tr>
    <th>Title</th>
    <th>Date</th>
    <th>Owner</th>
     <th>Insitution</th>
    <th>Subject Classification</th>
    <th>Files</th>
    <th>Level</th>
  </tr>
</thead>
<tbody>
  <?php
  $posta = array();
             $args = array(
                   'post_type'   => 'sims',
                   'orderby' => 'publish_date',
                    'order' => 'DESC',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args ); 
            foreach($latest_books as $post) {

              $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
              $count = 0;
             $postauth = $post->post_author;
             foreach ($result as $key) {
               # code...
              //$name = wp_basename( $key );
              $tit = get_the_title($key);
              if($tit !== ''){
                $count = $count + 1;
              }
            }
             // update_post_meta( get_the_ID(), 'posttitle',  get_the_title()  );
             //echo "$postauth";
             //$postauthname = get_the_author_meta()
             //print_r($posta);
             //print_r(get_post_meta( get_the_ID(), 'subject_classifications', true ));
              ?>
  <tr>
    <td><a href="/sim-details?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></td>
    <td><?php echo get_the_date() ?></td>
    <td><?php echo get_the_author_meta( 'display_name', $postauth ) ?></td>
     <td><?php echo get_post_meta( get_the_ID(), 'institutions', true ); ?></td>
       <td><?php echo get_post_meta( get_the_ID(), 'subject_classifications', true ); ?></td>

         <td><?php echo $count; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
  </tr>
  <?php } ?>

</tbody>
  
</table>


     <?php



    ?>

      </div>
    </div>
  </div>
  </div>
 

<script type="text/javascript">
    jQuery('body').on('change', '#institution', function() {
      var vals = jQuery(this).val();
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(vals != '#'){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/ajax-testing.php",
        type: "post",
        data: {"sfield" : vals },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
      
        jQuery('table tbody').html(result);
      }
  });
}

    });

    jQuery('body').on('click', '#sbutton', function() {
      var vals = jQuery('#searchh').val();
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(vals != '#'){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/ajax-testing.php",
        type: "post",
        data: {"ssfield" : vals },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
      
        jQuery('table tbody').html(result);
      }
  });
}

    });

     jQuery('body').on('change', '#classification', function() {
      var valsc = jQuery(this).val();
       //jQuery('#searchval').val("");
      //jQuery('#pagination').hide();
      //var role = '<?php echo $getrole ?>';
      if(valsc != '#'){
      jQuery.ajax({
    url: "<?php echo get_template_directory_uri() ?>/ajax-testing.php",
        type: "post",
        data: {"cfield" : valsc },

         beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
      success: function(result){
      
        jQuery('table tbody').html(result);
      }
  });
}

    });
   
    
</script>

<?php get_footer(); ?>