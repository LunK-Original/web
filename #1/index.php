<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php 
    $nama = "faris";
    echo "halo selamat datang";
    echo "<br>";
    echo "nama saya " . $nama;

    //function
    function tambah($a , $b){
      return "<br>hasil dari $a + $b adalah " .$a + $b;
    }
   
    function kurang($a , $b){
      return "<br>hasil dari $a - $b adalah " .$a - $b;
    }
   
    function kali($a , $b){
      return "<br>hasil dari $a * $b adalah " .$a * $b;
    }
   
    function bagi($a , $b){
      return "<br>hasil dari $a / $b adalah " .$a / $b;
    }
    
    function bagi_habis($a , $b){
      return "<br>hasil dari $a % $b adalah " .$a % $b;
    }
    
    function pangkat($a , $b){
      return "<br>hasil dari $a ** $b adalah " .$a ** $b;
    }

    echo "<hr>";

    echo  tambah(1 , 2);
    echo kurang(4 , 10);
    echo kali(100 , 2);
    echo pangkat(10 , 3);
  ?>
</body>
</html>
