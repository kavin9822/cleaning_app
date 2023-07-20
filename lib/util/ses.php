<?php
class Session {

    public function __construct() {
        if (!session_id()) {
            ini_set('session.use_only_cookies', 'On');
            ini_set('session.use_trans_sid', 'Off');
            ini_set('session.cookie_httponly', 'On');
            session_set_cookie_params(0, '/');
            /*
             * We an use session save path feeture on demand
             */
            //session_save_path('./applicationData/session');
            session_start();
        }
    }

    /**
     * Get session value
     * @return string
     */
    public function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Get session value
     * @return string
     */
    public function set($key, $val) {
        if (session_id()) {
            $_SESSION[$key] = $val;
        }
    }

    /**
     * Get session ID
     * @return string
     */
    public function getId() {
        if (session_id()) {
            return session_id();
        } else {
            return FALSE;
        }
    }

    /**
     * session destroy
     */
    public function destroy() {
        if (session_id()) {
            session_destroy();
        }
    }

}

//////////////////////////////////



