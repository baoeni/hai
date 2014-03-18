<?php slot('title') ?>
  Create an Activity - Step 1 - Basic
<?php end_slot() ?>

<?php slot('form_info_titile') ?>
  Create an Activity - Step 1 - Basic Information
<?php end_slot() ?>

<?php slot('form_info_verbose') ?>
  fill in the content below to start your activity!
<?php end_slot() ?>

<?php include_partial('form', array('form' => $form)) ?>