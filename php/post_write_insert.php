<?php 
    include('dbcon.php');

    $result = "";
    #$host = 'localhost';
    #$username = 'PROJ'; # MySQL 계정 아이디
    #$password = '1234'; # MySQL 계정 패스워드
    #$dbname = 'projDB';  # DATABASE 이름

    $title = $_POST['title']; # 제목
    $content = $_POST['content']; # 내용
    $ingredient = $_POST['ingredient']; # 재료
    $post_code = $_POST['post_code']; # 게시글 번호		

    #try {
        #$pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);

    #} catch(PDOException $e) {
        #die("Failed to connect to the database: " . $e->getMessage()); 
    #}

    if (empty($title)) {
        $errMSG = "제목 입력!";
    }

    if (!isset($errMSG)) {
        try {
            $query = $con->prepare('INSERT INTO post(title, content, ingredient, date, board_code, post_code) VALUES(:title, :content, :ingredient, now(), "testb1", :post_code)');
            $query-> bindParam(':title', $title);
            $query-> bindParam(':content', $content);
            $query-> bindParam(':ingredient', $ingredient);
            $query-> bindParam(':post_code', $post_code);
	     
	if ($query->execute()) {
	     $successMSG = "게시글이 작성되었습니다!";
	} else {
	      $errMSG = "게시글 작성이 실패했습니다";
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