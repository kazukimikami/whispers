<?php
include('header.php');
include('db.php');
    $pdo = getPDO();

    $stmt = $pdo->prepare('INSERT INTO users (email, password, name) VALUES (:email, :password, :name)');
    $result = $stmt->execute([
      ':email' => $_GET['email'],
      ':password' => $_GET['password'],
      ':name' => $_GET['name']
    ]);
    echo '登録が完了しました';
?>

<form action="/registration.php">
  <fieldset>
    <legend>会員登録</legend>
    <div><?php echo($message) ?></div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" value="<?php echo($_GET['email']) ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
    </div>
    <div class="form-group">
      <label for="exampleInputname1" class="form-label mt-4">name</label>
      <input name="name" type="name" class="form-control" id="exampleInputname1" placeholder="name" required>
  </fieldset>
  <button type="submit" class="btn btn-primary">会員登録</button>
</form>
<?php include ('footer.php'); ?>
