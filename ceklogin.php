        <?php

        require 'function.php';

        if(isset($_SESSION['login'])){
            //login
        } else {
            //belum login
            header('location:login.php');
        }
        ?>