<?php
// phpcs:disable

//use WebsiteNEO\SelectConnect\Helpers;

global $wpdb;
global $pagenow;
global $wp_filter;
global $wp_settings_sections;       //websiteneo-furniture-plugin-options
global $wp_settings_fields;         //wneof_manufacturer_group

// $screen = get_current_screen(); 
// d($pagenow, $screen);

\Kint\Renderer\RichRenderer::$folder = false;

// $scec_nonce = wp_create_nonce('scec_nonce');
$ajax_url = admin_url('admin-ajax.php');
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>




<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


<div id="vue-div" class="container">

    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">
                <h6 class="card-title"></h6>

                <div class="card-text">
                    <ul class="list-group">

                        <li class="list-group-item active">Local DB Manufacturers</li>
                        
                        <?php
                            /*
                            $scManufacturer = $wpdb->get_results(
                                "
                                select distinct manufacturer
                                from {$wpdb->prefix}wneof_products  
                                order by manufacturer asc
                                "
                            );
                            */

                            /*
                            select distinct manufacturer
                            from {$wpdb->prefix}wneof_products  
                            order by manufacturer asc
                            */
                        
                            $scManufacturer = $wpdb->get_results(
                                "                          
                                    select 

                                    `{$wpdb->prefix}wneof_products`.`manufacturer`
                                    AS `manufacturer`, 

                                    count(0) AS `_count`

                                    from `{$wpdb->prefix}wneof_products` where (`{$wpdb->prefix}wneof_products`.`manufacturer` is not null) 
                                    
                                    group by `{$wpdb->prefix}wneof_products`.`manufacturer`
                                "
                            );

                            // d($scManufacturer);
                            
                            foreach ($scManufacturer as $key => $m) {
                                echo "<li class='list-group-item'>
                                        <div class='row'>
                                            <span class='col-4'>$m->manufacturer</span>
                                            <span class='col-1 badge badge-secondary'>$m->_count</span>
                                        </div>
                                </li>";
                            };
                            
                        ?>

                    </ul>

                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">
                <h6 class="card-title"></h6>

                <div class="card-text">
                    <ul class="list-group">

                        <li class="list-group-item active">Local Active Plugins</li>
                        
                        <?php
                            // Check if get_plugins() function exists. This is required on the front end of the
                            // site, since it is in a file that is normally only loaded in the admin.
                            if ( ! function_exists( 'get_plugins' ) ) {
                                require_once ABSPATH . 'wp-admin/includes/plugin.php';
                            }

                            $apl=get_option('active_plugins');
                            $plugins=get_plugins();
                            $activated_plugins=array();

                            foreach ($apl as $p){           
                                if(isset($plugins[$p])){
                                    array_push($activated_plugins, $plugins[$p]);
                                }           
                            }
                            //This is the $activated_plugins information

                            /*
                            echo "<pre>";
                            var_dump($activated_plugins[0]);
                            echo "</pre>";
                            */

                            // d($activated_plugins);
                            
                            
                            foreach ($activated_plugins as $key => $p) {
                                echo "<li class='list-group-item'>
                                        <div class='row'>
                                            <span class='col-4'>$p[Name]</span>
                                            <span class='col'></span>
                                        </div>
                                </li>";
                            };
                            
                            
                        ?>

                    </ul>

                </div>
            </div>
            
        </div>
    </div>

    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">SETTINGS_SECTIONS</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                //d($wp_settings_sections); 
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">SETTINGS_FIELDS</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                foreach ($wp_filter as $key => $value) {
                                    if (strpos($key, 'sc_') !== false) {
                                        //echo $key . "\n";
                                        
                                        //d($key, $wp_filter[$key]);
                                    }
                                };                            
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">FILTERS</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php //d($wp_filter); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">FILTERS SC</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                foreach ($wp_filter as $key => $value) {
                                    if (strpos($key, 'sc_') !== false) {
                                        //echo $key . "\n";
                                        
                                        //d($key, $wp_filter[$key]);
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">FILTERS WNEO</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                foreach ($wp_filter as $key => $value) {
                                    if (strpos($key, 'wneo') !== false) {
                                        //echo $key . "\n";
                                        
                                        //d($key, $wp_filter[$key]);
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">WC PRODUCTS\POSTS</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                $wcProducts = $wpdb->get_results(
                                    "
                                    select *
                                    from $wpdb->posts
                                    where post_type='product'
                                    limit 5
                                    "
                                );

                                //d($wcProducts);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">SC PRODUCTS</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <?php 
                                $scProducts = $wpdb->get_results(
                                    "
                                    select *
                                    from {$wpdb->prefix}wneof_products
                                    limit 20
                                    "
                                );
                                
                                d($scProducts);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card col rounded border border-primary">
            <div class="card-body">

                <h6 class="card-title">SC Categories</h6>

                <div class="card-text">
                    
                    <div class="row">
                        <div class="col">
                            <ul>
                                <?php 
                                    $_scCategories = $wpdb->get_results(
                                        "
                                        select distinct category
                                        from {$wpdb->prefix}wneof_products
                                        "
                                    );

                                    d($_scCategories);

                                    $oc = [];

                                    foreach ($_scCategories as $key => $c) {
                                        $cc =$c->category;

                                        // $i = strpos($cc, '{');
                                        // $sub = substr($cc, $i);

                                        // $e = explode(':', $cc);
                                        $e=$cc;
                                        d($e);
                                        
                                        

                                        for( $i=0; $i< $e[1]; $i++){
                                            
                                        }

                                        $json_e= json_encode($e,JSON_FORCE_OBJECT   );

                                        echo "<li class='list-group-item'>
                                            <div class='row'>
                                                <span class='col'>$key => $cc</span>
                                                <span class='col badge badge-secondary'></span>

                                                <script>
                                                    //  $e
                                                    //  $json_e

                                                    // window.testCats[$key]= JSON.parse('$e');
                                                    // window.testCats[$key]= $json_e;
                                                
                                                </script>
                                            </div>
                                        </li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>






</div>