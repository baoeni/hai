<?php slot('title') ?>
  Activity - Payment transfer detail
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

  <div class="info">
    <h2>Payment transfer detail: </h2>
	<div style="color:blue">Note: Please transfer the payment to organizer by yourself!</div>
  </div>
	<table>
		    <tbody>
				<tr>
			  		<th>1. Total cost:</th>
			  		<td>&euro; <?php echo $user_activity->getOrderFeesTotal(); ?></td>
				  </tr>
		      <tr>
		  		<th>2. Organizer's bank account:</th>
		  		<td><?php echo $activity_organizer->getSfGuardUserProfile()->getBankAccountInfo(); ?> </td>
			  </tr>
			  <tr>
		  		<th style="color:blue">3. Please mention your name:</th>
		  		<td style="color:blue"><?php echo $sf_user->getGuardUser()->getUsername()?></td>
			  </tr>
			<tr>
		  		<th>4. Click links to your own Internet Banking site:</th>
		  		<td>
		  			<a class="bank_transfer" href="https://bankieren.rabobank.nl/klanten" target="_blank"><img src="https://bankieren.rabobank.nl/rabo/qsl/images/rabobank_logo.gif" alt="Rabo bank"/></a>
		  			<a class="bank_transfer" href="https://www.abnamro.nl/nl/dashboard/overview.html" target="_blank"><img src="http://www.abnamro.nl/nl/images/Systeem/abnamroNL/Content/includes/images/System/Includes/gfx/Logo_Transparent.gif" alt="ABN AMRO bank"/></a>
		  			<a class="bank_transfer" href="https://mijn.ing.nl/internetbankieren/SesamLoginServlet" target="_blank"><img src="https://mijn.ing.nl/internetbankieren/gfx/SES_logo_ing.gif" alt="ING bank"/></a>
					<div style="clear:both"></div>
		  		</td>
			  </tr>
		</tbody><tfoot>
	      <tr>
	        <td colspan="2">
				<a class="Button Button11 WhiteButton" href="<?php echo url_for('activity_show', $activity) ?>"><strong>Back to Activity</strong><span></span></a>
				<a class="Button Button11 WhiteButton" href="<?php echo url_for('activity_show', $activity) ?>"><strong>Pay later</strong><span></span></a>
	        </td>
	      </tr>
	    </tfoot>
	</table>
</div>