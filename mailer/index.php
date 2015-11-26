<?php 
    include '../util/util.php';
    //include 'newsutil.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
    <div id="overlay"></div>
    <?php printHeader($siteRootPath); ?>

    <div class="left rounded"> 

        <div class="box rounded">
            <h1><?php println('Welcome to <span class="white">Horrie Mailer</span>'); ?></h1>
            <div class="mail_form_div">
            <form id="mail_form">
            <ul>
                <li>To: <input id="to" class="mail_input" type="text" placeholder="victim@mail.com" minlength="20" /> (separate email addresses with commas or semi-colons)</li>
                <li>From: <input id="from" class="mail_input" type="text" placeholder="fake@mail.com"/></li>
                <li>Subject: <input id="subject" class="mail_input" type="text" placeholder="Enter a subject..."/></li>
                <li>Message:<br>
                <li><textarea id="message" rows="15" cols="40"></textarea></li>
                <li>Send me a BCC: <input id="bcc_checkbox" type="checkbox" value="no" /> <input id="bcc_input" class="mail_input bcc_input" type="text" placeholder="your_real_email@mail.com"/></li>
                <li><input id="submit" type="submit" value="Send mail"></li>
            </ul>
            <input type="hidden" id="attach" name="attach" value="" />
            </form>
            <script type="text/javascript" src="mailutil.js"></script>
            </div>
        </div>
    </div>

    <div class="right rounded"> 
        <h2>Categories :</h2>
        <?php printCategories(); ?>

        <h2>Archives :</h2>
        <?php printArchives(); ?>
    </div>
            
    <div style="clear: both;"> </div>
            
    <div id="footer" class="footer rounded">
        <img src="img/footerlogo.jpg" />
        <br />
        All rights reserved. &copy; Philipp Hein 2015
    </div>
</div>

</body>
</html>
