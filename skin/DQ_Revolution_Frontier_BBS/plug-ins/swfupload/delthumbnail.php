<?php 
if(eregi(' ',$filename)) die();
if(eregi(' ',$zbid)) die();
if(eregi(' ',$no)) die();

$fileid = $_GET['filename'];

chdir('../../../../');
require '_head.php';

if($_GET['mode'] == 'modify' && eregi("^revol_",$fileid)) 
{
    $mdata = mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='".$zbid."' and zb_no='".$no."'")) or zb_error();
    $data  = mysql_fetch_array(zb_query("select * from $t_board"."_$zbid where no='$no'"));

    if($data['ismember'] && $member['no'] != $data['ismember']) die('Access Denied');

    $mFiles = explode(',',$mdata['file_names']);
    $sFiles = explode(',',$mdata['s_file_names']);

    for($i=0;$i<count($mFiles);$i++){
        if(!$mFiles[$i]) {
          $mFiles = array_splice($mFiles,$i+1,1);
          $sFiles = array_splice($sFiles,$i+1,1);
        }
    }

    if($num == 0 && $data['file_name1']) 
    {
      zb_query("update $t_board"."_$zbid set file_name1='', s_file_name1='' where no=$no");
      unlink($data['file_name1']);
    } 
    elseif($num == 1 && $data['file_name2']) 
    {
      zb_query("update $t_board"."_$zbid set file_name2='', s_file_name2='' where no=$no");
      unlink($data['file_name2']);
    }
    elseif($mFiles[$num-2])
    {
      $keyPoint = $num-2;
      $mFiles[$keyPoint];
      unlink($mFiles[$keyPoint]);

      unset($mFiles[$keyPoint]);
      unset($sFiles[$keyPoint]);
      $mFiles = implode(',',$mFiles);
      $sFiles = implode(',',$sFiles);
      zb_query("update dq_revolution set file_names='$mFiles', s_file_names='$sFiles' where zb_id='$zbid' and zb_no='$no'");
    }
}
else 
{
    $fileid = $_SESSION[$fileid];
    $swfu_tempDir = 'data/__DQ_Revolution_MultiUpload_TempDir__/';
    $dir = (!eregi("^data",$fileid)) ? $swfu_tempDir : '';
    if(file_exists($dir.$fileid)) 
    {
        if(unlink($dir.$fileid)) {
          echo $fileid;
        }
        else echo 'faild';
    } else echo 'file not found : '.$dir.$fileid;
}
?>
