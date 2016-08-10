<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
		<?php //THE LOOP
		if( have_posts() ){  ?>

			<h1><?php post_type_archive_title(); ?></h1>

		<?php while( have_posts() ){ 
				the_post();  ?>
		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
			
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium' ); ?>
			</a>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?>
				</a>
			</h2>

			<div class="entry-content">
				<?php the_excerpt(); ?>				
			</div>

			<?php 
			$price = get_post_meta( get_the_id(), 'price', true );
			if($price){
			?>
			<div class="price">
				<?php 
				//display custom field "price"
				echo $price; 
				?>
			</div>
			<?php } ?>
	
		</article>
		<!-- end post -->
		<?php }//end while ?>

		<?php awesome_pagination(); ?>

		<?php }else{ ?>
			<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>
		


	</main>
	<!-- end #content -->



<?php get_sidebar(); //include sidebar.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>