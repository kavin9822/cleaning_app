<?php
/**
 * @copyright Copyright (c) 2014-2016 www.whyceeyes.com
 * Example
 * 'ApiStatus'=> 'Active','depricated'
 * SessionDuration in minutes
 */

return [
    'host_name' => 'http://localhost/',
    'base_folder' => 'cleaning_app/api/v1',//no trailing or leading slash
    'ApiVersion'=> 'v1',//not in use now
    'ApiStatus'=> 'Active',
    'SessionDuration'=> 120,//minutes
    'otpSessionDuration'=>120,//minutes,
    'customer_docs' => 'resource/customer',
    'user_docs' => 'resource/user'
];