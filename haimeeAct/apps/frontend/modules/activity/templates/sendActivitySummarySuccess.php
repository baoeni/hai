<?php slot('title') ?>
  <?php echo sprintf('activity - %s', $activity->getName()) ?>
<?php end_slot() ?>


<form class="wufoo" action="<?php echo url_for('send_activity_summary_do_send', $activity) ?>" method="post">

			<div class="info">
			<h2>send summary of this activity </h2>
			<div>send summary of this activity to your attenders!</div>
			</div>

			<?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

            
			<h2 style="margin-top:20px">Add summary here:</h2>
			<textarea name="content" dir="ltr" style="width: 600px; overflow-x: hidden; overflow-y: hidden; height: 3em; -moz-box-sizing:border-box" class="twitter-anywhere-tweet-box-editor" id="commentbox"></textarea>
			
			<br/>
			<br/>
			<a class="Button Button13 WhiteButton" onclick="$('form.wufoo').submit();"><strong>Submit</strong><span></span></a>
			
</form>