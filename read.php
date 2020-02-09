<?php
  require('database.php');

  if(isset($_GET['show']) && isset($_GET['id'])) {
    try {
      $statement = $pdo->prepare(
        'SELECT * FROM users'
      );
      $statement->execute();
      echo "Read from users table</br>";
      $results = $statement->fetchAll(PDO::FETCH_OBJ);
      var_dump($results);
    } catch(PDOException $e) {
      echo "<h4 style = 'color: red';>".$e->getMessage()."</h4>";
    }
  } elseif($_GET['show'] == 'one' && isset($_GET['id'])){
    $id = $_GET['id'];
    try {
      $statement = $pdo->prepare(
        'SELECT * FROM users WHERE id = :id'
      );
      $statement->execute(['id' => $id]);
      echo "Read from users table</br>";
      $results = $statement->fetchAll(PDO::FETCH_OBJ);
      var_dump($results);
    } catch(PDOException $e) {
      echo "<h4 style = 'color: red';>".$e->getMessage()."</h4>";
    }
  } else {
    echo "<script>location.href='/'</script>";
    die();
  }
?>

<html>
  <head>
  <title>Simple CRUD</title>
  </head>

  <body>
    <table>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    <?php foreach($results as $user) {?>
      <tr>
        <td><?php echo $user->id;?></td>
        <td><?php echo $user->first_name; ?></td>
        <td><?php echo $user->last_name; ?></td>
        <td><?php echo $user->age; ?></td>
        <td>
          <a href="/update.php?id=<?php echo $user->id; ?>">edit</a>
        </td>
        <td>
          <a href="/delete.php?id=<?php echo $user->id; ?>"
             oclick='confirm'>delete</a>
        </td>
      </tr>
    <?php } ?>
    </table>
  </body>
</html>