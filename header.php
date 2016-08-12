<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" 
	href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css">

	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //hook. required for the admin bar and plugins to work ?>
</head>
<body <?php body_class(); ?>>

	<header id="header" style="background-image:url(<?php header_image() ?>)">	
		<div class="header-bar">
		<?php 
		//CUSTOM LOGO
		if( function_exists( 'the_custom_logo' ) AND has_custom_logo() ){
			the_custom_logo();
		}else{ ?>
		<h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
		<?php } ?>
		<h2><?php bloginfo( 'description' ); ?></h2>


		<?php wp_nav_menu( array(
			'theme_location' 	=> 'main_menu', //registered in functions.php
			'container'			=> 'nav', //wrap in <nav> instead of <div>
			'container_class' 	=> 'menu', // <nav class="menu">
			'menu_class'		=> '', //no class on the <ul>
			'fallback_cb'		=> '',  //if no menu, do nothing
		) ); ?>

		<?php get_search_form(); //include searchform.php OR WP's default search form ?>
		</div>
	</header>
	<div class="wrapper">