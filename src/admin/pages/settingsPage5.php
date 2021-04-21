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
                <?php 
                    $postURL = "https://selectconnectdev.com/scapi/wp-json/wp/v2/posts?per_page=2" ;
                ?>

                <h6 class="card-title">
                    <?= $postURL ?>
                </h6>

                <div class="card-text">
                    <?php
                        // get the total number of pages from the master site
                        $header_response  = \wp_remote_get(
                            $postURL,
                            array(
                                'timeout'     => 120,
                                'sslverify'   => false,
                                'httpversion' => '1.1',
                            )
                        );

                        $response_posts = \wp_remote_retrieve_body( $header_response );
                        $response_posts_json = json_decode( $response_posts );
                        
                        $response_code    = \wp_remote_retrieve_response_code( $header_response );

                        $response_message = \wp_remote_retrieve_response_message( $header_response );

                        $total_pages = \wp_remote_retrieve_header( $header_response, 'X-WP-TotalPages' );

                        d($header_response);
                        d($response_message);
                        d($response_code);
                        d($total_pages);
                        d($response_posts);
                        d($response_posts_json);

                        echo "<pre>";
                        // var_dump($header_response);
                        // var_dump(json_decode($response_posts)[0]);
                        echo "</pre>";

                        foreach ($response_posts_json as $key => $value) {
                            d($value);
                            d($value->acf->builder->post_title);
                            d($value->acf->category);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>