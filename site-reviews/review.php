<?php defined('ABSPATH') || die; ?>
<div class="custom-review">
{{ avatar }}
<div class="user-review" id="review-{{ review_id }}" data-assigned='{{ assigned }}'>
<div class="review_header">
{{ author }}  gave  {{ rating }}  {{ date }}

</div> 
{{ title }}   
{{ content }}
{{ response }}
</div>
</div>