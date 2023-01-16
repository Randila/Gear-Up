<?php
session_start();
if (!isset($_SESSION["uname"])) {
    header('Location:login.php');
}
?>
<html>

<head>
    <title>Add to cart</title>
    <style>
        .background {
            background-image: url('src/motherboardbg.jpg');
        }

        .container {
            width: 90%;
            height: 90%;
            border: 2px solid red;
        }
    </style>

    <link rel="stylesheet" href="style.css">
</head>

<body class="body background">
    <?php
    $con = mysqli_connect("localhost", "root", "", "gearup");

    if (!$con) {
        die('<script type="text/javascript">                                        
                alert("Couldnt connect to the database");
                </script>');
    }

    $sql = "SELECT * FROM `products` WHERE `pid` = '" . $_GET["id"] . "';";

    $queryresult = mysqli_query($con, $sql);
    if (mysqli_num_rows($queryresult) > 0) {
        $row = mysqli_fetch_assoc($queryresult);
        echo "<form action='addtoCart.php?id=" . $_GET["id"] . "' method='POST'>
            <div class='addtocartmain'>
                <div class='addtocartcontainer'>
                    <div class='addtocartimg'>
                        <img src='" . $row["image"] . "' class='addtocartleftimg'>
                    </div>
                    <div class='addtocartdesc'>
                        <h1 class='productname'>
                            " . $row["proname"] . "
                        </h1>
                        <p class='pdescription'>
                            " . $row["description"] . "
                        </p>
                        <p class='pdescription'>
                            $ " . $row["price"] . "
                        </p>
                        <div class='centerbuttons'>
                            <input type='number' min='1' max='10' value='1' class='quantity' name='quannum'>
                            <input type='submit' name='cartsubbtn' value='Add to Cart' class='inaddcartpage'>
                        </div>
                    </div>
                </div>
            </div>
        </form>";
    }
    ?>
    <?php
    if (isset($_POST["cartsubbtn"])) {

        $con = mysqli_connect("localhost", "root", "", "gearup");

        if (!$con) {
            die('<script type="text/javascript">                                        
                alert("Couldnt connect to the database");
                </script>');
        }
        $quantity = $_POST["quannum"];
        $totprice = $quantity * $row["price"];

        $sql = "INSERT INTO `usercart`(`cartId`, `username`, `productname`, `quantity`, `imgpath`, `unitprice`, `totalprice`) 
        VALUES (NULL,'" . $_SESSION["uname"] . "','" . $row["proname"] . "','" . $quantity . "','" . $row["image"] . "','" . $row["price"] . "','$totprice')";

        

        if(mysqli_query($con,$sql)){
            echo '<script type="text/javascript">                                        
            alert("Added to cart");
            </script>';
            header('Location:home.php');
        }else{
            die("error");
        }
    }
    ?>

</body>

</html>