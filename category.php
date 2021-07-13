<?php
  
  get_header(); ?>
  <section class="page-container">
  <div class="page-content">
    <?php
  while(have_posts()) {
    the_post(); 
    $autorid = get_posts(array(
      'post_type' => 'author',
      'meta_query' => array(
        array(
          'key' => 'books', // name of custom field
          'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ));
    foreach( $autorid as $autor ) {
    
       ?>
     <div data-id="<?php the_ID(); ?>" class="single-card-content">
               <a href="<?php the_permalink() ?>">
                <div class="text">
                    <h1 class="card-title"> <?php the_title(); ?> </h1>
                    <p class="book-author">by <?php  echo apply_filters('the_title',$autor->post_title);?></p>

                   
                   <?php 
                                the_post_thumbnail();

                    the_content()?>
                    </div>
                    </a>
                </div>


  <?php }
  }
?>


</section>
</div>

<?php
  get_footer();

?>