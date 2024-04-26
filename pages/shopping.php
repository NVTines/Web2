<head>

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/script.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    
</head>
<?php
    $query = "SELECT MIN(ProductPrice) as min_price, MAX(ProductPrice) as max_price FROM product ";
    $dtb = new database();
    $row = $dtb->get_data($query);
    $result = $row->fetch_assoc();
    $min = (int) $result["min_price"];
    $max = (int) $result["max_price"];
?>
<div style="width:100%;background-color:whitesmoke">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="product d-flex flex-column-fluid" id="kt_product">
                        <div id="kt_content_container" class="container-xxl">
                            <div class="d-flex flex-column flex-xl-row">
                                <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-1">
                                    <div class="card fs-6 text-gray-700 fw-bold card-flush " style="margin-top:0px;margin-right:20px;">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Filters</h2>
                                            </div>
                                        </div>
                                        <div class="card-body filter-card p-0">

                                            <div class="separator"></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Search</h4>
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <div class="d-flex w-5 align-items-center position-relative my-1">
                                                        <input id="searchKeyword" type="text" class="form-control form-control-solid ps-14" placeholder="Search Product">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="separator"></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Price</h4>
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <div class="price-slider">
                                                        <input autocomplete="off" type="hidden" id="minimum_price" value="<?php echo $min; ?>" />
                                                        <input autocomplete="off" type="hidden" id="maximum_price" value="<?php echo $max; ?>" />
                                                        <p id="price_text"><?php echo $min; ?> VNĐ - VNĐ <?php echo $max; ?></p>
                                                        <div id="price_range"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Brand</h4>
                                                    </div>

                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = "SELECT DISTINCT(ProducerName) FROM producer JOIN product ON producer.ProducerID = product.ProducerID ";
                                                    if($results = $dtb->get_data($query)){
                                                        while ($row = $results->fetch_assoc()) {
                                                            echo '
                                                            <div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                                <input class="form-check-input" data-filter="brand" type="checkbox" value="' . $row["ProducerName"] . '" id="brand" />
                                                                <label class="form-check-label" for="brand' . $row["ProducerName"] . '">
                                                                    ' . $row["ProducerName"] . '
                                                                </label>
                                                            </div>';
                                                        }
                                                    }
                                                    
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Size</h4>
                                                    </div>

                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = "SELECT value FROM size ORDER BY value ASC ";
                                                    if($results = $dtb->get_data($query)){
                                                        while ($row = $results->fetch_assoc()) {
                                                            echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                        <input class="form-check-input" type="checkbox"  data-filter="size"  value="' . $row["value"] . '" id="size" />
                                                        <label class="form-check-label" for="size' . $row["value"] . '">
                                                            ' . $row["value"] . '
                                                        </label>
                                                    </div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>category</h4>
                                                    </div>

                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = "SELECT DISTINCT(TypeName) FROM category JOIN product ON category.TypeID = product.TypeID ";
                                                    if($results = $dtb->get_data($query)){
                                                        while ($row = $results->fetch_assoc()) {
                                                            echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                        <input class="form-check-input" type="checkbox"  data-filter="category" value="' . $row["TypeName"] . '" id="category" />
                                                        <label class="form-check-label" for="category' . $row["TypeName"] . '">
                                                            ' . $row["TypeName"] . '
                                                        </label>
                                                    </div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-lg-row-fluid ms-lg-1">
                                    <div id="productsContainer" class="row g-1">

                                    </div>
                                    <div id="pagination" style="margin-top:25px;">


                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$dtb->close_dtb();
?>