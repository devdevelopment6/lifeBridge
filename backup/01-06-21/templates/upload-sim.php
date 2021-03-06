<?php 
/* Template Name: Share Sim Template
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

      
<div class="inner-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-offset="10" data-wow-duration="1.5s">


    <?php 

    if(is_user_logged_in()) { 

global $current_user;
              global $Loginuser_role;
              $user_roles = $current_user->roles;
              $Loginuser_role = array_shift($user_roles);
              //echo $Loginuser_role;
              if($Loginuser_role == 'professor' || $Loginuser_role == 'professoional' ||  $Loginuser_role == 'administrator') {
    // show any error messages after form submission
    isigma_show_error_messages(); ?>

<form id="sim_creation" class="isigma_form" action="" method="POST" enctype="multipart/form-data">
       <div class="accordion-section">
       <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
      <div class="card cardfirst">
    <!-- Card header -->
    <div class="card-header" role="tab" id="heading-<?php the_ID(); ?>">
        <a class="collapsed openaccord" data-toggle="collapse" data-parent="#accordionEx" href="#collapse-<?php the_ID(); ?>"
        aria-expanded="false" aria-controls="collapse-<?php the_ID(); ?>">
        <h5 class="mb-0">Basic Information <i class="fa fa-angle-down rotate-icon"></i>
        </h5>
        <small>All fields in this section must be filled out</small>
      </a>
      
    </div>
    <!-- Card body -->
    <div id="collapse-<?php the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php the_ID(); ?>" data-parent="#accordionEx">
      <div class="card-body">

 <p>
        
          <label style="width: 25%">Title : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please note the title of the simulation" aria-hidden="true"></i></a><input id="title" required="required" name="share-title" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

        <p>
        
          <label style="width: 25%">Author : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give the name of the individual(s) who created the simulation.. " aria-hidden="true"></i></a><input id="author" required="required" name="share-author" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

         <p>
        
          <label style="width: 25%; vertical-align: top">Institution(s) : </label><a style="margin-right: 20px; vertical-align: top" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give the name of the institution that owns the simulation. " aria-hidden="true"></i></a>
           <select name="share-institution"  multiple style="max-width: 400px; display: inline-block; min-width: 400px" id="institution" class="required form-control">
            <?php
             $args = array(
                   'post_type'   => 'institution',
                   'orderby' => 'title',
    'order'   => 'ASC',
                     'posts_per_page' => -1
                  );
            $latest_books = get_posts( $args ); 
            foreach($latest_books as $post) {
              ?>
                        <option value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                       <?php } ?>
                        <option value="other">Other</option>
                      </select>
          

        </p>

            <!--p>
        
          <label style="width: 25%">Acknowledgement(s) : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please note any roles played by the staff, e.g. social services manager, partner in a law firm, planning officer . " aria-hidden="true"></i></a><input id="acknowledgement"  name="acknowledgement" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p-->

         <p>
        
          <label style="width: 25%">Visibility : </label><a style="margin-right: 20px; vertical-align: top" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Private (users will see the description of SIMS, but won???t be able to access the files. They can request you to grant access)<br><br>
Public (users can see the description of SIMS, and download the related files)
 " aria-hidden="true"></i></a>
          <select name="Security"  style="max-width: 400px; display: inline-block;  min-width: 400px" id="Security" class="required form-control">
                        <option value="private">Private</option>
                        <option value="public" >Public</option>
                      </select>

        </p>

         <p>
          <div class="row">
        <div class="col-md-3">
          <label><a href="http://en.wikipedia.org/wiki/Creative_Commons_licenses" target="_blank">Creative Commons License : </a></label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please select the licence you wish to release this simulation under: (delete all options except the licence you want to apply to your simulation). Click on the licence name for details of the terms and conditions. <br> 
??? Except where otherwise noted this work is licensed under a creative commons Attribution Non-Commercial Share Alike 2.0 licence. <br>
OR<br>
??? Except where otherwise noted this work is licensed under a creative commons Attribution 2.0 licence. 
<br>OR<br>
??? Except where otherwise noted this work is licensed under a creative commons Attribution Non-Commercial 2.0 licence.<br>
OR<br>
??? Except where otherwise noted this work is licensed under a creative commons Attribution Share Alike 2.0 licence. 
 " aria-hidden="true"></i></a></div>
          <div class="col-md-9">
            <div class="blk">
            <input type="radio"  id="license" name="license" value="6" />
            <label for="license">Attribution, ShareAlike</label></div>
            <div class="blk">
            <input type="radio"  id="license" name="license" value="5" checked="checked" />
            <label for="license">Attribution, Non-commercial, ShareAlike</label></div>
              <div class="blk">
            <input type="radio"  id="license" name="license" value="1" />
            <label for="license">Attribution</label></div>
            <div class="blk">
            <input type="radio"  id="license" name="license" value="4" />
            <label for="license">Attribution, Non-commercial  </label></div>
            </div></div>

        </p>

          <p>
        
          <label style="width: 25%">Subject Classification(s) : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give the relevant subject classification(s) for the simulation" aria-hidden="true"></i></a><select class="form-control" id="classification" name="classification"  style="max-width: 400px; display: inline-block; width:expression('400px'); min-width('400px');" >
                      <option value="Architecture, Building and Planning" >Architecture, Building and Planning</option>
                      <option value="Business and Administrative studies" >Business and Administrative studies</option>
                      <option value="Biological Science" >Biological Science</option>
                      <option value="Creative Arts and Design" >Creative Arts and Design</option>
                      <option value="Eastern, Asiatic, African, American and Australasian Languages, Literature and related subjects" >Literature and related subjects</option>
                      <option value="Education" >Education</option>
                      <option value="Engineering" >Engineering</option>
                      <option value="European Languages, Literature and related subjects" >European Languages, Literature and related subjects</option>
                      <option value="Historical studies" >Historical Studies</option>
                      <option value="Philosophical studies">Philosophical studies</option>
                      <option value="Law" >Law</option>
                      <option value="Linguistics, Classics and related subjects" >Linguistics</option>
                      <option value="Mass Communications and Documentation" >"Communication and Information Science</option>
                      <option value="Mathematical and Computer Sciences" >Mathematical and Computer Sciences</option>
                      <option value="Medicine and Dentistry" >Medicine and Dentistry</option>
                       <option value="Nursing" >Nursing</option>
                         <option value=">Other Health Care Disciplines" >Other Health Care Disciplines</option>
                      <option value="Physical Sciences" >Physical Sciences</option>
                      <option value="Social studies" >Social Studies</option>
                      <option value="Subjects allied to Medicine" >Subjects allied to Medicine</option>
                      <option value="Technologies" >Digital Technologies</option>
                      <option value="Veterinary Sciences, Agriculture and related subjects" >Veterinary Sciences, Agriculture and related subjects</option>
                       <option value="other">Other</option>
                    </select>

        </p>

         <p>
        
          <label style="width: 25%; vertical-align: top">Overview : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give a brief description of your simulation." aria-hidden="true"></i></a><textarea class="form-control" id="overview" name="overview" required="required" style="width: 400px; display: inline-block;"></textarea>

        </p>

        <p>
        
          <label style="width: 25%; vertical-align: top">Keywords : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please use commas to separate words and phrases" aria-hidden="true"></i></a><textarea class="form-control" id="keywords" name="keywords" style="width: 400px; display: inline-block;"></textarea>

        </p>

         <p>
        
          <label style="width: 25%; vertical-align: top">Simulation Files : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="all types except .exe and multiple files" aria-hidden="true"></i></a><input type="file" name="upload_attachment[]" multiple class="files" size="50" />
          <div class="form-group">

          </div>
                        <!--div class="progress" style="margin-left: 25%; width: 35%">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
                        <div style="margin-left: 25%" class="msg"></div>
                      </div-->
          <?php wp_nonce_field( 'upload_attachment', 'my_image_upload_nonce' ); ?>

        </p>
        </div>
      </div>
    </div>
  </div>
 <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
      <div class="card">
    <!-- Card header -->
    <div class="card-header" role="tab" id="heading-<?php the_ID(); ?>">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapse-<?php the_ID(); ?>"
        aria-expanded="false" aria-controls="collapse-<?php the_ID(); ?>">
        <h5 class="mb-0">Further Information <i class="fa fa-angle-down rotate-icon"></i>
        </h5>
        <small>This section is voluntary and will give your readers more information about your simulation.  Please fill out as many fields as you think are required.</small>
      </a>
    </div>
    <!-- Card body -->
    <div id="collapse-<?php the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php the_ID(); ?>" data-parent="#accordionEx">
      <div class="card-body">
           <p>
        
          <label class="labl" style="width: 25%">Program of study : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please name the degree or other programme in which the simulation is used." aria-hidden="true"></i></a><input id="pstudy" name="pstudy" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

         <p>
        
          <label style="width: 25%">Student roles : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please note what roles the students play, e.g. social worker, civil litigation lawyer, architect." aria-hidden="true"></i></a><input id="sroles" name="sroles" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

        <p>
        
          <label style="width: 25%">Staff roles : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please note any roles played by staff, e.g. simulated client, partner in a law firm, planning officer, etc " aria-hidden="true"></i></a><input id="staffroles" name="staffroles" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>          

         <p>
        
          <label style="width: 25%">Detailed simulation narrative </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give details of the simulation narrative. This can be as detailed or brief as you wish." aria-hidden="true"></i></a><textarea class="form-control" id="dsimnarat" name="dsimnarat" style="width: 400px; display: inline-block;"></textarea>

        </p>


        <p>
        
          <label style="width: 25%">Learning outcomes : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give details of the learning outcomes, including both academic and ???transferable??? skills where appropriate." aria-hidden="true"></i></a><input id="loutcomes" name="loutcomes" style="max-width: 400px; display: inline-block;  min-width: 400px;" class="required form-control" type="text"/>

        </p>

        <p>
        
          <label style="width: 25%">Assessment : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give details of how the simulation is assessed and what criteria are used.  If relevant, refer to supplementary assessment files you are uploading." aria-hidden="true"></i></a><textarea class="form-control" id="assesment" name="assesment" style="width: 400px; display: inline-block;"></textarea>

        </p>

        <p>
        
          <label style="width: 25%">Resources : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give an overview/inventory of  the resources that are used in this simulation. For example: <br><br><ul style='padding-left:6px'><li>
Documents such as reports, witness statements that are required to support each simulation and may be requested by the students acting in role (e.g. doctor???s reports, car accident reports, planning decision etc.)</li><li>
Photographs (e.g. of the place of an accident, an injury, a building site)<br></li><li>
Videos (e.g. of witnesses being interviewed, of a construction site etc.)<br></li><li>
Pro forma documents (e.g. contracts, planning application forms, transfer of property forms statements etc.)<br></li><li>
Other miscellaneous resources (e.g. newspaper reports, death certificates etc.)<br></li><li>
Web-based resources (e.g. Government agencies or professional bodies).</li></ul>
" aria-hidden="true"></i></a><textarea class="form-control" id="resources" name="resources"  style="width: 400px; display: inline-block;"></textarea>

        </p>

        <p>
        
          <label style="width: 25%">Student support : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please give details of the support provided to students using the simulation.  For example, this might include:<br><br>
??? On line discussion forums<br>
??? Weekly tutorial meetings<br>
??? FAQs<br>
??? Hard copy and on line guidance documents<br>
??? Preliminary exercises<br>
??? User guides<br><br>

Refer to any supplementary files you are uploading if relevant

" aria-hidden="true"></i></a><textarea class="form-control" id="ssuport" name="ssuport" style="width: 400px; display: inline-block;"></textarea>

        </p>

         <p>
        
          <label style="width: 25%">Staff time : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please indicate how much staff time is needed to run this simulation." aria-hidden="true"></i></a><textarea class="form-control" id="stime" name="stime"  style="width: 400px; display: inline-block;"></textarea>

        </p>

        <p>
        
          <label style="width: 25%">Time period : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please indicate the total period the simulation runs for, e.g. one seminar, 16 weeks or one semester." aria-hidden="true"></i></a><textarea class="form-control" id="pperiod" name="pperiod"  style="width: 400px; display: inline-block;"></textarea>

        </p>

        <p>
        
          <label style="width: 25%">Student feedback : </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="You may wish to include feedback from the students" aria-hidden="true"></i></a><textarea class="form-control" id="sexeperience" name="sexeperience"  style="width: 400px; display: inline-block;"></textarea>

        </p>

         <p>
        
          <label style="width: 25%">How could this simulation be adapted and re-used?  </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please suggest any ways in which this simulation could be adapted and re-used in different contexts (e.g. could it be played over a different time period, or used with students studying at a different level or in a different jurisdiction? Is group work optional?).  You do not need to try to anticipate the requirements of any and all potential users, but any ideas that you have could enhance the value of your simulation to others.  It would be especially useful if you have already shared your simulation and can document this." aria-hidden="true"></i></a><textarea class="form-control" id="ruse" name="ruse"  style="width: 400px; display: inline-block;"></textarea>

        </p> 

        <p>
        
          <label style="width: 25%">Are there any publications relating to the development and use of this simulation?   </label><a style="margin-right: 20px" class="help" href="" data-toggle="modal" ><i class="fa fa-question-circle" data-con="Please add references to print or web publications here. " aria-hidden="true"></i></a><textarea class="form-control" id="reference" name="reference" style="width: 400px; display: inline-block;"></textarea>

        </p> 
      </div>
    </div>

  </div>
</div>
         <!--p>
        
          <label style="width: 25%; vertical-align: top">Simulation Files : </label><input type="file" id="files" name="files" multiple>

        </p-->
          <p>
          <input type="hidden" name="sim_create_nonce" value="<?php echo wp_create_nonce('sim-create-nonce'); ?>"/>
           <input type="hidden" class="urlsadd" name="urlsadd" value=""/>
          <input type="submit" id="share-submit-button" name="share_submit_button" value="<?php _e('Save Sim'); ?>"/>
          <input type="submit" id="share-draft-button" name="share_draft_button" value="<?php _e('Save as Draft'); ?>"/>
        
        </p>
</div>

      </form>

     <?php

} else {

  echo "<h3>You must be professor to Create Sims</h3> ";
}
} else{
  echo "Please <a href='/login?redir=sharesim'>login</a> to continue";
}
    ?>

      </div>
    </div>
  </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin: 10% auto">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="display: block;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p class="mc"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
  jQuery('document').ready(function(){
  jQuery('.cardfirst a.openaccord').trigger('click');

  })
 jQuery('a.help').click(function(){
    var cont = jQuery(this).find('i').attr('data-con');
    var head = jQuery(this).closest('p').find('label').text();
    console.log(head);
     jQuery("#myModal .mc").html(cont);
     jQuery("#myModal h4.modal-title").text(head);
      jQuery("#myModal").modal('show');
  });
  var count = 0;
  var aurl = [];
  jQuery(function($) {
    $('body').on('click', '.remo', function() {
        var r = confirm("Are you Sure ?");
  if (r == true) {
      jQuery(this).closest('.main-bar').remove();
      var fileap = $(this).closest('.main-bar').attr('data-alt');
       $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
             data: {'action' : 'file_delete' , 'id':fileap},
             beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
                
              },
              complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
           
        },
            success: function (response) {
               console.log(response); 
                const index = aurl.indexOf(fileap);
              if (index > -1) {
                aurl.splice(index, 1);
              }
                aurl = aurl.filter(function (el) {
                  return el != null;
                });
                var xs = aurl.toString();

               jQuery('.urlsadd').val(xs);
                //alert('File(s) uploaded successfully.');
            }
        });
     }
    });


    $('body').on('change', '.files', function() {
       var a = jQuery('#title').val();
    var b = jQuery('#author').val();
    var c = jQuery('#overview').val();
    console.log(c);
     if (a == null || a == "" || b == null || b == "" || c == null || c == "") {
      jQuery(this).val('');
      alert("Please fill all required fields first");

     return false;
    } else {
        $this = $(this);
        file_obj = $this.prop('files');
         var filen = '';
        //console.log(file_obj);
        form_data = new FormData();
        for(i=0; i<file_obj.length; i++) {
            form_data.append('file[]', file_obj[i]);
            jQuery('.form-group').before('<div class="main-bar prog'+count+'"><div class="progress'+count+'" style="display: inline-block"><div style="display: inline-block" class="msg'+count+'">'+$this[0].files[i].name+'</div><div class="remdiv"></div></div>');
            count = count + 1;

        }
        console.log(form_data);
        form_data.append('action', 'file_upload');
      
        console.log(filen);
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function() { 
                jQuery('body').addClass("loading");  
                jQuery('body').append('<div class="modalgif">wait...</div>');
              },
        complete: function() { 
          jQuery('body').removeClass("loading"); 
          jQuery('.modalgif').remove();
        },
            success: function (response) {
                $this.val('');
                console.log(response);
                var auls = jQuery('.urlsadd').val();
                if(auls != ''){
                response = response+','+auls;
              }

                aurl = response.split(",");
                console.log(aurl);
                aurl = aurl.filter(function (el) {
                  return el != null;
                });
                  for(j=0; j<aurl.length; j++) {
                    jQuery('.prog'+j).attr('data-alt', aurl[j]);
                    //console.log(aurl[j]);
                     jQuery('.prog'+j+' .remdiv').html('<div style="display:inline-block; margin-left: 25px; color: red" class="remo remove'+count+'">Remove</div>');
                  }
                 
               
                
                console.log(aurl);
                
                 var xs = aurl.toString();
                 jQuery('.urlsadd').val(xs);
                  //count = count + 1;
                //alert('File(s) uploaded successfully.');
            }
        });
      }
    });
});
</script>

<?php get_footer(); ?>