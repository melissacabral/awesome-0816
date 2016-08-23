<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
		<?php //THE LOOP
		if( have_posts() ){ 
			while( have_posts() ){ 
				the_post();  ?>

		<?php 
		//show our slideshow plugin if it exists
		if( function_exists('rad_slider') ){
			rad_slider();
		}else{
			the_post_thumbnail('banner'); //custom image size - functions.php 
		}
		?>	

		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="entry-content">
				
				<?php the_content();	?>
			</div>
			
		</article>


		<?php 
		//front page is weird about getting the ID, 
		//so use this instead of get_post_id
		$id = get_option( 'page_on_front' );

		$about = get_post_meta( $id, 'about_box', true ); 
		if($about){
			?>
			<section class="about-text">
				<?php echo $about; ?>
			</section>
			<?php 
		}
		?>

		<!-- end post -->
		<?php 
			}//end while
		}else{ ?>
			<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>	


		<?php awesome_products(4); ?>

	</main>
	<!-- end #content -->


<?php get_template_part( 'section', 'homewidgets' ); //include section-homewidgets.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>