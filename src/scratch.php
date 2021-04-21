<?php

/** TESTING\WOOCOMMERCE intergration page */

/**
 * 
 */
//add_action( 'admin_enqueue_scripts', 'scwc_my_enqueue' );

function scwc_my_enqueue( $hook ) {
    if( 'myplugin_settings.php' != $hook ) return;
    
    wp_enqueue_script( 'ajax-script',
        plugins_url( '/js/myjquery.js', __FILE__ ),
        array( 'jquery' )
    );
}

//add_action('wp_enqueue_scripts', 'func_load_vuescripts');
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\func_load_vuescripts');
function func_load_vuescripts() {
    wp_register_script( 'wpvue_vuejs', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js', '', '', false);
    wp_enqueue_script('wpvue_vuejs');
}

/*
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue( $hook ) {
    if( 'myplugin_settings.php' != $hook ) return;
    wp_enqueue_script( 'ajax-script',
        plugins_url( '/js/myjquery.js', __FILE__ ),
        array( 'jquery' )
    );
    $title_nonce = wp_create_nonce( 'title_example' );
    wp_localize_script( 'ajax-script', 'my_ajax_obj', array(
       'ajax_url' => admin_url( 'admin-ajax.php' ),
       'nonce'    => $title_nonce,
    ) );
}
*/

/**
 * Register new scwc testing page
 * 
 * @return void
 * @author Robert Chula
 * 
 */
add_action('admin_menu', __NAMESPACE__ . '\\wneo_page1');

function wneo_page1(){
    //add_menu_page( page_title, menu_title, capability, menu_slug, function, icon_url, position );
    
    /*
    add_menu_page(
        'SelectConnect test',
        'SelectConnect test',
        'manage_options',
        'websiteneo-furniture-plugin-options',
        'test_init'
        //__NAMESPACE__ . '\\wneof_options'
    );
    */

    add_menu_page( 
        'Test Plugin Page', 
        'Test Plugin', 
        'manage_options', 
        'test-plugin', 
        // 'websiteneo-furniture-plugin-options',
        __NAMESPACE__ . '\\test_init'
    );
}

function test_init(){
    global $wpdb;
    //{$wpdb->prefix}

    $scwc_nonce = wp_create_nonce( 'scwc_nonce' );
    $ajax_url = admin_url( 'admin-ajax.php' );

    //Add Vue.js
    //wp_enqueue_script('wpvue_vuejs');

    
    //wp_enqueue_script( 'scwc_script1', plugins_url( '/js/myjquery.js', __FILE__ ), array('jquery'); )
    
    
    //echo "<h1>Hello World</h1>";

    vdump($_POST);
    //vdump($wpdb);

    //need db table wp_ wneo_ products

    echo "<h1>WC PRODUCTS\POSTS</h1>";
    $wcProducts = $wpdb->get_results(
        "
        select *
        from $wpdb->posts
        where post_type='product'
        limit 5
        "
    );
    vdump($wcProducts);

    echo "<h1>SC PRODUCTS</h1>";
    $scProducts = $wpdb->get_results(
        "
        select *
        from {$wpdb->prefix}wneof_products      
        limit 5  
        "
    );
    vdump($scProducts);

    echo "<h1>SC CATEGORIES</h1>";
    $scProducts = $wpdb->get_results(
        "
        select distinct  category
        from {$wpdb->prefix}wneof_products              
        "
    );
    vdump($scProducts);


    //vdump()




    ?>

        <!-- 
        <form action='' method='post'>
            <div class="categories"></div>
            <div class="sc_items"></div>
            <div class="wc_items"></div>
            <div class="scwc_buttons"></div>
            

            <input name='test' id='test' type='text' value='testing'/>
            <input type='hidden' name='action' value='sc_wc_test'/>            
            <input type='submit'/>
        </form>   
         -->

        <style>
            .test{
            }

            .test ul{
                width: 1200px;
            }

            .item{
                width: 500px;
                float: left;

                /* border: 1px solid black; */
                border: 1px dashed black;
                border-radius: 25px;
                
                padding: 20px;
                margin: 0 10px 10px 0;
            }

            .test .topRow{
                /* margin-bottom: 20px; */
            }


                
            .test .grid-1{
                display:grid;
                grid-template-columns: 100px 1fr;
                /*grid-template-columns: 150px 150px 150px;*/
                /* grid-template-columns: repeat(3, 33.33%); */
                /* grid-template-columns: repeat(2, 1fr); */
                /* grid-template-rows: auto auto auto; */
                grid-gap: 15px;
                grid-auto-flow: dense;
            }

            .test .grid-1 label{
                grid-column:1/2;
                /* text-align:right; */
                justify-self: end;
            }

            .test .grid-1 input{
                grid-column:2/3;
                align-self: start;
            }



            .test img{
                width: 150px;
                height:auto;
            }

            .test img.imageThumb{
                width:50px;
            }

            .test button{
                justify-self: end;
                margin-left: 10px;
            }

            /*
            .test input[type='checkbox']{ 
                text-align: left;
                justify-self: start;
            }
            */

            .test code{ background-color: #ddd; }
            .test .itemRaw{
                /* background: rgba(0, 0, 0, 0.07); */
                /* background: rgb(68, 68, 68); */
                background-color: #ddd;
                border-radius: 25px;
                overflow: auto;

            }

            /*
            .test .col1{
                float: left;
                padding-top: 10px;
            }

            .test .col2{
                float: left;
            }
            */

            .test .cls{
                clear:both;
            }
        </style>

        <div class="vue-div" id="vue-div">
            <!-- Message {{message}}! -->

            <form v-on:submit.prevent="function(){ ; }">
                <div>
                    Items from:
                    <input type="radio" name="selectItems" value="sc" checked/>Select Connect
                    <input type="radio" name="selectItems" value="wc"/>Woo Commerce
                </div>
                <br />

                <div class="scwc_categories">
                    <label>Category:</label>
                    <select v-model="selectedCategory" v-on:change="onCategoryChange">
                        <option v-for="cat in categories" v-bind:value="cat">     
                            {{cat}}           
                        </option>
                    </select>
                </div>
                <br />

                <div>
                    Items ({{items.length}}) for Category:: {{selectedCategory}}
                </div>
                <br />

                

                <div class="scwc_items1 test" v-if="items.length">
                    <ul>
                        <li v-for="item in items" v-bind:key="item.id" class="item">
                            <div>
                                <div class="topRow">
                                    <input type="checkbox">                                
                                    <button style="width: 100px; float:right;">Add Item</button>
                                    <button style="width: 100px; float:right;">Edit</button>
                                </div>
                                <br class="cls" />
                                    
                                
                                <div class="middleRow">
                                    <div class="images" style="float:left; ">
                                        <img v-bind:src="item.image" class="image"></img>
                                        <br />
                                        <img v-bind:src="item.thumbnail" class="imageThumb"></img>
                                    </div>
                                
                                    <div class="grid-1" style="">

                                        <label>Price:</label>
                                        <input type="text" placeholder="$Price?">
                                    
                                        <label>ID:</label>
                                        <input type="text" readonly v-bind:value="item.id">

                                        <label>Name:</label>
                                        <input type="text" readonly v-bind:value="item.name">
                                        
                                        <label>Manufacturer:</label>
                                        <input type="text" readonly v-bind:value="item.manufacturer">
                                                                            
                                        <label>Part Number:</label>
                                        <input type="text" readonly v-bind:value="item.part_number">
                                                                            
                                        <label>Category:</label>
                                        <input type="text" readonly v-bind:value="item.category">
                                                                            
                                        <label>Description:</label>
                                        <input type="text" readonly v-bind:value="item.descripton">
                                                                            
                                        <label>Image:</label>
                                        <input type="text" readonly v-bind:value="item.image">
                                                                            
                                        <label>Thumbnail:</label>
                                        <input type="text" readonly v-bind:value="item.thumbnail">
                                    </div>
                                </div>                 
                                <br class="cls" />

                                <div class="bottomRow">
                                    <div class="itemRaw">
                                        <pre><code>{{item}}</code></pre>
                                    </div>
                                </div>                 
                            </div>
                                
                               

                        </li>
                    </ul>

                </div>
            </form>
        </div>


        <script>
            var this2= this;
            window.scwc_ajax=null;
            window.scwc_categories1=null;
            window.scwc_category=null;
            window.scwc_sc_items=null;
            window.scwc_wc_items=null;


            app = new Vue({
                el: '#vue-div',
                data: {
                    message: "Hello @.@!",
                    categories:[],
                    categories_drill_down:[],
                    chosenCategory:'',
                    selectedCategory: '',
                    items:['item1'],
                    items_wc:[],
                    itesm_sc:[],
                },
                methods: {
                    onCategoryChange: function(event){
                        // this points to Vue instance

                        console.log(event);

                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo $ajax_url; ?>',

                            data:{
                                action: 'scwc_getMultitudes',
                                nonce: '<?php echo $scwc_nonce ?>',
                                what: 'scitems',
                                todo: 'getall',
                                subWhat: "categories",
                                param1: app.selectedCategory,                                
                            }

                        }).done(function(response){
                            console.log("done");
                            console.log(response);

                            app.items  = response;

                        }).fail( function(){
                            console.log("fail");

                        }).always( function(){
                            console.log("always");

                        });
                    },
                }
            });


            jQuery.ajax({
                type: 'POST',
                url: '<?php echo $ajax_url; ?>',

                data:{
                    action: 'scwc_getMultitudes',
                    what: 'category',
                    todo: 'getall',
                    nonce: '<?php echo $scwc_nonce ?>',                    
                }
            }).done( function(response){
                let r= response;
                window.scwc_ajax1 = r;
                console.log("done");
                console.log(response);



                // debugger;
                //regex = /([A-Za-z ]){2,}/g;
                let matches = r.replace(/category/g, "").match(/([A-Za-z ]){2,}/g);
                //let distinctMatches = matches;
                let distinctMatches = [...new Set(matches)];
                distinctMatches.unshift("");
                
                console.log(distinctMatches);
                
                //regex = new RegExp("([A-Za-z ]){2,}", "g");
                window.scwc_categories1 = distinctMatches;

                app.categories = window.scwc_categories1;

            }).fail( function(){
                console.log('fail');
            }).always( function(){
                console.log('always');
            });   
        
        </script>

    <?php
}
//add_action('admin_menu', 'wneo_page1');


/**
 * Testing page ajax
 * 
 * @author Robert Chula
 */

add_action('wp_ajax_scwc_getMultitudes',  __NAMESPACE__ . '\\scwc_ajax_getMultitudes');

function scwc_ajax_getMultitudes(){
    //check_ajax_referer( 'scwc_nonce' );
    
    global $wpdb;

    $what = $_POST['what'];
    $todo = $_POST['todo'];


    // $response = 'Hi! '.$value1;
    // echo $response;

    //vdump($_POST);

    switch ($what."_".$todo) {
        case 'category_getall':
            $scCatagories = $wpdb->get_results(
                "
                select distinct  category
                from {$wpdb->prefix}wneof_products              
                "
            );
            // vdump($scCatagories);
            
            
            $jsonCatagories = json_encode($scCatagories);
            // vdump($jsonCatagories);
            
            // wp_send_json( $scCatagories);
            wp_send_json( $jsonCatagories);
            
        break;

        case 'scitems_getall':
            // vdump($_POST);
            
            
            $subWhat = $_POST['subWhat'];
            $param1= $_POST['param1'];
            

            
            $scItems = 
            "
            select *
            from {$wpdb->prefix}wneof_products
            where category like '%{$param1}%'
            limit 5  
            "
            ;
            $scItems = $wpdb->get_results($scItems);
            // vdump($scItems);            
            // echo $scItems;
            

            wp_send_json( $scItems);

            break;
        
        default:
            # code...
            // echo "nope";
            vdump($_POST);
            break;
    }

    wp_die();
}

