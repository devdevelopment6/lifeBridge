<?php
header("Access-Control-Allow-Origin: *");

require_once('../../../wp-config.php');
global $wpdb;
 global $current_user;

 if(isset($_POST['sfield'])){
  $args = array(
    'meta_query' => array(
        array(
            'key' => 'institutions',
            'value' => $_POST['sfield']
        )
    ),
    'post_type' => 'sims',
    'posts_per_page' => -1
);
 	
$enterprise_posts = get_posts( $args );
 foreach($enterprise_posts as $post) {
  $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
             $postauth = $post->post_author;
  ?>

 
  <tr>
    <td><a href="/sim-details?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></td>
    <td><?php echo get_the_date() ?></td>
    <td><?php echo get_the_author_meta( 'display_name', $postauth ) ?></td>
     <td><?php echo get_post_meta( get_the_ID(), 'institutions', true ); ?></td>
       <td><?php echo get_post_meta( get_the_ID(), 'subject_classifications', true ); ?></td>

         <td><?php echo $carr; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
  </tr>
  <?php } }

if(isset($_POST['ssfield'])){
 // echo $_POST['ssfield'];
 $args = array(
    'meta_query' => array(
      'relation' => 'OR',
        array(
            'key' => 'posttitle',
            'value' => $_POST['ssfield'],
            'compare' => 'LIKE'
        ),array(
            'key' => 'keywords',
            'value' => $_POST['ssfield'],
            'compare' => 'LIKE'
        ),array(
            'key' => 'files',
            'value' => $_POST['ssfield'],
            'compare' => 'LIKE'
        ),array(
            'key' => 'creative_commons_license',
            'value' => $_POST['ssfield'],
            'compare' => 'LIKE'
        ),array(
            'key' => 'author',
            'value' => $_POST['ssfield'],
            'compare' => 'LIKE'
        )
    ),
    'post_type' => 'sims',
    'posts_per_page' => -1
);
  
  $quotes = get_posts( $args );
 
//$enterprise_posts = get_posts( $args );
 foreach($quotes as $post) {
              $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
             $postauth = $post->post_author;
  ?>

 
  <tr>
    <td><a href="/sim-details?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></td>
    <td><?php echo get_the_date() ?></td>
    <td><?php echo get_the_author_meta( 'display_name', $postauth ) ?></td>
     <td><?php echo get_post_meta( get_the_ID(), 'institutions', true ); ?></td>
       <td><?php echo get_post_meta( get_the_ID(), 'subject_classifications', true ); ?></td>

         <td><?php echo $carr; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
  </tr>
  <?php } }

if(isset($_POST['cfield'])){
  $args = array(
    'meta_query' => array(
        array(
            'key' => 'subject_classifications',
            'value' => $_POST['cfield']
        )
    ),
    'post_type' => 'sims',
    'posts_per_page' => -1
);
  
$enterprise_posts = get_posts( $args );
 foreach($enterprise_posts as $post) {
  $stra = get_post_meta( get_the_ID(), 'files', true );
              $posta = explode(",",$stra);
              $result = array_filter($posta); 
             $carr = sizeof($result);
             $postauth = $post->post_author;
  ?>

 
  <tr>
    <td><a href="/sim-details?simid=<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></td>
    <td><?php echo get_the_date() ?></td>
    <td><?php echo get_the_author_meta( 'display_name', $postauth ) ?></td>
     <td><?php echo get_post_meta( get_the_ID(), 'institutions', true ); ?></td>
       <td><?php echo get_post_meta( get_the_ID(), 'subject_classifications', true ); ?></td>

         <td><?php echo $carr; ?></td>
            <td style="text-transform: capitalize;"><?php echo get_post_meta( get_the_ID(), 'security', true ); ?></td>
  </tr>
  <?php } }

   ?>
