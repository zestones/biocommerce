<?php
require '../php/pdo.php';


function get_user_by_id($id_user)
{
    global $pdo;

    $query = "SELECT * FROM User WHERE id = :id_user";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function get_all_users()
{
    global $pdo;

    $query = "SELECT * FROM User";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function get_user_by_email($email)
{
    global $pdo;

    $query = "SELECT * FROM User WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function update_user_infos_by_id($user_id, $firstname, $lastname, $username, $phonenumber, $avatar)
{
    global $pdo;
    $query = 'UPDATE User 
              SET firstname = :firstname, lastname = :lastname,
                  username = :username, phone_number = :phonenumber,
                  icon = :avatar 
              WHERE id = :user_id
             ';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':phonenumber', $phonenumber);
    $stmt->bindParam(':avatar', $avatar);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function update_user_password_by_id($user_id, $password)
{
    global $pdo;
    $query = 'UPDATE User 
              SET password = :password
              WHERE id = :user_id
             ';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function update_user_admin_status($user_id, $status)
{
    global $pdo;
    $query = 'UPDATE User 
              SET is_admin = :status
              WHERE id = :user_id
             ';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':status', $status);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}


function get_user_avatar($id_user)
{
    global $pdo;

    $query = "SELECT icon FROM User WHERE id = :id_user";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['icon'];
}

function insert_new_user($email, $password, $phone_number)
{
    global $pdo;

    $query = "INSERT INTO User (firstname, lastname, username, icon, is_admin, email, phone_number, password) 
              VALUES ('', '', :username, '../public/default-user-icon.png', 0, :email, :phone_number, :password)
             ";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", explode('@', $email)[0]);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function delete_user_account($id_user)
{
    global $pdo;

    try {
        $pdo->beginTransaction();

        // Delete user from User table
        $query = "DELETE FROM User WHERE id = :id_user";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Delete user's announcements from Announce table
        $query = "DELETE FROM Announce WHERE id IN (SELECT announce_id FROM UserAnnounce WHERE user_id = :id_user)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Delete user's comments from AnnounceComment table
        $query = "DELETE FROM AnnounceComment WHERE user_id = :id_user";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Delete user's saved announcements from UserSaved table
        $query = "DELETE FROM UserSaved WHERE user_id = :id_user";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Delete user's announcements from UserAnnounce table
        $query = "DELETE FROM UserAnnounce WHERE user_id = :id_user";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollback();
        return false;
    }
}
