<?php

class Tags
{

    private $_db,
        $_data;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }
    public static function strSplit($delimiter = ", ", $data)
    {
        return explode($delimiter, $data);
    }

    public function getAllSameTags($search_tags, $limit1, $limit2)
    {
        $tags = $this->_db->query("SELECT p.*, u.user_firstname, u.user_middlename, u.user_lastname, c.cat_title FROM posts as p LEFT JOIN users as u ON p.post_user_id = u.user_id LEFT JOIN categories as c ON c.cat_id = p.post_category_id WHERE p.post_tags LIKE '%" . $search_tags . "%' ORDER BY p.post_id DESC LIMIT $limit1, $limit2");

        foreach ($tags->results() as $tag) {
            $this->_data = $tag;
        }
        return $tags->results();
    }

    public function formatFullName($firstname, $middlename, $lastname)
    {
        return $firstname . " " . substr($middlename, 0, 1) . ". " . $lastname;
    }

    public function pagination($search_tags, $limit1, $limit2)
    {

        $count = $this->getAllSameTags($search_tags, $limit1, $limit2);
        return count($count);
    }

    public function data()
    {
        return $this->_data;
    }
}
