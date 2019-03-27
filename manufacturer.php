<?php
	class manufacturer{
		public $error = array();
				
		public function create($detail){
			include 'database.php';
			$db = new Database();
			$db->add_manufacturer($detail['name']);
        }
		
		public function validate(){
			if (empty($this->name)) {
			    return $this->error[] = "Name should not be empty";
			}else{
				return '';
			}
        }

	}
	
	if($_POST){
		$manufacturer = new Manufacturer();	
		$manufacturer->name = $_POST['manufacturer'];
		
		if (empty($manufacturer->validate())) {
			$manufacturer_inf0 = array('name'=>$manufacturer->name);
			$manufacturer->create($manufacturer_inf0);
		}else{
			return $_POST['error'] = $manufacturer->validate();
		}
		
	}
?>