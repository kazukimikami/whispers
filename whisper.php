<?php
include('header.php');
include('db.php');

function createWhisper($whisper_text){
  /**
   * ささやきをDBに追加する
   *
   * @param strng $user_id 投稿したユーザーのID
   * @param strng $whisper_text ささやく内容
   *
   * @return 成功した場合はオートインクリメントしたID。失敗した場合はnullを返却する
   */
  $user_id = intval($_COOKIE["user_id"]);
  date_default_timezone_set('Asia/Tokyo');
  $date = date('Y-m-d H:i:s');
  $pdo = getPDO();
  $stmt = $pdo->prepare('INSERT INTO whispers (user_id, whisper_text, created_at) VALUES (:user_id, :whisper_text, :created_at);');
  $result = $stmt->execute([
    ':user_id' => $user_id,
    ':whisper_text' => $whisper_text,
    ':created_at' => $date
  ]);
  if ($result) {
    return $whisper_text;
  }

  return null;
}

// ささやこうとしている
if ($_GET['submit'] == '1') {
  $text = createWhisper($_GET['whisper_text']);
  if ($text) {
    header('Location: http://localhost:3001/index.php');
    exit();
  }

// このページに来たばかり
} else {
  setcookie('standby', '1');
}
?>
<form action="/whisper.php">
  <fieldset>
    <div class="form-group">
      <legend>ささやく</legend>
      <input name="whisper_text" class="form-control" id="exampleInputwhisper" placeholder="ここに入力してね" required>
  </fieldset>
  <button type="submit" name="submit" value="1" class="btn btn-primary">ささやく</button>
</form>
<?php include('footer.php'); ?>
