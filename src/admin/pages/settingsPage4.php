<?php
// phpcs:disable
\Kint\Renderer\RichRenderer::$folder = false;
    
global $wpdb;
global $pagenow;
global $wp_filter;
global $wp_settings_sections;       //websiteneo-furniture-plugin-options
global $wp_settings_fields;         //wneof_manufacturer_group    

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>

    <!-- bootstrap -->    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JQUERY GETS ADDED BY WORDPRESS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    <!-- vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
    <?php
        /** PAGE CATEGORIES */
        $sitePageCategories=[];
        
        /*
        $furniturePage = '';
        $pages = get_pages();
        foreach($pages as $page){
            if( strpos($page->post_name, 'furniture') !== false ){
                $furniturePage = $page;
                break;
            }
        }

        $pages = get_pages( array( 'child_of' => $furniturePage->ID ) );
        foreach( $pages as $page){
            //array_push( $pageCategories, array( $page->ID, $page->post_name, $page->post_title )  );
            $pageCategories[$page->post_name] = ''.$page->post_name.' __ '.$page->post_title.' ::'.$page->ID.' =>'.$page->post_parent;
        }
        asort($pageCategories);
        */





        // get furniture page
        $furniturePage = '';
        $furniturePageID = '';

        $pages = get_pages();
        foreach($pages as $page){
            if( strpos($page->post_name, 'furniture') !== false ){
                $furniturePage = $page;
                $furniturePageID = $page->ID;
                // $sitePageCategories[$page->ID] = $page->post_title;
                break;
            }
        }
        
        // get all child pages of furniture
        $pages = get_pages( array( 'child_of' => $furniturePage->ID ) );


        // var_dump($furniturePage);
        // var_dump($furniturePageID);
        d($furniturePageID);
        
        var_dump($pages[0]);



        //getting top level categories
        $topLevelCategories=[];
        $protoCategories = [];
        foreach ($pages as $key => $page) {
            // $protoCategories[$page->ID] = $page->post_name; 
            $protoCategories[$page->ID] = 
            [
                 'ID' => $page->ID, 
                 'post_name' => $page->post_name,
                 'post_parent' => $page->post_parent 
            ]; 
            


            if( $page->post_parent == $furniturePageID ){

                $sitePageCategories[$page->ID] = [ 'cat'=> $page->post_name, 'sub'=> [] ];                 

                $topLevelCategories[$page->ID] = $page->post_name; 
 
                unset( $protoCategories[$page->ID] );
            }
        }


        
        // foreach top level category
        foreach ($sitePageCategories as $catKey => $cat) {
            
            // echo "$catKey => {$cat['cat']} <br />";
            //echo $cat['cat'];

            
            // test pages for top level, and if found, store in that category
            foreach ($protoCategories as $key => $page) {            

                if( $page['post_parent'] === $catKey ){                    
                    $sitePageCategories[$catKey]['sub'][$page['ID']] = 
                    [
                        'cat' => $page['post_name'],
                        'sub' => []
                    ];
                    
                    unset( $protoCategories[$page['ID']] );
                }
            }
        }


        // 3rd level of categories?
        foreach ($protoCategories as $key => $page) {
            $ancestors = get_post_ancestors($key);
            
            /*
            d(
                $key, 
                $page, 
                $ancestors                
            );
            */    

            $sitePageCategories[$ancestors[1]]['sub'][$ancestors[0]]['sub'][$key] = $page['post_name'];

            unset( $protoCategories[$key] );
        }

        // d($protoCategories);

        // d($topLevelCategories);

        d($sitePageCategories);

        // var_dump($sitePageCategories);



        
        $protoCategories3 = [];
        
        foreach ($sitePageCategories as $catKey => $cat) {
            // d($catKey, $cat, count( $cat['sub'] )  );
            // echo "> $cat[cat] <br />";
            $s = $cat['cat'];

            if( count( $cat['sub'] ) > 0 )
            {
                foreach ($cat['sub'] as $subKey => $subCat) {
                    // d( $subKey, $subCat);
                    // echo "@@ $subCat[cat] <br />";
                    $ss = $subCat['cat'];

                    if( count( $subCat['sub'] ) > 0 )
                    {
                        foreach ($subCat['sub'] as $subSubKey => $subSubCat) {
                            // d( $subSubKey, $subSubCat);                        
                            // echo "### $subSubCat <br />";
                            $sss = $subSubCat;    
                            
                            
                            //echo "$s\\$ss\\$sss <br />";
                            $protoCategories3["$s/$ss/$sss"] = "$s/$ss/$sss"; 
                        }

                    }

                    // echo "$s\\$ss <br />";                    
                    $protoCategories3["$s/$ss"] = "$s/$ss"; 
                }
            }

            // echo "$s <br />";
            $protoCategories3["$s"] = "$s"; 
        }

        var_dump($protoCategories3);
        d($protoCategories3);










































        // d( $_SERVER );

        /*
        foreach ($pages as $key => $page) {
            // $url      = "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            // $a = get_post_ancestors( $page->ID );
            
            $l = get_permalink($page);
            $fpos = strpos($l,'furniture');
            $ll = substr($l,$fpos+ 10);
            
            echo "$ll <br />";
            
            d(
                $page->post_name,
                $page->ID,
                $page->post_parent,
                $a,
                $ll                
            );


        }
        */

        /*
        $furniturePage = '';
        $pages = get_pages();
        foreach($pages as $page){
            if( strpos($page->post_name, 'furniture') !== false ){
                $furniturePage = $page;
                // $furniturePageID = $page->ID;
                // $sitePageCategories[$page->ID] = $page->post_title;
                break;
            }
        }
        
        // get all child pages of furniture
        $pages = get_pages( array( 'child_of' => $furniturePage->ID ) );

        
        $pageCategories = [];
        foreach ($pages as $key => $page) {            
            $l = get_permalink($page);
            $fpos = strpos($l,'furniture');
            $ll = substr($l,$fpos+ 10);           

            $pageCategories[$ll] = $ll;
        }
        */














    ?>











</body>
</html>












<?php

?>