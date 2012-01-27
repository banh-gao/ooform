<?php


require_once '../OOForms/Form.php';

use OOForm\elements\ajax\AjaxListener;

class MyAjaxListener extends AjaxListener {
	
	protected function getResponse($query) {
		$result = array();
		for ($i=0;$i<20;$i++)
			$result[] = $query.'res'.$i;
		return $result;
	}
	
	public function getServiceUrl() {
		return 'elaboration.php';
	}
}

?>
