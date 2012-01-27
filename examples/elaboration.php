<?php
use OOForm\Form;
use OOForm\elements\recaptcha\Recaptcha;
require_once '../OOForms/Form.php';
require_once 'MyAjaxListener.php';

//Process ajax request
if(array_key_exists('query', $_REQUEST)) {
	$l = new MyAjaxListener();
	$l->processRequest();
}

?>
<html>
<head></head>
<body>
<table border="1">
	<thead>
		<tr>
			<th>Input name</th>
			<th>Input value</th>
		</tr>
	</thead>
	<tbody>
<?php

//Validate captcha field
Recaptcha::validate ( "6Le9xMASAAAAAMJsvYkTGwzgBJJq5OH1ITP-CPc3" );

//Get form parameters
$request = Form::getRequest ();

//Display all values
foreach ( $request->getValues () as $name => $value ) {
	$value = (is_array ( $value )) ? implode ( ', ', $value ) : $value;
	echo '<tr><td>' . $name . ':</td><td>' . $value . '</td></tr>' . "\n";
}

//Send back if there are errors (only captcha can fail here)
$request->sendErrors ();
?>
</tbody>
</table>
</body>
</html>
