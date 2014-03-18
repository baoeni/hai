<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="symfony project" />
<meta name="robots" content="index, follow" />
<meta name="description" content="symfony project" />
<meta name="keywords" content="symfony, project" />
<meta name="language" content="en" />
<title>Haimee Activity 海米活动 - error</title>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/main.css" />

</head>
<body>
	<div class="navbar  ">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		<a title="index" class="brand" href="/"><img width="100" height="26" src="/images/haimeeActLogo3.png" alt="haimeeAct Logo"></a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="/">Home</a></li>


		          </ul>
		          <ul class="nav pull-right">
								      <li><a href="/guard/login">Login</a></li>
					  <li class="divider-vertical"></li>
					  <li><a href="/guard/register">Register</a></li>



		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div>
		
	
    
    <div id="container">
	   
       
      <div class="wufoo">
	<div class="info">
	    <h2>
	        Something is wrong
	    </h2>
	    <p>
	        
	    </p>
	  </div>
	
<ul class="sfTIconList">
  <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
  <li class="sfTLinkMessage"><a href="/">Go to Homepage</a></li>
</ul>
</div>    </div>
    
	
	<div id="footer" >
	  <ul>
	    <li><a href="<?php echo url_for('aboutus') ?>">about us</a> · &nbsp;</li>
	    <li><a href="<?php echo url_for('contactus') ?>">contact us</a> · &nbsp;</li>	
	    <li><a href="<?php echo url_for('term') ?>">term and conditions</a></li>				
	    <!-- <li><a href="#">help</a></li>				 -->
	  </ul>
	</div>
</body>
</html>
