<?php
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	function zbDB_getFields($tableName) {
		global $connect;
		$result = zb_query("show fields from $tableName",$connect) or die(zb_error());
		unset($query);
		$query = '';
		while($data=mysql_fetch_array($result)) {
			$field = $data['Field'];
			$type = " ".$data['Type'];
			if($data['Null']=="YES") $null = " null"; else $null = " not null";
			if($data['Default']) $default = " default '".$data['Default']."'"; else $default="";
			$extra = " ".$data['Extra'];
			if($data['Key']=="PRI") $key = " primary key"; else $key="";
			$query .= "    ".$field.$type.$null.$default.$extra.$key.",\n";
		}
		return $query;
	}

	function zbDB_getKeys($tableName) {
		global $connect;
		$result = zb_query("show keys from $tableName",$connect) or die(zb_error());
		unset($query);
		$i=0;
		$toggle_name = '';
		$query = '';
		while($data=mysql_fetch_array($result)) {
			if($data['Key_name']!="PRIMARY") {
				$key_name = $data['Key_name'];
				$column_name = $data['Column_name'];
				if($toggle_name!=$key_name) {
					if($toggle_name) $query .="),\n";
					$query .= "    KEY $key_name ($column_name";
					$toggle_name=$key_name;
				} else {
					if($toggle_name) {
						$query .= ",$column_name";
					}
				}
			}
		}
		if($toggle_name&&$toggle_name==$key_name) $query.="),\n";
		return $query;
	}

	function zbDB_getSchema($tableName) {
		$fields = zbDB_getFields($tableName);
		$key = zbDB_getKeys($tableName);
		$schema = $fields."\n".$key;
		$schema = substr($schema,0,strlen($schema)-2);
		$schema = "\nCREATE TABLE $tableName ( \n".$schema." \n); ";
		echo $schema;
		flush();
	}

	function zbDB_getDataList($tableName) {
		global $connect;
		$result = zb_query("show fields from $tableName", $connect) or die(zb_error());
		$field = '';
		while($data=mysql_fetch_array($result)) {
			$field .= $data['Field'].",";
		}
		$field = substr($field,0,strlen($field)-1);
		$field_array = explode(",",$field);
		$field_count = count($field_array);

		$query = "\n";
		$result = zb_query("select $field from $tableName") or die(zb_error());
		while($data=mysql_fetch_array($result)) {
			unset($str);
			$str = '';
			for($i=0;$i<$field_count;$i++) {
				$str .= " '".addslashes(stripslashes($data[$field_array[$i]]))."',";
			}
			$str = substr($str,0,strlen($str)-1);
			echo "INSERT INTO ".$tableName." VALUES (".$str.");\n";
			flush();
		}
	}

	function zbDB_down($tableName) {
		echo "\n#\n# '$tableName' structure \n#\n";
		zbDB_getSchema($tableName);
		echo "\n";
		echo "\n#\n# '$tableName' data \n#\n";
		zbDB_getDataList($tableName);
		echo "\n# End of $tableName Dump\n";
		flush();
	}

	function zbDB_All_down($dbname) {
		global $connect;
		$result = zb_query("show table status from $dbname like '".$table_prefix."%'",$connect) or die(zb_error());
		$i=0;
		while($dbData=mysql_fetch_array($result)) {
			$tableName = $dbData['Name'];
			echo "\n\n";
			zbDB_down($tableName);
		}
	}

	function zbDB_Header($filename) {
		@ini_set('zlib.output_compression','Off');
		@ini_set('output_buffering','Off');
		header("Content-Type: application/force-download");
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Disposition: attachment; filename=\"".$filename."\"");
		header("Content-Transfer-Encoding: binary");
	}
?>
