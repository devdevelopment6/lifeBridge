<?php
/* Template Name: Home Page Template
*/ 

get_header();

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
							<li><input type="radio" name="msms" id="No" class="selected" onchange="showPatientId()">
							<label>No</label></li>
						</ul>
						<?php echo do_shortcode( '[contact-form-7 id="62" title="Home MCMS Member"]' ); ?>

						<!-- <div class="row">
							<div class="col-md-12" id="paitentId" style="display: none;">
							<input type="" name="">
							</div>
							<div class="col-md-12" >
							<p>The Life Bridge Program is a benefits available to MCMS members only. <a href="#">Learn more</a> about the benefits of becoming a member</p>
							<p id="resquestButton" style="display: none;">
							<input type="submit" class="ApointBTn" name="submit" value="Request an Appointment">
							</p>
						</div>
						</div> -->

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
       document.getElementById('resquestButton').style.display = 'block';
       document.getElementById('ifno').style.display = 'none';
    }else{
      document.getElementById('paitentId').style.display = 'none';
       document.getElementById('resquestButton').style.display = 'none';
       document.getElementById('ifno').style.display = 'block';
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
