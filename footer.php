	</div><!-- end .wrapper -->
	

	<footer id="footer" role="contentinfo">

		<?php wp_nav_menu( array(
			'theme_location' 	=> 'footer_menu',
			'fallback_cb' 		=> '',
			'container_class'	=> 'footer-menu',
		) ); ?>

		&copy; 2015 by <?php bloginfo( 'name' ); ?>. All Rights Reserved.
	</footer>



<?php wp_footer(); //hook. required for admin bar and plugins to work ?>
</body>
</html>