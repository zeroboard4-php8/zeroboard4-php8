<?php 
// 레볼루션을 사용중인 게시판인데 제로보드 파일을 통해 글쓰기를 시도할 경우 해킹이나 스팸봇에 의한 글쓰기로 간주하고 차단한다.
$REVOLUTION_FLAG=false;
if(file_exists($dir.'/skin_version.php') && require($dir.'/skin_version.php')) {
  if($dqrevolutionType == 'BBS' || $dqrevolutionType == 'Gallery') $REVOLUTION_FLAG = true;
  else $REVOLUTION_FLAG = false;
  if($REVOLUTION_FLAG && $skin_version) $REVOLUTION_FLAG = true;
  else $REVOLUTION_FLAG = false;
}

$PHPSELF = !empty($PHP_SELF) ? $PHP_SELF : ($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF'));

if($REVOLUTION_FLAG && eregi("^write_ok.php|^comment_ok.php",basename($PHPSELF))) die('Access Denied');
?>
