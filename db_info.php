<?php
function dbConnect($dsn, $user, $password,$dbName) {
  //MySQL 데이터베이스에 접속한다
  try {
    $pdo = new PDO($dsn, $user, $password);

    // 프리페어 스테이트먼트의 에뮬레이터를 무효로 한다
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 예외가 쓰로우되는 설정으로 한다
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    d("데이터베이스 {$dbName}에 접속했습니다.");
    
    return $pdo;
  
  } catch (Exception $e) {
     echo '<span class="error">오류가 있습니다. </span><br>';
     echo $e->getMessage();
  
     exit();
  }
}

function dbClose($pdo) {
      // 접속을 삭제한다
    //$pdo = NULL;
    unset($pdo);
}
  ?>