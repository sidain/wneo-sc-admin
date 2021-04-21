<?php

/**
 *
 * Class to add Ajax features for Select Connect
 *
 */
//use namespace SelectConnect
namespace WebsiteNEO\SelectConnect\SCADMIN;

class Ajax_scadmin
{

    public static function init(): void
    {
        //sc_local_getMultitudes
        add_action('wp_ajax_scadmin_local_getMultitudes', get_called_class() . '::scadmin_local_ajax_getMultitudes');
        
        //sc_local_doItems
        add_action('wp_ajax_scadmin_local_doItems', get_called_class().'::scadmin_local_ajax_doItems');
        
        //sc_local_ajax_settings
        add_action('wp_ajax_scadmin_local_ajax_settings', get_called_class().'::scadmin_local_ajax_settings');

        return;
    }

    /**
     * scec_ajax_getMultitudes
     *
     * function for getting various values from local wp?
     *
     * @return void
     */
    public static function scadmin_local_ajax_getMultitudes($options)
    {
        // d('sc_local_ajax_getMultitudes');

        global $wpdb;
        
        // check_ajax_referer('scec_nonce');

        if (isset($_POST['what'])) {
            $what = $_REQUEST['what'];
            $todo = $_REQUEST['todo'];
        } else if (isset($options['what'])) {
            $what = $options['what'];
            $todo = $options['todo'];
        }



        switch ($what . "_" . $todo) {
            case 'builders_getall':
                $scBuilders = "
                    select distinct  manufacturer
                    from {$wpdb->prefix}wneof_products
                    order by manufacturer asc
                ";
                $scBuilders = $wpdb->get_results($scBuilders);

                $scBuilders = array_map(function ($b) {
                    $name = ucwords(str_replace("-", " ", $b->manufacturer));

                    return ['value' => $b->manufacturer, 'name' => $name];
                }, $scBuilders);

                $scBuilders = json_encode($scBuilders);

                if (!isset($options['what'])) {
                    wp_send_json($scBuilders);
                } else {
                    return $scBuilders;
                }

                break;

            case 'builders_getsome':
                $subWhat = $_POST['subWhat'];
                $param1 = $_POST['param1'];

                $scBuilders = "
                    select distinct  manufacturer
                    from {$wpdb->prefix}wneof_products
                    where category like '%{$param1}%'
                    order by manufacturer asc
                ";
                $scBuilders = $wpdb->get_results($scBuilders);

                $scBuilders = array_map(function ($b) {
                    $name = ucwords(str_replace("-", " ", $b->manufacturer));

                    return ['value' => $b->manufacturer, 'name' => $name];
                }, $scBuilders);

                $scBuilders = json_encode($scBuilders);
                wp_send_json($scBuilders);

                break;

            case 'categories_getall':
                $scCatagories = $wpdb->get_results(
                    "
                    select distinct  category
                    from {$wpdb->prefix}wneof_products
                    "
                );

                $scCategoriesList = [];
                foreach ($scCatagories as $c) {
                    $parts1 = explode(':"', $c->category);

                    foreach ($parts1 as $cc) {
                        $s = substr($cc, 0, strpos($cc, '";'));

                        if (strlen($s) > 0) {
                            array_push($scCategoriesList, $s);
                        }

                    }
                }

                $scCategoriesList = array_unique($scCategoriesList);

                $scCategoriesList = array_map(function ($x) {
                    $s = str_replace(' ', '-', strtolower($x));

                    return ['value' => $x, 'name' => $x];
                }, $scCategoriesList);

                $jsonCatagories = json_encode($scCategoriesList);

                if (!isset($options['what'])) {
                    wp_send_json($jsonCatagories);
                } else {
                    return $jsonCatagories;
                }

                break;

            case 'categories_getsome':
                // echo "<pre>" . var_dump_r($_POST) . "</pre>";

                $subWhat = $_POST['subWhat'];
                $param1 = $_POST['param1'];

                /*
                $scBuilders = "
                select distinct  manufacturer
                from {$wpdb->prefix}wneof_products
                where category like '%{$param1}%'
                order by manufacturer asc
                ";
                 */

                $scCatagories = $wpdb->get_results(
                    "
                    select distinct  category
                    from {$wpdb->prefix}wneof_products
                    where manufacturer like '%{$param1}%'
                    "
                );







                $scCategoriesList2 = [];

                foreach ($scCatagories as $key => $cats) {
                    // error_log( "\n***");

                    foreach( unserialize($cats->category) as $k => $c ){
                        $scCategoriesList2[] = $c;
                    }

                    // error_log( "\n***\n\n\n\n\n");
                }

                $scCategoriesList2 = array_unique($scCategoriesList2);
                array_unshift($scCategoriesList2, count($scCategoriesList2));

                error_log( print_r($scCategoriesList2, true) );





                
                
                
                
                $scCategoriesList = [];

                foreach ($scCatagories as $key => $row) {
                    $cats1 = $row->category;
                    $cats2 = substr( $cats1, strpos($cats1, ':{')+2, -1  );
                    $cats3 = explode('";', $cats2  );

                    foreach ($cats3 as $key => $c) {
                        $cat = substr( $c, strpos($c, ':"' )+2  );

                        array_push($scCategoriesList, $cat);
                    }
                }

                $scCategoriesList = array_unique($scCategoriesList);

                $scCategoriesList = array_map(function ($x) {
                    $s = str_replace(' ', '-', strtolower($x));

                    return ['value' => $x, 'name' => $x];
                }, $scCategoriesList);
                array_unshift($scCategoriesList, count($scCategoriesList));



                // $jsonCatagories = json_encode($scCategoriesList);
                $jsonCatagories = json_encode($scCategoriesList2);
                error_log( $jsonCatagories );

                if (!isset($options['what'])) {
                    wp_send_json($jsonCatagories);
                } else {
                    return $jsonCatagories;
                }

                break;

            case 'scitems_getall':
                $subWhat = $_POST['subWhat'];

                //category
                $param1 = $_POST['param1'];

                $scItems = "
                    select *
                    from {$wpdb->prefix}wneof_products
                    where category like '%{$param1}%'
                    limit 150
                ";
                $scItems = $wpdb->get_results($scItems);

                foreach ($scItems as $key => $item) {
                    // error_log( print_r($item->category, true) );
                    $item->category = unserialize($item->category);
                }

                wp_send_json($scItems);

                break;

            case 'scitems_getsome':
                $subWhat = $_POST['subWhat'];

                //category
                $param1 = $_POST['param1'];
                //builder
                $param2 = $_POST['param2'];

                $scItems = "
                    select *
                    from {$wpdb->prefix}wneof_products
                    where category like '%{$param1}%' && manufacturer like '%{$param2}%'
                    limit 200
                ";
                $scItems = $wpdb->get_results($scItems);

                foreach ($scItems as $key => $value) {
                    // error_log( "\n\n\n".print_r($value->category, true)."\n\n\n"  );

                    $value->category= unserialize($value->category);
                }

                // error_log( "\n\n***SCITEM-GETSOME***\n\n".print_r($scItems, true)."\n\n" );

                wp_send_json($scItems);

                break;

            default:
                # code...
                // echo "nope";
                d($_REQUEST, $what, $todo, $options);
                break;
        }

        wp_die();
    }

    /**
     * scec_ajax_doItems
     *
     * function for dealing with various items
     *
     * @return void
     */
    public static function scadmin_local_ajax_doItems()
    {
        //check_ajax_referer( 'scec_nonce' );

        global $wpdb;

        $what = $_POST['what'];
        $todo = $_POST['todo'];

        // $response = 'Hi! '.$value1;
        // echo $response;

        // vdump($_POST);

        switch ($what . "_" . $todo) {
            case 'WC_add':
                // need to check values for validity

                d($_POST);

                $toInsert = $_POST['param1'];
                $toInsert = stripslashes($toInsert);
                $toInsert = json_decode($toInsert);

                // $toInsert=preg_replace('/.+?({.+}).+/','$1',$toInsert);
                d($toInsert);

                /*
                $itemCategorys =  json_decode($toInsert->category);
                d($itemCategorys);
                d ( json_last_error() );
                 */

                $categoryString = $toInsert->category;
                d($categoryString);

                // a:2:{i:0;s:7:"Bedroom";i:1;s:19:"Bedroom Nightstands";}

                $strIndex = strpos($categoryString, ":{");
                $strLen = strlen($categoryString) - $strIndex - 4;

                d($strLen);

                $catPart0 = explode(':', substr($categoryString, 0, $strIndex))[1];
                $catPart1 = explode(';', substr($categoryString, 1 + 1 + $strIndex, $strLen));
                //

                //preg_match_all();

                d($catPart0);
                d($catPart1);

                // $products_controller =new WC_REST_Products_Controller();

                $dataExample = [
                    'name' => 'Test2 Product Uber',
                    'type' => 'simple',
                    'regular_price' => '',
                    'description' => 'Lorem ipsum',
                    'short_description' => 'Lorem ipsum',
                    'categories' => [
                        ['id' => 9],
                    ],

                    'images' => [
                        ['src' => 'http://x.y.z'],
                    ],

                ];

                $data = [
                    'name' => $toInsert->name,
                    'type' => 'simple',
                    'regular_price' => '999999.99',
                    'description' => $toInsert->description,
                    'short_description' => $toInsert->description,
                    'categories' => [
                        ['id' => 9],
                    ],

                    /*
                'images' => [
                ['src' => $toInsert->thumbnail],
                ['src' => $toInsert->image],
                ]
                 */

                ];

                $request = new \WP_REST_Request('POST');
                $request->set_body_params($data);
                $products_controller = new \WC_REST_Products_Controller;
                //$response = $products_controller->create_item( $request );

                d($response);

                break;

            case 'category_getall':
                $scCatagories = $wpdb->get_results(
                    "
                    select distinct  category
                    from {$wpdb->prefix}wneof_products
                    "
                );
                // d($scCatagories);

                $jsonCatagories = json_encode($scCatagories);
                // d($jsonCatagories);

                // wp_send_json( $scCatagories);
                wp_send_json($jsonCatagories);

                break;

            case 'scitems_getall':
                // d($_POST);
                $subWhat = $_POST['subWhat'];
                $param1 = $_POST['param1'];

                $scItems = "
                select *
                from {$wpdb->prefix}wneof_products
                where category like '%{$param1}%'
                limit 150
                ";
                $scItems = $wpdb->get_results($scItems);
                // vdump($scItems);
                // echo $scItems;

                wp_send_json($scItems);

                break;

            default:
                # code...
                // echo "nope";
                d($_POST);

                break;
        }

        wp_die();
    }

    public static function scadmin_local_ajax_settings($options)
    {

        d($options);
        d($_POST);
        
        global $wpdb;

        $what = $_POST['what'];
        $todo = $_POST['todo'];
        
        $t = 'global_builder_parts_on';

        $ret = '';
        $res = '';

        switch($t){
            case 'global_builder_parts_on':
                $scOptions = $wpdb->get_results(
                "
                    select *
                    from {$wpdb->prefix}wneof_settings  
                    where `option` like '%part%'
                    order by `option`
                "
                );
                d('options',$scOptions);

                $scProducts = $wpdb->get_results(
                    "
                    select distinct manufacturer
                    from {$wpdb->prefix}wneof_products  
                    order by manufacturer asc
                    "
                );
                d($scProducts);

                /*
                $xIntersect= array_intersect(
                array_map(function($e){
                return $s= WebsiteNEO\SelectConnect\Helpers::toDashes($e->manufacturer)."-part-number-display";
                //$p = $s."-part-number-display";
                }, $scProducts),
                array_map(function($e){
                return $e->option;
                }, $scOptions)
                );
                d($xIntersect);
                */


                $xDiff= array_diff(
                    array_map(function($e){
                        return $s= \WebsiteNEO\SelectConnect\Helpers::toDashes($e->manufacturer)."-part-number-display";
                    //$p = $s."-part-number-display";
                    }, $scProducts),
                    array_map(function($e){
                        return $e->option;
                    }, $scOptions)
                );
                d('xdiff',$xDiff);


                $sqlRequest = "insert into {$wpdb->prefix}wneof_settings (`option`, value) values ";
                foreach($xDiff as $m){
                    $sqlRequest .= "('$m', 1),";    
                }
                d($sqlRequest);


                if( count( $xDiff ) >0){
                    d('xDiff > 0');
                    $sqlRequest = rtrim($sqlRequest, ',');
                    $res = $wpdb->get_results($sqlRequest);
                    $ret = update_option( 'sc-builder-code-defaults', 1);
                }

                d('result, response',$res, $ret);


                break;

            default:
                break;

            }
        
        wp_die();        
    }

    public function __construct()
    {
        //add_action('wp_ajax_sc_local_getMultitudes', array($this, 'sc_local_ajax_getMultitudes'));
        //add_action('wp_ajax_sc_local_doItems', array($this, 'scec_ajax_doItems'));
    }

}
