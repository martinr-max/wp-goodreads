<?php
  
  get_header();
  $custom_cat_name = get_the_category()[0]->name;
  $book_by_cat = get_posts( array( 
    'post_type' => 'book',
    'numberposts' => 4,
    'tax_query' => array(
      array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' =>  '"' . $custom_cat_name . '"' //pass your term name here
              )
            ))
      );
    

   ?>
  <section class="page-container">
  <div class="page-content">
  <div id="sidebar-primary" class="sidebar">
  <div id="review_sum">
        <h2 class="widgettitle">Summary Rating</h2>
        <?php   echo do_shortcode('[site_reviews_summary assigned_posts="post_id" ]'); ?>
  </div>
  <ul class="categories-list">
    <h2 class="widgettitle">Same categories:</h2>
      <?php 
     
        foreach($book_by_cat as $book) {
          $autorid = get_posts(array(
            'post_type' => 'author2',
            'numberposts' => 3,
            'meta_query' => array(
              array(
                'key' => 'books', // name of custom field
                'value' => '"' . $book->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
              )
            )
          ));
          foreach($autorid as $author) {
        if(get_the_ID() != $book->ID) {

        ?>
          <li >
                          <a class="author-book" href="<?php the_permalink($book->ID) ?>">
                        <div class="book-by-cat-header">
                        <h2 class="heading-2" id="authors-book-title"><?php echo apply_filters('the_title',$book->post_title);?></h2>
                        <p class="author-name" >by <?php  echo apply_filters('the_title',$author->post_title);?></p>

                        </div>
                        
                        <div class="author-book-cover">  <?php echo get_the_post_thumbnail( $book, 'post-thumbnail' );?> </div>
                        </a>
                        </li>
        
     <?php }}}
  ?>
  </ul>
</div>
    <?php
    $authors = get_posts(array(
      'post_type' => 'author2',
      'meta_query' => array(
        array(
          'key' => 'books', // name of custom field
          'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ));
   
  
  while(have_posts()) {
    the_post(); 
     foreach( $authors as $autor ): 

       ?>
     <div class="single-card-content">
                
                <?php the_post_thumbnail() ?>
                <div class="text">
                    <h1 class="card-title"> <?php the_title(); ?> </h1>
                    <?php echo do_shortcode('[site_reviews_summary assigned_posts="post_id" hide="summary, bars,if_empty, rating"]') ?>

                <p class="book-author">by <?php  echo apply_filters('the_title',$autor->post_title);?></p>
                   
                   <?php 
                  
                    the_content()?>
                    </div>
              
                </div>


  <?php 

?>
<div id="sidebar-secondary" class="sidebar">
<?php if( $autorid ){ 
  $the_books = get_field('books', $autor);
  ?>
 
    
  <ul>
            <li class="book-author-card">
            <h1 class="widgettitle">About an Author</h1>
                      <a href="<?php echo get_the_permalink($autor->ID); ?>">
                    <h2 class="heading-2" id="author-name"><?php echo apply_filters('the_title',$autor->post_title);?></h2>
                    <div class="author-img">  <?php echo get_the_post_thumbnail( $autor, 'post-thumbnail' );?> </div>
                        <?php echo apply_filters('the_content',$autor->post_content); ?>
                        </a>
                        <?php if(sizeof($the_books) > 1) { ?>

                    <ul class="author-books">
                      <h2 class="widgettitle">Author's others books:</h2>
                      <?php
                      $i = 0;
                      foreach( $the_books as $book ) { 
                        if(++$i > 2) break;
                        if($book->ID != get_the_ID()) {

                          ?>
                        <li >
                          <a class="author-book" href="<?php the_permalink($book->ID) ?>">
                        <h2 class="heading-2" id="authors-book-title"><?php echo apply_filters('the_title',$book->post_title);?></h2>
                        <div class="author-book-cover">  <?php echo get_the_post_thumbnail( $book, 'post-thumbnail' );?> </div>
                        </a>
                        </li>


                      <?php }
                      
                    }   ?>
                    </ul>
                    <?php }?>
</li>

							</ul>
						<?php }; ?>

</div>
<?php
						endforeach;
          }

 ?>
<section class="reviews">
  

  <div class="all_reviews">
    <h2 class="heading-2">Users reviews</h2>
    <?php echo do_shortcode('[site_reviews assigned_posts="post_id" display="3" pagination="ajax"]'); ?>
  </div>
<div class="show_review_form-btn">
<button class="button open_review_form">Add Review</button>
</div>
<?php
 echo do_shortcode('[site_reviews_form assigned_posts="post_id" class="my-reviews-form full-width"]');
?>


</section>

</section>
</div>

<?php
  get_footer();

?>