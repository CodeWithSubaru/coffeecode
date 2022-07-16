<?php

class Notification
{

    private $_db,
        $success,
        $error,
        $_count;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }
    public function insertNotification($user_id, $notif_type, $notif_message, $notif_isRead)
    {
        date_default_timezone_set('Asia/Manila');

        $this->create([
            'user_id' => $user_id,
            'notif_type' => $notif_type,
            'notif_message' => $notif_message,
            'notif_isRead' => $notif_isRead,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function all($id)
    {
        $notif = $this->_db->query("SELECT * FROM notifications WHERE user_id = '$id' ORDER BY notif_id DESC");
        return $notif->results();
    }

    public function getIsRead($id)
    {
        $notif = $this->_db->query("SELECT notif_isRead FROM notifications WHERE user_id = '$id'");
        if (count($notif->results()) > 0) {
            $this->_count = $this->_db->count();
            return $notif->results()[0]->notif_isRead;
        }
        return '';

        // dd($notif->result());
    }

    public function notifBadge($id)
    {
        $notif = $this->_db->query("UPDATE notifications SET notif_isRead = '1' WHERE user_id = '$id'");
        return '';
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('notifications', $fields)) {
            throw new Exception('There was a problem.');
        }
    }

    public function timeInAgo($timestamp)
    {
        date_default_timezone_set('Asia/Manila');
        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
        $time = time() - $timestamp;

        switch ($time) {
                // Seconds
            case $time <= 60:
                return 'Just Now';
                // Minutes
            case $time >= 60 && $time < 3600:
                return (round($time / 60) == 1) ? 'a minute ago' : round($time / 60) . ' minutes ago';
                // Hours
            case $time >= 3600 && $time < 86400:
                return (round($time / 3600) == 1) ? 'an hours ago' : round($time / 3600) . ' hours ago';
                // Days
            case $time >= 86400 && $time < 604800:
                return (round($time / 86400) == 1) ? 'a day ago' : round($time / 86400) . ' days ago';
                // Weeks
            case $time >= 604800 && $time < 2600640:
                return (round($time / 604800) == 1) ? 'a week ago' : round($time / 604800) . ' weeks ago';
                // Months
            case $time >= 2600640 && $time < 31207680:
                return (round($time / 2600640) == 1) ? 'a month ago' : round($time / 2600640) . ' months ago';
                // Years
            case $time >= 31207680:
                return (round($time / 31207680) == 1) ? 'a year ago' : round($time / 31207680) . ' years ago';
        }
    }

    public function count() {
        return $this->_count;
    }
}
