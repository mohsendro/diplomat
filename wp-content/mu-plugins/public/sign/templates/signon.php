<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>ورود به سایت</title>
</head>
<body>
    
<?php

    if( isset( $_GET['action'] ) ) {

        $query_string = $_GET['action'];

        switch ( $query_string ) {

            case 'signup':
                include "signup.php";
                break;

            case 'lostpassword':
                include "lostpassword.php";
                break;

            default:
                include "signin.php";
                break;

        }

    } else {

        include "signin.php";

    }
    
?>

<?php wp_footer(); ?>

</body>
</html>


