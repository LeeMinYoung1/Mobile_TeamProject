<?php 
    include('dbcon.php');

    $result = "";
    #$host = 'localhost';
    #$username = 'PROJ'; # MySQL 계정 아이디
    #$password = '1234'; # MySQL 계정 패스워드
    #$dbname = 'projDB';  # DATABASE 이름

    $id = $_POST['id']; # 아이디
    $password = $_POST['password']; # 비밀번호
    $name = $_POST['name']; # 이름
    $nickname = $_POST['nickname']; # 닉네임

    #try {
        #$pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);

    #} catch(PDOException $e) {
        #die("Failed to connect to the database: " . $e->getMessage()); 
    #}

    if (empty($password)) {
        $errMSG = "비밀번호 입력!";
    }
    if (empty($id)) {
        $errMSG = "아이디 입력!";
    }
    if (empty($name)) {
        $errMSG = "이름 입력!";
    }
    if (empty($nickname)) {
        $errMSG = "닉네임 입력!";
    }

    if (!isset($errMSG)) {
        try {
            $query = $con->prepare('INSERT INTO member(id, password, name) VALUES(:id, :password, :name)');
            $query-> bindParam(':id', $id);
            $query-> bindParam(':password', $password);
            $query-> bindParam(':name', $name);
	     
	if ($query->execute()) {
	     $successMSG = "회원가입 성공!";
	} else {
	      $errMSG = "회원가입 실패";
	}
        } catch (PDOException $e) {
            die ("Database error: ". $e->getMessage());
        }
    }
?>

<?php 
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
?>