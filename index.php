<?php 

include('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ТЗ Турбоподготовка</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Page Content -->
    
    <div class="container">
        <div class="row">
        	<br />
        	    <h2>Фильтр поиска товара</h2>
        	<br />
            <div class="col-md-9">
            	<br />
                    <div class="row filter_data">
                </div>
            </div>
            <div class="col-md-3">                				
				<div class="list-group">
					<h3>Цена</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="70000" />
                    <p id="price_show">1000 - 70000</p>
                    <div id="price_range"></div>
                </div>				
                <div class="list-group">
					<h3>Производитель</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(product_brand) FROM product WHERE product_status = '1' ORDER BY product_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" id="<?php echo $row['product_brand']; ?>" class="common_selector brand" value="<?php echo $row['product_brand']; ?>"  > <?php echo $row['product_brand']; ?></label>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>Оперативная память</h3>
                    <?php
                        $query = "
                        SELECT DISTINCT(product_ram) FROM product WHERE product_status = '1' ORDER BY product_ram DESC
                        ";
                        $statement = $connect->prepare($query);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        foreach($result as $row)
                        {
                        ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['product_ram']; ?>" > <?php echo $row['product_ram']; ?> GB</label>
                        </div>
                        <?php    
                        }
                    ?>
                </div>
				
				<div class="list-group">
					<h3>Втроенная память</h3>
					<?php
                    $query = "
                    SELECT DISTINCT(product_storage) FROM product WHERE product_status = '1' ORDER BY product_storage DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox"  class="common_selector storage" value="<?php echo $row['product_storage']; ?>"  > <?php echo $row['product_storage']; ?> GB</label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
                <div class="list-group">
					<h3>операционная система</h3>
					<?php
                    $query = "
                    SELECT DISTINCT(product_os) FROM product WHERE product_status = '1' ORDER BY product_os DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" id="<?php echo $row['product_os']; ?>"  class="common_selector os" value="<?php echo $row['product_os']; ?>" id="os" > <?php echo $row['product_os']; ?></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>
        </div>
    </div>
<!-- Script for filters -->
<script src="js/script.js"></script>

</body>

</html>
