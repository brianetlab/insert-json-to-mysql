<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Insert Json To MySQL | brianrakhmataji.com</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
    <link rel="stylesheet" href="halaman.css">
    <script>
      $(document).ready(function(){
      $(".button-collapse").sideNav();
      });
    </script>
  </head>
  <body>
    <!--Menu & Sidebar start-->
    <nav>
      <div class="container">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Home</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li class="active"><a href="index.php">Home</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
              <li class="active"><a href="index.php">Home</a></li>
            </ul>
        </div>
      </div>
    </nav>
    <!--Menu & Sidebar end-->
    <div class="container">
      <!--Desc-->
      <div class="row">
        <div class="col s12">
          <div class="card-panel teal">
            <span class="white-text"><center>Insert Json To MySQL <br>API Pilkada</center> 
            </span>
          </div>
        </div>
      </div>
      <!--Desc-->
      <?php
      $connect = mysqli_connect("localhost", "root", "", "pilkada"); //Connect PHP to MySQL Database
      $query = '';
      $table_data = '';
      $filename = "https://pilkada2017.kpu.go.id/api/hasil.json"; //API Pilkada
      $data = file_get_contents($filename); //Read the JSON file in PHP
      $array = json_decode($data, true); //Convert JSON String into PHP Array
      foreach($array as $row) //Extract the Array Values by using Foreach Loop
      {
        $query .= "INSERT INTO pilkada(namaKd,namaWkd,jumlahSuara,namaWilayah) VALUES ('".$row["namaKd"]."','".$row["namaWkd"]."','".$row["jumlahSuara"]."','".$row["namaWilayah"]."'); ";  // Make Multiple Insert Query 
        $table_data .= '
        <tr>
          <td>'.$row["namaKd"].'</td>
          <td>'.$row["namaWkd"].'</td>
          <td>'.$row["jumlahSuara"].'</td>
          <td>'.$row["namaWilayah"].'</td>
        </tr>'; //Data for display on Web page
      }
        if(mysqli_multi_query($connect, $query)) //Run Mutliple Insert Query
      {
        echo '<table id="tableData" class="bordered">
        <tr>
          <th>Nama Calon</th>
          <th>Nama Wakil Calon</th>
          <th>Jumlah Suara</th>
          <th>Wilayah</th> 
        </tr>';
        echo $table_data;  
        echo '</table>';
      }
      ?>
    </div>
    <footer class="page-footer">   
      <div class="footer-copyright">
        <div class="container">
          © 2017 Brianrakhmataji.com
        </div>
      </div>
    </footer>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="paging.js"></script> 
    <script type="text/javascript">
      $(document).ready(function() {
      $('#tableData').paging({limit:20});
      });
    </script>
  </body>
</html>