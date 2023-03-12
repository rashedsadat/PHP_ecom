<?php

class addToCart
{
    function addProduct($product_id, $quantity)
    {
        $_SESSION['CART'][$product_id]['QTY'] = $quantity;
    }

    function updateProduct($product_id, $quantity)
    {
        if (isset($_SESSION['CART'][$product_id])) {
            $_SESSION['CART'][$product_id]['QTY'] = $quantity;
        }
    }

    function removeProduct($product_id)
    {
        if (isset($_SESSION['CART'][$product_id])) {
            unset($_SESSION['CART'][$product_id]);
        }
    }

    function emptyProduct()
    {
        unset($_SESSION['CART']);
    }

    function totalProduct()
    {
        if (isset($_SESSION['CART'])) {
            return count($_SESSION['CART']);
        } else {
            return 0;
        }
    }
}
