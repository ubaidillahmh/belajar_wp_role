<?php

    function role_create()
    {
        
        add_role( 'staff', __('Staff'), [
            'read'  => 'true',
        ]);
    

        add_role( 'manager', __('Manager'), [
            'read'          => 'true',
            'list_users'    => 'true'
        ]);
    }

    add_action('init', 'role_create');

?>