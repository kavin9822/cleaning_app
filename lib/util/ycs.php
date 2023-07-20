<?php

final class Registry {

    private $data = array();

    public function get($key) {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function has($key) {
        return isset($this->data[$key]);
    }

    public function drop($key) {
        unset($this->data[$key]);
    }

}

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

/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2011, Mike Cao <mike@mikecao.com>
 * @license     MIT, http://flightphp.com/license
 */

/**
 * The View class represents output to be displayed. It provides
 * methods for managing view data and inserts the data into
 * view templates upon rendering.
 */
class View {

    /**
     * Location of view templates.
     *
     * @var string
     */
    public $path;

    /**
     * File extension.
     *
     * @var string
     */
    public $extension = '.php';

    /**
     * View variables.
     *
     * @var array
     */
    protected $vars = array();

    /**
     * Template file.
     *
     * @var string
     */
    private $template;

    /**
     * Constructor.
     *
     * @param string $path Path to templates directory
     */
    public function __construct($path = '.') {
        $this->path = $path;
    }

    /**
     * Gets a template variable.
     *
     * @param string $key Key
     * @return mixed Value
     */
    public function get($key) {
        return isset($this->vars[$key]) ? $this->vars[$key] : null;
    }

    /**
     * Sets a template variable.
     *
     * @param mixed $key Key
     * @param string $value Value
     */
    public function set($key, $value = null) {
        if (is_array($key) || is_object($key)) {
            foreach ($key as $k => $v) {
                $this->vars[$k] = $v;
            }
        } else {
            $this->vars[$key] = $value;
        }
    }

    /**
     * Checks if a template variable is set.
     *
     * @param string $key Key
     * @return boolean If key exists
     */
    public function has($key) {
        return isset($this->vars[$key]);
    }

    /**
     * Unsets a template variable. If no key is passed in, clear all variables.
     *
     * @param string $key Key
     */
    public function clear($key = null) {
        if (is_null($key)) {
            $this->vars = array();
        } else {
            unset($this->vars[$key]);
        }
    }

    /**
     * Renders a template.
     *
     * @param string $file Template file
     * @param array $data Template data
     * @throws \Exception If template not found
     */
    public function render($file, $data = null) {
        $this->template = $this->getTemplate($file);

        if (!file_exists($this->template)) {
            throw new \Exception("Template file not found: {$this->template}.");
        }

        if (is_array($data)) {
            $this->vars = array_merge($this->vars, $data);
        }

        extract($this->vars);

        include $this->template;
    }

    /**
     * Gets the output of a template.
     *
     * @param string $file Template file
     * @param array $data Template data
     * @return string Output of template
     */
    public function fetch($file, $data = null) {
        ob_start();

        $this->render($file, $data);
        $output = ob_get_clean();

        return $output;
    }

    /**
     * Checks if a template file exists.
     *
     * @param string $file Template file
     * @return bool Template file exists
     */
    public function exists($file) {
        return file_exists($this->getTemplate($file));
    }

    /**
     * Gets the full path to a template file.
     *
     * @param string $file Template file
     * @return string Template file location
     */
    public function getTemplate($file) {
        $ext = $this->extension;

        if (!empty($ext) && (substr($file, -1 * strlen($ext)) != $ext)) {
            $file .= $ext;
        }

        if ((substr($file, 0, 1) == '/')) {
            return $file;
        }

        return $this->path . '/' . $file;
    }

    /**
     * Displays escaped output.
     *
     * @param string $str String to escape
     * @return string Escaped string
     */
    public function e($str) {
        echo htmlentities($str);
    }

}

//////////////////////////////////



class SecureData {

    /**
     * @param <type> string
     * @return <type> string
     * @desc treat with html entities and trim only
     * @example good for all types of post data except data from text area
     */
    public function safedata($mds) {
        $dta = trim($mds);
        if ($dta) {
            $tzz = htmlentities($dta);
            return $tzz;
        } else {
            return false;
        }
    }

    /*
     * //Colum name array to string array
     * now i use this function only for registrattion form
     * user/auth/register
     * replace this in future version with efficient way
     * 
     */

    public function table_column_name_value_gen($col_name_pair) {
        $cnv;

        // value string generation
        // this doube assignment because
        //array_keys($col_arr)
        // will change the original array
        //pass by reference
        $value_arr = $col_name_pair;
        $col_arr = $col_name_pair;

        $pup_last_column = array_pop($value_arr);

        $value_sting = "'";
        foreach ($value_arr as $value) {
            $value_sting .= $value . "','";
        }
        $value_sting .= $pup_last_column . "'";
        $cnv['value_string'] = $value_sting;

        //column name generation
        $table_columns_to_select = array_keys($col_arr);
        $COLUMS = "`";
        $COLUMS .= implode("`,`", $table_columns_to_select);
        $COLUMS .= "`";
        $cnv['column_string'] = $COLUMS;
        return $cnv;
    }

}


