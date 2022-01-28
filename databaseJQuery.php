<?php
require_once "DB&Config.php";

function getNicks()
{
    $conn = DBconn();

    $query = "SELECT DISTINCT PName from x_world";
    
    $sth = $conn->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo json_encode($result);
}


function getUserInfo($nick)
{
    $conn = DBconn();

    $query = "SELECT DISTINCT Alliance, X, Y, VName from x_world WHERE PName = :pname";
    
    $sth = $conn->prepare($query);
    $sth->execute([':pname' => $nick]);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo json_encode($result);
}

function getAllyNicks()
{
    $conn = DBconn();

    $query = "SELECT DISTINCT PName from x_world WHERE Alliance = 'DC'";
    
    $sth = $conn->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
}

function getAllyInfo($nick)
{
    $conn = DBconn();

    $query = "SELECT DISTINCT Alliance, X, Y, VName from x_world WHERE PName = :pname";
    
    $sth = $conn->prepare($query);
    $sth->execute([':pname' => $nick]);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo json_encode($result);
}


if(isset($_GET['getNicks']))
{
    echo getNicks();
}
if(isset($_GET['getAllyNicks']))
{
    echo getAllyNicks();
}
if(isset($_GET['getUserInfo']))
{
    echo getUserInfo($_GET['getUserInfo']);
}
if(isset($_GET['getAllyInfo']))
{
    echo getUserInfo($_GET['getAllyInfo']);
}

?>