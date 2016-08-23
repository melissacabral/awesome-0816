<?php 
/*
Template Name: Products sorted by brand
*/

get_header();  //include header.php ?>
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
			<div class="entry-content">
				
				<?php 			
				//show the featured image
				the_post_thumbnail('large');
				the_content();			
				?>
			</div>
			
		</article>
		<!-- end post -->
		<?php 
			}//end while
		}else{ ?>
			<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>	


		<?php 
		//get all the brands
		$terms = get_terms('brand');
		
		//go through each term, showing a list of procucts
		foreach( $terms as $term ){
			?>
			<h2><?php echo $term->name; ?> (<?php echo $term->count; ?>)</h2>

			<?php
			//get up to 3 products in this term
			$custom_query = new WP_Query( array(
				'post_type' 		=> 'product',
				'posts_per_page' 	=> 3,
				'taxonomy'			=> 'brand',
				'term'				=> $term->slug,
			) );

			if( $custom_query->have_posts() ){
			?>
			<ul>
				<?php while($custom_query->have_posts()){ 
					$custom_query->the_post();
				?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnail'); ?>
						<h3><?php the_title(); ?></h3>
					</a>
				</li>
				<?php }  //end while ?>
			</ul>
			<?php 
			}//end if
			wp_reset_postdata();
			
		} //end foreach
		?>



	</main>
	<!-- end #content -->


<?php get_sidebar('page'); //include sidebar-page.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>