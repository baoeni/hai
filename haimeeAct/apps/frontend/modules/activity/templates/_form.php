<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="wufoo" action="<?php echo url_for('activity/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<!--
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
-->

<div class="info">
  <h2>
    <?php if (!include_slot('form_info_titile')): ?>
	  Create Activity - Step1 - Basic Information
    <?php endif ?>
  </h2>
  <p>
    <?php if (!include_slot('form_info_verbose')): ?>
	  fill in the content below to start your activity!
    <?php endif ?>
  </p>
</div>

<?php include_partial('activity/form_error', array('form' => $form)) ?>

<?php echo form_tag_for($form, '@activity') ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong>Submit</strong><span></span></a>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>

</form>