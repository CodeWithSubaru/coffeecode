<?php
class Session
{
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = '')
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }

    public function strReplace($str) {
        
        if($str === 'cattitle') {
            substr($str, 3);
            return 'category';
        }

        return ucfirst(str_replace(['user_','_'], [""," "], $str));
        
    }

    public static function flashMessage($instance)
    {
        $session = new Session();
        if (Session::exists('success')) {
            $success = $session->strReplace(Session::flash('success'));
            echo '<div class="position-fixed animate__animated animate__fadeOut animate__delay-4s alert shadow toast-top-right p-4 d-flex" role="alert" style="background: white;z-index:99;top:10%;right:0; min-width: 350px; border-left: 4px solid rgb(25,135,84);"> 
                    <div class="flex-shrink-0 toast-title me-2" style="font-size: 3rem;line-height: 1;">
                        <i class="fas fa-check-circle text-success" style="font-size: 40px;"></i>
                    </div>
                    <div class="flex-grow-1 ms-1">
                        <div class="font-bold" style="font-size: 1.1rem; font-weight: 700;">Success</div> 
                        <span class="toast-message" style="font-weight: 500;">' . $success . '!</span>
                    </div>
                </div>';
        }

        foreach ($instance as $errors) {
            $errors = $session->strReplace($errors);
            echo '<div class="position-fixed  animate__animated animate__fadeOut animate__delay-4s alert shadow toast-top-right p-4 d-flex" role="alert" style="background: white;z-index:99;top:10%;right:0; min-width: 350px; border-left: 4px solid rgb(220,53,69);"> 
                    <div class="d-flex justify-content-center align-items-center toast-title me-3">
                    <i class="fas fa-exclamation-circle text-danger" style="font-size: 40px;"></i> 
                    </div>
                    <div class="flex-grow-1 ms-1">
                        <div style="font-size: 1.1rem; font-weight: 700;">Error</div> 
                        <span class="toast-message" style="font-weight: 500;">' . $errors . '!</span>
                    </div>
                 </div>';
            break;
        }
    }
}
