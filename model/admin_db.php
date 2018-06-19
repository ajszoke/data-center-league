<?php
function is_valid_admin_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = 'SELECT * FROM Admins_Table
              WHERE email_address = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function admin_count() {
    global $db;
    $query = 'SELECT count(*) AS adminCount FROM Admins_Table';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['adminCount'];
}

function get_all_admins() {
    global $db;
    $query = 'SELECT * FROM Admins_Table ORDER BY last_name, first_name';
    $statement = $db->prepare($query);
    $statement->execute();
    $admins = $statement->fetchAll();
    $statement->closeCursor();
    return $admins;
}

function get_admin ($adminID) {
    global $db;
    $query = 'SELECT * FROM Admins_Table WHERE admin_id = :adminID';
    $statement = $db->prepare($query);
    $statement->bindValue(':adminID', $adminID);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}

function get_admin_by_email ($email) {
    global $db;
    $query = 'SELECT * FROM Admins_Table WHERE email_address = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}

function is_valid_admin_email($email) {
    global $db;
    $query = '
        SELECT * FROM Admins_Table
        WHERE email_address = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function add_admin($email, $firstName, $lastName, $password_1) {
    global $db;
    $password = sha1($email . $password_1);
    $query = '
        INSERT INTO Admins_Table (email_address, password, first_name, last_name)
        VALUES (:email, :password, :firstName, :lastName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $admin_id = $db->lastInsertId();
    $statement->closeCursor();
    return $admin_id;
}

function update_admin($adminID, $email, $firstName, $lastName,
                      $password_1, $password_2) {
    global $db;
    $query = '
        UPDATE Admins_Table
        SET email_address = :email,
            first_name = :firstName,
            last_name = :lastName
        WHERE admin_id = :adminID';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':adminID', $adminID);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1) && !empty ($password_2)) {
        if ($password_1 !== $password_2) {
            display_error('Passwords do not match.');
        } elseif (strlen($password_1) < 6) {
            display_error('Password must be at least six characters.');
        }
        $password = sha1($email . $password_1);
        $query = '
            UPDATE Admins_Table
            SET password = :password
            WHERE admin_id = :adminID';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':admin_id', $adminID);
        $statement->execute();
        $statement->closeCursor();
    }
}

function delete_admin($adminID) {
    global $db;
    $query = 'DELETE FROM Admins_Table WHERE admin_id = :adminID';
    $statement = $db->prepare($query);
    $statement->bindValue(':admin_id', $admin_D);
    $statement->execute();
    $statement->closeCursor();
}
?>