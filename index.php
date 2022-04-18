<?php include('header.php'); ?>
<legend>ささやき一覧</legend>
<hr>
<?php
  include('db.php');
  $pdo = getPDO();
  $sql = 'SELECT whispers.id, whisper_text, created_at, username FROM whispers JOIN users ON whispers.user_id = users.id ORDER BY whispers.id DESC';
  /*
  $sql = 'SELECT
    whispers.id,
    MAX(whisper_text),
    MAX(whispers.created_at),
    MAX(username),
    COUNT(*) as fav_count
  FROM whispers
  INNER JOIN users
  ON whispers.user_id = users.id
  LEFT JOIN favorite
  ON whispers.id = favorite.whisper_text_id
  GROUP BY whispers.id
  ORDER BY whispers.id
  DESC';
  */
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $whispers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($whispers as $whisper) {
    $created_at = new DateTime($whisper['created_at']);
  ?>
    <?php echo($whisper['username']); ?>
    <?php echo($created_at->format('Y年m月d日 H:i:s')); ?>
    <br/>
    <?php echo($whisper['whisper_text']); ?>
    <br/>
    <?php if (false) { ?>
      <a class="nav-link active" href="/favorite.php?whisper_text_id=<?php echo($whisper['id']); ?>">お気に入り解除</a>
    <?php } else { ?>
      <a class="nav-link active" href="/favorite.php?whisper_text_id=<?php echo($whisper['id']); ?>">お気に入り登録</a>
    <?php } ?>
    <hr/>
  <?php
}
?>
<?php include('footer.php'); ?>
