<?php 
    include '../util/util.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
    <?php printHeader($siteRootPath); ?>
    <div class="left rounded">     
        <div class="head-container">
            <h2><a href="#">Horrie International News Archives</a></h2>
            
        <div class="box rounded center-text"><h2>Archived news from <?php echo $_REQUEST["datetime"]; ?></h2></div>
       <div class="archives">
        <?php if(isset($_REQUEST["year"]) && isset($_REQUEST["month"])) {
                printArchivesForDate($_REQUEST["year"], $_REQUEST["month"]);
            }
       ?>
    </div>
    </div>
    </div>
    <div class="right rounded"> 
        <h2>Categories :</h2>
        <?php printCategories(); ?>
    </div>
        
    <div style="clear: both;"> </div>
            
    <div id="footer" class="footer rounded">
        <img src="img/footerlogo.jpg" />
        <br />
        All rights reserved. &copy; Philipp Hein 2016
    </div>
</div>

</body>
</html>