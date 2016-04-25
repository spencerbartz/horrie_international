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
                <ul>
                <li>First Name: <input name="first_name" type="text" class="rounded text-input" /></li>
                <li>Last Name: <input name="last_name="text" class="rounded text-input" /></li>
                <li>User Name: <input name="user_name" type="text" class="rounded text-input" /></li>
                <li>Email: <input name="email" type="text" class="rounded text-input" /></li>
                <li>Password: <input name="pass_word" type="password" class="rounded text-input" /></li>
                <li>Re-enter Password: <input  name="reenter_pass_word" type="password" class="rounded text-input" /></li>
                <li><button class="button">Create User Account</button></li>
                </ul>
            
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
