<?php

    function role_list($rule)
    {
        $rull = array();

        if($rule == "staff")
        {
            $rull = ['Staff'];
        }elseif($rule == 'manager')
        {
            $rull = ['Manager'];
        }else{
            $rull = ['Manager', 'Staff'];
        }

        $tampil = 5; 
        $hal    = ( isset($_GET['pag'])) ? ($tampil*($_GET['pag'] - 1)) : 0;
        $current= ( isset($_GET['pag'])) ? ($_GET['pag']) : 1;
        
        $arg    = array(
            'role__in'  => $rull,
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
                        'total' => $total, 
                        'current' => $current, 
                        'end_size' => 1,
                        'mid_size' => 5,
                    ));
                ?>
            </div>
        <?php
    }

    function role_shortcode($atts, $content = null)
    {
        extract( shortcode_atts(
            array(
              'rule' => '',
            ), $atts )
          );
        ob_start();
        role_list($rule);

        return ob_get_clean();
    }

    // contoh shortcode [role_short rule="staff"]
    add_shortcode('role_short', 'role_shortcode');

?>