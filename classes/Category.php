<?php

class Category
{
    private $_db;
    public $error = array();
    public $success = array();

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    // Retrive
    public function all()
    {

        $category = DB::getInstance()->query('SELECT * FROM categories ORDER BY cat_id DESC');
        if ($category->results() < 0) return;

        return $category->results();
    }

    public function fetchCategoryId()
    {
        $option = '';

        $category = DB::getInstance()->query('SELECT * FROM categories');

        foreach ($category->results() as $category) {
            $selected = (Input::get('post_category_id') == $category->cat_id) ? "selected" : ' ';
            $option .= "<option value='{$category->cat_id}' {$selected}> {$category->cat_title} </option> ";
        }
        return $option;
    }

    public function cat_title($id)
    {
        if (!empty($id)) {
            $category = DB::getInstance()->query("SELECT cat_title FROM categories WHERE cat_id = $id");
            foreach ($category->results() as $category) {
                return  $category->cat_title;
            }
        }
    }

    public function byPostCateg()
    {
        $cat_id = Input::get('cat_id');
        $category = DB::getInstance()->query("SELECT p.*, c.cat_title, u.user_firstname, u.user_middlename, u.user_lastname FROM posts as p LEFT JOIN categories as c ON c.cat_id = p.post_category_id LEFT JOIN users as u ON u.user_id = p.post_user_id WHERE c.cat_id = '" . $cat_id . "' AND p.post_status = 'Published' ORDER BY post_id DESC");
        return  $category->results();
    }

    // Add
    public function addcategory()
    {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'cat_title' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 15,
                        'unique' => 'categories'
                    )
                ));

                if ($validate->passed()) {
                    $this->create(array(
                        'cat_title' => Input::get('cat_title'),
                    ));
                    unset($_POST);
                    $this->success = Session::put('success', 'Category Successfully Created!!');
                } else {
                    $this->error = $validate->errors();
                }
            }
        }

        return $this;
    }

    // Insert to db
    public function create($fields = array())
    {
        if (!$this->_db->insert('categories', $fields)) {
            throw new Exception('There was a problem creating new Category');
        }
    }


    // Update
    public function updatecategory()
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'cat_title' => array(
                'required' => true,
                'min' => 3,
                'max' => 15,
                'unique' => 'categories',
            ),
        ));

        if ($validate->passed()) {

            try {

                $this->update(
                    'cat_id=' . Input::get('cat_id') . '',
                    array(
                        'cat_title' => Input::get('cat_title')
                    )
                );
                unset($_POST);
                $_GET['cat_id'] = '';
                $this->success = Session::put('success', 'Category Successfully Updated!', 'Success');
                Redirect::to('categories');
            } catch (Exception $e) {
                die($e->getMessage());
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

        if (!$this->_db->update('categories', $id, $fields)) {
            throw new Exception('There was a problem updating your Posts.');
        }
    }


    // Delete

    public function delete()
    {
        $cat_id = Input::get('cat_id');
        DB::getInstance()->delete('categories', array("cat_id", "=", "$cat_id"));
        $this->success = Session::put('success', 'Category Successfully Deleted!', 'Success');
        Redirect::to('categories');
        return $this;
    }


    // Row Count of Category in db
    public static function count_row()
    {
        return DB::countAll('cat_id', 'categories');
    }

    // pagination
    public function pagination()
    {
        $status = 'Published';
        $cat_id = Input::get('cat_id');
        $category = DB::getInstance()->query("SELECT * FROM posts WHERE post_status='" . $status . "' AND post_category_id = '$cat_id'");
        if ($category->results() <= 0) return;
        $count = ceil($category->count() / 5);
        return $count;
    }
}
