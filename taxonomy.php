<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
		<?php //THE LOOP
		if( have_posts() ){  ?>

			<h1>
			<?php
			//how to use conditional tags to tell which taxo we are viewing
			if(is_tax('brand')){
				echo 'Products By ';
			}elseif(is_tax('feature')){
				echo 'Products Featuring: ';
			}	
			 ?>		

			<?php single_term_title(); ?></h1>

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
			<?php the_terms( get_the_id(), 'brand', '<h3>', ', ', '</h3>' ); ?>

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



<?php get_sidebar('shop'); //include sidebar-shop.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>