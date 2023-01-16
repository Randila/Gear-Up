<?php
session_start();
if (!isset($_SESSION["uname"])){
    header('Location:login.php');

}
?>
<?php
if (isset($_POST["logoutbutton"])) {
    session_destroy();
    header('Location:home.php');
}
?>
<html>

<head>
    <title>GearUp Home</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">


</head>

<body>

    <div class="divbody">
        <div class="topheader">
            <table border="0" align="center" class="headertable">
                <tbody>
                    <tr>
                        <th width="40%" height="49" scope="col">
                            <input type="text" placeholder="Search an Item" class="searchbar" />
                            
                        </th>
                        <th width="20%" scope="col">
                            <p class="headertext" onclick="window.scrollTo(0,document.body.scrollHeight);">About</p>
                        </th>
                        <th width="30%" scope="col">
                            <?php
                            $logout = false;
                            if (!isset($_SESSION["uname"])) {
                                echo "<a href='login.php'><p class='headertext'  >Login\SignUp</p></a>";
                            } else {
                                echo "<p class='headertext' >" . $_SESSION["uname"] . "</p>";
                                $logout = true;
                            }
                            ?>
                        </th>
                        <th class="logout">
                            <form action="home.php" method="POST">
                                <?php
                                if ($logout) {
                                    echo "<input type='submit' class='logoutbtn' value='Logout' name='logoutbutton'/>";
                                }
                                ?>
                            </form>
                        </th>
                        <th width="8%" scope="col">
                            <a href="mycart.php">
                                <div class="cart">

                                </div>
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="productbg">

            <?php

            $con = mysqli_connect("localhost", "root", "", "gearup");

            if (!$con) {
                die('<script type="text/javascript">                                        
                alert("Couldnt connect to the database");
                </script>') ;
            }

            $sql = "SELECT * FROM `products`;";

            $queryresult = mysqli_query($con, $sql);

            if (mysqli_num_rows($queryresult) > 0) {
                while ($row = mysqli_fetch_assoc($queryresult)) {
                    echo "<div class='productmain'>
                        <div class='productdiv'>
                            <img src='" . $row["image"] . "' alt='' class='productimg'>
                        </div>
                        <div class='productdesc'>
                            <p class='pdescription'>
                            " . $row["proname"] . "
                            </p>
                            <p class='pdescription' style='font-size:small;'>
                                " . $row["description"] . "
                            </p>
                            <p class='pdescription'>
                                $" . $row["price"] . "
                            </p>   
                                <a href='addtoCart.php?id=" . $row["pid"] . "'>
                                <input type='submit' value='Add to cart' name='' class='addcart'>
                                </a>                                 
                        </div>
                    </div>";
                }
            }
            ?> 
        </div>
        <footer>
            <br>
            <div class="smringcontainer">
                <div class="smring">
                    <img src="src/facebook.png" alt="" class="smimg">
                </div>
                <div class="smring">
                    <img src="src/instagram.png" alt="" class="smimg">
                </div>
                <div class="smring">
                    <img src="src/twitter.png" alt="" class="smimg">
                </div>
                <div class="smring">
                    <img src="src/whatsapp.png" alt="" class="smimg">
                </div>

            </div>
        </footer>
    </div>

</body>

</html>