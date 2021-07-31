<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/Page.class.php");

$message = array();

//check for post data
if( !empty( $_POST )){

    //initialize UserDAO
    UserDAO::init();
    
    // Check for existing username
    if(UserDAO::getUser($_POST['username']) != false){
        
        $message[] = 'Username already in use';
        
    }else {
        
        //validate user input
        /****** TEST VALIDATIONS ******/

        //if all validations pass
        list( $form_errors, $input ) = Validate::validateRegistForm();

        if( $form_errors ){

            // show the errors with the form
            Page::$title =  "Please correct the following errors";
            Page::header();
            Page::errors();
            Page::registerForm();
            Page::showMessage($form_errors);
            Page::footer();
        } else {
            
            //create user
            $nu = new User();
            $nu->setFirstName($input['firstname']);
            $nu->setLastName($input['lastname']);
            $nu->setEmail($input['email']);
            $nu->setUserName($input['username']);
            $nu->setPasswordHash(password_hash($input['password'],PASSWORD_DEFAULT));

            // add user to database
            UserDAO::createUser($nu);

            //Set the user to logged in
            // $_SESSION['username'] = $nu->getUserName();
            // $_SESSION['userId'] = $nu->getUserId();
            // $_SESSION['loginTimeStamp'] = time();

            header("Refresh: 2; url=index.php");

            $message[] = "Account successfully created. Please wait to be redirected to the login page.";
            Page::$title = "Register &bull; Booksmart";
            Page::header();
            Page::showMessage($message);
            // display footer
            Page::footer();

        }        
    }
} else{

    Page::$title = "Register &bull; Booksmart";
    Page::header();
    Page::showMessage($message);
    Page::registerForm();
    Page::footer();

}

?>
