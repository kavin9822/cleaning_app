<?php
/**
 * @copyright Copyright (c) 2014-2016 www.whyceeyes.com
 * Example
 * 'ApiStatus'=> 'Active','depricated'
 * SessionDuration in minutes
 */

return [
    'host_name' => 'https://localhost/',
    'base_folder' => 'cleaning_app/api/v1',//no trailing or leading slash
    'ApiVersion'=> 'V1.0',//not in use now
    'ApiStatus'=> 'Active',
    'SessionDuration'=> 120,//minutes
    'otpSessionDuration'=>120,//minutes,
    'profile_pic_customer' => 'resource/profile_pic/customer',
    'customer_docs' => 'resource/customer',
    'user_docs' => 'resource/user'
];