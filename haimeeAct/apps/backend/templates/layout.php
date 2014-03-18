<?php use_helper('I18N') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>
		<?php if (!include_slot('title')): ?>
			Haimee Activity - Your best choice
		<?php endif ?>
	</title>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/favicon.ico" />
	<!-- JavaScript -->
	<!-- CSS -->
	<?php use_stylesheet('main.css') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body class="<?php if (!include_slot('bodyClass')): ?><?php endif ?>">
    <div class="header">
      <div id="logo">
	    <a href="<?php echo url_for('sf_guard_user') ?>" title="index"><img width="200" height="53" alt="haimeeAct Logo" src="/images/haimeeActLogo3.png"></a>
	  </div>
	  
	<h1 style="font-size: 54px;left: 300px;  position: absolute;">Admin</h1>
	  
	<?php if ($sf_user->isAuthenticated()): ?>	
	<ul id="menu" style="left:500px">
		<li>
		  <a href="<?php echo url_for('sf_guard_user') ?>">users</a>&nbsp; · &nbsp;
		</li>
        <li>
		  <a href="<?php echo url_for('sf_guard_permission', $sf_user->getGuardUser()) ?>">permissions</a>&nbsp;
		</li>
		<li>&nbsp; · &nbsp;
		  <a href="<?php echo url_for('sf_guard_group', $sf_user->getGuardUser()) ?>">groups</a>
		</li>
	  </ul>
		<?php endif ?>			
		
      <div id="search">
		<form action="index_submit" method="post" accept-charset="utf-8">
		  <input type="text" name="search_key" value="" id="search_key" />
			<a class="lg" href="#" id="query_button"><img alt="" src="/images/search.gif"></a>
		</form>
	  </div>
		
	  <div id="login">
	    <?php if ($sf_user->isAuthenticated()): ?>
<?php echo $sf_user->getUsername() ?>
          <a href="<?php echo url_for('sf_guard_signout') ?>">Logout</a>
		<?php else: ?>
	      <a href="<?php echo url_for('sf_guard_signin') ?>">Login</a>
		  <!-- <a href="<?php echo url_for('sf_guard_register') ?>">Register</a> -->
		<?php endif ?>
	  </div>
		
			
    </div>
	
    
    <div id="container">
	  <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_notice">
          <?php echo $sf_user->getFlash('notice') ?>
        </div>
      <?php endif ?>
 
      <?php if ($sf_user->hasFlash('error')): ?>
        <div class="flash_error">
          <?php echo $sf_user->getFlash('error') ?>
        </div>
      <?php endif ?>
 
      <?php echo $sf_content ?>
    </div>
    
	
	<div id="footer">
	  <ul>
	    <!-- <li><a href="#">about us</a> · &nbsp;</li>
	    	    <li><a href="#">contact us</a> · &nbsp;</li>	
	    	    <li><a href="#">feedback</a> · &nbsp;</li>				
	    	    <li><a href="#">help</a></li>				 -->
	  </ul>
	</div>
  
  </body>

</html>
