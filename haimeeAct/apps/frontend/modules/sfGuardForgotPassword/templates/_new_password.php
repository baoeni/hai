
<?php slot('header1') ?>
  New Password
<?php end_slot() ?>

<?php slot('header2') ?>
<?php end_slot() ?>

<?php slot('content') ?>

Below is your username and new password:
<br/>
Username : <?php echo $user->getUsername() ?> 
<br/>
Password : <?php echo $password ?>
<br/>
<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>