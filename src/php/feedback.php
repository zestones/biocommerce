<?php
require "../php/pdo.php";
require "../php/user.php";

function insert_new_feedback($announce_id, $rating, $comment)
{
    global $pdo;

    $query = "INSERT INTO AnnounceComment (announce_id, user_id, comment, rating) 
              VALUES (:announce_id, :user_id, :comment, :rating)";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':comment', $comment);

    $stmt->execute();
}

function delete_feedback_by_id($id_feedback)
{
    global $pdo;

    $query = "DELETE FROM AnnounceComment WHERE id = :id_feedback";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_feedback', $id_feedback);
    $stmt->execute();
}

function get_last_inserted_feedback()
{
    global $pdo;

    $query = "SELECT * FROM AnnounceComment WHERE id = last_insert_rowid()";
    $stmt = $pdo->query($query);
    $feedback = $stmt->fetch(PDO::FETCH_ASSOC);

    return $feedback;
}

function get_feedback_by_announce_id($id_announce)
{
    global $pdo;

    $query = "SELECT * FROM AnnounceComment WHERE announce_id = :id_announce";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_announce', $id_announce);
    $stmt->execute();

    $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $feedback;
}

function display_feedback($feedback)
{
    usort($feedback, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    foreach ($feedback as $comment) {
        $user = get_user_by_id($comment['user_id']);

        echo '<div class="feedback-item" id="feedback-' . $comment['id'] . '">';
        echo '<div class="user-infos">';
        echo '<img src="https://picsum.photos/id/1005/50/50.jpg" alt="' . $user['name'] . '">';
        echo '<div class="user-details">';
        echo '<div class="name">' . $user['firstname'] . '</div>';
        echo '<div class="rating">' . generate_star($comment['rating']) . '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="message">';
        echo '<p>' . $comment['comment'] . '</p>';
        echo '</div>';

        if ($comment['user_id'] == $_SESSION['user_id']) {
            echo '<div class="delete-feedback" onclick="delete_feedback(' . $comment['id'] . ')">&times;</div>';
        }

        echo '<div class="date">';
        echo '<span>' . $comment['date'] . '</span>';
        echo '</div>';
        echo '<hr>';
        echo '</div>';
    }
}
