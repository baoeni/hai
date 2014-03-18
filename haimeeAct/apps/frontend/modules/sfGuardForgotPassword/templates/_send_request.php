<?php use_helper('I18N') ?>

<table align="center" width="100%" bgcolor="#FAF7F7"><tbody><tr><td style="background-color:#FAF7F7"> 

<table align="center" cellpadding="5" cellspacing="0" width="710" bgcolor="#FAF7F7"><tbody><tr><td style="background-color:#FAF7F7"> 

<table align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FAF7F7">
<tbody><tr>
<td style="background-color:#FAF7F7">

<table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody>
<tr><td style="font-size:1px"><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="5" border="0"></td></tr>
<tr><td style="background-color:#c2cad3">

<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" bgcolor="#ffffff" style="border:1px solid #c2cad3">
<tbody><tr><td style="background-color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#003580">

</td></tr>
<tr>
<td align="left" bgcolor="#ffffff" style="background:#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#2C2C2C" align="center" style="border-bottom:1px solid #dae0e8">
<tbody><tr><td colspan="3" style="font-size:1px"><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="10" border="0"></td></tr>
<tr>
<td rowspan="2"><a href="<?php echo url_for('@homepage', true) ?>"><img style="display:block" src="<?php echo url_for('@homepage', true) ?>/images/haimeeActLogo3.png" width="100" height="26" border="0" alt=""></a></td>
<td width="387" style="color:#FAF7F7" valign="top" align="right">
<a style="color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:12px;text-decoration:none" href="<?php echo url_for('@homepage', true) ?>" title="Home" target="_blank">Home</a>
</td>
<td rowspan="2" width="40" align="right">
</td>
</tr>
<tr>
<td align="right">
</td>
</tr>
<tr><td colspan="3" style="font-size:1px"><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="10" border="0"></td></tr>

</tbody></table>
</td>
</tr>
<tr>
<td align="center">
<table align="center" width="550" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tbody><tr><td style="font-size:1px"><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="20" border="0"></td></tr>
<tr>
<td width="550" align="center" style="display:block;font-size:20px;color:#003580;font-family:Arial,Helvetica,sans-serif;text-decoration:none;font-weight:bold">
	  Reset password
</td>
</tr>
<tr><td style="font-size:1px"><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="5" border="0"></td></tr>
<tr>
<td align="center" style="display:block;font-size:16px;color:#003580;font-family:Arial,Helvetica,sans-serif;text-decoration:none;font-weight:normal">
	<?php if (!include_slot('header2')): ?>
		
	<?php endif ?>
</td>
</tr>
<tr><td style="font-size:1px"><!-- <img src="/images/clear.gif" height="40" border="0"> --></td></tr>

</tbody></table>
</td>
</tr>
<tr>
<td align="center">
	<table border="0" cellspacing="0" cellpadding="0" width="600">
		<tr><td>
				<!-- content -->
				This e-mail is being sent because you requested information on how to reset your password.<br/><br/>

				You can change your password by clicking the below link which is only valid for 24 hours<br/><br/>

				<?php echo link_to('Click to change password', '@sf_guard_forgot_password_change?unique_key='.$forgot_password->unique_key, 'absolute=true') ?>
				
				<img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="10" border="0">
			<!-- content end -->
		</td></tr>
	</table>
</td>
</tr>
<!-- footer -->
<tr><td >
<table width="100%" cellpadding="20" cellspacing="0" border="0">
<tbody><tr>
<td style="background-color:#edf1f7" width="100%" align="center">
	
	<table border="0" cellpadding="0" cellspacing="0" width="600" style="color:#ffffff;font-family:Helvetica;font-size:14px;line-height:100%;text-shadow:0 1px 0 #f9e8d2">
	                                                    <tbody><tr>
	                                                        <td width="57">
	                                                            <br>
	                                                        </td>
	                                                        <td align="center" valign="middle" width="35">
	                                                            <img src="<?php echo url_for('@homepage', true) ?>/images/weibo2.gif" style="display:block;border:none;outline:none;text-decoration:none">
	                                                        </td>
	                                                        <td width="10">
	                                                            <br>
	                                                        </td>
	                                                        <td align="left" valign="middle" width="100">
	                                                            <div><a href="http://haimee.us2.list-manage2.com/track/click?u=08d10012ab9a06358d03c1fab&amp;id=e2c39661a9&amp;e=ccd6591805" style="color:#423f22;font-weight:bold;text-decoration:none" target="_blank">关注我们微博</a></div>
	                                                        </td>
	                                                        <td width="25">
	                                                            <br>
	                                                        </td>
	                                                        <td align="center" valign="middle" width="35">
	                                                            <img src="http://gallery.mailchimp.com/0d61bb2ec9002f0e9872b8c36/images/icon_facebook.7.gif" style="display:block;border:none;outline:none;text-decoration:none">
	                                                        </td>
	                                                        <td width="10">
	                                                            <br>
	                                                        </td>
	                                                        <td align="left" valign="middle" width="100">
	                                                            <div><a href="http://haimee.us2.list-manage2.com/track/click?u=08d10012ab9a06358d03c1fab&amp;id=c386b604dc&amp;e=ccd6591805" style="color:#423f22;font-weight:bold;text-decoration:none" target="_blank">Friend us<br>
	on Facebook</a> </div>
	                                                        </td>
	                                                        <td width="25">
	                                                            <br>
	                                                        </td>
	                                                        <td align="center" valign="middle" width="35">
	                                                            <img src="http://gallery.mailchimp.com/0d61bb2ec9002f0e9872b8c36/images/icon_forward.7.gif" style="display:block;border:none;outline:none;text-decoration:none">
	                                                        </td>
	                                                        <td width="10">
	                                                            <br>
	                                                        </td>
	                                                        <td align="left" valign="middle" width="100">
	                                                            <div><a href="http://us2.forward-to-friend1.com/forward?u=08d10012ab9a06358d03c1fab&amp;id=ffd8100bfa&amp;e=ccd6591805" style="color:#423f22;font-weight:bold;text-decoration:none" target="_blank">Forward this<br>
	to a Friend</a> </div>
	                                                        </td>
	                                                        <td width="57">
	                                                            <br>
	                                                        </td>
	                                                    </tr>
	     </tbody></table>
	
		<table border="0" cellpadding="0" cellspacing="0" width="600" style="color:#000000;font-family:Helvetica;font-size:14px;line-height:100%;text-shadow:0 1px 0 #f9e8d2"><tbody>
			<tr><td><img src="<?php echo url_for('@homepage', true) ?>/images/clear.gif" height="25" border="0"></td></tr>
			<tr>
			<td>
				Copyright © 2012 <?php echo link_to(__('海米活动', null, 'sf_guard'), '@homepage',array( 'absolute' => true)) ?>. All rights reserved. For more information, please read our Policy, or contact us at feedback@haimee.com.
				</td>
			</tr>		</td></tr></tbody></table>
			
<!-- footer end -->			</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>
