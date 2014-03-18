<div class="comment" id="<?php echo $comment->getId() ?>">
<?php echo include_partial('avatar', array('user' => $comment->getUser())) ?>
	<div class="comment_time"><?php echo $comment->getDateTimeObject('time')->format('M j')  ?></div>
    <div class="CommenterMeta">
	<div class="username"><a href="<?php echo url_for('user_profile_show', $comment->getUser(), true) ?>"><?php echo $comment->getUser()->getUsername() ?></a></div>
		<div class="commment-content">
			<?php echo $comment->getContent(); ?>
		
			<?php if (!is_null($comment->getSmallImage())): ?>
				<br/>
				<a class="image-zoom" href="/uploads/comments/<?php echo $comment->getImage(); ?>" title="<?php echo $comment->getContent(); ?>"><img src="/uploads/comments/<?php echo $comment->getSmallImage(); ?>"/></a>
			<?php endif ?>
		</div>
	</div>
	<?php if ($sf_user->isOrganizedActivity($activity->getId())): ?>
		<br/>
		<a  class="Button Button11 RedButton"  onclick="removeComment(<?php echo $comment->getId() ?>); return false;" style="top:-8px"><strong><em></em>Delete</strong><span></span></a>
	<?php endif ?>
</div>