<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;

$getPIdValue=$_REQUEST['getPIdValue'];

global $wpdb;    
//echo "SELECT * FROM " . $wpdb->prefix . "appointment where patientId='".$getPIdValue."' ";     
$appointment = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "appointment where patientId='".$getPIdValue."' ");

  $visitNumber =$wpdb->num_rows;


$getyearcount = $wpdb->get_row("SELECT count(*) as total FROM lb_appointment WHERE YEAR(dateTime) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) and patientId='".$getPIdValue."'");



?>


<div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-9">
                       <!--  <input type="text" id="age" name="age" placeholder="Age" class="form-control" required=""> -->

                       <?php 
                                $employmentstatus = get_field_object( 'field_60953085daf0f' );
                                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                       <select name="age" class="form-control" >
                       <?php
                             foreach( $employmentstatuslabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>" <?php if($t==$appointment->age){ echo "selected=selected";}?>><?php echo $w; ?></option>
                         <?php } ?>
                       </select>

                    </div>
                </div>


              
               <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="gender" id="gender1" value="m" <?php if($appointment->gender=="m"){ echo "checked=checked";}?>>Male
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="">
                                    <input type="radio" name="gender" id="gender2" value="f" <?php if($appointment->gender=="f"){ echo "checked=checked";}?>>Female
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 

                
                <div class="form-group">
                        <label for="Height" class="col-sm-3 control-label">Primary Employment Status* </label>
                    <div class="col-sm-9">
						<?php 
                                $employmentstatus = get_field_object( 'field_609513c02a5c4' );
				                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
						?>
                       <select name="employmentstatus" class="form-control" >
                       <?php
                        	 foreach( $employmentstatuslabel as $t => $w ) { ?>
                        		   <option value="<?php echo $t;?>" <?php if($t==$appointment->employmentstatus){ echo "selected=selected";}?>><?php echo $w; ?></option>
                         <?php } ?>
                       </select>

                      
                    </div>
                </div>
                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Primary Specialty* </label>
                    <div class="col-sm-9">
                        <?php 
                                $employmentstatus = get_field_object( 'field_60952f6bc60a2' );
                                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="specialty" class="form-control" >
                       	    <?php
                             foreach( $employmentstatuslabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>" <?php if($t==$appointment->specialty){ echo "selected=selected";}?> ><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Counselor* </label>
                    <div class="col-sm-9">
                        <?php 
                                $employmentstatus = get_field_object( 'field_609531d3b7fc5' );
                                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="counselor" class="form-control" >
                       	    <?php
                             foreach( $employmentstatuslabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>"  <?php if($t==$appointment->counselor){ echo "selected=selected";}?>><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div>

                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Appointment Type* </label>
                    <div class="col-sm-9">
                        <?php 
                                $employmentstatus = get_field_object( 'field_609530a8daf10' );
                                $employmentstatuslabel = $employmentstatus['choices'];
                               // print_r($employmentstatuslabel);
                        ?>
                        <select name="appointmentType" class="form-control" >
                       	    <?php
                             foreach( $employmentstatuslabel as $t => $w ) { ?>
                                   <option value="<?php echo $t;?>" <?php if($t==$appointment->appointmentType){ echo "selected=selected";}?>  ><?php echo $w; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                </div> 
                <?php 
                   $getDateOfSession =date('Y-m-d',strtotime($appointment->dateOfSession));
                ?>
                <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Date Of Session* </label>
                    <div class="col-sm-9">
                        <input type="date" id="dateOfSession" name="dateOfSession" class="form-control" value="<?php echo $getDateOfSession; ?>" >
                    </div>
                </div>

                 <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Visit Number </label>
                    <div class="col-sm-9">
                        <input type="text" id="visitNumber" name="visitNumber" placeholder="visit Number" class="form-control" readonly=""  value="<?php echo $getyearcount->total+1; ?>"   >
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Billable</label>
                    <div class="col-sm-9">
                        <?php if($getyearcount->total  >= 4){ ?>
                           <!--  <option value="2" selected="">Self Pay</option> -->
                           <input type="text" class="form-control"  name="" value="Self" disabled=""  style="background: red; color: #fff;">
                           <input type="hidden" name="billable" value="2">
                          <?php }else{ ?>                           
                           <input type="text" class="form-control"  name="" value="MCMS Pay" disabled="" style="background: green; color: #fff;">
                           <input type="hidden" name="billable" value="1">
                          <?php } ?>

                    </div>
                </div>