<?php
  function getPDO() {
    $db['host'] = 'localhost';
    $db['user'] = 'kazuki';
    $db['passwd'] = 'kazuki';
    $db['dbname'] = 'twitter';
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8;', $db['host'], $db['dbname']);
    try {
      return new PDO($dsn, $db['user'], $db['passwd']);
    } catch (PDOException $e) {
      exit($e->getMessage());
    }
  }
?>
