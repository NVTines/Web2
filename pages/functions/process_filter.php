<?php
include __DIR__."/../../database.php";

if (isset($_POST['action'])) {

    $sql = "SELECT  p.ProductID,
                    p.ProducerID,
                    p.TypeID,
                    p.ProductName,
                    p.ProductPrice,
                    p.Size,
                    p.IMG,
                    producer.ProducerName
                    FROM  product p, producer, category 
                    WHERE p.ProducerID = producer.ProducerID AND p.TypeID = category.TypeID AND p.ProductName != ''";
    $page = isset($_POST["page"]) ? $_POST["page"] : 1;

    if (isset($_POST["minimumPrice"], $_POST["maximumPrice"])) {
        $minimumPrice = $_POST["minimumPrice"];
        $maximumPrice = $_POST["maximumPrice"];
        $sql .= " AND p.ProductPrice BETWEEN '" . $minimumPrice . "' AND '" . $maximumPrice . "'";
    }

    if (isset($_POST["brand"])) {
        $brand = $_POST["brand"];
        $brand = implode(",", $brand);
        $sql .= " AND producer.ProducerName IN (" . $brand . ")";
    }

    if (isset($_POST["category"])) {
        $category = $_POST["category"];
        $category = implode(",", $category);
        $sql .= " AND category.TypeName IN(" . $category . ")";
    }

    if (isset($_POST["size"])) {
        $size = $_POST["size"];
        $size = implode(",", $size);
        $sql .=  " AND p.Size IN(" . $size . ") ";
    }

    if (isset($_POST["searchKeyword"])) {
        $searchKeyword = $_POST["searchKeyword"];
        $sql .= " AND (
        producer.ProducerName LIKE '%$searchKeyword%' OR
        p.Size LIKE '%$searchKeyword%' OR
        p.ProductName LIKE '%$searchKeyword%' OR
        category.TypeName LIKE '%$searchKeyword%' OR
        p.ProductPrice LIKE '%$searchKeyword%')";
    }

    //Pagination
    $recordsPerPage = 16;
    $recordsFetched = ($page - 1) * $recordsPerPage;
    // echo "<h1>$sql</h1>";
    $totalRecords = mysqli_num_rows(mysqli_query($conn, $sql));
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $completeSql = "$sql ORDER BY ProductID DESC LIMIT $recordsFetched,$recordsPerPage ";
    $query = mysqli_query($conn, $completeSql);
    $products = '';

    $paginationData = '';
    if ($page > 1) {
        $paginationData .=  '<li class="paginate_button page-item previous" ><a data-page="' . ($page - 1) . '" class="page-link"><i class="previous"></i></a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $active = $i == $page ? "active" : "";
        $paginationData .= '<li class="paginate_button page-item ' . $active . '"><a data-page="' . $i . '" class="page-link">' . $i . '</a></li>';
    }

    if ($totalPages > $page) {
        $paginationData .= '<li class="paginate_button page-item next" ><a data-page="' . ($page + 1) . '" class="page-link"><i class="next"></i></a></li>';
    }

    $pagination = empty($paginationData) ? '' :  '<div class="card my-2 py-4">
                           <ul class="pagination"> ' . $paginationData . '</ul>
                </div>';

    while ($row = mysqli_fetch_array($query)) {
        $product_image = $row["IMG"];
        $image_src = 'assets/images/' . $product_image;
        $products .= '<div class="product-card col-md-6 col-lg-4 col-xxl-3">
                                    <div class="card h-100">
                                        <div class="h-250px text-center card-heading">
                                                <img class="mh-250px img-fluid" src="' . $image_src . '" alt="image">
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="card-body p-4">
                                            <a class="fs-5 wrap-text-1 fw-bold" >' . $row["ProductName"] . '</a>

                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Price:</span>
                                            <div class="ms-2 fw-bolder">' . number_format($row["ProductPrice"], 2) . ' VNĐ</div>
                                        </div>

                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Size:</span>
                                            <div class="ms-2 fw-bolder">' . $row["Size"] . '</div>
                                        </div>

                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Brand : </span>
                                            <div class="ms-2 fw-bolder">' . $row["ProducerName"] . '</div>
                                        </div>
                                        </div>
                                    </div>
                                </div>';
    }

    if (!mysqli_num_rows($query)) $products .= '<div class="card min-h-400px col-lg-12">
    <div div="" class="card-body justify-align-center less-container">
        <center><img style="width: 200px;opacity: .5;"
                src="assets/images/empty_search.jpg" alt="">
            <h2>Sorry, no results found!</h2>
            <h4 class="text-muted">Please check the spelling or try searching for something else:)</h4>
        </center>
    </div>
</div>';

    $output = new stdClass;
    $output->products = $products;
    $output->pagination = $pagination;
    echo json_encode($output);
}
