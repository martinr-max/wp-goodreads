<?php get_header() ?>
<div class="page-container">
<div class="bg-video">
    <h1 id="bg-video-heading" class="heading-1"><strong>Good</strong>Reads</h1>
    <p class="bg-video-subtitle">Find your next favorite book!</p>

                <video class="bg-video__content video-1" autoplay  muted >
                    <source src="<?php echo get_theme_file_uri('/images/Bookshelf - 11254.mp4') ?>" type="video/mp4">
                    <p>Your browser is not support</p>  
                </video>
              
            </div>

<div class="page-content">
<div id="sidebar-primary" class="sidebar">
    <?php dynamic_sidebar( 'primary' ); ?>
</div>
<section class="update">
<ul class="update_list">
      <h1 class="heading-1">New Books</h1>
    <?php
    //books custom query
 $books = new WP_Query(array(
    'post_type' => 'book',
    
 ));


  while($books->have_posts()) {
    $books->the_post();
  
    $autorid = get_posts(array(
      'post_type' => 'author2',
      'meta_query' => array(
        array(
          'key' => 'books', // name of custom field
          'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ));

  
    $existStatus = 'no';
    $existQuery = new WP_Query(array(
        'author' => get_current_user_id(),
        'post_type' => 'my_booklist',
        'meta_query' => array(
          array(
            'key' => 'list_book',
            'compare' => '=',
            'value' => get_the_ID()
          )
        )
      ));
      if ($existQuery->found_posts) {
        $existStatus = 'yes';
      }
   
      foreach( $autorid as $autor ) {

  ?>
      <li>
           <div data-id="<?php the_ID(); ?>" class="book-card">
              <div class="card-content">
              <?php the_post_thumbnail() ?>
              <div class="text">
                  <h1 class="heading-2 card-title"> <?php the_title(); ?> </h1>
                  <?php echo do_shortcode('[site_reviews_summary assigned_posts="post_id" hide="summary, bars,if_empty, rating"]') ?>
                  <p class="book-author">by <?php  echo apply_filters('the_title',$autor->post_title);?></p>

                 <?php echo wp_trim_words(get_the_content(), 30) ?>
                 <p class="read-more-link"><a href="<?php the_permalink(); ?>">Read more</a></p>
              </div>
            </div>
              <?php if($existStatus == 'no') { ?>
                <button  data-exists="<?php echo $existStatus; ?>" type="submit"  data-id="<?php the_ID(); ?>" class="button add_to_list"> add to list </button>
             <?php } else { ?>
                <button  data-exists="<?php echo $existStatus; ?>" type="submit" disabled  data-id="<?php the_ID(); ?>" class="button add_to_list"> Book added </button>
                <?php }?>
              </div>
      </li>
     
  <?php }
  }
    
  ?>
  </ul>
</section>
<div id="sidebar-secondary" class="sidebar">
    <?php dynamic_sidebar( 'secondary' ); ?>
</div>
</div>

</div>
<?php get_footer(); ?>

