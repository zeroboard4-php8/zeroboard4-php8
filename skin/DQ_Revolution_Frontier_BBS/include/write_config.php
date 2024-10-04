<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');

//if($_POST['upload_number']>99) $_POST['upload_number'] = 99;
if(!isset($member_picture_x)) $member_picture_x='';
if(!isset($member_picture_y)) $member_picture_y='';
$_CONFIG_MBPIC_STR = "<?php \n";
$_CONFIG_MBPIC_STR .= "\$skin_setup['member_picture_x'] = \"$member_picture_x\";\n";
$_CONFIG_MBPIC_STR .= "\$skin_setup['member_picture_y'] = \"$member_picture_y\";\n";
$_CONFIG_MBPIC_STR .= "?>\n";

if( !empty($copy_file) && $cfg_link == 1 ) {
	$_CONFIG_STR .= "<?php \n";
	$_CONFIG_STR .= "\$cfg_linkFile   = \"$copy_file\"; \n";
	$_CONFIG_STR .= "include \$_SKIN_config_dir.\$cfg_linkFile; \n";
	$_CONFIG_STR .= "\$skin_setup['version']   = \"$skin_version\";\n";
	$_CONFIG_STR .= "\$skin_setup['config_id'] = \"$id\";\n";
	$_CONFIG_STR .= "?>\n";
} else {
	if( !empty($copy_file) && $cfg_link == 2){
		$_SKIN_config_file_old = $_SKIN_config_file;
		for( $i==0; $i<count($_POST ); $i++) {
			$current = key( $_POST );
			unset( $_POST[$current] );
			next( $_POST );
		}
		unset( $_POST );
		include $_SKIN_config_dir.$copy_file;
		$_POST = $skin_setup;
		foreach ( $skin_setup as $key => $value ) 
		{
		   if( !eregi("^config_id|^version",$key) ) {
			   if( is_string($value)&& ereg("[^\\]\"", $value) ) $value = addslashes( trim($value) );
			   $$key = $value;
			   $_POST[$key] = $value;
		   }
		}
		$_SKIN_config_file = $_SKIN_config_file_old;
	}

	// echo "<pre>"; var_dump($_POST); echo "</pre>"; die();

	unset($tmp);
	$using_titlebar3 = $_POST['using_titlebar3'] = 1;
	if(!empty($using_titlebar1)) $tmp = 1;
	if(!empty($using_titlebar2)) $tmp = 2;
	if(!empty($using_titlebar3)) $tmp = 3;
	if(!empty($using_titlebar4)) $tmp = 4;
	if(!empty($using_titlebar5)) $tmp = 5;
	if(!empty($using_titlebar6)) $tmp = 6;
	if(!empty($using_titlebar7)) $tmp = 7;
	if(empty($tmp)) $using_titlebar = '';

	ksort( $_POST );

	$_CONFIG_STR = "<?php \n";
	$_CONFIG_STR .= "\$skin_setup['config_id'] = \"$id\";\n";
	$_CONFIG_STR .= "\$skin_setup['version']   = \"$skin_version\";\n";

	$passkey = array('pos','css_sel','lang_sel','copy_file','cfg_link','submit2','save_as','save_file');
	foreach ( $_POST as $key => $value ) 
	{
		if( !preg_match("/^config_id|^version/i",$key) ) {
			if( is_string( $value ) && preg_match("/\[^\\\]\"/", $value)) $value = addslashes($value);
			if(preg_match("/^thumb_info/i",$key)) $value = addslashes($value);
			if( !in_array( $key,$passkey ) ) {
				$_CONFIG_STR .= "\$skin_setup['$key'] = \"$value\";\n";
			}
		}
	}

	$_CONFIG_STR .= "?>\n";
}
?>
