<?php 
    include 'util/util.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
    <?php printHeader($siteRootPath); ?>
    <div class="left rounded">     
        <div class="head-container">
            <h2><a href="#">Welcome To Horrie International!</a></h2>
            <div class="row-container">
                <div class="horrie-head index-row rounded"><img class="rounded" src="img/horrie.gif"/><br><img src="img/fire.gif"/></div>
                <div class="index-row rounded"><img class="rounded" src="img/mission.gif" /></div>
                <div class="horrie-head index-row rounded flip"><img class="rounded" src="img/horrie.gif"/><br><img src="img/fire.gif"/></div>
            </div>
        </div>  
        <div class="box rounded center-text"><h2>Breaking News!</h2></div>
        <?php printNews($siteRootPath); ?>
    </div>
    
    <div id="right-bar" class="right rounded"> 
        <div id="search-link" class="rounded"><h1>Search</h1></div>
        <h2>Categories :</h2>
        <?php printCategories(); ?>
        <h2>Archives :</h2>
        <ul>
        <?php printNewsArchives(); ?>
    </div>

    <div id="search-box" class="search-box rounded"> 
        <h3>Search Horrie International</h3>
        <form>
            <input class="search-input rounded block" type="search" placeholder="search horrieinternational.com" />
            <button class="search-button rounded">Submit</button>
        </form>
    </div>
        
    <div style="clear: both;"> </div>
            
    <div id="footer" class="footer rounded">
        <?php printFooter($siteRootPath); ?>
    </div>
</div>

</body>
</html>