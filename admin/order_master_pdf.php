<?php
require('../vendor/autoload.php');
require('connection.inc.php');
require('constant.inc.php');
require('functions.inc.php');

$order_id = get_safe_value($con, $_GET['id']);

$user_name = '';
$total_price = 0;
$address = '';
$city = '';
$zip = '';

$css = file_get_contents('admin/assets/css/bootstrap.min.css');
$css .= file_get_contents('admin/assets/css/style.css');

$html = '
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Details </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Quantity</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-price">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>';

$sql = "select distinct(order_details.id), order_details.*, products.name, products.image, products.price, orders.address, orders.city, orders.zip, orders.order_status from order_details, products, orders where order_details.order_id = '$order_id' and order_details.product_id = products.id and orders.id = '$order_id'";
$result = mysqli_query($con, $sql);

$total_price = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_price += round($row['quantity'] * $row['price']);
    $address = $row['address'];
    $city = $row['city'];
    $zip = $row['zip'];
    $order_status = $row['order_status'];

    $html .= '<tr>
                                            <td class="product-add-to-cart"><a href="#">' . $row['name'] . '</a></td>
                                            <td class="product-name"><img src="' . PRODUCT_IMAGE_SITE_PATH . $row['image'] . '" alt=""></td>
                                            <td class="product-name">' . $row['quantity'] . '</td>
                                            <td class="product-name">' . round($row['price']) . '</td>
                                            <td class="product-price">' . round($row['quantity'] * $row['price']) . '</td>
                                        </tr>';
}
$html .= '<tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price with( 9% ) Tax</td>
                                        <td class="product-name">' . $total_price + round($total_price * $tax_percent) . '</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="address_details">
                                <strong>Address</strong><br>' . $address . ', ' . $city . ', ' . $zip . '<br><br>

                                <strong>Order Status</strong><br>';

$row = mysqli_fetch_assoc(mysqli_query($con, "select name from order_status where id = '$order_status'"));


$html .= $row['name'] . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html, 2);
$file = time() . ".pdf";
$mpdf->Output($file, "D");
