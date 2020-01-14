<?php

  try {
      $hostname='localhost';
      $username='';
      $password='';
      $dbh = new PDO("mysql:host=$hostname;dbname=",$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }catch(PDOException $e){
      echo $e->getMessage();
  }

  $sql = $dbh->prepare("SELECT * FROM temperature");
  $sql->execute();
?>

<!doctype html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SICAKLIK ve NEM ÖLÇÜMLERİ</title>
  </head>
  <body>
    <h3 style="text-align:center;">SICAKLIK ve NEM ÖLÇÜMLERİ</h3>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sıcaklık</th>
      <th scope="col">Nem</th>
      <th scope="col">Tarih</th>
    </tr>
  </thead>
  <tbody>
     <?php while($row=$sql->fetch(PDO::FETCH_ASSOC)) { ?>

    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['temp'].' &#176;C'; ?></td>
      <td><?php echo $row['hum']; ?></td>
      <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php }  ?>


  </tbody>
</table>


        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
