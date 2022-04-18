<?php
//DB接続
  function getPDO() {
    $db['host'] = 'localhost';
    $db['user'] = 'kazuki';
    $db['passwd'] = 'kazuki';
    $db['dbname'] = 'twitter';
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8;', $db['host'], $db['dbname']);
    try {
      return new PDO($dsn, $db['user'], $db['passwd']);

    } catch (PDOException $e) {
      echo('DB接続に失敗!!<br>');
      echo('<pre>');
      var_dump($db);
      echo('</pre>');
      exit($e->getMessage());
    }
  }
?>
