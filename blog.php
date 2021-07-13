<?php
  
  get_header(); ?>
  <section class="page-container">
  <div class="page-content">
    <?php
  while(have_posts()) {
    the_post(); 
    
       ?>
     <div class="single-card-content">
                tere
               
                <div class="text">
                    <h1 class="card-title"> <?php the_title(); ?> </h1>
                   
                   <?php 
                  
                    the_content()?>
                    </div>
              
                </div>


  <?php }
?>


</section>
</div>

<?php
  get_footer();

?>