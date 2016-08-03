<?php 
//wordpress will include this file at the top of every page 
//of the theme, admin, login, feeds...

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'quote', 'image', 'gallery', 'audio', 'video', 'chat', 'aside', 'status', 'link' ) );

				//name 	  width  height  crop?
add_image_size( 'banner', 1200, 300, true );
add_image_size( 'skinny-banner', 1200, 150, true );
//use force regenerate thumbnails to resize all your images!

//no close php!