<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?> - <?php bloginfo( 'description' ); ?></title>
	<link rel="stylesheet" type="text/css" 
		href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css">
		
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //hook. required for the admin bar and plugins to work ?>
</head>
<body <?php body_class(); ?>>
	<header role="banner" id="header">
		<h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo( 'description' ); ?></h2>
		<nav>
			<ul class="nav">
				<?php wp_list_pages( array(
					'depth' 	=> 1,
					'title_li' 	=> '',
					'exclude' 	=> '735,174', //list of page IDs to hide
				) ); ?>
			</ul>
		</nav>

		<?php get_search_form(); //include searchform.php OR WP's default search form ?>
	</header>