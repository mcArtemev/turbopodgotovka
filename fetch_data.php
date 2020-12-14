<?php

include('database_connection.php');




if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product WHERE product_status = '1'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$brand_filter."')
		";
	}
	if(isset($_POST["ram"]))
	{
		$ram_filter = implode("','", $_POST["ram"]);
		$query .= "
		 AND product_ram IN('".$ram_filter."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND product_storage IN('".$storage_filter."')
		";
	}
	if(isset($_POST["os"]))
	{
		$os_filter = implode("','", $_POST["os"]);
		$query .= "
		 AND product_os IN('".$os_filter."')
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div class="card">
					<img src="image/'. $row['product_image'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="#">'. $row['product_name'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .' руб.</h4>
					<p>Камера : '. $row['product_camera'].' MP <br />
					Производитель : '. $row['product_brand'] .' <br />
					Оперативная память : '. $row['product_ram'] .' Гб <br />
					Втроенная память : '. $row['product_storage'] .' Гб <br />
					Операционная система : '. $row['product_os'] .' </p>
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>Товар не найден</h3>';
	}
	echo $output;
}


?>