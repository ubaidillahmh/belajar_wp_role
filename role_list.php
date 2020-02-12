<?php

    function role_list()
    {
        $tampil = 1; 
        $hal    = ( isset($_GET['pag'])) ? ($tampil*($_GET['pag'] - 1)) : 0;
        $current= ( isset($_GET['pag'])) ? ($_GET['pag']) : 1;
        
        $arg    = array(
            'role__in'  => array('Manager', 'Staff'),
            'number'    => $tampil,
            'offset'     => $hal
        );
        $query  = new WP_User_Query($arg);
        $mans    = $query->get_results();
        $total  = $query->total_users / $tampil;
        
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
                <?php
                    // grab the current query parameters
                    $query_string = $_SERVER['QUERY_STRING'];

                    $base = site_url() . '?' . remove_query_arg('p', $query_string) . '%_%';

                    echo paginate_links( array(
                        'base' => $base, 
                        'format' => '&pag=%#%', 
                        'prev_text' => __('&laquo; Previous'), 
                        'next_text' => __('Next &raquo;'), 
                        'total' => $query->total_users, 
                        'current' => $current, 
                        'end_size' => 1,
                        'mid_size' => 5,
                    ));
                ?>
            </div>
        <?php
    }

    function role_shortcode()
    {
        ob_start();
        role_list();

        return ob_get_clean();
    }

    add_shortcode('role_short', 'role_shortcode');

?>