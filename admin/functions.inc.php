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
