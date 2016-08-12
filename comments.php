<?php //if the post is password protected, hide the comments
if(post_password_required()){
	return; //stop the rest of the file from running
} 
//Count the number of trackbacks and pingbacks. 
//see functions.php for the correct way to adjust "comments_number"
$comments_by_type = separate_comments( $comments );
$pings_count = count($comments_by_type['pings']);
?>
<section class="comments">
	<h2>

		<?php comments_number(  'No comments yet', 'One comment', '% Comments' ); ?> 

		<?php if(comments_open()){ ?>
			| <a href="#respond">Leave a comment</a>
		<?php } ?>
	</h2>

	<ol class="commentlist">
		<?php wp_list_comments(array(
			'type' => 'comment', //just real human comments
		)); ?>
	</ol>

	<?php 
	//check to see if comment pagination is needed
	if( get_option( 'page_comments' ) AND get_comment_pages_count() > 1 ){ ?>

	<div class="comment-pagination pagination">
		<?php previous_comments_link(); ?>
		<?php next_comments_link(); ?>
	</div>

	<?php } //end if comment pagination is needed ?>

	<?php comment_form(); ?>
</section>



<?php if( $pings_count != 0 ){ ?>
<section class="pingbacks">
<h2> <?php echo $pings_count; ?> Sites mention this post:</h2>

	<ol class="pingslist">
		<?php wp_list_comments(array(
			'type' => 'pings', //pingbacks and trackbacks
		)); ?>
	</ol>	

</section>
<?php } //end if there are pingbacks ?>