<?php
/* Template Name: Home Page Template
*/ 

get_header();


date_default_timezone_set("Asia/Calcutta"); 


if($_REQUEST['actionInquiry']=="inquiry"){

		$inqueryDate=date('Y-m-d');
    $inquerytime=date('H:i', time());
    $inqueryMethod=$_POST['inqueryMethod'];


    $wpdb->insert( 
        'lb_inquirey', 
        array( 
            'inqueryDate'     => $inqueryDate,
            'inquerytime'    => $inquerytime,
            'inqueryMethod' => $inqueryMethod,
            'assignBy' => get_current_user_id()
        )
    );
    $record_id = $wpdb->insert_id;
    if($record_id){     
     echo '<script type="text/javascript">window.location.href = "thankyou/"</script>';      
    }
}

?>
<section class="innerSec">							
	<div class="container">	
		<div class="contBox">
			<div class="row">
				<div class="col-sm-6">
					<div class="Welnessprgrm"><h1>
						<?php $abv=get_field( "field_60a502c799b82" );						
											
						echo $abv['1_box_heading_left'];
						?><br/>
						</h1>
						<?php echo $abv['1_box_descriptio_left'];?>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="ApointBox">
						<h2>Are you a MCMS member?</h2>
						<ul class="radioBtns">
							<li><input type="radio" name="msms" id="mcmsChecked" value="yes" onchange="showPatientId()">
							<label>Yes</label></li>
							<li><input type="radio" name="msms" id="mcmsCheckedNo" class="selected" onchange="noPatientId()">
							<label>No</label></li>
						</ul>
						<?php //echo do_shortcode( '[contact-form-7 id="62" title="Home MCMS Member"]' ); ?>

						<div class="col-md-12" id="paitentId" style="display: none;">
							<form  name="inquiryForm" id="inquiryForm" action="" method="post">
									<input type="hidden" name="inqueryMethod" value="web">
									<input type="hidden"   name="actionInquiry" value="inquiry">
									<input type="submit"  class="ApointBTn" value="Request an Inquiry">
							</form>	
						</div>

						<div class="row"  id="paitentIdno" style="display: none;">
							
							<div class="col-md-12" >
							<p>The Life Bridge Program is a benefits available to MCMS members only. <a href=" http://mclennancountymedicine.org/texas-medical-society/" target="_blank">Learn more</a> about the benefits of becoming a member.</p>
							
						</div>
						</div>

						<!-- <p>The Life Bridge Program is a benefits available to MCMS members only. <a href="#">Learn more</a> about the benefits of becoming a member</p>
						<a href="#" class="ApointBTn">Request an Appointment</a> -->
					</div>
				</div>

			</div>
		</div>

		<div class="singleHd">
			<h3><?php 
				echo $abv['2_box_content'];
				?></h3>
		</div>
	</div>
</section>
	<!--=================================================== Appointment text ends ================================== -->
	<!--================================================== working points how and why starts ========================================= -->
	
<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="shadowBox">
					<?php $home3rdleft=get_field( "field_60a503e288509" );	?>
					<h3><?php echo $home3rdleft["3rd_box_left_heading"];	?>:</h3>
					<ul>
						<?php echo $home3rdleft["3rd_box_left_description"];	?>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="shadowBox1">
					<?php $home3rdright=get_field( "field_60a504498850c" );	?>
					<h3><?php echo $home3rdright["3rd_box_right_heading"];	?>:</h3>
					<ul>
						<?php echo $home3rdright["3rd_box_right_description"];	?>
				</div>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	function showPatientId(){

    if (document.getElementById('mcmsChecked').checked) {
    	  document.getElementById('paitentId').style.display = 'block';
       document.getElementById('paitentIdno').style.display = 'none';
    }else{
      document.getElementById('paitentId').style.display = 'none';
       document.getElementById('resquestButton').style.display = 'none';
       document.getElementById('ifno').style.display = 'none';
       document.getElementById('paitentIdno').style.display = 'none';
    }


}

function noPatientId(){

    if (document.getElementById('mcmsCheckedNo').checked) {    	
       document.getElementById('paitentId').style.display = 'none';
       document.getElementById('paitentIdno').style.display = 'block';
    }else{
      document.getElementById('paitentId').style.display = 'none';
       document.getElementById('resquestButton').style.display = 'none';
       document.getElementById('ifno').style.display = 'none';
       document.getElementById('paitentIdno').style.display = 'none';
    }


}
</script>
<footer class="footer">
	
<div class="FtrHeading">
<div class="shape"><img src="<?php bloginfo('template_url');?>/img/triangleShape.png" width="100%">
</div>
<?php echo get_field( "footer_content" );?>
</footer>
<?php

//get_footer();
