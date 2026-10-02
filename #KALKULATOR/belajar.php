<?php 

$inputAngka = $_POST["angka"] ?? "";
$display = $_POST["display"] ?? "";
$operator = $_POST["operator"] ?? "";
$perhitungan = "";

if(isset($_POST["angka"])){
  $display .= $inputAngka;
};


// C
if (isset($_POST["clear"])) {
    $display = "";
}


// CE
if (isset($_POST["clearEntry"])) {
  $display = substr($display, 0, -1);
  
}


if ($operator === "=") {

    if ($display === "" || $display === "0" || $display === "=") {
        $display = "ERROR";
    } else {

        $perhitungan = $display;

        $display = eval("return $perhitungan;");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   

    </style>
</head>

  <body>

<form action="" method="POST">

    <input 
        type="text" 
        name="display" 
        value="<?= htmlspecialchars($display) ?>" 
        readonly
    />

    <div>

        <!-- C -->
        <button type="submit" name="clear">C</button>

        <!-- CE -->
        <button type="submit" name="clearEntry">CE</button>

    </div>


    <div>
        <button type="submit" name="angka" value="1">1</button>
        <button type="submit" name="angka" value="2">2</button>
        <button type="submit" name="angka" value="3">3</button>
        <button type="submit" name="angka" value="*">*</button>
    </div>

    <div>
        <button type="submit" name="angka" value="4">4</button>
        <button type="submit" name="angka" value="5">5</button>
        <button type="submit" name="angka" value="6">6</button>
        <button type="submit" name="angka" value="/">/</button>
    </div>

    <div>
        <button type="submit" name="angka" value="7">7</button>
        <button type="submit" name="angka" value="8">8</button>
        <button type="submit" name="angka" value="9">9</button>
        <button type="submit" name="angka" value="-">-</button>
    </div>

    <div>
        <button type="submit" name="angka" value="0">0</button>
        <button type="submit" name="operator" value="=">=</button>
        <button type="submit" name="angka" value="+">+</button>
    </div>

</form>

    

</body>
</html>


