
# PHP QR Code Generator 
[![Latest Stable Version](http://poser.pugx.org/sujanshresthanet/php-qrcode-generator/v)](https://packagist.org/packages/sujanshresthanet/php-qrcode-generator) [![Total Downloads](http://poser.pugx.org/sujanshresthanet/php-qrcode-generator/downloads)](https://packagist.org/packages/sujanshresthanet/php-qrcode-generator) [![Latest Unstable Version](http://poser.pugx.org/sujanshresthanet/php-qrcode-generator/v/unstable)](https://packagist.org/packages/sujanshresthanet/php-qrcode-generator) [![License](http://poser.pugx.org/sujanshresthanet/php-qrcode-generator/license)](https://packagist.org/packages/sujanshresthanet/php-qrcode-generator) [![PHP Version Require](http://poser.pugx.org/sujanshresthanet/php-qrcode-generator/require/php)](https://packagist.org/packages/sujanshresthanet/php-qrcode-generator)

[![Donate via PayPal](https://img.shields.io/badge/donate-paypal-87ceeb.svg)](https://www.paypal.com/donate/?hosted_button_id=2L5XM9USTV4K4)
*Please consider supporting this project by making a donation via [PayPal](https://www.paypal.com/donate/?hosted_button_id=2L5XM9USTV4K4)*

## Description
This is an easy to use, non-bloated, framework independent, QR Code generator in PHP.

## Installation
Install through [composer](https://getcomposer.org/doc/00-intro.md):

```
composer require sujanshresthanet/php-qrcode-generator
```

**Getting started:-**

We start off by creating a folder named **PHP QRCode Generator**. We open this folder in an editor. I am using Atom for it. Having done that, we will create a file named ‘index.html’ which will be storing the Html structure of our web page.

**Creating index.html file:-**

We give our web page the title **“PHP QRCode Generator”**. We include css in our project with the following code:-

`<link rel="stylesheet" href="css/style.css">`

We also include jQuery in our project with the following code:-

`<script src="js/jquery-3.6.0.js"></script>`

and we include custom jQuery code in our project with the following code:-

`<script src="js/custom.js"></script>`

We include the QR code library with the following code:-
`
include('libs/phpqrcode/qrlib.php');`

**index.php file**

```php

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

```

**style.css file**

```css

input:not([type=submit]), textarea {
    display: block;
    width: 100%;
    margin-bottom: 1rem;
    padding: 0.25rem;
    font-size: 1rem;
    color: black;
    border: 0;
    outline: 0;
    background-color: #e6e6e6;
    transition: 0.2s ease-in-out;
    transition-property: background-color, box-shadow;
}
input:not([type=submit])::-moz-placeholder, textarea::-moz-placeholder {
    color: rgba(22, 22, 22, 0.5);
    opacity: 1;
    -moz-transition: color 0.2s ease-in-out;
    transition: color 0.2s ease-in-out;
}
input:not([type=submit]):-ms-input-placeholder, textarea:-ms-input-placeholder {
    color: rgba(22, 22, 22, 0.5);
    opacity: 1;
    -ms-transition: color 0.2s ease-in-out;
    transition: color 0.2s ease-in-out;
}
input:not([type=submit])::placeholder, textarea::placeholder {
    color: rgba(22, 22, 22, 0.5);
    opacity: 1;
    transition: color 0.2s ease-in-out;
}
input:not([type=submit]):focus::-moz-placeholder, textarea:focus::-moz-placeholder {
    opacity: 1;
}
input:not([type=submit]):focus:-ms-input-placeholder, textarea:focus:-ms-input-placeholder {
    opacity: 1;
}
input:not([type=submit]):focus::placeholder, textarea:focus::placeholder {
    opacity: 1;
}
input:not([type=submit]):-moz-placeholder-shown, textarea:-moz-placeholder-shown {
    background-color: #808080;
}
input:not([type=submit]):-ms-input-placeholder, textarea:-ms-input-placeholder {
    background-color: #808080;
}
input:not([type=submit]):placeholder-shown, textarea:placeholder-shown {
    background-color: #fff;
}
input:not([type=submit]):not(:-moz-placeholder-shown), textarea:not(:-moz-placeholder-shown) {
    background-color: #e6e6e6;
}
input:not([type=submit]):not(:-ms-input-placeholder), textarea:not(:-ms-input-placeholder) {
    background-color: #e6e6e6;
}
input:not([type=submit]):not(:placeholder-shown), textarea:not(:placeholder-shown) {
    background-color: #fff;
}
input:not([type=submit]):not(:focus):not(:-moz-placeholder-shown):valid, textarea:not(:focus):not(:-moz-placeholder-shown):valid {
    box-shadow: inset 0 0 0 0.125rem #00a34a;
}
input:not([type=submit]):not(:focus):not(:-ms-input-placeholder):valid, textarea:not(:focus):not(:-ms-input-placeholder):valid {
    box-shadow: inset 0 0 0 0.125rem #00a34a;
}
input:not([type=submit]):not(:focus):not(:placeholder-shown):valid, textarea:not(:focus):not(:placeholder-shown):valid {
    box-shadow: inset 0 0 0 0.125rem #00a34a;
}
input:not([type=submit]):not(:focus):not(:-moz-placeholder-shown):invalid, textarea:not(:focus):not(:-moz-placeholder-shown):invalid {
    box-shadow: inset 0 0 0 0.125rem #208484;
}
input:not([type=submit]):not(:focus):not(:-ms-input-placeholder):invalid, textarea:not(:focus):not(:-ms-input-placeholder):invalid {
    box-shadow: inset 0 0 0 0.125rem #208484;
}
input:not([type=submit]):not(:focus):not(:placeholder-shown):invalid, textarea:not(:focus):not(:placeholder-shown):invalid {
    box-shadow: inset 0 0 0 0.125rem #208484;
}
input:not([type=submit]):-moz-placeholder-shown:invalid:not(:focus), input:not([type=submit]):-moz-placeholder-shown:valid:not(:focus), textarea:-moz-placeholder-shown:invalid:not(:focus), textarea:-moz-placeholder-shown:valid:not(:focus) {
    box-shadow: inset 0 0 0 0.125rem #808080;
}
input:not([type=submit]):-ms-input-placeholder:invalid:not(:focus), input:not([type=submit]):-ms-input-placeholder:valid:not(:focus), textarea:-ms-input-placeholder:invalid:not(:focus), textarea:-ms-input-placeholder:valid:not(:focus) {
    box-shadow: inset 0 0 0 0.125rem #808080;
}
input:not([type=submit]):placeholder-shown:invalid:not(:focus), input:not([type=submit]):placeholder-shown:valid:not(:focus), input:not([type=submit]):focus, textarea:placeholder-shown:invalid:not(:focus), textarea:placeholder-shown:valid:not(:focus), textarea:focus {
    box-shadow: inset 0 0 0 0.125rem #808080;
}
input:not([type=submit]):focus, textarea:focus {
    background-color: #fff;
}
form:invalid input[type=submit] {
    opacity: 0.5;
    cursor: not-allowed;
}
form:valid input[type=submit] {
    opacity: 1;
    cursor: pointer;
}
* {
    box-sizing: border-box;
}
html, body {
    height: 100%;
    font-size: 16px;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    color: #161616;
    background: linear-gradient(to bottom right, white, #808080) fixed;
}
form {
    position: relative;
    width: 16rem;
    margin: 1rem auto;
    padding: 1rem;
    text-align: center;
    border-radius: 0.5rem;
    background: #e6e6e6;
    box-shadow: 0 0.25rem 1rem rgba(128, 128, 128, 0.25);
    overflow: hidden;
}
form::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 0.5rem;
    background-color: #0e8484;
}
fieldset {
    border: none;
    color: #808080;
    font-size: 0.75rem;
}
label {
    display: block;
    font-size: 0.75rem;
    text-align: left;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}
input, textarea {
    border-radius: 0.25rem;
}
textarea {
    min-height: 2rem;
    resize: vertical;
}
input[type=submit] {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    color: #e6e6e6;
    font-size: 0.75rem;
    text-transform: uppercase;
    border: none;
    background: linear-gradient(180deg, #0e8484, #0abbe6);
    box-shadow: 0 0.0625rem 0.5rem rgba(128, 128, 128, 0.25);
    transition: all 0.25s ease-in-out;
}
input[type=submit]:hover {
    box-shadow: 0 0.125rem 0.5rem rgba(128, 128, 128, 0.5);
    transform: translateY(-0.0625rem);
}
.qr-image {
    padding: 10px;
    text-align: center;
}


```

**custom.js file:-**

```js

var inputs = document.querySelectorAll('input[type=text], input[type=email]');
for (i = 0; i < inputs.length; i++) {
    var inputEl = inputs[i];
    if (inputEl.value.trim() !== '') {
        inputEl.parentNode.classList.add('input--filled');
    }
    inputEl.addEventListener('focus', onFocus);
    inputEl.addEventListener('blur', onBlur);
}

function onFocus(ev) {
    ev.target.parentNode.classList.add('inputs--filled');
}

function onBlur(ev) {
    if (ev.target.value.trim() === '') {
        ev.target.parentNode.classList.remove('inputs--filled');
    } else if (ev.target.checkValidity() == false) {
        ev.target.parentNode.classList.add('inputs--invalid');
        ev.target.addEventListener('input', liveValidation);
    } else if (ev.target.checkValidity() == true) {
        ev.target.parentNode.classList.remove('inputs--invalid');
        ev.target.addEventListener('input', liveValidation);
    }
}

function liveValidation(ev) {
    if (ev.target.checkValidity() == false) {
        ev.target.parentNode.classList.add('inputs--invalid');
    } else {
        ev.target.parentNode.classList.remove('inputs--invalid');
    }
}
var submitBtn = document.querySelector('input[type=submit]');
submitBtn.addEventListener('click', onSubmit);

function onSubmit(ev) {
    var inputsWrappers = ev.target.parentNode.querySelectorAll('span');
    for (i = 0; i < inputsWrappers.length; i++) {
        input = inputsWrappers[i].querySelector('input[type=text], input[type=email]');
        if (input.checkValidity() == false) {
            inputsWrappers[i].classList.add('inputs--invalid');
        } else if (input.checkValidity() == true) {
            inputsWrappers[i].classList.remove('inputs--invalid');
        }
    }
}


```

# Output

![Form](images/form.png)

***

![QRCode](images/form-with-qrcode.png)

***
