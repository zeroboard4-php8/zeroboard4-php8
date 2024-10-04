<?php 
    chdir('../../../../');
    
    if($_GET['query']) {
      if(preg_match("/ |%|\?|\/\/|:/i", $_GET['query'])) die();
      //session_id($_GET['query']);
    }

    if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
		header("HTTP/1.1 500 Internal Server Error");
		echo "error : invalid upload";
		exit(0);
	}

    $zb_dir = './';
    $upload_dir = 'data/__DQ_Revolution_MultiUpload_TempDir__/';
    if(!file_exists($upload_dir)) 
    {
      mkdir($zb_dir.$upload_dir);
      //chmod($zb_dir.$upload_dir,0755);
    }

    if (!is_writable($zb_dir.$upload_dir)) {
		header("HTTP/1.1 501 Internal Server Error");
		echo "upload directory is not writable";
		exit(0);
	}

    $pathinfo  = pathinfo($_FILES["Filedata"]["name"]);
    $extension = $pathinfo['extension'];
    $dest_fileName = tempnam(realpath($zb_dir.$upload_dir),'_');

    $move = move_uploaded_file($_FILES["Filedata"]["tmp_name"],$dest_fileName);
    if (!$move) {
		header("HTTP/1.1 502 Internal Server Error");
		echo "error : upload file moving faild";
		exit(0);
	}

    //$file_id = basename($dest_fileName);
	$file_id = md5($_FILES["Filedata"]["tmp_name"] . microtime());

    $sessionName = $_GET['query'];
//    session_start();
//    $sessionName = session_id();
    $file = $zb_dir.$upload_dir.$sessionName;
    if(file_exists($file)) {
        $f = fopen($file,"r");
        if($f) $str = fread($f, filesize($file));
        fclose($f);
    }
    $f = fopen($file,"w");
    if($str) $str .= ",";         
    fputs($f,$str.$file_id.':'.basename($dest_fileName));
    fclose($f);

    echo $file_id;
?>
