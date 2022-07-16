<?php

require_once "./core/Init.php";
include './functions/Sanitize.php';

spl_autoload_register(fn ($class) => require_once 'classes/' . ucfirst(strtolower($class)) . '.php');

$notifs = new Notification();

if (isset($_POST['action']) && $_POST['action'] == 'fetchNotif') {
    $output = '';
    if ($notifs->all(Session::get('user'))) {
        $arrayNotif = json_decode(json_encode($notifs->all(Session::get('user'))), true);
        foreach ($arrayNotif as $notif) {
            $output .= "<li class='success'>";
            $output .= "<div class='notify_icon'>";
            $output .= ($notif['notif_type'] == 1) ? '<i class="fas fa-user-check me-2 text-2xl"></i>' : '<i class="fas fa-user-times me-2 text-2xl"></i>';
            $output .= "</div>";
            $output .= "<div class='notify_data'>";
            $output .= "<div class='title'>";
            $output .= "Regards to request";
            $output .= "</div>";
            $output .= "<div class='sub_title'>";
            $output .= $notif['notif_message'];
            $output .= "</div>";
            $output .= "</div>";
            $output .= "<div class='notify_status'>";
            $output .= ($notif['notif_type'] == 1) ? '<p class="text-success">Success</p>' : '<p class="text-danger">Failed</p>';
            $output .= "<small class='text-muted'>{$notifs->timeInAgo($notif['created_at'])}</small>";
            $output .= "</div>";
            $output .= "</li>";
        }
        echo $output;
    } else {
        echo '<li class="success justify-content-center">No new Notifications!</li>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'updateRead') {
    echo $notifs->notifBadge(Session::get('user'));
}

if (isset($_POST['action']) && $_POST['action'] == 'checkNotif') {
    if ($notifs->getIsRead(Session::get('user')) == '0') {
        echo '<span class="badge bg-danger text-sm d-flex align-items-center justify-content-center" style="height: 20px; width: 1px;"> <small> '. $notifs->count() .' </small> </span>';
    } else {
        echo '';
    }
}
