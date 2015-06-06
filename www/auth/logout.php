<?php 
session_start();
session_destroy();
header('location:../index.php' . (isset ($_REQUEST['page']) ? '?page=' . $_REQUEST['page'] : ''));
?>
