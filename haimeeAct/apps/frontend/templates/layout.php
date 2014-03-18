<?php use_helper('I18N') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>
		Haimee Activity 海米活动 - 
		<?php if (!include_slot('title')): ?>
			Your best choice
		<?php endif ?>
	</title>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta property="wb:webmaster" content="e0f22d775356bfd2" />
	<meta name="google-site-verification" content="T-B7g-fk0WdSXnQkOyIEimcxtVl8pFjrF8pxLRAdars" />
    <link rel="shortcut icon" href="/favicon.ico" />
	<!-- JavaScript -->
	<!-- CSS -->
	<?php use_stylesheet('main.css') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			setTimeout(function() {
				$('.flash_notice').fadeOut('slow');
			}, 5000);
		});
	</script>
	<script type="text/javascript" charset="utf-8">
		// Checks the browser and adds classes to the body to reflect it.

		$(document).ready(function(){

		    var userAgent = navigator.userAgent.toLowerCase();
		    $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase()); 

		    // Is this a version of IE?
		    if($.browser.msie){
		        $('body').addClass('msie');

		        // Add the version number
		        $('body').addClass('msie' + parseInt($.browser.version));
		    }


		    // Is this a version of Chrome?
		    if($.browser.chrome){

		        $('body').addClass('webkit chrome');

		        //Add the version number
		        $('body').addClass('chrome' + parseInt($.browser.version));

		        // If it is chrome then jQuery thinks it's safari so we have to tell it it isn't
		        $.browser.safari = false;
		    }

		    // Is this a version of Safari?
		    if($.browser.safari){
		        $('body').addClass('webkit safari');

		        // Add the version number
		        $('body').addClass('safari' + parseInt($.browser.version));
		    }

		    // Is this a version of Mozilla?
		    if($.browser.mozilla){

		        //Is it Firefox?
		        if(navigator.userAgent.toLowerCase().indexOf('firefox') != -1){
		            $('body').addClass('firefox');

		            // Add the version number
		            $('body').addClass('firefox' + parseInt($.browser.version));
		        }
		        // If not then it must be another Mozilla
		        else{
		            
		        }
		    }

		    // Is this a version of Opera?
		    if($.browser.opera){
		        $('body').addClass('opera');
		    }


		});
		
		if (!("ontouchstart" in document.documentElement)) {
		    document.documentElement.className += " no-touch";
		}
		
	</script>
	<?php $route = $sf_context->getInstance()->getRouting()->getCurrentRouteName(); ?>
  </head>
  <body class="<?php if (!include_slot('bodyClass')): ?><?php endif ?>">
	<!-- ClickTale Top part -->
	<script type="text/javascript">
	var WRInitTime=(new Date()).getTime();
	</script>
	<!-- ClickTale end of Top part -->
	
	<div class="navbar  ">
	    <div class="navbar-inner">
	      <div class="container">
	        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </a>
	<a href="<?php echo url_for('@homepage') ?>" class="brand" title="index"><img width="100" height="26" alt="haimeeAct Logo" src="/images/haimeeActLogo3.png"></a>
	        <div class="nav-collapse">
	          <ul class="nav">
	            <li <?php if ($route == 'homepage'): ?>class="active"<?php endif ?>><a href="<?php echo url_for('@homepage') ?>">Home</a></li>
				<li <?php if ($route == 'older_activity'): ?>class="active"<?php endif ?>><a href="<?php echo url_for('@older_activity') ?>">Previous Activities</a></li>
				<?php if ($sf_user->isAuthenticated()): ?>	  

				<?php if ($sf_user->getGuardUser()->getAttendedActivitiesNumber() > 0): ?>
					
					<li <?php if ($route == 'user_activity_attended'): ?>class="active"<?php endif ?>>
					  <a href="<?php echo url_for('user_activity_attended', $sf_user->getGuardUser()) ?>">activity attended <span class="noteBadge"><?php echo $sf_user->getGuardUser()->getAttendedActivitiesNumber() ?></span></a>
					</li>
				<?php endif ?>

				<?php if ($sf_user->hasCredential('activity_admin') && $sf_user->getGuardUser()->getOrganizedActivitiesNumber() > 0): ?>
				
				<li <?php if ($route == 'user_activity_organized'): ?>class="active"<?php endif ?>>
				  <a href="<?php echo url_for('user_activity_organized', $sf_user->getGuardUser()) ?>">activity organized <span class="noteBadge"><?php echo $sf_user->getGuardUser()->getOrganizedActivitiesNumber() ?></span></a>
				</li>
				<?php endif ?>

				<?php endif ?>
	            
				<?php if ($sf_user->hasCredential('activity_admin')): ?>
				     <li><a class="Button RedButton Button13" href="<?php echo url_for('activity_new') ?>" style="margin:6px;padding:3px"><strong>Add Activity</strong><span></span></a></li>
				<?php endif ?>
				
	          </ul>
	
	          <!-- <form action="" class="navbar-search pull-left">
		            <input type="text" placeholder="Search" class="search-query span2">
		          </form> -->
	          <ul class="nav pull-right">
				<?php if ($sf_user->isAuthenticated()): ?>
					<li class="dropdown">
		              <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="padding:4px 0 0 0 ">
				<img width="30" height="30" alt="Picture of <?php echo $sf_user->getGuardUser()->getUsername()?>" src="/uploads/avatar/<?php $avatar = $sf_user->getGuardUser()->getSfGuardUserProfile()->getSmallAvatar(); echo $avatar ? $avatar : 'avatar.png' ?>"/>
				 <b class="caret"></b></a>
		              <ul class="dropdown-menu">
		                <li><a href="<?php echo url_for('user_profile_show', $sf_user->getGuardUser()) ?>">Profile</a></li>
		                <li class="divider"></li>
						<li><a href="<?php echo url_for('sf_guard_signout') ?>">Logout</a></li>
		              </ul>
		            </li>
		          
				<?php else: ?>
			      <li><a href="<?php echo url_for('sf_guard_signin') ?>">Login</a></li>
				  <li class="divider-vertical"></li>
				  <li><a href="<?php echo url_for('sf_guard_register') ?>">Register</a></li>
				<?php endif ?>
	            
	            
	            
	          </ul>
			<ul class="nav pull-right">
				<li><a href="<?php echo url_for('aboutus') ?>" style="font-size:15px;">什么是海米活动？</a></li>
			</ul>
	        </div><!-- /.nav-collapse -->
	      </div>
	    </div><!-- /navbar-inner -->
	  </div>
    
    <div id="container" >
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
    
	
	<div id="footer" >
	  <ul>
	    <li><a href="<?php echo url_for('aboutus') ?>">about us</a> · &nbsp;</li>
	    <li><a href="<?php echo url_for('contactus') ?>">contact us</a> · &nbsp;</li>	
	    <li><a href="<?php echo url_for('term') ?>">term and conditions</a></li>				
	    <!-- <li><a href="#">help</a></li>				 -->
	  </ul>
	</div>
  	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36661185-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	
	<!-- ClickTale Bottom part -->
	<div id="ClickTaleDiv" style="display: none;"></div>
	<script type="text/javascript">
	if(document.location.protocol!='https:')
	  document.write(unescape("%3Cscript%20src='http://s.clicktale.net/WRd.js'%20type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	if(typeof ClickTale=='function') ClickTale(10884,0.9,"www14");
	</script>
	<!-- ClickTale end of Bottom part -->
	
  </body>

</html>
