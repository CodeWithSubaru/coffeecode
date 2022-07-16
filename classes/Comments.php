<?php

class Comments
{
    private $_db;
    private $_data;
    private $_posts;
    public $error = array();
    public $success = array();


    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('comments', $fields)) {
            throw new Exception('There was a problem creating new Post');
        }
    }

    public function addcomment()
    {
        date_default_timezone_set("Asia/Manila");
        if (isset($_POST['submit_comment'])) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $user = new User();
                $validation = $validate->check($_POST, array(
                    'comment_content' => array(
                        'required' => true,
                        'min' => 10
                    )
                ));
                
                if ($validate->passed()) {
                    $this->create(array(
                        'comment_user_id' => $user->data()->user_id,
                        'comment_post_id' => $_GET['post_id'],
                        'comment_content' => $_POST['comment_content'],
                        'comment_date' => date('y-m-d h:i:s'),
                    ));

                    unset($_POST);
                    Session::put('success', 'Comment Added Successfully!');
                } else {
                    $this->error = $validate->errors();
                }
            }
        }
        return $this;
    }



    // Retrieve

    public function all()
    {
        $comment = DB::getInstance()->query('SELECT c.*, p.post_title FROM comments as c LEFT JOIN posts as p ON c.comment_post_id = p.post_id ORDER BY comment_id DESC');
        if ($comment->results() < 0) return;

        return $comment->results();
    }

    public function commentsByUserId()
    {
        $user = new User();
        $user_id = $user->data()->user_id;
        $comment = DB::getInstance()->query("SELECT * FROM comments ORDER BY comment_user_id = '$user_id' DESC");
        if ($comment->results() < 0) return;

        return $comment->results();
    }

    public function commentsbyPostId($post_id = '')
    {
        $statement = '';
        if (!empty($post_id)) {
            $statement = "AND posts.post_id = "."'".$post_id."'";
        } else {
            $user = new User();
            $user_id = $user->data()->user_id;
            $statement = "AND comments.comment_user_id = '$user_id'";
        }

        $comment = DB::getInstance()->query("SELECT * FROM comments, posts WHERE comments.comment_post_id = posts.post_id " . $statement . " ORDER BY comments.comment_id DESC");
        
        foreach ($comment->results() as $result) {
            $this->_posts = $result;
        }
    }
    
    // Testing
    public function getCommentsEveryUserByPostId($post_id) {
        
        $comment = DB::getInstance()->query("SELECT * FROM `comments`, `users` WHERE comments.comment_post_id = '". $post_id ."' AND comments.comment_user_id = users.user_id ORDER BY comment_id DESC");
        
        return $comment->results();

    }

    public function getPostByCommentId($comment_id)
    {

        $comment = DB::getInstance()->query("SELECT * FROM comments, posts WHERE comments.comment_post_id = posts.post_id AND comments.comment_id = " . $comment_id . "");

        foreach ($comment->results() as $result) {
            $this->_data = $result;
        }
    }

    public function getPostTitles($id)
    {
        $post_titles = $this->_db->query("SELECT p.post_title, c.* FROM posts as p WHERE p.post_id = ".$id."");
        return $post_titles->results()[0]->post_title;
    }


    public function getSpecificUser($user_id)
    {
        $comment = $this->_db->query("SELECT * FROM comments, users WHERE comments.comment_user_id = '$user_id'");

        foreach ($comment->results() as $result) {
            $this->_data = $result;
        }
    }

    public function getFullName()
    {
        return $this->_data->user_firstname . " " . substr($this->_data->user_middlename, 0, 1) . ". " . $this->_data->user_lastname;
    }

    public function getEmail()
    {
        return $this->_data->user_email;
    }

    public static function limit()
    {
        $limit = 5;
        $comment = DB::getInstance()->query("SELECT * FROM comments, users WHERE comments.comment_user_id = users.user_id ORDER BY comment_id DESC LIMIT $limit");
        if ($comment->results() < 0) return;

        return $comment->results();
    }

    public function getId($comment_id)
    {
        $comment = DB::getInstance()->query("SELECT c.*, u.user_firstname, u.user_middlename, u.user_lastname, u.user_email, p.post_title FROM comments as c LEFT JOIN users as u ON c.comment_user_id = u.user_id LEFT JOIN posts as p ON p.post_id = c.comment_post_id");

        foreach ($comment->results() as $result) {
            $this->_data = $result;
        }

        return $comment;
    }


    // Retrieve Count

    public static function count_row()
    {
        return DB::countAll('comment_id', 'comments');
    }


    public static function countCommentsByPost($post_id)
    {
        // Input::ge
        return DB::countAll('comment_id', 'posts, comments', " WHERE comments.comment_post_id = '" . $post_id . "'");
    }

    // Retrive Count Limit

    // Update

    public function updatecomment()
    {

                $validate = new Validate();
                $user = new User();
                $validation = $validate->check($_POST, array(
                    'comment_content' => array(
                        'required' => true,
                    ),
                ));
                if ($validate->passed()) {
        
                        $post_id = Input::get('post_id1');
                        $this->update(
                            'comment_id = ' . Input::get('comment_id') . '',
                            array(
                                'comment_content' => Input::get('comment_content'),
                            )
                        );
                        unset($_POST);
                        $_GET['comment_id'] = '';
                        $this->success = Session::put('success', 'Comment Successfully Updated!');

                        if ($user->data()->user_role === 'Admin') {

                            Redirect::to('../post?post_id=' . $post_id . '');
                        } else {
                            Redirect::to('post?post_id=' . $post_id . '');
                        }
                
                } else {
                    $this->error = $validate->errors();
                }
        return $this;
    }


    public function update($fields = array(), $id = null)
    {
        // if (!$id && $this->isLoggedIn())
        // {
        //     $id = $this->data()->id;
        // }

        if (!$this->_db->update('comments', $id, $fields)) {
            throw new Exception('There was a problem updating your Comment.');
        }
    }


    // Delete

    public function delete()
    {
        $comment_id = $_POST['comment_id'];
        DB::getInstance()->delete('comments', array("comment_id", "=", "$comment_id"));
        $this->success = Session::put('success', 'Comment Successfully Deleted!');
        Redirect::to('comments');
        return $this;
    }

    public function data() {
        return $this->_data;
    }
}
