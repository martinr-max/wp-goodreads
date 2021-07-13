<?php
  get_header(); ?>
  <section class="page-container">
    <div class="page-content" id="single-author-page">
    <?php
        while(have_posts()) {
        the_post();     ?>
        <div id="sidebar-primary" class="sidebar">
           <figure class="single-author-image"><?php the_post_thumbnail(); ?></figure>
        </div>
        <div data-id="<?php the_ID(); ?>" class="author-card">
            <div class="author-card-content">
                <div class="text" id="single-author-desc">
                    <h1 class="single-author-name"> <?php the_title(); ?> </h1>
                    <?php the_content() ?>
                </div>
            <?php 
                $books = get_field('books');
			    if( $books ) { ?>
                    <div class="author-books-slider">
                
                    <h2  class="heading-2" id="authors-books-heading"> <?php echo  the_title(). "'" . " all books:" ?> </h2>
                    <?php if(sizeof($books) < 2) { ?>
                        <button class="button not_show" id="next_nav" >&#10094;</button>
                        <button class="button not_show" id="prev_nav">&#10095;</button>
                    <?php } else { ?>
                        <button class="button" id="next_nav" >&#10094;</button>
                        <button class="button" id="prev_nav">&#10095;</button> 
                   <?php }  ?>
                    
                    <div class="authors-bookslist" id="itemslider">
   
                        <?php foreach( $books as $book ){ ?>
                           
                            <div class="authors-bookslist-item activeSlide">
                            <a id="authors-booklist-link" href="<?php the_permalink($book->ID); ?>">
                            <div class="single-author-books-content">
                                <?php echo get_the_post_thumbnail( $book->ID ); ?>
                                   
                                    <h2 class="heading-2"><?php echo get_the_title( $book->ID ); ?></h2>
                                    </div>
                                    </a>
                                   
                                    </div>
                            <?php }?>
                            </div>

                    </div>
              <?php  }?>
        </div>
    <?php }?>
        </div>
        </div>
    </section>
  </div>
</div>
<?php
  get_footer();
