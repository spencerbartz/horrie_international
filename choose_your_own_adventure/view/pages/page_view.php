<?php
    include '../util/util.php';
    $siteRootPath = getAppRoot(__FILE__);
    printPageDec($siteRootPath);
?>
</head>
<body>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="#">Create a New Page for the Adventure</a></h1>
        </div>
        <?php printAppMenu(); ?>	    
    </div>
        
    <div id="banner" class="container">
        <div class="title"> 
            <h2>Create Your Own Adventure!!</h2>
            <span class="byline">The possibilities are potentially endless...</span>
        </div>
        <ul class="actions">
            <li><a href="#" class="button">Get Started!</a></li>
        </ul>
    </div>
</div>
<?php printCopyright() ?>
</body>
</html>
