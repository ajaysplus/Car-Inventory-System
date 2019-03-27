<?php
	class Database{
		
		public function __construct() {
			$this->conn = mysqli_connect('localhost', 'xlnccpks_ajay', 'Ak@12345', 'xlnccpks_car_inventory');

			if(!$this->conn)
			{  
				die ("Cannot connect to the database");  
			}
		}

	
		function add_manufacturer($data){
			$sql = "INSERT INTO manufacturer (name) VALUES ('".trim($data)."')";

			$result = mysqli_query($this->conn, $sql);
			if ($result === TRUE) {
				echo "New record created successfully";
				header('Location: index.php');
			} else {
				echo "Error: " . $sql . "<br>" . $this->conn->error;
			}
		}
		
		function getManufacturer(){
			$sql = "SELECT id,name FROM manufacturer";
			$result = mysqli_query($this->conn, $sql);
			
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			$options = '<option value="">Select Manufacturer</option>';

			foreach($rows as $key=>$value){
				$options .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
			}
			return $options;
		}
		
		
		function add_model($data){
			$sql = "INSERT INTO model (manufacturer_id,model,color,manufacturing_year,registration_no,note,image_1,image_2) VALUES ('".trim($data['manufacturer'])."','".trim($data['model'])."','".trim($data['color'])."','".trim($data['year'])."','".trim($data['registration_number'])."','".trim($data['notes'])."','".trim($data['image1'])."','".trim($data['image2'])."')";

			$result = mysqli_query($this->conn, $sql);
			if ($result === TRUE) {
				echo "New record created successfully";
				header('Location: index.php');
			} else {
				echo "Error: " . $sql . "<br>" . $this->conn->error;
			}
		}
		
		function getModel(){
			$sql = "SELECT count(name) as count_pair, model.id as id,manufacturer_id as man_id,name,model FROM model LEFT JOIN manufacturer ON model.manufacturer_id = manufacturer.id group by name,model";
			$result = mysqli_query($this->conn, $sql);
			return $result;
		}
		
		function getModelDetail($id,$model){
			$sql = "SELECT id,color,manufacturing_year,registration_no,note,image_1,image_2 FROM model where manufacturer_id = '".trim($id)."' and model = '".trim($model)."'";
			$result = mysqli_query($this->conn, $sql);
			return $result;
		}
		
		function getImages($id){
			$sql = "SELECT image_1,image_2 FROM model where id = '".trim($id)."'";
			$result = mysqli_query($this->conn, $sql);
			return $result;
		}
		
		function getModelDelete($id){
			$sql = "DELETE FROM model where id = '".trim($id)."'";
			$result = mysqli_query($this->conn, $sql);
			return $result;
		}
		
	}
?>