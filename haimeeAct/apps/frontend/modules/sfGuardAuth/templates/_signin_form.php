<?php use_helper('I18N') ?>
<?php use_helper('Melody') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" class="wufoo" style="text-align: center">
	
	<div class="info">
	  <h2>
		Login
	  </h2>
	  <p>
	  </p>
	</div>
	<div style="margin:10px 0 20px">
		
		<table border="0" cellspacing="5" cellpadding="5" style="margin:0 auto;">
			<tr>
				<td >
					<div style="border: 1px solid #D1CDCD;">
						<p style="background-color:#D1CDCD;line-height: 25px;text-align:left;padding-left:10px">Login with Haimee</p>
					<table style="margin: 0pt auto; text-align: left;">
					    <tbody>
					      <?php echo $form ?>
					    </tbody>
					    <tfoot>
					      <tr>
					        <td colspan="2">
								<a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong>Login</strong><span></span></a>	
								<input type="submit" style="padding: 0pt; border: medium none;width:0px" value=""/>	
					          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
					          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
					            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>" style="font-size: 80%;text-decoration: none;"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
					          <?php endif; ?>

					        </td>
					      </tr>
					    </tfoot>
					  </table>
					</div>
				</td>
				<td style="padding:10px;text-align: left;">
					<div class="sns-login">
					<a class="" href="<?php echo url_for('@linkedin_connect') ?>" title="Signin with Linkedin"><img src="/images/linkedin-login.png"></a>
					</div>
					
					
					<!-- <div class="sns-login">
										<a class="" href="<?php echo url_for('@weibo_connect') ?>" title="Signin with weibo"><img src="/images/weibo-login.png"></a>
										<br/>
										<p>安全轻松，一步搞定</p>
										</div> -->
					<div class="sns-login">
					<a class="fb_button fb_button_medium" href="<?php echo url_for('@facebook_connect') ?>" title="Signin with Facebook"><span class="fb_button_text">Signin with Facebook</span></a>
					</div>
				</td>
			</tr>
		</table>
		
	</div>
  
</form>