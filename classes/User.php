<?php
class User
{

    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn,
        $_post,
        $_fullName;

    public $success = [],
        $error = [],
        $userRole;

    public function __construct($user = null)
    {
        $this->_db = Db::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    //process logout
                    $this->_isLoggedIn = false;
                }
            }
        } else {
            $this->find($user);
        }

        $this->_post = $_GET['post_id'] ?? false;
    }

    // public function update($fields = array(), $id = null) {

    //     if(!$id && $this->isLoggedIn()) {
    //         $id = $this->data()->user_id;
    //     }

    //     if(!$this->_db->update('users', $id, $fields)) {
    //         throw new Exception('There was a problem updating.');
    //     }
    // }

    public function createuser($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function createother_details($fields = array())
    {
        if (!$this->_db->insert('other_Details', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    // Retrieve
    public function all()
    {
        $user = DB::getInstance()->query("SELECT * FROM users ORDER BY user_id DESC");
        if ($user->results() < 0) return;

        foreach ($user->results() as $result) {
            $this->_data = $result;
        }

        return $user->results();
    }

    public function commentsbyPostId($id)
    {
        $user = DB::getInstance()->query("SELECT * FROM users, posts WHERE users.user_post_id = posts.post_id AND users.user_post_id = '$id' ORDER BY users.user_id DESC");
        if ($user->results() <= 0) return False;

        return $user->results();
    }

    public function byCommentId($id)
    {
        $user = DB::getInstance()->query("SELECT * FROM users, comments WHERE users.user_id = comments.comment_user_id AND users.user = '$id' ORDER BY users.user_id DESC");
        if ($user->results() <= 0) return False;

        return $user->results();
    }

    public static function limit()
    {
        $limit = 5;
        $user = DB::getInstance()->query("SELECT * FROM users ORDER BY user_id DESC LIMIT $limit");
        if ($user->results() < 0) return;

        return $user->results();
    }


    public function find($user = null)
    {
        if ($user) {
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function route($role = "", $location = "")
    {
        if ($this->isLoggedIn()) {
            if ($this->data()->user_role === $role) {
                Redirect::to($location);
            }
        } else {
            Redirect::to('../index');
        }
    }

    public function confirmLogin($username = null, $password = null, $remember = false)
    {

        if (!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->user_id);
        } else {

            $user = $this->find($username);

            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->randSalt)) {
                    Session::put($this->_sessionName, $this->data()->user_id);

                    // Remember
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->user_id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->user_id,
                                'Hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->Hash;
                        }

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public function login()
    {
        date_default_timezone_set("Asia/Manila");
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'username' => array('required' => true),
                    'password' => array('required' => true),
                ));

                if ($validate->passed()) {

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $this->confirmLogin(Input::get('username'), Input::get('password'), $remember);

                    if ($login) {

                        if ($this->data()->user_role === "Subscriber") {
                            $message = 'To create content, wait for the admins permission. Thank you for your patience.';
                            Cookie::put("user_{$this->data()->user_id}", $message, 10, "/");
                        }

                        if ($this->data()->user_role === "Admin") {
                            Redirect::to('admin');
                        }

                        if ($this->_post) {
                            Redirect::to('post?post_id=' . $this->_post . '');
                        }

                        Redirect::to('index');
                    } else {
                        $this->error = ['Sorry, logging in failed'];
                    }
                } else {
                    $this->error = $validate->errors();
                }
            }
        }
        return $this;
    }

    public function register()
    {

        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'user_firstname' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 50,
                    ),
                    'user_middlename' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 50,
                    ),
                    'user_lastname' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 50,
                    ),
                    'username' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 20,
                        'unique' => 'users'
                    ),
                    'user_email' => array(
                        'required' => true,
                        'email' => 'valid'
                    ),
                    'password' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'confirm_password' => array(
                        'required' => true,
                        'matches' => 'password'
                    ),
                    'country' => array(
                        'required' => true
                    )
                ));

                if ($validate->passed()) {
                    $salt = Hash::salt(32);

                    try {
                        $this->create(array(
                            'user_firstname' => Input::get('user_firstname'),
                            'user_middlename' => Input::get('user_middlename'),
                            'user_lastname' => Input::get('user_lastname'),
                            'username' => Input::get('username'),
                            'user_email' => Input::get('user_email'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'user_role' => Input::get('user_role'),
                            'country' => Input::get('country'),
                            'randSalt' => $salt,
                            'author_permission' => 0,
                            'date_joined' => date('Y-m-d H:i:s'),
                        ));

                        $this->success = Session::put('success', 'You have been registered and can now log in!');
                        Redirect::to('login');
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                } else {
                    $this->error = $validate->errors();
                }
            }
        }

        return $this;
    }

    // insert db
    // Insert to db
    public function create($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating new User');
        }
    }

    public function hasPermission($key)
    {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->Group));

        if ($group->count()) {
            $permissions = json_decode($group->first()->Permission, true);

            if (isset($permissions[$key])) {
                return true;
            }
        }
        return false;
    }

    public function admin()
    {
        if (Input::get('admin')) {
            $role = "Admin";
            DB::getInstance()->query("UPDATE users SET user_role='" . $role . "' WHERE user_id=" . Input::get('admin'));
            $this->message($role);
        } elseif (Input::get('subscriber')) {
            $role = "Subscriber";
            DB::getInstance()->query("UPDATE users SET user_role='" . $role . "' WHERE user_id=" . Input::get('subscriber'));
            $this->message($role);
        }
    }


    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout()
    {

        // $this->_db->delete('users_session', array('user_id', '=', $this->data()->user_id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
        Redirect::to('login');
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }

    public function getFullName()
    {

        $this->_fullName = $this->data()->user_firstname . " " . substr($this->data()->user_middlename, 0, 1) . ". " . $this->data()->user_lastname;
        return $this->_fullName;
    }

    public function getfk()
    {
        $userid = "SELECT user_id FROM users ORDER BY user_id DESC";
        $stmt = $this->_db->prepare($userid);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            return $row['user_id'];
        }
    }

    protected function generateNumber($table, $column, $field, $number1, $trans)
    {
        $sql = "SELECT * FROM $table ORDER BY $column DESC LIMIT 1";
        $stmt = $this->_db->query($sql);
        if ($stmt->rowCount() < 1) {
            if ($trans == "account")
                return "0000000001";
            else
                return "000000000001";
        }
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $a = $row[$field];
            $generate_account_number = intval($a);
            return str_pad($generate_account_number + 1, $number1, 0, STR_PAD_LEFT);
        }
    }

    public function generateAccountNumber()
    {
        return $this->generateNumber('other_details', 'account_num', 'account_num', 10, 'account');
    }

    public static function count_row()
    {
        return DB::countAll('user_id', 'users');
    }

    private function message($status)
    {
        if (!empty($status)) {
            $this->success = Session::put('success', 'Successfully Updated Status to “' . ucfirst($status) . '”');
        }
        Redirect::to('users');
    }

    // Delete

    public function delete()
    {
        $user_id = Input::get('user_id');
        DB::getInstance()->delete('users', array("user_id", "=", "$user_id"));
        DB::getInstance()->delete('posts', array("post_user_id", "=", "$user_id"));
        $this->success = Session::put('success', 'user Successfully Deleted!');
        Redirect::to('users');
        return $this;
    }



    // Update
    public function updateuser()
    {
        $user = new User();
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'user_firstname' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
            ),
            'user_middlename' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
            ),
            'user_lastname' => array(
                'required' => true,
                'min' => 3,
                'max' => 50,
            ),
            'user_email' => array(
                'required' => true,
                'email' => 'valid'
            ),
            'username' => array(
                'required' => true,
                'min' => 5,
                'max' => 20
            ),

            'country' => array(
                'required' => true
            )

        ));

        if ($validate->passed()) {
            $salt = Hash::salt(32);

            $user->update(
                'user_id = ' . Input::get('user_id') . '',
                array(
                    'user_firstname' => Input::get('user_firstname'),
                    'user_middlename' => Input::get('user_middlename'),
                    'user_lastname' => Input::get('user_lastname'),
                    'username' => Input::get('username'),
                    'user_email' => Input::get('user_email')
                )
            );
            unset($_POST);
            $this->success = Session::put('success', 'Profile Successfully Updated!!');
            Redirect::to('users');
        } else {
            $this->error = $validate->errors();
        }

        return $this;
    }


    public function getId($user_id)
    {

        $user = DB::getInstance()->query("SELECT * FROM users WHERE user_id = '" . $user_id . "'");

        foreach ($user->results() as $result) {
            $this->_data = $result;
        }

        return $user;
    }

    public function update($fields = array(), $id = null)
    {
        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There was a problem updating your Posts.');
        }
    }

    public function send_request_to_be_author($permission_val)
    {
        if (isset($_POST['send_request'])) {
            $id = Session::get('user');
            $permission = $this->_db->query('UPDATE users SET author_permission = ' . $permission_val . ' WHERE user_id = ' . $id . '');
            $this->success = Session::put('success', 'Sending Request Success!!');
        }
    }

    public function getRequestToBeAuthor()
    {
        $role = 'Subscriber';
        $users = $this->_db->query("SELECT user_firstname, user_middlename, user_lastname, user_id FROM users WHERE author_permission = '1' AND user_role =  '$role' ORDER BY user_id DESC");
        return $users->results();
    }

    public function updatePermission()
    {
        $notif = new Notification;
        $user_id = Input::get('user_id');
        $permissionVal = Input::get('permission');
        $role = 'Author';

        if (isset($_POST['allow'])) {
            $permission = $this->_db->query("UPDATE users SET author_permission = '" . $permissionVal . "', user_role = '" . $role . "' WHERE user_id = '" . $user_id . "'");
            $this->success = Session::put('success', 'Succesfully "Allow" User!!');
            $notif->insertNotification($user_id, 1, 'You are now author!', 0);
        } else {
            $permission = $this->_db->query("UPDATE users SET author_permission = '" . $permissionVal . "' WHERE user_id = '" . $user_id . "'");
            $this->success = Session::put('success', 'Succesfully "Deny" User!!');
            $notif->insertNotification($user_id, 0, 'Sorry, your request denied!', 0);
        }
    }
}
