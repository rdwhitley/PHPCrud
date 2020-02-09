<?php
  require('database.php');

  if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id']) && $_POST['_method'] == 'PUT') {
    $id = $_GET['id'];

    
    try {
      $statement = $pdo->prepare(
        'DELETE FROM users WHERE id = :id'
      );
      $statement->execute(['id' => $id]);
      echo "<script>location.href='/read.php?show=all'</script>";
    } catch(PDOException $e) {
      echo "<h4 style = 'color: red';>".$e->getMessage()."</h4>";
    }
  } else {
    echo "<script>location.href='/read.php?show=all'</script>";
    die();
  }
?>
