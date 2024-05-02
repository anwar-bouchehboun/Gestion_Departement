<?php
session_start();
include 'assete/cnx.php';

$name = "";
$password = "";

if (isset($_POST['login'])) {
  $name = $_POST["name"];
  $password = $_POST['password'];
  $q = $cnx->prepare("SELECT * FROM user WHERE user_name = ?");
  $q->bind_param("s", $name);
  $q->execute();
  $result = $q->get_result();
  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    if ($password === $data['password']) {
      $id = $data['id_admin'];
      $admin = $data['user_name'];
      setcookie('id_admin', $id, time() + (86400 * 30), "/");
      setcookie('admin', $admin, time() + (86400 * 30), "/");

      header("location: assete/Dashboard.php");
      exit;
    }
  } else {
    echo 0;
  }
}
if (
  isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
  !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
  header("location: Dashboard.php");
  exit();
}
?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login page</title>
  <!-- Lien vers la police Google Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="input-box">
          <input type="text" name="name" required />
          <label>Email</label>
        </div>
        <div class="input-box">
          <input type="password" name="password" required />
          <label>Password</label>
        </div>

        <button type="submit" class="btn" name="login">Login</button>
      </form>
    </div>
  </div>
</body>

</html>