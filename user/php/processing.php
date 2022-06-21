<?php
session_start();
include "../../Connection.php";
error_reporting(0);

$msg = mysqli_real_escape_string($conn, $_POST['msg']);

//general questions
$sql = "SELECT response FROM knowledge WHERE phrase LIKE '%{$msg}%'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    $res = mysqli_fetch_assoc($query);
    $output = $res['response'];
    if (!substr($output, 0, 1) != '#') {
        echo $output;
    }
} else {
    strpos($msg, 'buy') !== false? $_SESSION['buy'] = true : $_SESSION['buy'] = false;
    execUserRequest($conn, $msg);
}
function execUserRequest($conn, $msg_or)
{
    $productResult = '';
    $varietyName = '';
    $varietyResult = '';
    $quantityResult = '';
    $output = '';
    $productIsNull = true;
    $varietyIsNull = true;
    $quantityIsNull = true;
    $msgs = explode(" ", $msg_or);

    foreach ($msgs as $m) {
        list($productResult, $productIsNull) = getProducts($conn, $m, $msg_or);
        if (!$productIsNull) {
            break;
        }
    }
    foreach ($msgs as $m) {
        list($varietyName, $varietyResult, $varietyIsNull) = getVarieties($conn, $m, $msg_or);
        if (!$varietyIsNull) {
            $_SESSION['variety'] = '';
            $_SESSION['variety'] = $varietyName;
            break;
        }
    }
    if ($_SESSION['variety'] != '') {
        $varietyName =  $_SESSION['variety'];
        $varietyIsNull =  false;
    }
    if (!$varietyIsNull) {
        foreach ($msgs as $m) {
            list($quantityResult, $quantityIsNull) = getQuanties($conn, $m, $varietyName);
            if (!$quantityIsNull) {
                $_SESSION['variety'] = '';
                break;
            }
        }
    }
    if (!$quantityIsNull) {
        if($_SESSION['buy'] == true) {
            makeOrder($conn, $_SESSION['variety']);
            echo $quantityResult;
        } 
        else {
            echo  $quantityResult;
        }
    } elseif ($quantityIsNull && !$productIsNull) {
        echo $productResult;
    } elseif ($quantityIsNull && !$varietyIsNull && $varietyResult != '') {
        echo $varietyResult;
    } elseif ($quantityIsNull && !$varietyIsNull && $varietyResult == '') {
        echo 'Specify the quantity of ' . $_SESSION['variety'];
    } else {
        echo " Please,I can not understand. Please try again";
    }
}
function getProducts($conn, $msg, $msg_or)
{
    $sql = "SELECT name FROM products WHERE name LIKE '%{$msg}%'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $sql = "SELECT  DISTINCT(v.name) as variety
                from  variety v 
                join products p 
                on v.productId = p.id WHERE p.name LIKE '%{$msg}%'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $results = '<p>We have the following varieties of ' . $msg . ': <br/>';
            while ($data = mysqli_fetch_assoc($query)) {
                $results .= $data['variety'] . ' <br/>';
            }
            if (!pullVarietyAssistant($conn, $msg_or)) {
                $results .= 'Specify the variety of ' . $msg;
            }
            return array($results, false);
        }
    } else {
        return array('', true);
    }
}
function getVarieties($conn, $msg, $msg_or)
{
    $sql = "SELECT name FROM variety WHERE name LIKE '%{$msg}%'";
    $query = mysqli_query($conn, $sql);
    $output = '';
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        if (pullQuantityAssistant($conn, $msg_or)) {
            $sql = "SELECT 
            c.cost as cost,c.qnty as qnty
            FROM price c 
            join  variety v 
            on c.varietyId = v.id 
            WHERE v.name='{$msg}'";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query)) {
                $output .= "<p>These are the quantities of {$msg} <br/>";
                while ($row = mysqli_fetch_array($query)) {
                    $output .= $row['qnty'] . ' @ ' . $row['cost'] . "<br/>";
                }
                return array($res['name'], $output, false);
            }
        }
        return array($res['name'], $output, false);
    } else {
        return array('', $output, true);
    }
}
function getQuanties($conn, $msg, $varietyName)
{
    $sql = "SELECT 
            c.cost as cost,c.qnty as qnty, c.isavailable as status
            FROM price c 
            join  variety v 
            on c.varietyId = v.id 
            WHERE c.qnty LIKE '%{$msg}%' and v.name='{$varietyName}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        if ($res['status'] == 0 ) {
            $results = 'Hello, The price of ' . $varietyName . ' is as follows:';
            $results .= '<p>' . $msg . ' @ ' . $res['cost'] . '</p>';
            $results .= 'However, it is out of stock';
        }
        else if($_SESSION['buy'] !== false){
            $results = 'You have ordered <br>' . $varietyName;
            $results .= '<p>' . $msg . ' @ ' . $res['cost'] . '</p>';
            $results .= 'Our delivery agent will call you shortly to confirm you order';
        }
        else{
            $results = 'Hello, The price of ' . $varietyName . ' is as follows:';
            $results .= '<p>' . $msg . ' @ ' . $res['cost'] . '</p>';
        }
        
        return array($results, false);
    } else {
        return array('', true);
    }
}

function pullVarietyAssistant($conn, $msg_or)
{
    $varietyAss = array();
    $sql = "SELECT phrase  FROM knowledge WHERE response ='#v'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $varietyAss[] = $row['phrase'];
    }
    foreach ($varietyAss as $dt) {
        if (stristr($msg_or, $dt) == true) {
            return true;
        }
    }
    return false;
}
function pullQuantityAssistant($conn, $msg_or)
{
    $quantityAss = array();
    $sql = "SELECT phrase  FROM knowledge WHERE response ='#q'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $quantityAss[] = $row['phrase'];
    }
    foreach ($quantityAss as $dt) {
        if (stristr($msg_or, $dt) == true) {
            return true;
        }
    }
    return false;
}

function makeOrder($conn, $variety)
{
    $sql = "SELECT id FROM variety WHERE name LIKE '%{$variety}%'";
    $sql1 = "SELECT id FROM registration WHERE username = '{$_SESSION['Username']}'";
    $q1 = mysqli_query($conn, $sql);
    $q2 = mysqli_query($conn, $sql1);
    $output = '';
    if (mysqli_num_rows($q1) > 0 && mysqli_num_rows($q2) > 0) {
        $var = mysqli_fetch_assoc($q1);
        $user = mysqli_fetch_assoc($q2);
        $sql = "INSERT INTO requests (`variety_id`, `user_id`) values(".$var['id'].",".$user['id'].")";
        $query = mysqli_query($conn, $sql);
        return mysqli_error($conn);
    }
}