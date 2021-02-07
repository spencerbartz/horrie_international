<?php 
    include '../util/util.php';
    include 'newsutil.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
    <?php printHeader($siteRootPath); ?>
    <div class="left rounded">     
        <div class="head-container">
            <h2 class="center-text">Official Horrie International News Archives</h2>
            
            <div class="box rounded center-text"><h2>News from <?php echo date("F, Y", mktime(0, 0, 0, 0, $_REQUEST["month"], $_REQUEST["year"])); ?></h2></div>
        </div>

        <div class="archives">
            <?php 
                if(isset($_REQUEST["year"]) && isset($_REQUEST["month"])) {
                    printArchivesForDate($_REQUEST["year"], $_REQUEST["month"]);
                } 
            ?>
        </div>

    </div>
    
    <div id="right-bar" class="right rounded"> 
        <div id="search-link"><h2>Search</h2></div>
        <h2>Categories :</h2>
        <?php printCategories(); ?>
        <h2>Archives :</h2>
        <ul>
        <?php printArchiveBar(); ?>
    </div>
    
    <div id="search-box" class="search-box rounded"> 
        <h2>Search: COMING SOON!</h2>
        <form>
            <input class="rounded" type="search" placeholder="search horrieinternational.com" />
        </form>
    </div>
        
    <div style="clear: both;"> </div>
            
    <div id="footer" class="footer rounded">
        <?php printFooter($siteRootPath); ?>
    </div>
</div>

</body>
</html>