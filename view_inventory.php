<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
    include('database.php');
    $db = new Database();
    $model = $db->getModel();
?>
<html>
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

            <script>
				$(document).ready(function(){
					$('.short_details').click(function (){
						var model_id = $(this).attr('id');
						var model = $(this).attr('model');
						var man_id = $(this).attr('man_id');
						$.ajax({ url: 'show_details.php',
							data: {model_id: model_id, man_id: man_id,model : model},
							dataType : 'html',
							type: 'post',
							success: function(output) {
								$('.sold').attr('carid', model_id)
								$('.modal-body').html(output);
								$('#model_details').modal('show');
							}
						});
					});
				})
            </script>
	<style type="text/css">
	body{
		color: #fff;
		background: #63738a;
		font-family: 'Roboto', sans-serif;
	}
    .form-control{
		height: 40px;
		box-shadow: none;
		color: #969fa4;
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
    .form-control, .btn{        
        border-radius: 3px;
    }
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
        margin: 0 0 15px;
		position: relative;
		text-align: center;
    }
	.signup-form h2:before, .signup-form h2:after{
		height: 2px;
		width: 30%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}
    .signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
    .signup-form form, .thumbnail {
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #f2f3f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
        font-size: 16px;
        font-weight: bold;		
		min-width: 140px;
        outline: none !important;
    }
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
    .signup-form a{
		color: #fff;
		text-decoration: underline;
	}
    .signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
	}
.menu a { color:#fff; }
.clear { clear:both; }
.table { background:#fff; }
.table td, .table th, .modal-title { color:#666; }
</style>
    </head>
    <body>
	
    <div class="signup-form">		
		<div class="menu">
			<div class="navbar-header">
				<a class="navbar-brand text-center" href="#">Car Inventory</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="/test/">Add Manufacturer</a></li>
				<li><a href="/test/model_html.php">Add Model</a></li>
				<li><a href="/test/view_inventory.php">View Inventory</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="thumbnail">
			<h2 class="text-center">Inventory</h2>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th style="width: 10%">
						<div>Sr. No.</div>
					</th>
					<th style="width: 40%">
						<div>Manufacturer Name</div>
					</th>
					<th style="width: 30%">
						<div>Model Name</div>
					</th>
					<th style="width: 20%">
						<div>Count</div>
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				while($row = $model->fetch_assoc()){
					echo '<tr  class="short_details" id='.$row['id'].' model='.$row['model'].' man_id='.$row['man_id'].'>
							<td>' . $i . '</td>
							<td>' . $row['name'] . '</td>
							<td>' . $row['model'] . '</td>
							<td>' . $row['count_pair'] . '</td>
						</tr>';
					$i++;
				}
				?>
				</tbody>
			</table>
		</div>
    </div>

	<div class="modal fade" id="model_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Car Details</h4>
                </div>
                <div class="modal-body">
					<div id="modal-data"></div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
    </body>
</html>