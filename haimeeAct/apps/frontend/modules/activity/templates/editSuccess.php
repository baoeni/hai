<?php slot('title') ?>
  Edit an Activity - Basic Info
<?php end_slot() ?>

<?php slot('form_info_titile') ?>
  Modify Activity - <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php slot('form_info_verbose') ?>
  fill in the content below to modify your activity!
<?php end_slot() ?>

<?php include_partial('form', array('form' => $form)) ?>