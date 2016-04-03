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
            <h1><a href="#">Create a New User Account</a></h1>
        </div>
        <?php printAppMenu(); ?>        
    </div>
    <div id="banner" class="container">
        <div class="title"> 
            <span class="byline">Enter your contact information:</span>
            <form id="contactform" action="<?php Router::form_action("users_controller", "create"); ?>"  method="post">
                <input type="text" class="rounded text-input" />
                <button class="button">Create User Account</button>
            </form>
        </div>
        <ul class="actions">
            <li></li>
        </ul>
    </div>
</div>
<?php printCopyright(); ?>
</body>
</html>
