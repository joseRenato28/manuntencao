<?php
require_once('template.php');
if (!isset($TPL)) {
    $TPL = new Template();
    $TPL->PageTitle = "Home";
    $TPL->ContentBody = __FILE__;
    include "header.php";
    exit;
}
?>
<h1>Home</h1>