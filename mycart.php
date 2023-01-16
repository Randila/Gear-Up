<?php
session_start();
if (!isset($_SESSION["uname"])) {
    header('Location:login.php');
}
?>
<?php
if (isset($_POST["orderbtn"])) {
    $fname = $_POST["txtfname"];
    $lname = $_POST["txtlname"];
    $mobile = $_POST["txtmobile"];
    $Address = $_POST["txtAddress"];
    $city = $_POST["txtcity"];
    $postcode = $_POST["txtpostcode"];
    $radioval = $_POST["pmethod"];
    $con = mysqli_connect("localhost", "root", "", "gearup");
    if (!$con) {
        die('<script type="text/javascript">                                        
            alert("Couldnt connect to the database");
            </script>');
    }

    $sql = "SELECT * FROM `usercart` WHERE `username` = '" . $_SESSION["uname"] . "';";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $secsql = "INSERT INTO `purchase`(`oID`, `username`, `firstname`, `lastname`, `mobile number`, `address`, `city`, `postalCode`, `product`, `quantity`, `price`,`payment method`) 
                                            VALUES (NULL,'" . $_SESSION["uname"] . "','" . $fname . "','" . $lname . "','" . $mobile . "','" . $Address . "','" . $city . "','" . $postcode . "','" . $row["productname"] . "','" . $row["quantity"] . "','" . $row["totalprice"] . "','" . $radioval . "')";

            if (mysqli_query($con, $secsql)) {
                $sqlthree = "DELETE FROM `usercart` WHERE `username` ='" . $_SESSION["uname"] . "';";
                if (mysqli_query($con, $sqlthree)) {
                    header('Location:mycart.php');
                }
            }
        }
    }
}
?>
<html>

<head>
    <title>MyCart</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
    <style>
        .topic {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            color: white;
            text-shadow: 0px 2px 10px white;
        }

        .orderheader {
            color: white;
            /* text-shadow: 0px 2px 10px white;
            text-align: center; */
            margin-top: 0px;
            text-align: center;
        }

        h2 {
            position: absolute;
            top: 10%;
            transform: translate(0%, -50%);
            text-indent: 2em;
            font-weight: normal;
        }

        td {
            position: relative;
            height: 6em;
        }

        input[type=text] {
            position: absolute;
            /* left: 50%; */
            transform: translate(0%, -50%);
            border-radius: 50px;
            border: 0px;
            width: 70%;
            padding: 20px;
            outline: none;
            background-color: rgb(23, 23, 23);
            color: white;
            font-weight: bold;
            margin-left: 5em;
        }

        input[type=submit] {
            position: absolute;
            /* left: 50%; */
            transform: translate(0%, -50%);
            border-radius: 50px;
            border: 0px;
            width: 70%;
            padding: 20px;
            outline: none;
            background-color: rgb(23, 23, 23);
            color: white;
            font-weight: bold;
            margin-left: 5em;
        }

        input::placeholder{
            color: white;
        }

        textarea {
            position: absolute;
            /* left: 50%; */
            transform: translate(0%, -50%);
            border-radius: 20px;
            border: 0px;
            width: 70%;
            padding: 20px;
            outline: none;
            background-color: rgb(23, 23, 23);
            color: white;
            font-weight: bold;
            margin-left: 5em;
            height: 100px;
        }

        .test {
            height: 120px;
            padding-left: 0px;
            padding-top: 1em;
            padding-bottom: 1em;
        }

        .payicons {
            height: 70%;
            width: fit-content;
            object-fit: contain;
            display: inline-block;
        }

        .radio {
            /* height: 100%; */
            /* width: fit-content; */
            display: inline-block;
        }

        .header {
            width: 100%;
            height: 5em;
            background-color: rgb(23, 23, 23);
            border-top-left-radius: 1em;
        }

        body {
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);

        }

        .goback {
            padding: 20px;
            border: none;
            box-shadow: 0px 5px 10px rgb(38, 35, 53);
            border-radius: 50px;
            background-color: rgb(38, 35, 53);
            color: white;
            font-weight: bold;
            font-family: "Roboto Mono", monospace;
            position: absolute;
            left: 50%;
            transform: translate(-50%);
        }
    </style>

    <script src="bonk.js"></script>

</head>

<body>
    <div class="cartbg">
        <!-- <h1 class="topic">My Shopping Cart</h1><br> -->
        <!-- <div class="cartsecond"> -->
        <div class="cartthird">

            <div class="cartdetails">
                <header class="header">
                    <h1 style="margin-top: 0px;" class="orderheader">
                        Your Order
                    </h1>
                </header>
                <?php
                $con = mysqli_connect("localhost", "root", "", "gearup");
                $tot = 0;
                if (!$con) {
                    die('<script type="text/javascript">                                        
                                alert("Couldnt connect to the database");
                                </script>');
                }

                $sql = "SELECT * FROM `usercart` WHERE `username` = '" . $_SESSION["uname"] . "';";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tot = $tot + $row["totalprice"];
                        echo "<div class='showcartitems'>
                                <div class='cartitemcontainer'>
                                    <div class='cartproductdetails'>
                                        " . $row["productname"] . " <br> Quantity : " . $row["quantity"] . "
                                        <br> Price : $" . $row["totalprice"] . "
                                    </div>
                                    <div class='cartproductimgdiv'>
                                        <img src=" . $row["imgpath"] . " class='cartproductimg'>
                                    </div>
                                </div>
        
        
                            </div>
                            
                            <footer class='cartpagefooter'>
                                <h2 style='color: white;'>
                                    Total price : $" . $tot . "
                                </h2>
                            </footer>";
                    }
                } else {
                    echo "<h1 style='text-align:center'>Your cart is empty!</h1>
                        <br><a href='home.php'><button class='goback'>Browse More</button></a>";
                }

                ?>


            </div>

            <div class="orderdiv">
                <form action="mycart.php" method="POST">
                    <table border="0" class="ordertable">
                        <tr>
                            <td>
                                <input type="text" placeholder="First Name" name="txtfname" required autocomplete="off">
                            </td>
                            <td>
                                <input type="text" placeholder="Last Name" name="txtlname" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" placeholder="Mobile Number" name="txtmobile" id="txtMobile" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="test">
                                <!-- <textarea name="" id="" cols="30" rows="10" placeholder="Address" name="txtAddress"></textarea> -->
                                <input type="text" name="txtAddress" placeholder="Address" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" placeholder="City" name="txtcity" required autocomplete="off">
                            </td>
                            <td>
                                <input type="text" placeholder="Postal Code" name="txtpostcode" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" id="cod" name="pmethod" value="COD" class="radio" style="margin-left: 5em;" required autocomplete="off">
                                <label for="cod">
                                    <img src="src/cod.png" alt="" class="payicons">
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="card" name="pmethod" value="Card" class="radio" style="margin-left: 5em;" required>
                                <label for="card">
                                    <img src="src/credit-card.png" alt="" class="payicons">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: fit-content;">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="submit" name="orderbtn" value="Place Order">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!-- </div> -->
    </div>
</body>

</html>