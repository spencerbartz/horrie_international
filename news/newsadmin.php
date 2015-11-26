<?php 
    include '../util/util.php';
    include 'newsutil.php';
    $siteRootPath = getPathToRootDir(__FILE__);
    printPageDeclaration($siteRootPath);
?>
<div id="wrap">
     <div id="overlay"></div>
    <?php printHeader($siteRootPath); ?>

    <div class="left rounded"> 

        <div class="box rounded">
            <?php processParams(); ?>
            <h1><?php println('Welcome to <span class="white">News Admin</span>'); ?></h1>
            <?php currentlyEditing(); ?>
            <?php deletePost(); ?>
            <p>
            <script src="../ckeditor/ckeditor.js"></script>
            <form action="newsadmin.php" method="post" onsubmit="return validateTextAreaInput('posttext');">
                <div>
                    <textarea id="posttext" class="posttext rounded" name="posttext"><?php newsPostText(); ?></textarea><br />
                    <script>
                        CKEDITOR.replace('posttext', {filebrowserBrowseUrl: 'filebrowser.php', filebrowserUploadUrl: 'fileupload.php'});
                    </script>
                        <input type="hidden" name="postid" value="<?php newsPostId(); ?>" />
                <div style="text-align:center">
                <input type="submit" value="submit" class="newssubmit rounded" />
                </div>

                </div>
            </form>
            <div class="rounded">  
            <table>
                <th class="first">ID</th>
                <th>Time Stamp</th>
                <th>Preview</th>
                <th>Action</th>
                <tr class="row-a">
                    <td>N/A</td><td>N/A</td><td><a href="newsadmin.php">CREATE NEW NEWS STORY</a></td><td>N/A</td>
                </tr>
                <?php printNewsLinks(); ?>
            </table>
            </div>
        </p>
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
