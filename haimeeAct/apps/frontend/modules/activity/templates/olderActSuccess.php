<?php slot('title') ?>
	Older Activities
<?php end_slot() ?> 

<?php include_partial('activity/list', array('activities' => $activities,'mode' => 'common')) ?>