<?php 
    $t_board = '';
    if(eregi(":\/\/| |%",$id)) die();
    if(eregi(":\/\/| |%",$no)) die();

    chdir('../../');
    require_once '_head.php';

	$data=mysql_fetch_array(zb_query("select * from  $t_board"."_$id  where no='$no'"));

	if(!$data['no']) die();

	if(!eregi($setup['no']."_".$no,$_SESSION['zb_hit'])) {
		zb_query("update $t_board"."_$id set hit=hit+1 where no='$no'");
		$hitStr=",".$setup['no']."_".$no;
		
		$zb_hit=$_SESSION['zb_hit'].$hitStr;
		session_register('zb_hit');
	}
?>
