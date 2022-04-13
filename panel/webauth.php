<?php
require_once "./../vendor/autoload.php";
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
}
if (!isset($_SESSION['expires_at'])) {
    header('Location: login.html');
} else {
    if(time() > $_SESSION['expires_at']){
        session_unset();
        session_destroy();
        header('Location: login.html');
    }
}

$user = $_SESSION['user'];
?>

<script type="text/javascript">
    const loggedInUser = <?php echo $user;?>
</script>