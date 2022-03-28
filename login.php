<?php
  include('header.php');
  include('db.php');

  $message = 'ログイン情報を入力してください';
  $exec_login = false;
  if ($_GET['email']) {
    $exec_login = true;
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $stmt->execute([':email' => $_GET['email'], ':password' => $_GET['password']]);
    $result = $stmt->fetch();

    if ($result) {
      setcookie('user_id', $result['id']);
      setcookie('msg', 'ログインしました');
      header('Location: http://127.0.0.1:8080/whisper.php');
      exit();
    } else {
      $message = 'ログイン情報が違います';
    }
  }
 ?>

<form action="/login.php">
  <fieldset>
    <legend>ログイン</legend>
    <div class="alert alert-<?php if ($exec_login) { ?>danger<?php } else { ?>success<?php } ?>" role="alert">
      <?php echo($message) ?>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" value="<?php echo($_GET['email']) ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
    </div>
  </fieldset>
  <button type="submit" class="btn btn-primary">ログイン</button>
</form>

<?php include('footer.php'); ?>
