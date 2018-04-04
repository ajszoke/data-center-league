<?php
require_once('../util/main.php');

require_once('../model/database.php');
require_once('../model/player_db.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Registration page and other pages
$fields->addField('email');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('first_name');
$fields->addField('last_name');

// for the Login page
$fields->addField('password');

switch ($action) {
    case 'view_register':
        // Clear user data
        $email = '';
        $first_name = '';
        $last_name = '';
        
        include 'account_register.php';
        break;
    case 'register':
        // Store user data in local variables
        $email = filter_input(INPUT_POST, 'email');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $firstName = filter_input(INPUT_POST, 'first_name');
        $lastName = filter_input(INPUT_POST, 'last_name');
        
        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);        
        $validate->text('first_name', $firstName);
        $validate->text('last_name', $lastName);

        // If validation errors, redisplay Register page and exit controller
        if ($fields->hasErrors()) {
            include'account_register.php';
            break;
        }

        // If passwords don't match, redisplay Register page and exit controller
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include'account_register.php';
            break;
        }

        // Validate the data for the customer
        if (is_valid_user_email($email)) {
            display_error('The e-mail address ' . $email . ' is already in use.');
        }
        
        // Add the customer data to the database
        $user_id = add_user($email, $firstName,
                                    $lastName, $password_1);

        // Store user data in session
        $_SESSION['user'] = get_user($accountID);    
        include 'account_view.php';
        break;
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';
        
        include 'account_login_register.php';
        break;
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        // Validate user data
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include'account_login_register.php';
            break;
        }
        
        // Check email and password in database
        if (is_valid_user_login($email, $password)) {
            $_SESSION['user'] = get_user_by_email($email);
            include 'account_view.php';
        } else {
            $password_message = 'Login failed. Invalid email or password.';
            include 'account_login_register.php';
            break;
        }    
        break;
    case 'view_account':
        $user_name = $_SESSION['user']['first_name'] . ' ' .
                         $_SESSION['user']['last_name'];
        $email = $_SESSION['user']['email_address'];   
        $accountID = $_SESSION['user']['account_id'];            
     
        include 'account_view.php';
        break;
    case 'view_account_edit':
        $email = $_SESSION['user']['email_address'];
        $firstName = $_SESSION['user']['first_name'];
        $lastName = $_SESSION['user']['last_name'];

        $password_message = '';        

        include 'account_edit.php';
        break;
    case 'update_account':
        // Get the customer data
        $accountID = $_SESSION['user']['account_id'];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $firstName = filter_input(INPUT_POST, 'first_name');
        $lastName = filter_input(INPUT_POST, 'last_name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $password_message = '';

        // Get the old data for the customer
        $old_user = get_user($accountID);

        // Validate user data
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);        
        $validate->text('first_name', $firstName);
        $validate->text('last_name', $lastName);        
        
        // Check email change and display message if necessary
        if ($email != $old_user['email_address']) {
            display_error('You can\'t change the email address for an account.');
        }

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include'account_edit.php';
            break;
        }
        
        // Only validate the passwords if they are NOT empty
        if (!empty($password_1) && !empty($password_2)) {            
            if ($password_1 !== $password_2) {
                $password_message = 'Passwords do not match.';
                include'account_edit.php';
                break;
            }
        }

        // Update the customer data
        update_user($accountID, $email, $firstName, $lastName,
            $password_1, $password_2);

        // Set the new customer data in the session
        $_SESSION['user'] = get_user($accountID);

        redirect('.');
        break;
    case 'logout':
        unset($_SESSION['user']);
        redirect('..');
        break;
    default:
        display_error("Unknown account action: " . $action);
        break;
}
?>