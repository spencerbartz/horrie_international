<?php 
    include '../util/util.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
    <?php printHeader($siteRootPath); ?>
    <div class="left rounded">     
        <div class="head-container">
            <h2><a href="#">Horrie International Presents</a></h2>
            <div class="row-container">
                <div class="horrie-head index-row rounded"><img class="rounded" src="../img/horrie.gif"/><br><img src="../img/fire.gif"/></div>
                <div class="index-row rounded"><img class="rounded" src="../img/mission.gif" /></div>
                <div class="horrie-head index-row rounded flip"><img class="rounded" src="../img/horrie.gif"/><br><img src="../img/fire.gif"/></div>
            </div>
        </div>  
        <div class="box rounded center-text"><h2>Cameron's Corner!</h2></div>
        <div class="box rounded center-text">
            <img src="../img/cameronpenis.gif">
        </div>
    </div>
    
    <div id="right-bar" class="right rounded"> 
        <h2>Categories:</h2>
        <?php printCategories(); ?>
    </div>
        
    <div style="clear: both;"> </div>
            
    <div id="footer" class="footer rounded">
        <?php printFooter($siteRootPath); ?>
    </div>
</div>

</body>
</html>