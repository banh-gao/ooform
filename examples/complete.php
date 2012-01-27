<?php

require_once '../OOForms/Form.php';

use OOForm\elements\ajax\Suggestion;
use OOForm\Form;
use OOForm\elements\Separator;
use OOForm\elements\basic\Hidden;
use OOForm\elements\basic\Text;
use OOForm\elements\basic\Textarea;
use OOForm\elements\basic\Password;
use OOForm\elements\basic\Select;
use OOForm\elements\basic\SelectOption;
use OOForm\elements\basic\Checkbox;
use OOForm\elements\basic\Radio;
use OOForm\elements\basic\File;
use OOForm\elements\basic\Button;
use OOForm\elements\basic\Reset;
use OOForm\elements\basic\Submit;
use OOForm\elements\basic\Image;
use OOForm\elements\group\CheckboxGroup;
use OOForm\elements\group\RadioGroup;
use OOForm\elements\group\YesNoRadio;
use OOForm\elements\group\Fieldset;

require_once 'MyAjaxListener.php';
?>
<html>
<body>
<?php

$form = new Form ( 'sampleForm' );
$form->setAttribute ( 'action', 'elaboration.php' );

$form->addElement ( new Separator ( "OOForm complete form" ) );

//Hidden
$form->addElement ( new Hidden ( "hidden1", 'hiddenValue' ) );

//Text
$text = new Text ( "text1", 'disabled textbox', 'Textbox' );
$text->setEnabled ( false );
$form->addElement ( $text );

//Ajax suggestion text box
$listener = new MyAjaxListener ();
$form->addElement ( new Suggestion ( 'sugg', 'Ajax suggestion box' ,$listener ) );

//password
$form->addElement ( new Password ( "password", 'passwordValue', 'Password box' ) );

//Select with grouped options
$select = new Select ( 's1', '', 'Required selection' );
$select->setMultiSelection ( true );
$select->setTooltip ( "Selection with groups" );
$select->setRequired ( true );
$g1 = new SelectOption ( "Group1" );
$g1->addOption ( new SelectOption ( "g1-OptA", "g1A" ) );
$g1B = new SelectOption ( "g1-OptB", "g1B" );
$g1B->setSelected ( true );
$g1->addOption ( $g1B );
$select->addOption ( $g1 );
$g2 = new SelectOption ( "Group2" );
$disOption = new SelectOption ( "Disabled option", "disOption" );
$disOption->setEnabled ( false );
$g2->addOption ( $disOption );

$g2A = new SelectOption ( "g2-OptA", "g2A" );
$g2A->setSelected ( true );

$g2->addOption ( $g2A );
$g2->addOption ( new SelectOption ( "g2-OptB", "g2B" ) );
$select->addOption ( $g2 );
$form->addElement ( $select );

//Checkbox group
$checkList = new CheckboxGroup ( 'checks', 'Checkbox group' );
$checkedBox = new Checkbox ( '', 'check1', 'checked check1' );
$checkedBox->setChecked ( true );
$checkList->addElement ( $checkedBox );
$checkList->addElement ( new Checkbox ( '', 'check2', 'check2' ) );
$disBox = new Checkbox ( '', 'disCheck3', 'disabled check3' );
$disBox->setEnabled ( false );
$checkList->addElement ( $disBox );
for($i = 4; $i < 10; $i ++) {
	$checkList->addElement ( new Checkbox ( '', 'check' . $i, 'check' . $i ) );
}
$form->addElement ( $checkList );

//Radio group
$radioList = new RadioGroup ( 'radios', 'Radio buttons group' );
$radioList->addElement ( new Radio ( '', 'radio1', 'radio1' ) );
$checkedRadio = new Radio ( '', 'radio2', 'checked radio2' );
$checkedRadio->setChecked ( true );
$radioList->addElement ( $checkedRadio );
$disRadio = new Radio ( '', 'disradio3', 'disabled radio3' );
$disRadio->setEnabled ( false );
$radioList->addElement ( $disRadio );

//Nested element fieldsets
$nestedFieldset = new Fieldset ( 'Nested fieldset' );
$rootFieldset = new Fieldset ( "RootFieldset" );

$rootFieldset->addElement ( $radioList );

$rootFieldset->addElement ( $nestedFieldset );

$rootFieldset->addElement ( new YesNoRadio ( 'yesNo', 1, 'Yes-No' ) );

//File
$nestedFieldset->addElement ( new File ( 'file', 'File' ) );

//Textarea
$textarea = new Textarea ( 'textarea1', 'read only textarea', 'Textarea' );
$textarea->setTooltip ( "Tooltip for this textarea" );
$textarea->setReadonly ( true );
$nestedFieldset->addElement ( $textarea );

$form->addElement ( $rootFieldset );

//Editor
$editorText = '<p style="text-align: center;"><span style="color: rgb(255, 0, 0);"><span style="font-size: 36px;"><span style="font-family: comic sans ms,cursive;"><strong>This is a rich text editor</strong></span></span></span></p>';
$editor = new OOForm\elements\editor\Editor ( 'editor', $editorText, 'Editor' );
$editor->setMode ( $editor::MODE_FULL );
$form->addElement ( $editor );

//Captcha
$form->addElement ( new OOForm\elements\recaptcha\Recaptcha ( "6Le9xMASAAAAAD72b8Dfu57ShgDOQYsNdk3tiVBg" ) );

//Separator
$form->addElement ( new Separator ( "This is a separator for the form, next we have some buttons..." ) );

//Button
$form->addElement ( new Button ( 'button1', 'Button' ) );
//Reset
$form->addElement ( new Reset ( "ResetButton" ) );
//Submit
$form->addElement ( new Submit ( "SubmitButton" ) );
//ImageSubmit
$form->addElement ( new Image ( 'submitImage.jpg' ) );

echo $form->render ();
?>
</body>
</html>
