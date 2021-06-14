<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>
<section class="innerSec">							
	<div class="container">	
		<div class="contBox">
			<div class="row">
				<div class="col-sm-6">
					<div class="Welnessprgrm"><h1>MCMS Physician<br/>
						Wellness Program</h1>
						<p>A free program, by physicians serving physicians, to support members of the McLennan County Medical Society</p>
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
			<h3>If you are struggling with significant psychological,emotional or financial stressors, please utilize this resource. It is meant for our local Waco physicians.</h3>
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
					<h3>Why it Works:</h3>
					<ul>
						<li>Counseling sessions with licensed therapists experienced in burnout, chronic stress, depression & addiction</li>
						<li>Self-referral only – not punitive or compulsory</li>
						<li>Complete confidentiality – not reported for credentialing or licensing renewals</li>
						<li>No medical record, diagnosis made or insurance billing</li>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="shadowBox1">
					<h3>How it Works:</h3>
					<ul>
						<li>MCMS provides up to 4 free sessions per year for members</li>
						<li>Appointments made via dedicated & confidential phone source. They may be virtual or in person.</li>
						<li>Same day responses & appointments within 72 hours of request </li>
					</ul>
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
<?php

get_footer();
