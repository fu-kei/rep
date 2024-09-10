<?php
if(isset($_POST['code'])){
    $code = $_POST['code'];
    $pdo=db_connect();
    echo $code;
    $sql = $pdo->prepare('SELECT * from data WHERE code = '. $code. ';');
    var_dump($sql);
    $sql->execute();
    $row=$sql->fetchAll(PDO::FETCH_ASSOC);
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
    <form method="POST" action="sqlinj.php">
        <input type="text" class="form-control" id="Input1" name="code" placeholder="入力" required>
    </form>
    <?php
        if(isset($_POST['code'])){
            var_dump($row);
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