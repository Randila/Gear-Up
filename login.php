<?php
    session_start();
?>
<html>

<head>
    <script src="bonk.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
    <style>
        input {
            border-radius: 50px;
            border: 0px;
            width: 70%;
            padding: 20px;
            outline: none;
            /* top: 50%;
          left: 50%;
          transform: translate(-50%, -50%); */
            /* background-color: rgb(200, 200, 200, 0.7); */
            /* background-color: rgb(38, 35, 53); */
            background-color: rgb(23, 23, 23);
            color: white;
            font-weight: bold;
        }

        input::placeholder {
            /* font-weight: bold; */
            color: rgb(220, 200, 200);
            font-weight: normal;
        }

        input:placeholder:hover {
            color: black;
        }

        input:hover {
            /* background-color: white; */
            background-color: rgb(38, 35, 53);
            /* box-shadow: 0px 10px 10px rgb(255, 255, 255); */
            box-shadow: 0px 5px 10px rgb(0, 197, 248);
        }

        input:focus {
            color: white;
        }

        input[type="submit"] {
            color: white;
            background-color: rgb(0, 77, 132);
            font-weight: bold;
        }

        input[type="submit"]:hover {
            box-shadow: 0px 10px 10px rgb(38, 35, 53);
            background-color: rgb(0, 60, 110);
        }

        td {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        table {
            width: 100%;
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
        }

        button {
            border-radius: 50px;
            border: 0px;
            width: 70%;
            padding: 20px;
            background-color: rgb(200, 200, 200);
            font-weight: bold;
        }

        button:hover {
            box-shadow: 0px 5px 10px rgb(255, 255, 255);
            background-color: rgb(170, 170, 170);
        }

        h1 {
            text-align: center;
            color: white;
            font-weight: bold;
            text-shadow: 0px 5px 12px white;
        }

        .regtabletd {
            padding: 10px;
        }
    </style>
</head>

<body class="login">

    <div class="loginbgdiv">
        <div class="loginmaindiv">
            <div class="insideloginmaindiv">
                <div class="insideloginmaindivleft">
                    <!-- This is where the left image is -->
                </div>
                <div class="insideloginmaindivright">
                    <div id="Page1" class="pageone pages">
                        <!-- Content of page 1
                <a href="#" onclick="return show('Page2','Page1');">Show page 2</a> -->
                        <div class="loginpanel">
                            <h1>Welcome Back!</h1>
                            <form action="login.php" method="POST">

                                <table border="0">
                                    <tr>
                                        <td><input type="text" name="loguname" placeholder="Username" required autocomplete="off" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="this.setCustomValidity('')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" name="logpwd" placeholder="Password" required /></td>
                                    </tr>
                                    <tr>
                                        <?php
                                        if (isset($_POST["loginsub"])) {
                                            $loguname = $_POST["loguname"];
                                            $logpass = $_POST["logpwd"];
                                            $valid = false;

                                            $con = mysqli_connect("localhost", "root", "", "gearup");

                                            if (!$con) {
                                                die('<script type="text/javascript">                                        
                                                alert("Couldnt connect to the database");
                                                </script>') ;
                                            }

                                            $sql = "SELECT * FROM `users` WHERE `username` like '" . $loguname . "' and `password` like '" . $logpass . "'";

                                            $queryres = mysqli_query($con, $sql);

                                            if (mysqli_num_rows($queryres) > 0) {
                                                
                                                $row=mysqli_fetch_assoc($queryres);
                                                if($loguname == $row["username"] and $logpass == $row["password"]){
                                                    $valid = true;
                                                }else{
                                                    $valid = false;
                                                }
                                                
                                            } else {
                                                $valid = false;
                                            }

                                            if ($valid) {
                                                $_SESSION["uname"] = $loguname;
                                                header('Location:home.php');
                                            } else {
                                                // echo "wrong credentials";
                                                echo '<script type="text/javascript">                                        
                                                alert("invalid username or password");
                                                </script>';
                                            }
                                        }
                                        ?>
                                        <td><input type="submit" name="loginsub" value="Login" /></td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <button onclick="return show('Page2','Page1');">
                                                Don't have an account?
                                            </button>
                                            <!-- <button name="btntest">
                                                test
                                            </button> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>

                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <input type="text" placeholder="Username" /><br>
                                <input type="password" placeholder="Password" /><br>
                                <input type="submit" value="Login" /><br> -->
                            </form>
                        </div>
                    </div>


                    <div id="Page2" class="pagetwo pages">
                        <!-- Content of page 2
                <a href="#" onclick="return show('Page1','Page2');">Show page 1</a> -->
                        <h1>Join Us</h1>
                        <form action="login.php" method="POST">
                            <table border="0">
                                <tr>
                                    <td class="regtabletd">
                                        <input type="text" id="reguname" name="reguname" placeholder="Enter a username" required autocomplete="off" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="regtabletd">
                                        <input type="password" id="regpwd" name="regpwd" placeholder="Enter a Password" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="regtabletd">
                                        <input type="password" id="regpwdval" placeholder="Reenter the Password" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="regtabletd">
                                        <input type="text" id="regEmail" name="regemail" placeholder="abc@example.com" required autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                        if(isset($_POST["regsub"])){
                                            $regusername = $_POST["reguname"];
                                            $regpassword = $_POST["regpwd"];
                                            $regemail = $_POST["regemail"];

                                            $con = mysqli_connect("localhost","root","","gearup");

                                            if(!$con){
                                                echo '<script type="text/javascript">                                        
                                                alert("Couldnt connect to the database");
                                                </script>';
                                            }
                                            
                                            $sql = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('".$regusername."','".$regpassword."','".$regemail."')";

                                            if(mysqli_query($con,$sql)){
                                                echo '<script type="text/javascript">                                        
                                                alert("successfully created an account");
                                                </script>';
                                            }else{
                                                echo '<script type="text/javascript">                                        
                                                alert("Failed to create an account");
                                                </script>';
                                            }
                                            
                                            
                                        }
                                    ?>
                                    <td class="regtabletd">
                                        <input type="submit" name="regsub" value="Create Account" onclick="validateRegister()" />
                                    </td>
                                </tr>

                                <tr>
                                    <td class="regtabletd">
                                        <button onclick="return show('Page1','Page2');">
                                            Already have an account?
                                        </button>
                                    </td>
                                </tr>
                            </table>
                            <!-- <input type="text" placeholder="Username" /><br>
                    <input type="password" placeholder="Password" /><br>
                    <input type="submit" value="Login" /><br> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <script>
        function test() {
            var randomvar = "";
            alert(randomvar);
        }
    </script> -->



    <script type="text/javascript">
        function show(shown, hidden) {
            document.getElementById(shown).style.display = "block";
            document.getElementById(hidden).style.display = "none";
            return false;
        }

        show("Page1", "Page2");
    </script>

</body>

</html>