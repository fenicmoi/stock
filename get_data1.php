<?php
	include("library/database.php");
	

	////แสดงกลุ่มครุภัณฑ์ (group)






	
	if(isset($_GET['show_province'])){
		
		$sql = "SELECT gid, gnumber, gname FROM st_group";
		$result = dbQuery($sql);

		if (dbNumRows($result) > 0) {
			while($row = dbFetchAssoc($result)) {
				$json_result[] = [
                    'gid'=>$row['gid'],
                    'gnumber'=>$row['gnumber'],
					'gname'=>$row['gname'],
				];
			}
			echo json_encode($json_result);
		} 
	}

	
	//แสดงรายชื่อประเภท (class)
	if(isset($_GET['province_id'])){


		$province_id = $_GET['province_id'];
		$sql = "SELECT cid, cnumber, cname FROM st_class WHERE gid = ".$province_id." ";
		$result = dbQuery($result);

		if ($result->num_rows > 0) {
			while($row = dbFetchAssoc($result)) {
				$json_result[] = [
                    'cid'=>$row['cid'],
                    'cnumber'=>$row['cnumber'],
					'cname'=>$row['cname'],
				];
			}
			echo json_encode($json_result);
		} 
	}
	
	
	//แสดงรายชื่อประเภท (Type)
	if(isset($_GET['amphur_id'])){
		
		$amphur_id = $_GET['amphur_id'];
		$sql = "SELECT tid, tnumber, tname FROM st_typetype WHERE cid = '".$amphur_id."' ";
		$result = dbQuery($result);
		
		if ($result->num_rows > 0) {
			while($row = dbFetchAssoc($result)) {
				$json_result[] = [
					'tid'=>$row['tid'],
                    'tnumber'=>$row['tnumber'],
					'tname'=>$row['tname'],
				];
			}
			echo json_encode($json_result);
		} 
		
	}
	
	
?>