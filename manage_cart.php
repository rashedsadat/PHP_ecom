<?php

require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$product_id = get_safe_value($con, $_POST['id']);
$quantity = get_safe_value($con, $_POST['quantity']);
$type = get_safe_value($con, $_POST['type']);

$cart = new addToCart();

if ($type == 'add') {
    $cart->addProduct($product_id, $quantity);
}

if ($type == 'remove') {
    $cart->removeProduct($product_id);
}

if ($type == 'update') {
    $cart->updateProduct($product_id, $quantity);
}

echo $cart->totalProduct();
