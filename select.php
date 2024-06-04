<?php 
    include "db.php";

    if (isset($_POST['knop'])) {
        $naam = $_POST["Naam"];
        $prijs = $_POST["prijs"];
        $oms = $_POST["Omschrijving"];

        $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$naam, $prijs, $oms]);
        header('location:insert.php');
    }
    $sql = "SELECT * FROM producten";
    $stmt = $pdo->query($sql);
    $producten = $stmt->fetchAll();

    $sql = "SELECT product_naam FROM producten WHERE productID = 1";
    $stmt = $pdo->query($sql);
    $product1 = $stmt->fetch();

    $sql = "SELECT product_naam FROM producten WHERE productID = 2";
    $stmt = $pdo->query($sql);
    $product2 = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php include "style.css" ?>
    </style>
</head>
<body>
    <form method="POST">
        <input type="text" name="Naam" placeholder="Naam" required> <br>
        <input type="number" step="any" name="prijs" placeholder="Prijs" required> <br>
        <input type="text" name="Omschrijving" placeholder="Omschrijving" required> <br><br>
        <input type="submit" name="knop">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Omschrijving</th>
        </tr>
        <?php 

            if (count($producten) > 0) {
                foreach($producten as $rows) {
                    echo "<tr>";
                    echo "<td>" . $rows['productID'] . "</td>";
                    echo "<td>" . $rows['product_naam'] . "</td>";
                    echo "<td>" . $rows['prijs_per_stuk'] . "</td>";
                    echo "<td>" . $rows['omschrijving'] . "</td>";
                    echo "</tr>";
                }
            }
            foreach($product1 as $row) {
                echo $row . "<br>";
            }
            foreach($product2 as $row) {
                echo $row;
            }
        ?>
    </table>
</body>
</html>