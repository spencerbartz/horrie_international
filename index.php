<?php 
    include 'util/util.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">

    <?php printHeader($siteRootPath); ?>

    <div class="left rounded"> 

        <h2><a href="#">Welcome To Horrie International!</a></h2>

        <div class="articles">
            Willkommen! I am Philipp Hein, President and CEO of Horrie International Enterprises. 
            <br /><br />
            
            <img src="img/horrie.gif" class="rounded" />
            <br /><br />
            
            We are here to make your wildest dreams come true!!
        </div>

        <h2><a href="#">Our Mission</a></h2>
        <div class="articles">
            To take the world by the throat and ask it "What have you done for us lately!?"
        </div>
        
        <h2>Breaking News!</h2>
        <?php printNews($siteRootPath); ?>
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