<?php
  
  get_header();

  while(have_posts()) {
    the_post(); ?>

    

      <div class="generic-content"><?php the_content(); ?></div>

      <?php 
       $postid = get_field('user_book');
       $mypost = get_post($postid);
echo apply_filters('the_title',$mypost->post_title);
echo apply_filters('the_content',$mypost->post_content);
echo apply_filters('the_thumbnail',$mypost->post_thumbnail);
echo get_the_post_thumbnail( $postid, 'post-thumbnail' );




      ?>

    </div>
    

    
  <?php }

  get_footer();

?>