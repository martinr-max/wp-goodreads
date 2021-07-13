<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title() ?></title>
    <?php wp_head(); ?>
</head>
<header class="header">
    <div class="header_content">
    <h1 class="heading-1">good<strong>reads</strong></h1>
    <nav class="main-navigation">
        <ul>
            <li><a href="<?php echo site_url('/') ?>">Home</a> </li>
            <li><a href="<?php echo site_url('/my-booklist') ?>">My Books</a> </li>
            <li><a href="#">Browse</a> </li>
            <li><a href="#">Community</a></li>
        </ul>
        <div class="search">
        <input type="text" placeholder="search a book">
    </div>
     
    <div class="user-profile">
    <img src="<?php echo get_theme_file_uri('/images/ben-parker-NohB3FJSY90-unsplash.jpg') ?>" alt="">
    </div>
    </nav>
   

    </div>
    
</header>
<body>
    
</body>
</html>