<!DOCTYPE html>


<html>
<head>
  <title>Glavni urednik</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
  <link rel="icon" href="../slike/title-slika.png" type="image/jpg">

</head>
<body>
    <?php
    include 'navbar.php';
    ?>
  <div class="login-box">
    <h1> Login admin </h1>
    
    <form method="post" action="../process/eadmin.php">
    <label for="name">Ime:</label>
      <input type="text" id="name" name="name">
      <br>
      <label for="surname">Prezime:</label>
      <input type="text" id="surname" name="surname">
      <br>
      <label for="password">Lozinka:</label>
      <input type="password" id="password" name="password">
      <br><br>
      <input type="submit" name="submit" value="Prijavi se">
    </form>
    <h4><a href="../php/login_urednik.php">Ti si urednik? - ULOGUJ SE OVDE </a></h4>
    <h4><a href="../php/login_novinar.php">Ti si novinar? - ULOGUJ SE OVDE</a></h4>
  </div>

</body>
</html>
