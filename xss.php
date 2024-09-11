<?php
if(isset($_POST['code'])){
    $code = $_POST['code'];
    $pdo=db_connect();
    $sql = $pdo->query('SELECT count(*) as cnt FROM xssdata');
    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
    var_dump($row);
    if($row[0]['cnt']==NULL){
        $id = 0;
    }
    else{
        $id = $row[0]['cnt'];
    }
    $sql = $pdo->prepare("INSERT INTO xssdata(id, xssText) VALUES ('$id','$code') ;");
    $sql->execute();
}

?>

<!doctype html>
<html>
<meta lang="ja">
<head>
<!-- Bootstrap JavaScriptの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <form method="POST" action="xss.php">
        <input type="textarea" class="form-control" id="Input1" name="code" placeholder="入力" required>
    </form>
    <?php
        if(isset($_POST['code'])){
            $sql = $pdo->query('SELECT * FROM xssdata');
            $row = $sql->fetchALL(PDO::FETCH_ASSOC);
            foreach($row as $temp){
                ?>
                <p><?php var_dump($temp);?></p>
                <?php
            }
        }
    ?>
</body>
<footer>
</footer>
</html>

<?php
    function db_connect(){
        $host = '';
        $dbname = '';
        $user = '';
        $password = '';  
        try{
          $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
          echo $e->getMessage();
        }
        return $pdo;
      }
?>