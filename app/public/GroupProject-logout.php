<?php
require_once('inc/config.inc.php');
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/UserDAO.class.php');
require_once('inc/Utility/LoginManager.class.php');
require_once('inc/Utility/Page.class.php');

// start session
session_start();



//if user logged in we want to log them out
if(LoginManager::verifyLogin()){
    
    
    // initialize user DAO
    UserDAO::init();
    
    //set username logout message
    $message[] = $_SESSION['username']." Logged Out";
    
    //Destroy the session
    session_destroy();
    //redirect the user
    header( "Refresh: 2; url=index.php" );

    // display page header
    Page::header(null);

    //display messages
    Page::showMessage($message);
    
//If user not logged in take them to homepage
}else{
    header("Location: index.php");

    // display page header
    Page::header(null);
}

// display page footer
Page::footer();
