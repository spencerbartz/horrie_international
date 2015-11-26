<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>

    <!-- Framework CSS -->
    <link rel="stylesheet" href="http://github.com/joshuaclayton/blueprint-css/raw/master/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="http://github.com/joshuaclayton/blueprint-css/raw/master/blueprint/print.css" type="text/css" media="print">
    <link rel="stylesheet" href="uploadstyle.css" type="text/css" />
    <!--[if IE]>
        <link rel="stylesheet" href="http://github.com/joshuaclayton/blueprint-css/raw/master/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!--[if lte IE 7]>
    <script type="text/javascript" src="http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js"></script>
<![endif]-->


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.2/mootools.js"></script>

	<script type="text/javascript" src="source/Swiff.Uploader.js"></script>

	<script type="text/javascript" src="source/Fx.ProgressBar.js"></script>

	<script type="text/javascript" src="http://github.com/mootools/mootools-more/raw/master/Source/Core/Lang.js"></script>

	<script type="text/javascript" src="source/FancyUpload2.js"></script>
	<script type="text/javascript" src="fancyupload.js"></script>
</head>
<body>
<?php


function multiexplode($delimiters,$string) 
{
	$ready = str_replace($delimiters, $delimiters[0], $string);
	$launch = explode($delimiters[0], $ready);
	return  $launch;
}

function spamcheck($field)
{
	$addresses = multiexplode(array(",",";"), $field);
	
	for($i = 0; $i < count($addresses); $i++)
	{
		//filter_var() sanitizes the e-mail
		//address using FILTER_SANITIZE_EMAIL
		$addresses[$i] = filter_var($addresses[$i], FILTER_SANITIZE_EMAIL);
	
		//filter_var() validates the e-mail
		//address using FILTER_VALIDATE_EMAIL
		if(!filter_var($addresses[$i], FILTER_VALIDATE_EMAIL))
		{
			return FALSE;
		}
	}
	
	return TRUE;
}

if (isset($_REQUEST['to']))
{
	//if "email" is filled out, proceed
	//check if the email address is invalid
	$mailcheck = spamcheck($_REQUEST['to']);
	
	if ($mailcheck == FALSE)
	{
		echo "One or more of the email addresses you entered was malformed. Please input valid email addresses separated by commas or semi-colons.<br>";
		echo "<a href=mailform.php>Back</a>";
	}
	else
	{
		//send email
		$to = $_REQUEST['to'];
		$from = $_REQUEST['from'];
		$subject = $_REQUEST['subject'];
		$message = $_REQUEST['message'];
		$htmlmail = $_REQUEST['htmlmail'];
				
		$headers = 'From: ' . $from . "\r\n";
		$headers .= 'Bcc: spencerbartz@gmail.com' . "\r\n";

		

		if(isset($_REQUEST['attach']))
		{
			$file = $_REQUEST['attach'];
			$filename = "server/uploads/" . $_REQUEST['attach'];
		
		$file_size = filesize($filename);
		echo "FILE SIZE: " . $file_size . "<br/>";
		$handle = fopen($filename, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));
		
		// a random hash will be necessary to send mixed content
		$separator = md5(time());
		
		// carriage return type (we use a PHP end of line constant)
		$eol = PHP_EOL;
		
		$headers .= "MIME-Version: 1.0" . $eol;
		$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
		$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
		$headers .= "This is a MIME encoded message." . $eol . $eol;
		
		// message
		$headers .= "--" . $separator . $eol;
		$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
		$headers .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
		$headers .= $message . $eol . $eol;
		
		// attachment
		$headers .= "--" . $separator . $eol;
		$headers .= "Content-Type: application/octet-stream; name=\"" . $file . "\"" . $eol;
		$headers .= "Content-Transfer-Encoding: base64" . $eol;
		$headers .= "Content-Disposition: attachment" . $eol . $eol;
		
		//$headers .= "Content-Disposition: attachment;\n" . " filename=\"" . $file . "\"; size=" . $file_size . ";\n";
		
		$headers .= $content . $eol . $eol;
    		$headers .= "--" . $separator . "--";
		}
		
		include('Mail.php');
		
		$recipients = 'spencerbartz@gmail.com';
		
		$myheaders['From'] = 'somesender@example.com';
		$myheaders['To'] = 'spencerbartz@gmail.com';
		$myheaders['Subject'] = 'Sending test message using Pear';
		
		$body = 'This is a test message sent using Pear';
		
		$params['sendmail_path'] = '/usr/sbin/sendmail -t -i';
		
		$mail =& Mail::factory('sendmail', $params);
		
		$result = $mail->send($recipients, $myheaders, $body);
		
var_dump($result);
		
		if(mail("$to", "$subject", $message, $headers, "-fspencerbartz@gmail.com"))
		{
		
			echo "Your important message was sent to the following email addresses:<br>";

			$addresses = multiexplode(array(",", ";"), $to);

			for($i = 0; $i < count($addresses); $i++)
			{
				echo $addresses[$i] . "<br>";
			}
			echo "With the following attachment: " . $filename . "<br/>";
			echo "Thank you for using our mail form. Have a nice day.<br>";
			echo "<a href=mailform.php>Back</a>";
		}
		else
		{
			echo "Mail was not sent for some reason<br/>";
		}
	}
}
else
{
	//if "email" is not filled out, display the form
	echo "<form method='post' action='mailform.php'>
	To: <input name='to' type='text'> (separate multiple email addresses with commas or semi-colons)<br>
	From: <input name='from' type='text'><br>
	Subject: <input name='subject' type='text'><br>
	Message:<br>
	<textarea name='message' rows='15' cols='40'></textarea><br>
	<input type='submit'><br>

	<input type='hidden' id='attach' name='attach' value='' />

	</form>";
?>

		<div>
			<form action="server/script.php" method="post" enctype="multipart/form-data" id="form-demo">

	<fieldset id="demo-fallback">
		<legend>File Upload</legend>
		<p>
			This form is just an example fallback for the unobtrusive behaviour of FancyUpload.
			If this part is not changed, something must be wrong with your code.
		</p>
		<label for="demo-photoupload">
			Upload a Photo:
			<input type="file" name="Filedata" />
		</label>
	</fieldset>

	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse">Browse Files</a> |
			<a href="#" id="demo-clear">Clear List</a> |
			<a href="#" id="demo-upload">Start Upload</a>
		</p>
		<div>
			<strong class="overall-title"></strong><br />
			<img src="../../assets/progress-bar/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title"></strong><br />
			<img src="../../assets/progress-bar/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>

	<ul id="demo-list"></ul>

</form>		</div>


	</div>
<?php
}
?>
</body>
</html>  