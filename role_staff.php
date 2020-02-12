<?php

    function role_staff_list()
    {
        
        $arg    = array(
            'role'  => 'Staff',
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

    function role_staff_shortcode()
    {
        ob_start();
        role_staff_list();

        return ob_get_clean();
    }

    add_shortcode('role_staff_short', 'role_staff_shortcode');

?>