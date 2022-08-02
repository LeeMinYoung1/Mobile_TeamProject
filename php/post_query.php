<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');
    
    $post_code=isset($_POST['post_code']) ? $_POST['post_code'] : '';
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    

    $sql="select * from post where post_code = '$post_code'";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0)
    {
        $data = array(); 
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
        	extract($row);

       	 array_push($data, 
           		array('title'=>$row["title"],
           		'date'=>$row["date"],
           		'content'=>$row["content"],
           		'ingredient'=>$row["ingredient"]	
     	 ));
         }

        header('Content-Type: application/json; charset=utf8');
        $json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        echo $json;
    }

?>
