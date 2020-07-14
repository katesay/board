<?php
  /// 여기는 필요한 설정으로 바꿔서 사용해주세요
  // 데이터베이스 사용자
  $user = 'php7';
  $password = 'php777';
  // 이용할 데이터베이스
  $dbName = 'testdb';
  $charset = "utf8";
  // MySQL 서버
  $host = 'localhost:3306';

  // MySQL의 DSN 문자열
  $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";

  
  ?>