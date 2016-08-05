<?php 
//wordpress will include this file at the top of every page 
//of the theme, admin, login, feeds...

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'quote', 'image', 'gallery', 'audio', 'video', 'chat', 'aside', 'status', 'link' ) );

				//name 	  width  height  crop?
add_image_size( 'banner', 800, 200, true );
//use force regenerate thumbnails to resize all your images!

//wakes up panels in the 'customize' screen
add_theme_support( 'custom-background' );

//don't forget to add header_image() somewhere in your templates
add_theme_support( 'custom-header', array(
					'width' => 1200,
					'height' => 400,
					'flex-height' => true,
				) );

//put the_custom_logo() anywhere in your templates
add_theme_support( 'custom-logo', array( 
					'width' => 180,
					'height' => 50,
				 ) );

add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//SEO-friendly <title> tags. delete <title>tag  from your header first!
add_theme_support( 'title-tag' );

//adds contextual RSS feeds for every tag, category, author, and post
add_theme_support( 'automatic-feed-links' );

//support for editor-style.css
add_editor_style();


/**
 * Make the excerpt better
 */
add_filter( 'excerpt_length', 'awesome_ex_length' );

function awesome_ex_length(){
	//default is 55 words
	//this condition will apply a different length on the search results
	if( is_search() ){
		return 25;
	}else{
		return 75;
	}
}

//replace the [...] with a button
add_filter( 'excerpt_more', 'awesome_ex_more' );
function awesome_ex_more(){
	return '&hellip; <a href="' . get_permalink() . '" class="button">Continue Reading</a>';
}


/**
 * Improve Comment UX with Javascript
 */
add_action( 'wp_enqueue_scripts', 'awesome_comment_reply' );

function awesome_comment_reply(){
	if( is_single() AND comments_open() ){
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Add 3 menu areas
 * Don't forget to put wp_nav_menu in your templates to display menus
 * Then go to appearance > menus to configure!
 */
add_action( 'init', 'awesome_menu_areas' );
function awesome_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Area',
		'footer_menu' => 'Footer Navigation Area',
		'social_menu' => 'Social Media Links',
	) );
}

/**
 * Helper function:  pagination
 * just call this func wherever you want pagination links
 */
function awesome_pagination(){
	echo '<div class="pagination">';
	//are we viewing a single post?
	if( is_singular() ){
		previous_post_link( '%link' , '&larr; Older Post');
		next_post_link( '%link', 'Newer Post &rarr;' );
	}else{
		//archive 
		if( function_exists( 'the_posts_pagination') && !wp_is_mobile() ){
				the_posts_pagination( array(
					'next_text' => 'Next Page &rarr;',
					'prev_text' => '&larr;',
					'mid_size' 	=> 2,  //show more numbers in the middle 
			) );
		}else{
			previous_posts_link('&larr; Newer Posts'); 
			next_posts_link('Older Posts &rarr;'); 
		}
	}
	echo '</div>';
}


//no close php!