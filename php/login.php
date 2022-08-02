<?php 
   	 include('dbcon.php');

   	$result = "";
	$search = "";
    	#$host = 'localhost';
    	#$username = 'PROJ'; # MySQL 계정 아이디
    	#$password = '1234'; # MySQL 계정 패스워드
	#$dbname = 'projDB';  # DATABASE 이름
	$id = $_POST['id']; # id
	$password = $_POST['password']; # password

function checkID ($con, $id, $password) {
	global $errMSG;
	global $successMSG;
	$query = "SELECT ID FROM member";
	$query .= " WHERE ID = '$id'";

	if (empty($id)) {
		return $errMSG = "아이디 입력";
	}
	if (empty($password)) {
		return $errMSG = "비밀번호 입력";
	}

	if (!isset($errMSG)) { # ID 유무 검사
		try {
			$statement = $con->prepare($query);
			$statement->execute();
			
			# PDO::FETCH_ASSOC
			# 데이터베이스의 열 이름으로 인덱싱된 배열을 반환
			$row = $statement->fetch(PDO::FETCH_ASSOC); 
			$search = $row['ID'];
			if ($id != $search) {
				return $errMSG = "아이디를 찾을 수 없어요.";
			} else {
				return checkPassword($con, $id, $password);
			}
		} catch (PDOException $e) {
			return die ("Database error: ". $e->getMessage());
		}
	} else {
		return $errMSG = "로그인 실패";
	}
}	

function checkPassword($con, $id, $password) {
	global $errMSG;
	global $successMSG;
	$query = "SELECT ID FROM member";
	$query .= " WHERE ID = '$id'";
	$query .= " AND PASSWORD = '$password'";

	if (!isset($errMSG)) { # Password가 맞는지 검사
		try {
			$statement = $con->prepare($query);
			$statement->execute();
			
			# PDO::FETCH_ASSOC
			# 데이터베이스의 열 이름으로 인덱싱된 배열을 반환
			$row = $statement->fetch(PDO::FETCH_ASSOC); 
			$search = $row['ID'];
			if ($id != $search) {
				return $errMSG = "비밀번호가 틀렸어요..";
			} else {
				return $successMSG = "로그인 성공";
			}
		} catch (PDOException $e) {
			return die ("Database error: ". $e->getMessage());
		}
	} else {
		return $errMSG = "로그인 실패";
	}
}
	checkID($con, $id, $password);
?>

<?php
	if (isset($errMSG)) echo $errMSG;
	if (isset($successMSG)) echo $successMSG;

	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
?>