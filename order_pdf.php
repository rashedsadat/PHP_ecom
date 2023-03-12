<?php
require("vendor/autoload.php");
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

if (!isset($_SESSION['USER_ID'])) {
    header("location:login.php");
}

$order_id = get_safe_value($con, $_GET['id']);

$css = file_get_contents("css/bootstrap.min.css");
$css .= file_get_contents("style.css");

$html = '
<div class="wishlist-table table-responsive">
    <h1 style="text-align: center; margin-bottom:50px; font-weight:600;">Your order details</h1>
    <table>
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
$user_id = $_SESSION['USER_ID'];

$sql = "select distinct(order_details.id), order_details.*, products.name, products.image, products.price from order_details, products, orders where order_details.order_id = '$order_id' and orders.user_id = '$user_id' and products.id = order_details.product_id";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) <= 0) {
    die();
}
$total_price = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_price += round($row['quantity'] * $row['price']);

    $html .= '
            <tr>
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
</div>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html, 2);
$name = time() . ".pdf";
$mpdf->Output($name, "D");
