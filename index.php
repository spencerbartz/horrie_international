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
                <div class="horrie-head index-row rounded"><img class="rounded" src="img/horrie.gif"/></div>
                <div class="index-row rounded"><img class="rounded" src="img/mission.gif" /></div>
                <div class="horrie-head index-row rounded"><img class="rounded" src="img/horrie.gif"/></div>
            </div>
        </div>  
        <div class="box rounded center-text"><h2>Breaking News!</h2></div>
        <?php printNews($siteRootPath); ?>
    </div>
    
    <div id="right-bar" class="right rounded"> 
        <h2><a id="search-link" href="#">Search</a></h2>
        <h2>Categories :</h2>
        <?php printCategories(); ?>
        <h2>Archives :</h2>
        <ul>
        <?php printNewsArchives(); ?>
    </div>

    <div id="search-box" class="search-box rounded"> 
        <h2>Search</h1>
        <form>
            <input class="rounded" type="search" placeholder="search horrieinternational.com" />
        </form>
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