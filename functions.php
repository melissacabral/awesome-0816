<?php 
//wordpress will include this file at the top of every page 
//of the theme, admin, login, feeds...

//the width of auto-embeds, like youtube, vimeo, twitter, etc
if ( ! isset( $content_width ) ) $content_width = 670;



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
	//are we viewing a single product?
	if( is_singular('product') ){
		//fancy pagination with post thumbnails
		$next_product = get_next_post();
		$prev_product = get_previous_post();
		?>
		<h3>More Products:</h3>

		<?php if($prev_product){ ?>
			<a href="<?php echo get_permalink( $prev_product ); ?>">
				<?php echo get_the_post_thumbnail( $prev_product, 'thumbnail' ); ?>
				<h4><?php echo $prev_product->post_title; ?></h4>
			</a>
		<?php } //end if prev product exists 

		if($next_product){
			?>		
			<a href="<?php echo get_permalink( $next_product ); ?>">
				<?php echo get_the_post_thumbnail( $next_product, 'thumbnail' ); ?>
				<h4><?php echo $next_product->post_title; ?></h4>
			</a>
			<?php
		} //end if next product 

	}elseif( is_singular('post') ){
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

/**
 * Register all the widget areas we need
 * Call dynamic_sidebar() in the templates to display 
 */
add_action( 'widgets_init', 'awesome_widget_areas' );
function awesome_widget_areas(){
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id' 			=> 'home-area',
		'description' 	=> 'appears on the front page near the middle of the page',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		));

	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog-sidebar',
		'description' 	=> 'These widgets will appear next to the blog and search results',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		));

	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id' 			=> 'page-sidebar',
		'description' 	=> 'appears next to static pages',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		));
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer-area',
		'description' 	=> 'appears on the bottom of everything',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		));

	
}


// add jquery!
add_action( 'wp_enqueue_scripts', 'awesome_scripts' );
function awesome_scripts(){

	//attach jquery (built in to WP)
	wp_enqueue_script( 'jquery' );
	//attach our custom js
	$js = get_stylesheet_directory_uri() . '/js/main.js';
	wp_enqueue_script( 'awesome-js', $js, array('jquery') );
}



/**
 * Adjust the comments_number to reflect real comments 
 * and not pingbacks, trackbacks, or moderated comments
 */
add_filter('get_comments_number', 'awesome_comment_count', 0);
function awesome_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
} 


/**
 * Get some recent products with thumbnails
 * @return mixed HTML
 */
function awesome_products( $number = 5 ){
	//custom query to get up to 5 newest products
	$product_query = new WP_Query( array(
		'post_type' 		=> 'product',  	//any registered post type
		'posts_per_page' 	=> $number,		//limit
	) );

	if( $product_query->have_posts() ){ ?>
	
	<section class="featured-products">
		<h2>Newest Products:</h2>
		<ul>
		<?php while( $product_query->have_posts() ){
				$product_query->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<div class="caption">
						<h3><?php the_title(); ?></h3>
						<div><?php echo get_post_meta( get_the_id(), 'price', true ); ?></div>
					</div>
				</a>
			</li>
		<?php } //end while ?>
		</ul>
	</section>
	<?php 
	} //end of custom loop 
	//clean up
	wp_reset_postdata();
}


/**
 * Example of altering a default loop
 */
add_action( 'pre_get_posts', 'awesome_blog_exclude_cat' );
function awesome_blog_exclude_cat( $query ){
	if( is_home() ){
		$query->set( 'category__not_in', array(29) );
	}
}


/**
 * Theme Customization options
 * 1. custom "container" color
 * 2. link color
 * 3. choose which side the sidebar is on
 * 2. choose from some fonts
 */
add_action( 'customize_register', 'awesome_customizer' );
function awesome_customizer($wp_customize){
	//1. register the setting for the container color
	$wp_customize->add_setting('awesome_container_color', array( 'default' => '#ffffff' ));
	//1. add the form control for the container color
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'awesome_container_color_ui',
		array(
			'label' 	=> 'Container Color',
			'section' 	=> 'colors', //built in
			'settings' 	=> 'awesome_container_color', //the one added in the last step
		)
	) );

	//2. link color setting
	$wp_customize->add_setting( 'awesome_link_color', array('default' => '#4f92bd') );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'awesome_link_color_ui',
		array(
			'label' 	=> 'Link Color',
			'section' 	=> 'colors',
			'settings' 	=> 'awesome_link_color',
		)
	));

	//3. add a new section for "design" options
	$wp_customize->add_section( 'awesome_design_section', array(
		'title' => 'Design',
		'priority' => 30,
	) );
	//3. setting for sidebar position
	$wp_customize->add_setting( 'awesome_sidebar_position', 
		array( 'default' => 'right' ) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'awesome_sidebar_position_ui',
		array(
			'label' 	=> 'Sidebar Position',
			'section' 	=> 'awesome_design_section',
			'settings' 	=> 'awesome_sidebar_position',
			'type' 		=> 'radio',
			'choices'	=> array(
				'left' 		=> 'Left Side',
				'right' 	=> 'Right Side',
			),
		)
	) );

 	//4. fonts dropdown
 	$wp_customize->add_setting( 'awesome_font', array( 'default' => 'Playfair Display' ) );
 	$wp_customize->add_control( new WP_Customize_Control(
 		$wp_customize,
 		'awesome_font_ui',
 		array(
 			'label' 	=> 'Heading Font',
 			'section' 	=> 'awesome_design_section',
 			'settings'	=> 'awesome_font',
 			'type' 		=> 'select',
 			'choices' 	=> array(
 				'Playfair Display' 	=> 'Playfair',
 				'Fjalla One' 		=> 'Fjalla',
 				'Montserrat'		=> 'Montserrat',
 			),
 		)
 	) );
}

//Embedded CSS for the customizations!
add_action( 'wp_head', 'awesome_custom_css' );
function awesome_custom_css(){
	?>
	<style>
		#content{
			background-color:<?php echo get_theme_mod( 'awesome_container_color' ); ?> ;
		}
		a{
			color:<?php echo get_theme_mod( 'awesome_link_color' ); ?> ;
		}
		input[type=submit], button{
			background-color: <?php echo get_theme_mod( 'awesome_link_color' ); ?>;
			color: <?php echo awesome_contrast( get_theme_mod( 'awesome_link_color' ) ) ?> !important;
		}

		<?php if( get_theme_mod( 'awesome_sidebar_position' ) == 'left' ){ ?>
			#sidebar{
				float:left;
			}
			#content{
				float:right;
			}

		<?php } ?>

		h1, h2, h3, h4{
			font-family:'<?php echo get_theme_mod('awesome_font'); ?>', Georgia, serif;
		}
	</style>
	<?php 
}

//enqueue the google font file
add_action( 'wp_enqueue_scripts', 'awesome_google_font' );
function awesome_google_font(){
	//make sure to convert spaces to '+' for the google url
	$font = str_replace(' ', '+', get_theme_mod('awesome_font'));
	$url = 'https://fonts.googleapis.com/css?family=' . $font;
	wp_enqueue_style( 'awesome_font', $url );
}



//for outputting Black or White to contrast with any background
//// https://24ways.org/2010/calculating-color-contrast/
function awesome_contrast($hexcolor){
	$r = hexdec(substr($hexcolor,0,2));
	$g = hexdec(substr($hexcolor,2,2));
	$b = hexdec(substr($hexcolor,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? 'black' : 'white';
}



/**
 * Create a custom widget
 */
add_action( 'widgets_init', 'awesome_register_widget' );
function awesome_register_widget(){
	register_widget('Awesome_Simple_Widget');
}
//make our widget from a copy of the built in widget class
class Awesome_Simple_Widget extends WP_Widget{
	//constructor function
	function __construct(){
		$widget_ops = array(
			'class_name' => 'awesome_widget',
			'description' => 'Just the most basic widget',
		);
		parent:: __construct( 'awesome_widget', 'Awesome Widget', $widget_ops );
	}
	//widget output function
	// $args = array. arguments from register_sidebar
	// $instance = array. current settings of one instance of this widget
	function widget( $args, $instance ){
		extract($args);

		echo $before_widget; //<section>

		$title = apply_filters( 'widget_title', $instance['title'] );

		if($title){
			echo $before_title . $title . $after_title;
		}

		//This is where the widget output goes
		awesome_products($instance['number']);

		echo $after_widget; //</section>
	}

	//admin form function
	function form( $instance ){
		//set up default values
		$defaults = array(
			'title' 	=> 'Default Title goes here',
			'number'	=> 2,
		);

		//apply the defaults to the form values
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>

			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" 
			id="<?php echo $this->get_field_id('title'); ?>" 
			value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of Products:</label>

			<input type="number" name="<?php echo $this->get_field_name('number'); ?>" 
			id="<?php echo $this->get_field_id('number'); ?>" 
			value="<?php echo $instance['number']; ?>" class="tiny-text">
		</p>

		<?php
	}

	//update/sanitize function
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		
		//sanitize each field
		$instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
		$instance['number'] = wp_filter_nohtml_kses( $new_instance['number'] );

		return $instance;
	}
}


//no close php!