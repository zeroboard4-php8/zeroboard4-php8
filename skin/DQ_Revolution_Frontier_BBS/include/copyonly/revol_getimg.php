<?php 
include "lib.php";
$conn = dbconn();
$id = !empty($_GET['id']) ? $_GET['id'] : null;
$no = !empty($_GET['no']) ? $_GET['no'] : null;
$num = isset($_GET['num']) ? $_GET['num'] : null;
$setup = get_table_attrib($id);
$dir = 'skin/'.$setup['skinname'];
include $dir.'/include/get_uploadimg.php';
?>
