<?php

//$status

/**
 * Description of registration_form
 * @example 'DB Colum name' => array(
  'input type' => 'text',
  'value' => $form_data['DB Colum name'],
  'label' => 'User Name',
 *                  'status' => $status - Add if required
  ),
 * 
 *          'user_login' => array(
  'type' => 'text',
  'value' => $form_data['user_login'],
  'label' => 'User Name'
  ),
 * @author psmahadevan
 */
class Registration_Form {

    public static function data() {
        $FormConfig = array(
            'form_title' => 'Registration From',
            'form_content' => array(
                'ID' => array(
                    'type' => 'hidden',
                    'value' => $form_data['name'],
                ),
                'user_login' => array(
                    'type' => 'text',
                    'value' => $form_data['user_login'],
                    'label' => 'User Name'
                ),
                'user_pass' => array(
                    'type' => 'password',
                    'value' => $form_data['user_pass'],
                    'label' => 'Password'
                ),
                'user_nicename' => array(
                    'type' => 'text',
                    'value' => $form_data['user_nicename'],
                    'label' => 'User Nice Name'
                ),
                'user_email' => array(
                    'type' => 'email',
                    'value' => $form_data['user_email'],
                    'label' => 'Email'
                )
            ),
            'form_footer' => array(
                'submit' => array(
                    'type' => 'button',
                    'label' => 'Register',
                    'status'=> 'pull-right'
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}
