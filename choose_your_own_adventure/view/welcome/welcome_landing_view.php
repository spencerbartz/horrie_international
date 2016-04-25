<?php
    include_once "../util/util.php";
    include_once "pages_controller.php";
    
    $siteRootPath = getAppRoot(__FILE__);
    printPageDec($siteRootPath);
?>
</head>
<body>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="http://www.horrieinternational.com"> < Back to Horrie International</a></h1>
        </div>
        <?php printAppMenu($siteRootPath); ?>
    </div>
    
    <div id="banner" class="container">
	<div class="title">
                <h2>Create Your Own Adventure!</h2>
                <span class="byline">The possibilities are endless...</span>
        </div>
        <ul class="actions">
            <li><?php Router::link_to(PagesController::to_string() , "new_page_landing", "Get Started!", array("class" => "button")) ; ?></li>
        </ul>
    </div>
</div>
<?php printCopyright(); ?>
</body>
</html>
