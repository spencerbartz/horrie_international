<?php 

	$target_path = "uploads/"; 
	$fileName = $_FILES['upload']['name'];

	//We don't want to overwrite files that are already in the hall of fame. If the file name already exists, append the current timestamp to it
	$fileName = substr($fileName, 0, -4) . "-" . date("YmdGis") . ".gif"; 
	
	if(move_uploaded_file($_FILES['upload']['tmp_name'], $target_path . $fileName)) 
	{ 
	    echo "The file ". basename($_FILES['upload']['name']) . " has been uploaded"; 
	} 
	else
	{ 
	    echo "There was an error uploading the file, please try again!"; 
	}
	
	// Load the stamp and the photo to apply the watermark to
	$stamp = imagecreatefrompng('watermark.png');
	$im = imagecreatefromgif("uploads/" . $fileName);

	// Set the margins for the stamp and get the height/width of the stamp image
	$marge_right = 10;
	$marge_bottom = 10;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);

	// Copy the stamp image onto our photo using the margin offsets and the photo 
	// width to calculate positioning of the stamp. 
	imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

	// Output and free memory
	//header('Content-type: image/png');
	$newFileName = substr($fileName, 0, (strlen ($fileName)) - (strlen (strrchr($fileName,'.'))));
	
	imagepng($im, 'watermarked/' . $newFileName . '.png');
	imagedestroy($im);
        
        // Required: anonymous function reference number as explained above.
        $funcNum = $_GET['CKEditorFuncNum'] ;
        // Optional: instance name (might be used to load a specific configuration file or anything else).
        $CKEditor = $_GET['CKEditor'] ;
        // Optional: might be used to provide localized messages.
        $langCode = $_GET['langCode'] ;
    
        // Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
        $url = "http://localhost/horrieinternational/news/uploads/" . $fileName;
        // Usually you will only assign something here if the file could not be uploaded.
        $message = "horrie!";

    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        
?> 