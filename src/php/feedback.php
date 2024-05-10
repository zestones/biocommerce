<?php
require "../php/pdo.php";
require "../php/user.php";

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

        echo '<div class="feedback-item">';
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
        echo '<div class="date">';
        echo '<span>' . $comment['date'] . '</span>';
        echo '</div>';
        echo '<hr>';
        echo '</div>';
    }
}
