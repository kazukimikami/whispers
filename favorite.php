<?php
  include('db.php');

  function createFavorite($whisper_text_id){
  /**
   * お気に入りをDBに追加する
   *
   * @param strng $user_id お気に入りするユーザーのID
   * @param strng $whisper_text_id ささやいた内容
   *
   * @return 成功した場合はオートインクリメントしたID。失敗した場合はnullを返却する
   */
  $user_id = intval($_COOKIE["user_id"]);
  $pdo     = getPDO();
  $stmt    = $pdo->prepare('INSERT INTO favorite (user_id, whisper_text_id) VALUES (:user_id, :whisper_text_id)');
  $result  = $stmt->execute([
    ':user_id'         => $user_id,
    ':whisper_text_id' => $whisper_text_id
  ]);

  if ($result) return $user_text_id;
  return null;
}

//お気に入り追加
createFavorite($_GET['whisper_text_id']);
header('Location: http://localhost:3001/index.php');
?>
