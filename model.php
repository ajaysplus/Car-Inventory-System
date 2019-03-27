<?php
	class Model{
		public function __construct() {
			$this->db = new Database();
		}
		
		public function create($detail){
			$this->db->add_model($detail);
        }
		
		function unlinkImages($id){
			$images = $this->db->getImages($id);
			$images = $images->fetch_assoc();
			
			unlink('upload/'.$images["image_1"]); // correct
			unlink('upload/'.$images["image_2"]); // correct
			return 1;
		}
	}
	
	if(isset($_POST) && !(isset($_POST['action']))){
		$model_info['model'] = $_POST['model_name'];
		$model_info['color'] = $_POST['color'];
		$model_info['year'] = $_POST['year'];
		$model_info['registration_number'] = $_POST['registration_number'];
		$model_info['notes'] = $_POST['notes'];
		$model_info['manufacturer'] = $_POST['manufacturer'];
		$model_info['image1'] = $_POST['image1'];
		$model_info['image2'] = $_POST['image2'];

		$model = new Model();
		$model->create($model_info);
	}
?>