<?php

get_header();

 ?>
<section class="page-container">

  <div class="page-content">
    <h1 class="heading-1">My Books</h1>
    <?php
     $likeCount = new WP_Query(array(
      'post_type' => 'my_booklist'
     )); ?>
     <ul class="my-booklist">
  <?php
  while( $likeCount->have_posts()) {
    $likeCount->the_post(); ?>
        <?php
        $customId = get_field('list_book');
        $customPost = get_post($customId);
  global $current_user;
  wp_get_current_user() ;
  

      
        ?>
     <li class="book-card">
       <div class="user-card-content">
       <?php echo get_the_post_thumbnail( $customId, 'post-thumbnail' ); ?>
          <div class="user-card-text">
          <p class="user-rating"><?php echo $current_user->user_login . " " . "rated this book:" . " " . do_shortcode('[site_reviews_summary assigned_posts=$customId hide="summary, bars,if_empty, rating"]') ?></p>

          <h2 class="heading-2"><?php  echo apply_filters('the_title', $customPost->post_title);     ?></h2>
         <p class="author">by <?php echo get_field('author', $customId); ?></p>

          </div>
          </div>
           </li>
  <?php }?>
     </ul>
</div>
</section>
    
   <?php 
   
  
   wp_reset_postdata();
 ?>

<?php get_footer();

?>