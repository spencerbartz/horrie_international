<?php
	include '../php/util.php';
	$curLang = "en";
	if(isSet($_GET["locale"]))
		$curLang = "jp";
	
	if(strcmp($curLang, "jp") === 0)
		changeLanguage();
		
	printPageDec(__FILE__);
?>

<title><?php echo _("Spencer Bartz - Portfolio Website"); ?></title>
</head>

	<div id="overlay"></div>
	
	<!-- header starts here -->
	<div id="header">
		<div id="header-content">
		<?php
			printHeader(__FILE__);
		?>
		 </div>
	</div>
	
<!-- navigation starts here -->
<div id="nav-wrap">
  <div id="nav">
<?php
	printNav(__FILE__);
?>
  </div>
</div>
<!-- content-wrap starts here -->
<div id="content-wrap">
  <div id="content">
    
    <!-- Right side search box area -->
    <div id="sidebar" >
      <div class="sidebox" id="searchbox">
	<?php printSearchBox(__FILE__) ?>
      </div>
      <div class="sep"></div>
    </div>
    
    <!-- Left Side (Main Content)-->
    <div id="main">
      <div class="box">
        <h1><?php echo _('Welcome to <span class="white">Edit News</span>'); ?></h1>
        <p>
            <form action="addnews_submit.php" method="POST">
                <textarea name="posttext"></textarea>
                <div class="sep"></div>
                <input type="submit" value="submit"/>
            </form>        
        </p>
        <p class="post-footer align-right"><span class="date"><?php lastUpdated(__FILE__); ?></span> </p>
      </div>

    </div>

    <!-- content-wrap ends here -->
  </div>
</div>
<!-- footer starts here-->
<div id="footer-wrap">
  <div id="footer-columns">
  	<?php
  		printFooter(__FILE__);
  	?>

  </div>
  <!-- footer ends-->
</div>
</body>
</html>
