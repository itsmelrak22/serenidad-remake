<?php
if( !isset($_SESSION['client-token']) ) 
{
    header('Location: ../client-login.php');
}
