<?php
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

// function to manipulate data
function get_safe_value($con, $str)
{
    if (!empty($str)) {
        $str = trim($str);
        return mysqli_real_escape_string($con, $str);
    }
}

// funtion to get all products
function get_product($con, $type = '', $limit = '', $cat_id = '', $product_id = '', $search_str = '', $sort_order = '', $is_best_seller = '', $sub_id = '')
{
    $sql = "select products.*, categories.categories from products, categories where products.status = 1";
    if ($cat_id != '') {
        $sql .= " and products.categories_id = $cat_id";
    }

    if ($product_id != '') {
        $sql .= " and products.id = $product_id";
    }

    if ($sub_id != '') {
        $sql .= " and products.sub_categories_id = $sub_id";
    }

    if ($is_best_seller != '') {
        $sql .= " and products.best_seller = 1";
    }

    $sql .= " and products.categories_id = categories.id";

    if ($search_str != '') {
        $sql .= " and (products.name like '%$search_str%' or products.description like '%$search_str%')";
    }

    if ($sort_order != '') {
        $sql .= $sort_order;
    } else {
        $sql .= " order by products.id desc";
    }

    if ($limit != '') {
        $sql .= " limit $limit";
    }

    // echo $sql;
    $result = mysqli_query($con, $sql);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}
