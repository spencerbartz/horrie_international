<H1>Fle Browser</H1>
        <script type="text/javascript">
        function select_image(url) {
        var CKEditorFuncNum = <?php echo $_GET['CKEditorFuncNum']; ?>;
        window.parent.opener.CKEDITOR.tools.callFunction( CKEditorFuncNum, url, '' );
        self.close();
        }
        </script>
<?php

    $dir = 'uploads';
    $files = array_diff(scandir($dir), array('..', '.'));
    
    // Required: anonymous function reference number as explained above.
    $funcNum = $_GET['CKEditorFuncNum'] ;
    // Optional: instance name (might be used to load a specific configuration file or anything else).
    $CKEditor = $_GET['CKEditor'] ;
    // Optional: might be used to provide localized messages.
    $langCode = $_GET['langCode'] ;
    
    
    echo "Available images: (" . count($files) . ")<br/>"; 
    
    $i = 0;
    
    foreach($files as $file)
    {
        $url = "http://localhost/horrieinternational/news/uploads/" . $file;
?>
        <a href="javascript:select_image('<?php echo $url; ?>');"><img style="display:inline" height="50" width="50" src="<?php echo $url; ?>"/></a>
<?php
                
        if($i % 5 == 0)
            echo "<br/>";
        else
            $i++;
    }

?>