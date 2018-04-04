<?php
function is_valid_user_email($email) {
    global $db;
    $query = '
        SELECT account_id FROM accounts
        WHERE email_address = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function is_valid_user_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = '
        SELECT * FROM accounts
        WHERE email_address = :email AND password = :password';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_user($accountID) {
    global $db;
    $query = 'SELECT * FROM accounts WHERE account_id = :accountID';
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', $accountID);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function get_user_by_email($email) {
    global $db;
    $query = 'SELECT * FROM accounts WHERE email_address = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function add_user($email, $firstName, $lastName,
                      $password_1) {
    global $db;
    $password = sha1($email . $password_1);
    $query = '
        INSERT INTO accounts (email_address, password, first_name, last_name)
        VALUES (:email, :password, :firstName, :lastName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $accountID = $db->lastInsertId();
    $statement->closeCursor();
    return $accountID;
}

function update_user($accountID, $email, $firstName, $lastName,
                      $password_1, $password_2) {
    global $db;
    $query = '
        UPDATE accounts
        SET email_address = :email,
            first_name = :firstName,
            last_name = :lastName
        WHERE account_id = :accountID';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':accountID', $accountID);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1) && !empty($password_2)) {
        $password = sha1($email . $password_1);
        $query = '
            UPDATE accounts
            SET password = :password
            WHERE account_id = :accountID';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':accountID', $accountID);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>