<?php

    function role_manager_list()
    {
        
        $arg    = array(
            'role'  => 'Manager',
        );
        $query  = new WP_User_Query($arg);
        $mans    = $query->get_results();
        // var_dump();
        ?>
            <div class="table">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                    <?php
                        if(!empty($mans))
                        {
                            foreach($mans as $man)
                            {
                                $man_info = get_userdata( $man->ID );
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $man_info->first_name.' '.$man_info->last_name; ?></td>
                        <td><?php echo $man->user_email; ?></td>
                        <td><?php echo $man_info->roles[0]; ?></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    
                </table>
            </div>
        <?php
    }

    function role_manager_shortcode()
    {
        ob_start();
        role_manager_list();

        return ob_get_clean();
    }

    add_shortcode('role_manager_short', 'role_manager_shortcode');

?>