<script>
	$(document).ready(function (){
		$('.sold').click(function (){
			var model_id = $(this).attr('carid');
			$.ajax({ url: 'show_details.php',
				data: {model_id: model_id, action:'delete'},
				type: 'post',
				success: function(output) {
					location.reload();
				}
			});
		});
	})
</script>
<?php
	include('database.php');
    $db = new Database();
    $model = $db->getModelDetail($_POST['man_id'],$_POST['model']);
	
	if(isset($_POST['model_id']) && isset($_POST['action'])){
		include('model.php');
		$model = new Model();
		
		$unlink_images = $model->unlinkImages($_POST['model_id']);
		
		if($unlink_images){
			$db->getModelDelete($_POST['model_id']);
			echo 'Deleted successfully';
		}
	}
?>

<div>
	<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 10%">
                    <div>Color.</div>
                </th>
                <th style="width: 20%">
                    <div>Manufact. Year</div>
                </th>
                <th style="width: 20%">
                    <div>Reg. No</div>
                </th>
                <th style="width: 10%">
                    <div>Note</div>
                </th>
                <th style="width: 20%">
                    <div>Image1</div>
                </th>
                <th style="width: 20%">
                    <div>Image2</div>
                </th>
                <th style="width: 20%">
                    <div>Action</div>
                </th>
            </tr>
		</thead>
		<?php
			while($details = mysqli_fetch_assoc($model)){
                echo '<tr  class="short_details" id=' . $details['id'] . '>
						<td>' . $details['color'] . '</td>
						<td>' . $details['manufacturing_year'] . '</td>
						<td>' . $details['registration_no'] . '</td>
						<td>' . $details['note'] . '</td>
						<td><img src="/test/upload/'.$details['image_1'].'" class="img-responsive thumbnail">' . $details['image_1'] . '</td>
						<td><img src="/test/upload/'.$details['image_2'].'" class="img-responsive thumbnail">' . $details['image_2'] . '</td>
						<td><button type="button" class="btn btn-danger sold" carid=' . $details['id'] . '>Sold</button></td>
					</tr>';
				}
		?>
</div>