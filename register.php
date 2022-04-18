<?php
include ('header.php');
include ('db.php');

function createUser($email, $password, $username) {
  /**
   * 会員を登録する
   *
   * @param strng $email 登録するメールアドレス
   * @param strng $password 登録するパスワード
   * @param strng $username 登録するユーザの名前
   *
   * @return 成功した場合はオートインクリメントしたID。失敗した場合はnullを返却する
   */
  $pdo = getPDO();
  $stmt = $pdo->prepare('INSERT INTO users (email, password, username) VALUES (:email, :password, :username)');
  $result = $stmt->execute([
    ':email'    => $email,
    ':password' => $password,
    ':username' => $username
  ]);

  if ($result) {
    return $pdo->lastInsertId();
  }

  return null;
}

// 登録しようとしている
if ($_GET['submit'] == '1') {
  $createdId = createUser($_GET['email'], $_GET['password'], $_GET['username']);
  if ($createdId) {
    setcookie('user_id', $createdId);
    setcookie('msg', '会員登録しました');
    header('Location: http://localhost:3001/whisper.php');
    setcookie('standby', null);
    exit();
  }
  
// このページに来たばかり
} else {
  setcookie('standby', '1');
}

// setcookie('standby', '1');
// createUser($_GET['email'], $_GET['password'], $_GET['username']);
// setcookie('standby', null);
?>

<form action="/register.php">
  <fieldset>
    <legend>会員登録</legend>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" value="<?php echo($_GET['email']) ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" arequired>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" arequired>
    </div>
    <div class="form-group">
      <label for="exampleInputname1" class="form-label mt-4">username</label>
      <input name="username" type="username" class="form-control" id="exampleInputname1" placeholder="username" arequired>
  </fieldset>
  <button type="submit" name="submit" value="1" class="btn btn-primary">会員登録</button>
</form>
<?php include ('footer.php'); ?>
