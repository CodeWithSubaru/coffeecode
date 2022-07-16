<?php

date_default_timezone_set("Asia/Manila");

class Post
{
    private $_db;
    private $_data;
    private $_category;
    protected static $image_file_tmp = "";
    public $error = array();
    public $sucess = '';


    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    // Create

    public function create($fields = array())
    {
        if (!$this->_db->insert('posts', $fields)) {
            throw new Exception('There was a problem creating new Post');
        }
    }

    public function addpost()
    {


        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validate1 = new Validate();
                $validation = $validate->check($_POST, array(
                    'post_title' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 200,
                        'unique' => 'posts'
                    ),
                    'post_tags' => array(
                        'required' => true,
                    ),
                    'post_content' => array(
                        'required' => true,
                    ),
                ));

                $validation1 = $validate1->checkUpload($_FILES, array('post_image'));

                if ($validate->passed() && $validate1->passed()) {
                    $post = new Post();
                    $post->create(array(
                        'post_title' => Input::get('post_title'),
                        'post_user_id' => $_POST['post_user_id'],
                        'post_category_id' => Input::get('post_category_id'),
                        'post_status' => Input::get('post_status'),
                        'post_image' => $this->uploadimage(),
                        'post_tags' => Input::get('post_tags'),
                        'post_date' => date('y-m-d h:i:s'),
                        'post_content' => Input::get('post_content'),
                    ));
                    if (isset($_POST['create_post_subs'])) {
                        $this->success = Session::put('success', 'Post Successfully Created! <br> Wait for the confirmation of admin');
                    } else {
                        $this->success = Session::put('success', 'Post Successfully Created!');
                    }
                    unset($_POST);
                    Redirect::to('viewpost');
                } else {

                    if (!empty($validate->errors())) {
                        $this->error = $validate->errors();
                    } else {
                        $this->error = $validate1->errors();
                    }
                }
            }
        }
        return $this;
    }


    // Retrieve
    public function all()
    {
        $post = DB::getInstance()->query("SELECT p.*, c.cat_title, u.user_firstname, u.user_middlename, u.user_lastname FROM posts as p LEFT JOIN categories as c ON c.cat_id = p.post_category_id LEFT JOIN users as u ON u.user_id = p.post_user_id ORDER BY post_id DESC");
        if ($post->results() <= 0) return False;

        return $post->results();
    }

    public function getPostbyUserFk($post_user_id, $post_id)
    {

        $post = DB::getInstance()->query("SELECT * FROM posts, users WHERE users.user_id = posts.post_user_id AND posts.post_id = '$post_id'");
        if ($post->results() <= 0) return False;

        foreach ($post->results() as $result) {
            $this->_data = $result;
        }
        return $post;
    }

    public function getPostbyUserId($post_user_id, $post_id)
    {

        $post = DB::getInstance()->query("SELECT * FROM posts, users WHERE users.user_id = " . $post_user_id . " AND posts.post_id = '$post_id'");

        foreach ($post->results() as $result) {
            $this->_data = $result;
        }
        return $post;
    }

    public function cat_title($post_cat_id)
    {
        $posts = DB::getInstance()->query("SELECT cat_title FROM categories WHERE cat_id = '$post_cat_id'");

        return $posts->results()[0]->cat_title;
    }

    public function getCategorybyCatFK($post_cat_id)
    {

        $post = DB::getInstance()->query("SELECT * FROM posts, categories WHERE posts.post_category_id = categories.cat_id AND categories.cat_id = '$post_cat_id'");

        foreach ($post->results() as $result) {
            $this->_category = $result;
        }

        return $post->results();
    }

    public function byPostAuthor($user_id = "")
    {
        $post = DB::getInstance()->query("SELECT * FROM users, posts WHERE posts.post_user_id = users.user_id AND posts.post_user_id = '" . $user_id . "' ORDER BY post_id DESC");
        if ($post->results() <= 0) return False;
        foreach ($post->results() as $result) {
            $this->_data = $result;
        }

        return $post->results();
    }


    public function getcategory()
    {
        return $this->_category;
    }

    public function getFullName($firstname, $middlename, $lastname)
    {
        return $firstname . " " . substr($middlename, 0, 1) . ". " . $lastname;
    }

    public static function limit($limit1, $limit2)
    {
        $status = 'Published';

        $post = DB::getInstance()->query("SELECT p.*, c.cat_title, u.user_firstname, u.user_middlename, u.user_lastname FROM posts as p LEFT JOIN categories as c ON c.cat_id = p.post_category_id LEFT JOIN users as u ON u.user_id = p.post_user_id WHERE p.post_status = '" . $status . "' ORDER BY p.post_id DESC LIMIT $limit1, $limit2 ");
        if ($post->results() < 0) return;

        return $post->results();
    }

    public function getId($post_id)
    {
        $post = DB::getInstance()->query("SELECT p.*, c.cat_title, u.user_firstname, u.user_middlename, u.user_lastname FROM posts as p LEFT JOIN categories as c ON c.cat_id = p.post_category_id LEFT JOIN users as u ON u.user_id = p.post_user_id WHERE p.post_id = '" . $post_id . "'");

        foreach ($post->results() as $result) {
            $this->_data = $result;
        }

        return $post;
    }

    public function getPostByPostId($post_id)
    {
        $post = DB::getInstance()->query("SELECT * FROM posts WHERE post_id = '" . $post_id . "' AND post_status = 'Published'");

        foreach ($post->results() as $result) {
            $this->_data = $result;
        }

        return $post;
    }


    public function addViews()
    {
        $post_id = Input::get('post_id');
        $views = $this->getId($post_id)->first()->post_views_count;
        if (Input::get('v')) {

            $this->update(
                'post_id = ' . Input::get('post_id') . '',
                array(
                    'post_views_count' =>  $views += Input::get('v'),
                )
            );
        }
        return $views;
    }

    // Update

    public function updatepost()
    {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'post_title' => array(
                'required' => true,
                'min' => 5,
                'max' => 100,
            ),
            'post_tags' => array(
                'required' => true,
            ),
            'post_content' => array(
                'required' => true,
            )
        ));

        if ($validate->passed()) {

            $post = new Post();
            $post->update(
                'post_id = ' . Input::get('post_id') . '',
                array(
                    'post_title' => Input::get('post_title'),
                    'post_user_id' => Input::get('post_user_id'),
                    'post_category_id' => Input::get('post_category_id'),
                    'post_status' => Input::get('post_status'),
                    'post_image' => $this->uploadimage(),
                    'post_tags' => Input::get('post_tags'),
                    'post_date' => date('y-m-d h:i:s'),
                    'post_content' => Input::get('post_content'),
                )
            );
            unset($_POST);
            $this->success = Session::put('success', 'Post Successfully Updated!!');
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

        if (!$this->_db->update('posts', $id, $fields)) {
            throw new Exception('There was a problem updating your Posts.');
        }
    }

    public function published()
    {
        if (Input::get('publish')) {

            $status = "Published";
            DB::getInstance()->query("UPDATE posts SET post_status = '" . $status . "' WHERE post_id = " . Input::get('publish'));
            $this->message($status);
        } elseif (Input::get('draft')) {
            $status = "Draft";
            DB::getInstance()->query("UPDATE posts SET post_status = '" . $status . "' WHERE post_id = " . Input::get('draft'));
            $this->message($status);
        }
        return $this;
    }


    // Delete

    public function delete()
    {
        $post_id = Input::get('post_id');
        DB::getInstance()->delete('posts', array("post_id", "=", "$post_id"));
        DB::getInstance()->delete('comments', array("comment_post_id", "=", "$post_id"));
        $this->success = Session::put('success', 'Post and its Comment Successfully Deleted!', 'Success');
        Redirect::to('viewpost');
        return $this;
    }


    // Upload Image
    public function uploadimage()
    {
        $result = "";
        $image_file_name = $_FILES['post_image']["name"] ?? $_FILES['post_image_subscriber']["name"] ?? '';

        $image_file_tmp = $_FILES['post_image']["tmp_name"];

        if (isset($_POST['create_post_admin'])) {
            if (empty($image_file_name))
                $image_file_name = "default.png";

            $image_file_path = "../uploads/img/" . $image_file_name;

            if (move_uploaded_file($image_file_tmp, $image_file_path))
                return $image_file_path;

            return $image_file_path;
        } elseif (Input::get('post_image')) {

            // Create Post Image Path From Subscriber
            $image_file_path = "./uploads/img/" . $image_file_name;
            if (move_uploaded_file($image_file_tmp, $image_file_path))
                return $image_file_path;
        }

        if (Input::get('post_image_old')) {
            return Input::get('post_image_old');
        }
    }

    public static function count_row()
    {
        return DB::countAll('post_id', 'posts');
    }

    public function pagination()
    {
        $status = 'Published';
        $post = DB::getInstance()->query("SELECT * FROM posts WHERE post_status='" . $status . "'");
        if ($post->results() <= 0) return;

        $count = $post->count();

        return $count;
    }


    // Search Function
    public function search()
    {
        $search = $_GET['search'];
        $post = DB::getInstance()->query("SELECT p.*, u.user_firstname, u.user_middlename, u.user_lastname, c.cat_title FROM posts as p LEFT JOIN users as u ON p.post_user_id = u.user_id LEFT JOIN categories as c ON p.post_category_id = c.cat_id WHERE p.post_title LIKE '%" . $search . "%' ORDER BY p.post_id DESC");
        if ($post->results() <= 0) return;
        return $post->results();
    }

    private function message($status)
    {
        if (!empty($status)) {
            $this->success = Session::put('success', 'Successfully Updated Status to “' . ucfirst($status) . '”');
        }
        Redirect::to('viewpost');
    }

    public static function currentPage($page, $link)
    {

        if ($page === $link) {
            echo 'current';
            Session::put($page, '');
        }
        return;
    }

    public function data()
    {
        return $this->_data;
    }
}
