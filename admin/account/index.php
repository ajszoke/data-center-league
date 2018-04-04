<?php
require_once('../../util/main.php');
//require_once('util/secure_conn.php');
require_once('../../model/database.php');
require_once('../../model/admin_db.php');
require_once('../../model/fields.php');
require_once('../../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if (admin_count() == 0) {
    if ($action != 'create') {
        $action = 'view_account';
    }
} elseif (isset($_SESSION['admin'])) {
    if ($action == null) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == null ) {
            $action = 'view_account';            
        }
    }
} elseif ($action == 'login') {
    $action = 'login';
} else {
    $action = 'view_login';
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Add Account page and other pages
$fields->addField('email', 'Must be valid email.');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('firstName');
$fields->addField('lastName');

// for the Login page
$fields->addField('password');

switch ($action) {
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';
        
        include 'account_login.php';
        break;
    case 'login':
        // Get username/password
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account_login.php';
            break;
        }
        
        // Check database - if valid username/password, log in
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['admin'] = get_admin_by_email($email);
        } else {
            $password_message = 'Login failed. Invalid email or password.';
            include 'account_login.php';
            break;
        }

        // Display Admin Menu page
        redirect('..');
        break;
    case 'view_account':
        // Get all accounts from database
        $admins = get_all_admins();

        // Set up variables for add form
        $email = '';
        $firstName = '';
        $lastName = '';
        if (!isset($email_message)) { 
            $email_message = '';             
        }
        if (!isset($password_message)) { 
            $password_message = '';             
        }

        // View admin accounts
        include 'account_view.php';
        break;
    case 'create':
        // Get admin user data
        $email = filter_input(INPUT_POST, 'email');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');

        $admins = get_all_admins();
        $email_message = '';             
        $password_message = '';             

        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('firstName', $firstName);
        $validate->text('lastName', $lastName);        
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);     
        
        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account_view.php';
            break;
        }
        
        if (is_valid_admin_email($email)) {
            $email_message = 'This email is already in use.';
            include 'account_view.php';
            break;
        }
        
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'account_view.php';
            break;
        }

        // Add admin user
        $adminID = add_admin($email, $firstName, $lastName,
                                 $password_1);

        // Set admin user in session
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = get_admin($adminID);
        }

        redirect('.');
        break;
    case 'view_edit':
        // Get admin user data
        $adminID = filter_input(INPUT_POST, 'adminID', FILTER_VALIDATE_INT);
        $admin = get_admin($adminID);
        $firstName = $admin['first_name'];
        $lastName = $admin['last_name'];
        $email = $admin['email_address'];
        $password_message = '';

        // Display Edit page
        include 'account_edit.php';
        break;
    case 'update':
        $adminID = filter_input(INPUT_POST, 'adminID', FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, 'email');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        
        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('firstName', $firstName);
        $validate->text('lastName', $lastName);        
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);     
        
        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account_edit.php';
            break;
        }
        
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'account_edit.php';
            break;
        }
        
        update_admin($adminID, $email, $firstName, $lastName, 
                $password_1, $password_2);
       
        if ($admin_id == $_SESSION['admin']['admin_id']) {
            $_SESSION['admin'] = get_admin($adminID);
        }
        redirect($app_path . '.?action=view_account');
        break;
    case 'view_delete_confirm':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        if ($adminID == $_SESSION['admin']['admin_id']) {
            display_error('You cannot delete your own account.');
        }
        $admin = get_admin($adminID);
        $first_name = $admin['first_name'];
        $last_name = $admin['last_name'];
        $email = $admin['email_address'];
        include 'account_delete.php';
        break;
    case 'delete':
        $admin_id = filter_input(INPUT_POST, 'adminID', FILTER_VALIDATE_INT);
        delete_admin($adminID);
        redirect($app_path . '../../admin/account');
        break;
    case 'logout':
        unset($_SESSION['admin']);
        redirect($app_path . '../../admin/account');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        break;
}
?>