<?php
$f = "visit.php";
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}
include('libs/phpqrcode/qrlib.php');
function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}
$email = '';
$subject = '';
$body = '';
if(isset($_POST['submit']) ) {
	// set error correction level L
	$err_correction = 'L';
	$pixel_size = 8;
	$frame_size = 8;
	$tempDir = 'images/';
	$errorMessage = '';
	$folderPermission = substr(sprintf('%o', fileperms($tempDir)), -4);
	if($folderPermission != '777' && $folderPermission != '0777') {
		$errorMessage = 'You do not have permissions to generate a file to a directory - '.$tempDir.'. Please change the folder permission to 777.';
	} else {
		$email = $_POST['mail'];
		$subject =  $_POST['subject'];
		$filename = getUsernameFromEmail($email);
		$body =  $_POST['msg'];
		$codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body);
		QRcode::png($codeContents, $tempDir.''.$filename.'.png', $err_correction, $pixel_size, $frame_size);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div>
		<form method="POST">
			<?php echo $errorMessage; ?>
			<fieldset>
				<p>Enter your information to generate QRcode</p>
				<label for="email">E-mail address</label>
				<input type="email" placeholder="you@domain.com" id="email" name="mail" value="<?php echo $email; ?>" required>
				<label for="subject">Subject</label>
				<input type="text" placeholder="Email Subject" id="subject" name="subject"  value="<?php echo $subject; ?>" required>
				<label for="message">Message</label>
				<textarea name="msg" rows="3" placeholder="Enter your message" id="message"><?php echo $body; ?></textarea>
				<input type="submit" name="submit" value="Generate QRcode">
			</fieldset>
		</form>
	</div>
	<?php if(isset($filename)): ?>
		<div class="qr-image">
			<img src="images/<?php echo $filename; ?>.png" style="width:200px; height:200px;">
			<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png "><br>Download QR Code</a>
		</div>
	<?php endif; ?>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>