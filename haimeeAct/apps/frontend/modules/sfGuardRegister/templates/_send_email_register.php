<?php slot('header1') ?>
  Welcome to 海米活动!
<?php end_slot() ?>

<?php slot('header2') ?>
Find many activities organized for you from <a href="<?php echo url_for('@homepage',true) ?>" >海米活动 haimee.com!</a>
<?php end_slot() ?>

<?php slot('content') ?>
<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>