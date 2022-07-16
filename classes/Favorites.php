<?php

class Favorites {

    private $_db;
    private $_data;
    public $errors;
    
    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function allByUser() {

        if ( Session::exists( 'user' ) ) {
            // current loggined user
            $user_id = Session::get( 'user' );

            $favorites = DB::getInstance()->query( 'SELECT * FROM favorites, posts WHERE favorites.user_id = ' . $user_id . ' AND favorites.post_id = posts.post_id ORDER BY favorite_id DESC' );

            return $favorites->results();
        }

    }
    
    public function find($post_id)
    {
         if ( Session::exists( 'user' ) ) {
            $user_id = Session::get( 'user' );
            
            $data = $this->_db->query('SELECT * FROM favorites WHERE user_id = '.$user_id.' AND post_id = '. $post_id .'');
            
            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        
            return false;
         }
    }

    public function data() {
        return $this->_data;
    }

    // Add to favorites
    public function add() {
         if ( Session::exists( 'user' ) ) {
            $post_id = Input::get( 'post_id' );
            $user_id = Session::get( 'user' );

            $this->create(array(
                'user_id' => $user_id,
                'post_id' => $post_id
            ));

            unset( $_POST );
            Session::put( 'success', 'Added to Favorites Successfully!' );
         }
    }
    
    public function create($fields = array())
    {
        if (!$this->_db->insert('favorites', $fields)) {
            throw new Exception('There was a problem creating new Favorites');
        }
    }
    
    
    // Delete to favorites
    public function remove() {

        if ( Session::exists( 'user' ) ) {
            if (isset($_POST['favorite_id'])) {
                $favorite_id = $_POST['favorite_id'];
                $data = $this->_db->query('DELETE FROM favorites WHERE favorite_id = '.$favorite_id.'');
                unset( $_POST );
                Session::put( 'success', 'Remove to Favorites Successfully!' );
                return;
            }

            $post_id = Input::get('post_id');
            $user_id = Session::get('user');

            $data = $this->_db->query('DELETE FROM favorites WHERE user_id = '.$user_id.' AND post_id = '. $post_id .'');

        }

        unset( $_POST );
        Session::put( 'success', 'Remove to Favorites Successfully!' );
    }
    
}