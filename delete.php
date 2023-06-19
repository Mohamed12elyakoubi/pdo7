<?php
$host = 'localhost:3307';
$db   = 'Winkel1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];

    $sql = "DELETE FROM producten WHERE product_code = :product_code";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_code' => $product_code]);

    if ($stmt->rowCount() > 0) {
        echo "Het product is succesvol verwijderd";
    } else {
        echo "Het product kon niet worden verwijderd";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
<a href="delete.php?product_code=2">Verwijder product 2</a>

<form method="GET">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Product naam:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="text" name="product_naam" required><br>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prijs per stuk:</label><br>
    <input type="int" class="form-control" id="exampleInputEmail1" name="prijs_per_stuk" required>
  </div>
  <div class="mb-3 ">
    <input type="text" class="form-control" id="exampleCheck1" name="omschrijving" required>
    <label class="form-check-label" for="exampleInputEmail1">Omschrijving:</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</body>

</html>