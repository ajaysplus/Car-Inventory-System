<?php
	if ( $_FILES['file']['error'] > 0 ){
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		$path_parts = pathinfo($_FILES["file"]["name"]);
		$image_path = $path_parts['filename'].'.'.$path_parts['extension'];
        if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $image_path))
        {
            echo $image_path;
        }
    }

?>