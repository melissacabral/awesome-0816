<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
	<?php //THE LOOP
	if( have_posts() ){ 
		while( have_posts() ){ 
			the_post();  ?>
			<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title"> 
					<a href="<?php the_permalink(); ?>"> 
						<?php the_title(); ?>
					</a>
				</h2>

				<?php the_terms( get_the_id(), 'brand', '<h3>', ', ', '</h3>' ); ?>

				<div class="entry-content">

					<?php 			
					the_post_thumbnail('large');

					the_meta(); //a list of all custom fields

					the_terms( get_the_id(), 'feature', 
						'<h3>Features:</h3><ul class="features"><li>', 
						'</li><li>', 
						'</li></ul>' );
					
					the_content();					
					?>
		</div>
		
		<!-- end postmeta -->
	</article>
	<!-- end post -->


	<?php }//end while ?>

	<?php awesome_pagination(); ?>

	<?php }else{ ?>
		<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>



	</main>
	<!-- end #content -->


<?php get_sidebar('shop'); //include sidebar-shop.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>