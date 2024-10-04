<?php
    $_zb_path = "../";

    include "../lib.php";

    $connect=dbconn();

    $member=member_info();

    if(!$member['no']||$member['is_admin']>1||$member['level']>1) Error("최고 관리자만이 사용할수 있습니다");
	
	$no = isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) ? $_REQUEST['no'] : '';

    $board_info=mysql_fetch_array(zb_query("select * from $admin_table where no='$no'",$connect));

    $id=$board_info['name'];
 
    head("bgcolor=black");
	
    $skinname=$board_info['skinname'];
    $scanarr = array();
    if (!is_dir('../skin/'.$skinname.'/')) {
        $skinstat = "스킨 디렉토리 접근 불가";
	} elseif (in_array($skinname, array('DQuest_thumb_gray', 'DQuest_thumb_white', 'DQ_Revolution_Frontier_BBS', 'DQ_Revolution_Frontier_Gallery'))) {
        $skinstat = "완료";
    } else {
        scanskindir('../skin/'.$skinname.'/');
        if (!is_dir('../skin/'.$skinname.'/original')) {
            @mkdir('../skin/'.$skinname.'/original', 0755, true);
            if (is_dir('../skin/'.$skinname.'/original')) {
                foreach ($scanarr as $file) {
                    if (preg_match("/(\.(php|php3|htm|html|txt|css|js))$/i", strtolower($file)) && filesize($file) > 0) {
                        if (!file_exists(dirname($file)."/original/".basename($file))) {
                            @copy($file, dirname($file)."/original/".basename($file));
                        }
                        $f = @fopen($file,"r");
                        $temp = @fread($f,filesize($file));
                        @fclose($f);
                        if (!is_utf8($temp)) {
                            $temp = iconv("EUC-KR", "UTF-8", $temp);
                        }
                        if (empty($temp)) {
                            continue;
                        }
                        $temp = str_replace("<?php", "<?", $temp);
                        $temp = str_replace("<?php ", "<?", $temp);
                        $temp = str_replace("<? ", "<?", $temp);
                        $temp = str_replace("<?", "<?php ", $temp);
                        $temp = str_replace("<?php =", "<?=", $temp);
                        $temp = str_replace("mysql_query(", "zb_query(", $temp);
                        $temp = str_replace("mysql_error(", "zb_error(", $temp);
                        $temp = preg_replace("/(\\$[a-z_][a-z0-9_]*)\\[([a-z][a-z0-9_]*)\\]/", "$1['$2']", $temp);
		
                        $f = @fopen($file,"w");
                        @fwrite($f, $temp);
                        @fclose($f);
                    }
                }
                $skinstat = "성공";
            } else {
                $skinstat = "퍼미션 체크";
            }
        } else {
            $skinstat = "완료";
        }
    }
 
    function is_utf8($string) {
        // UTF-8 문자열은 1바이트에서 4바이트로 구성됩니다.
        // 각 바이트는 특정 범위 내에 있어야 합니다.
        return preg_match('%^(?:
              [\x09\x0A\x0D\x20-\x7E]            # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # 2바이트 시퀀스
            | \xE0[\xA0-\xBF][\x80-\xBF]         # 3바이트 시퀀스 (E0)
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # 3바이트 시퀀스 (E1-EC, EE-EF)
            | \xED[\x80-\x9F][\x80-\xBF]         # 3바이트 시퀀스 (ED)
            | \xF0[\x90-\xBF][\x80-\xBF]{2}      # 4바이트 시퀀스 (F0)
            | [\xF1-\xF3][\x80-\xBF]{3}          # 4바이트 시퀀스 (F1-F3)
            | \xF4[\x80-\x8F][\x80-\xBF]{2}      # 4바이트 시퀀스 (F4)
        )*$%xs', $string);
    }

    function scanskindir($dir) {
        global $scanarr;
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file === '.' || $file === '..' || $file === 'original') continue;
                    if (is_dir($dir.$file)) {
                        scanskindir($dir.$file.'/');
                    } else {
                        $scanarr[] = $dir.$file;
                    }
                }
                closedir($dh);
            }
        }
        return $scanarr;
    }
?>
<img src=../images/t.gif border=0 width=1 height=8><Br>
<u><center><font color=aaaaaa>[<b><?=$id?></b>] 게시판 정리</font></center></u><Br>
<img src=../images/t.gif border=0 width=1 height=8><Br>
<font color=white>&nbsp;&nbsp;&nbsp;&nbsp;스킨 패치 : <font color=yellow><?php echo $skinstat; ?></font>
<font color=white>&nbsp;&nbsp;&nbsp;&nbsp;Category 정리 :
<?php
  $s_que="";
  $f_cn="";
  $temp=zb_query("select * from $t_category"."_$id order by no asc");
  while($no=mysql_fetch_array($temp))
  {
   if(!$f_cn)$f_cn=$no['no'];
   $s_que.=" category!='$no[no]' and ";
  }
  $s_que.=" category!=0";
  $check=zb_query("update $t_board"."_$id set category='$f_cn' where $s_que",$connect) or (zb_error());

  $temp=zb_query("select * from $t_category"."_$id order by no asc");
  while($no=mysql_fetch_array($temp))
  {
   $c=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where category='$no[no]'",$connect));
   zb_query("update $t_category"."_$id set num='$c[0]' where no='$no[no]'",$connect) or error(zb_error());
  }
  echo"<font color=yellow>성공</font>";
?>
<font color=white>&nbsp;&nbsp;&nbsp;&nbsp;Division 정리 :
<?php
  $temp=zb_query("select * from $t_division"."_$id order by no asc",$connect);
  while($data=mysql_fetch_array($temp))
  {
   $c=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where division='$data[division]'",$connect));
   zb_query("update $t_division"."_$id set num='$c[0]' where division='$data[division]'",$connect) or Error(zb_error());
  }
  $temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id",$connect));
  zb_query("update $admin_table set total_article='$temp[0]' where no='$no'",$connect) or Error(zb_error());
  echo"<font color=yellow>성공</font>";
?>
<br><br><center><a href=# onclick=window.close()><font color=888888>[close windows]</font></a>
<?php
 foot();
 mysql_close($connect);
?>
