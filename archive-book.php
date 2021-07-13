<?php

get_header();

 ?>


<div class="container">

<ul class="link-list min-list">

<?php
 $relatedProfessors = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'book',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 14,
        'compare' => '=',
        'value' => 14
      )
    )
  ));
  while($relatedProfessors->have_posts()) {
    $relatedProfessors->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php }
  echo paginate_links();
?>
</ul>



</div>

<?php get_footer();

?>