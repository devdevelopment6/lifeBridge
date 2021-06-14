<?php 
 global $current_user;
 $sname = $current_user->first_name.' '.$current_user->last_name;
 $ids = get_current_user_id();
 $ppic = get_the_author_meta( 'profile_pic', $current_user->ID );
 if(!$ppic){
  $ppic = 'http://simshare.dev-first-cut.com/wp-content/uploads/2021/01/usera.png';
 }

?>

<div class="sponsors">
            <div class="profilecard">
              <div style="display: block;">
                          <img style=" padding: 10px; " src="<?php echo $ppic; ?>" alt="" style="padding: 10px; display: block; border: none; float: left;">
                          <div style="padding: 10px;  font-size: 13px">
                            <p><strong><?php echo $sname; ?></strong></p>
                             <p><?php the_author_meta( 'occupation', $current_user->ID ); ?></p>
                            <p><?php the_author_meta( 'institutions', $current_user->ID ); ?></p>
                            <p><?php the_author_meta( 'location', $current_user->ID );  ?></p>                           
                          </div>
                        </div>
            </div>
            
                       
                      <div class="profileMenu">
                        <ul class="sideNav">
                          <li id="navigationItem">
                            <a href="<?php echo site_url();?>/view-profile/"><span class="imgWrap"></span><span><i class="fa fa-user" aria-hidden="true"></i> View my profile</span></a>
                          </li>
                          <li id="navigationItem">
                            <a href="<?php echo site_url();?>/edit-profile"><span class="imgWrap"></span><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit my profile</span></a>
                          </li>
                        </ul>
                      </div>
                     
                       <div class="profileMenu">
                        <ul class="sideNav">
                          <li id="navigationItem">
                            <a href="<?php echo site_url();?>/change-password"><span class="imgWrap"></span><span><i class="fa fa-key" aria-hidden="true"></i> Change password</span></a>
                          </li>                           
                          <li id="navigationItem">
                            <a href="<?php echo wp_logout_url( ) ?>"><span class="imgWrap"></span><span><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</span></a>
                          </li>
                        </ul>
                      </div>
          </div>
          <script type="text/javascript">
            $(function(){
    var current = location.pathname;
    $('#navigationItem a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})
          </script>