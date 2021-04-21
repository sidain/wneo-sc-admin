<!-- phpcs:disable -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        

    <!-- VUE FRAME WORK -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>





    <!-- BOOTSTRAP FRAME WORK version 5 -->
    <!-- https://v5.getbootstrap.com/ -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <?php include("./common/header"); ?>




    <!-- BEGIN CODEPAGE -->

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





























    <!--  
    echo "<div class=''>";    

    echo "<div class='card border border-primary rounded p-1 mb-1'>";
        echo "<div class='card-body'>";    
            echo "<h4 class='card-title'>Total Manufacturers</h4>";
            $scManufacturer = $wpdb->get_results(
                "
                select distinct manufacturer
                from {$wpdb->prefix}wneof_products  
                order by manufacturer asc
                "
            );

            echo "<div class='card-test'>";
                d($scManufacturer);
            echo "</div>";
        echo "</div>";
    echo "</div>";



    echo "<div class='card border border-primary rounded p-1 mb-1'>";
        echo "<h4 class='dev2Header'>--SETTINGS_SECTIONS</h4>";
        echo "<div class='dev2Div '>";
            d($wp_settings_sections);
        echo "</div>";
        echo "<hr />";


        echo "<h4 class='dev2Header'>--SETTINGS_FIELDS</h4>";
        echo "<div class='dev2Div '>";
            d($wp_settings_fields);
            d($wp_settings_fields['websiteneo-furniture-plugin-options']['wneof_manufacturer_group']);
        echo "</div>";
        echo "<hr />";
    echo "</div>";



    echo "<div class='border border-primary rounded p-1 mb-1'>";
        echo "<h4 class='dev2Header'>--FILTERS</h4>";
        echo "<div class='dev2Div'>";
        //d($wp_filter);
        echo "</div>";
        echo "<hr />";

        echo "<h4 class='dev2Header'>--FILTERS SC</h4>";
        echo "<div class='dev2Div'>";
        foreach ($wp_filter as $key => $value) {
            if (strpos($key, 'sc_') !== false) {
                //echo $key . "\n";
                d($key, $wp_filter[$key]);
            }
        }
        echo "</div>";
        echo "<hr />";

        echo "<h4 class='dev2Header'>--FILTERS WNEO</h4>";
        echo "<div class='dev2Div'>";
        foreach ($wp_filter as $key => $value) {
            if (strpos($key, 'wneo') !== false) {
                //echo $key . "\n";
                d($key, $wp_filter[$key]);
            }
        }
        echo "</div>";
        echo "<hr />";
    echo "</div>";

        
        



    echo "<div class='border border-primary rounded p-1 mb-1'>";
    echo "<h4>WC PRODUCTS\POSTS</h4>";
    $wcProducts = $wpdb->get_results(
        "
        select *
        from $wpdb->posts
        where post_type='product'
        limit 5
        "
    );
    d($wcProducts);

    echo "<h4>SC PRODUCTS</h4>";
    $scProducts = $wpdb->get_results(
        "
                select *
                from {$wpdb->prefix}wneof_products
                limit 20
                "
    );
    d($scProducts);
    echo "</div>";


    /*
    echo "<h4 class='dev2Header'>SC CUSTOM SORT OPTIONS</h4>";
    echo "<div class='dev2Div'>";
    if (have_rows('builder_sort', 'options')) {
        while (have_rows('builder_sort', 'options')) {
            d(the_row());
        }
    }
    echo "<hr />";
    */

    echo "</div>";
    ?>


    </div>
    -->


    <div class="vue-div container-fluid" id="vue-div">
    <!-- Message {{message}}! -->

    <div class="row">
        
    </div>












    <div class="row">
        <!--  
        <div class='card border border-primary rounded col'>
        < !-- <div class="buildersList"> -- >
            <h4>Local Builders</h4>
            <ul>
                <li v-for="(b, index) in buildersMasterList1">{{b.name}}</li>
            </ul>
        </div>
        -->

        <div class="card col rounded border border-primary">

                <div class="list-group">
                    <button class="list-group-item list-group-item-action active disabled">All Local DB Manufacturers</button>
                    
                    <?php                        
                        $scManufacturer = $wpdb->get_results(                                    
                            "                          
                                select 
                                    replace(m.manufacturer, '-', ' ') AS `_manufacturer`, 
                                    count(0) AS `_count`,
                                    b.builder_id as _id
                                from 
                                    `{$wpdb->prefix}wneof_products` as m  
                                    inner join (select  *  from wp_wneof_builders group by builder) as b
                                
                                on replace(m.manufacturer, '-', ' ')  = b.builder
                                
                                where (m.manufacturer is not null) 
                                group by m.manufacturer
                                order by manufacturer asc
                            "
                        );

                        foreach ($scManufacturer as $key => $m) {
                            echo "<button class='list-group-item list-group-item-action'>
                                    <div class='row'>
                                        <span class='col-3'>$m->_id</span>
                                        <span class='col text-capitalize'>$m->_manufacturer</span>
                                        <span class='col-2 badge bg-secondary'>$m->_count</span>
                                    </div>
                                </button>";
                        };
                        
                    ?>

                </div>


                <div class="card rounded border-0 border-primary d-flex ">
                    <div class="card-body flex-fill">
                        <h6 class="card-title"></h6>

                        <div class="card-text">
                            <?php
                                $sql = "select * from  `{$wpdb->prefix}wneof_products` limit 1";
                                $oneRecord = $wpdb->get_results("
                                    select * from  `{$wpdb->prefix}wneof_products` limit 1
                                ");

                                echo "<pre>";
                                // d($oneRecord);
                                var_dump($oneRecord);
                                echo "</pre>";
                            ?>                        
                        </div>
                    </div>
                </div>
            
        </div>


        <!--  
        <div class="card col rounded border border-primary">
        <! -- <div class="catList"> -- >
            <h4>Local Categories</h4>
            <ul>
                <li v-for="cat in categoriesMasterList1" v-if="cat.length > 0">{{cat}}</li>
            </ul>

        </div>
        -->

        <div class="card col rounded border border-primary">
            <ul class="list-group">
                <li class="list-group-item active">All Local DB Categories</li>

                <li v-for="cat in categoriesMasterList1" v-if="cat.length > 0" class='list-group-item'>
                    {{cat}}
                </li>                       
            </ul>
        </div>


    </div>



    <form v-on:submit.prevent="function(){ ; }" class="">
        <div class="row">
            <!-- <div class="miscButtonsDiv card border rounded-pill border-primary col"> -->
            <div class="miscButtonsDiv card border rounded border-primary col">
                <span>
                    Buttons of Power:
                </span>

                <button type="button" class="btn btn-primary" v-on:click="onClickDisplayPartsNumbers">
                    Enable and Display all( local\global ) Part numbers
                </button>
            </div>
        </div>

        <div class="row">
            <div class="searchButtonsDiv card border rounded  border-primary col">
                <span>
                    Items from:
                </span> 

                <div>
                    <!-- <div class=""> -->
                        <input class="" type="radio" id="selectItems1" name="selectItems" value="scLocal" checked />
                        <label for="selectItems1" >Select Connect - Local</label>
                    <!-- </div> -->

                    <!-- <div class=""> -->
                        <input class="ml-2" type="radio" id="selectItems2" name="selectItems" value="scRemote" />
                        <label for="selectItems2">Select Connect - Remote</label>
                    <!-- </div> -->

                    <!-- <div class=""> -->
                        <input class="ml-2" type="radio" id="selectItems3" name="selectItems" value="wc" />
                        <label for="selectItems3">Woo Commerce</label>
                    <!-- </div> -->

                    <!-- <div class=""> -->
                        <input class="ml-2" type="radio" id="selectItems4" name="selectItems" value="wc" />
                        <label for="selectItems4">E-Commerce</label>
                    <!-- </div> -->
                </div>

            </div>
        </div>

        <div class="ui1 test">
            <div class="scec_categories row">

                <div class="card col">
                    <label for="catOptions1">Categories:</label>
                    <select name="catOptions1" v-model="selectedCategory1" v-on:change="onCategoryChange1">
                        <option v-for="cat in categories1" v-bind:value="cat">
                            {{cat}}
                        </option>
                    </select>
                </div>


                <div class="card col">
                    <label for="buildOptions1">Builders:</label>
                    <select name="buildOptions1" v-model="selectedBuilder1" v-on:change="onBuilderChange1">
                        <option v-for="b in builders1" v-bind:value="b.value">
                            {{b.name}}
                        </option>
                    </select>
                </div>
            </div>

            <div class="ui1-divider row">
                <div class="card col text-center">
                    &laquo; OR &raquo;
                </div> 
            </div> 

            <div class="scec_builders row">
                <div class="card col">
                    <label for="buildOptions2">Builders:</label>
                    <select v-model="selectedBuilder2" v-on:change="onBuilderChange2">
                        <option v-for="builder in builders2" v-bind:value="builder.value">
                            {{builder.name}}
                        </option>
                    </select>
                </div>

                <div class="card col">
                    <label for="catOptions2">Categories:</label>
                    <select name="catOptions2" v-model="selectedCategory2" v-on:change="onCategoryChange2">
                        <option v-for="cat in categories2" v-bind:value="cat.value">
                            {{cat.name}}
                        </option>
                    </select>
                </div>
            </div>

        </div>





        <div class="row">
            <div class="catList catList2 card col" v-if='selectedCategory1 != "" && buildersLocalList1.length > 0' >
                <h4>Category Builders({{buildersLocalList1.length-1}})</h4>
                <ul>
                    <li v-for="b in buildersLocalList1" v-if="b.name.length > 0">{{b.name}}</li>
                </ul>

                <br class='cls' />
            </div>
        </div>

        <div class="row">
            <div class="catList catList2 card col" v-if='selectedBuilder2 != "" && categoriesLocalList2.length > 0'>
                <h4>Builder Categories({{categoriesLocalList2.length-1}})</h4>
                <ul>
                    <li v-for="cat in categoriesLocalList2" v-if="cat.name.length > 0">{{cat.name}}</li>
                </ul>

                <br class='cls' />
            </div>
        </div>


        <div class="row">
            <div class="card col">
                <label for="searchTxt">Search :</label>
                <input name="searchTxt" id="seatchTxt" type="text" value="Search for SKU">
            </div>

            <div class="card col">
                Items ({{items.length}}) for Category:: {{selectedCategory1 + selectedCategory2}}
            </div>
        </div>
        
        <!-- row-cols-2 , limit columns to two rows -->
        <!-- https://v5.getbootstrap.com/docs/5.0/layout/grid/#row-columns -->
        <!-- https://v5.getbootstrap.com/docs/5.0/components/card/#grid-cards -->
        <!-- https://v5.getbootstrap.com/docs/5.0/layout/gutters/ -->
        <!-- https://v5.getbootstrap.com/docs/5.0/utilities/spacing/#negative-margin -->
        <!-- <div class="scec_items1 row row-cols-2 test p-0 m-0 mt-3 mb-3" v-if="items.length"> -->
        <!-- <div class="scec_items1 row-cols-2 g-6 test mt-4 mb-4" v-if="items.length"> -->
        <div class="mt-4">
            <div class="row" id='itemsTop'>TOP</div>
            
            <div class="row">MIDDLE :: CONTENT :: ITEMS</div>

            <div class="row">
                <div class="row-col-2 g-2">
                    <div class="m-0 p-0 col card item">
                        <div class="title">TITLE</div>                    
                        <div class="titleContent">title content</div>                    

                        <div class="title">FIELDS</div>                    
                        <div class="fieldsContent">
                            <div>fields Content</div>

                            <!-- <div class="form-group"> -->
                            <div class="">
                                <label class="form-label">Name:</label>
                                <input class='form-control-sm' type="text" readonly  readonly>
                            </div>                    
                            <!-- </div>                     -->
                        
                        </div>                    
                        
                        <div class="title">RAW</div>                    
                        <div class="rawContent">raw content</div>                    
                    </div>
                </div>
            </div>

            <div class="row" id='itemsBottom'>BOTTOM</div>        
        </div>
                


    </form>
    </div>


    <script>
    jQuery( '.dev2Div' ).slideUp();

    jQuery('.dev2Header').on( 'click', function(x,y,z){
        jQuery(this).next().slideToggle();

    });



    // ui logic\code
    var this2 = this;
    window.scec_ajax = null;
    window.scec_ajax1 = null;
    window.scec_ajax2 = null;

    window.scec_categories1 = null;
    window.scec_category = null;    

    window.scec_builders1 = null;
    window.scec_builder = null;

    window.scec_sc_items = null;
    window.scec_wc_items = null;


        app = new Vue({
            el: '#vue-div',
            data: {
                message: "Hello @.@!",

                buildersMasterList1: [],
                categoriesMasterList1: [],

                buildersLocalList1: [],
                categoriesLocalList2: [],

                buildersList1: [],
                categoriesList1: [],
                categoriesList2: [],

                categories1: [],
                builders1: [],

                selectedCategory1: '',
                selectedBuilder1: '',

                categories2: [],
                builders2: [],
                selectedCategory2: '',
                selectedBuilder2: '',

                categories3: [],
                builders3: [],


                categories_drill_down: [],
                chosenCategory: '',

                builders_drill_down: [],
                chosenBuilder: '',

                items: ['item1'],
                items_wc: [],
                items_sc: [],
            },
            methods: {
                onClickDisplayPartsNumbers: function(event){
                    jQuery.ajax({
                        type:'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data:{
                            action: 'sc_local_ajax_settings',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'global_builder_parts_on',
                            what: '',
                            subWhat: '',
                        }
                    }).done( function(response){
                        console.log("sc_settings global_builder_parts_on done");
                        console.log(response);
                        
                    }).fail(function() {
                        console.log("sc_settings global_builder_parts_on fail");
                    }).always(function() {
                        console.log("sc_settings global_builder_parts_on always");
                    });

                },

                onCategoryChange1: function(event) {
                    // this points to Vue instance
                    console.log('cat change');
                    console.log(event);

                    if( app.selectedCategory1 == "" )  {
                        app.items = [];
                        app.items_sc = [];
                        app.items_wc = [];
                        app.scec_sc_items = [];
                        app.scec_wc_items = [];
                        app.selectedBuilder1='';
                        return;
                    }



                    // get builders in categories...
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_getMultitudes',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'getsome',
                            what: 'builders',
                            subWhat: "",
                            param1: app.selectedCategory1,
                        }

                    }).done(function(response) {
                        let r = response;
                        window.scec_ajax1 = r;

                        console.log("builders,cat change:: done");
                        console.log(response);

                        let bList= JSON.parse(response);
                        bList.unshift( {"value": "", "name": ""} );

                        window.scec_builders1 = bList;

                        app.buildersLocalList1=bList;

                        app.builders1 = bList;
                        app.categoriesList2="";
                        app.selectedBuilder1 ="";
                        app.selectedBuilder2 ="";
                        app.selectedCategory2 ="";

                    }).fail(function() {
                        console.log("getsome builders fail");
                    }).always(function() {
                        console.log("getsome builders always");
                    });


                    //get Items...
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_getMultitudes',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'getall',
                            what: 'scitems',
                            subWhat: "categories",
                            param1: app.selectedCategory1,
                        }

                    }).done(function(response) {
                        console.log("getall items done");
                        console.log(response);

                        app.items = response;

                        if( app.selectedBuilder1 != "")
                            app.buildersLocalList1="";

                    }).fail(function() {
                        console.log("getall items fail");

                    }).always(function() {
                        console.log("getall items always");

                    });


                },
                onCategoryChange2: function(event) {
                    // this points to Vue instance

                    console.log('category change 2');
                    console.log(event);


                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_getMultitudes',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'getsome',
                            what: 'scitems',
                            subWhat: "",
                            param1: app.selectedCategory2,
                            param2: app.selectedBuilder2,
                        }

                    }).done(function(response) {
                        let r = response;
                        window.scec_ajax2 = r;

                        console.log("category2 change done");
                        console.log(response);

                        app.items = response;
                        app.categoriesLocalList2="";

                    }).fail(function() {
                        console.log("category2 change fail");

                    }).always(function() {
                        console.log("category2 change always");

                    });
                },
                onBuilderChange1: function(event) {
                    // this points to Vue instance

                    console.log('builder change 1');
                    console.log(event);


                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_getMultitudes',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'getsome',
                            what: 'scitems',
                            subWhat: "categories",
                            param1: app.selectedCategory1,
                            param2: app.selectedBuilder1,
                        }

                    }).done(function(response) {
                        let r = response;
                        window.scec_ajax1 = r;

                        console.log("builder change done");
                        console.log(response);

                        app.items = response;
                        app.buildersLocalList1="";

                        if( app.selectedBuilder1 == "" )
                            app.buildersLocalList1 = app.builders1;

                    }).fail(function() {
                        console.log("builder change fail");

                    }).always(function() {
                        console.log("builder change always");

                    });

                },
                onBuilderChange2: function(event) {
                    // this points to Vue instance
                    console.log("Builder Change 2");
                    console.log(event);

                    app.selectedCategory1="";
                    app.selectedBuilder1="";

                    app.items = [];
                    app.items_sc = [];
                    app.items_wc = [];
                    app.scec_sc_items = [];
                    app.scec_wc_items = [];

                    // get categories in builder...
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_getMultitudes',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'getsome',
                            what: 'categories',
                            subWhat: "",
                            param1: app.selectedBuilder2,
                        }

                    }).done(function(response) {
                        let r = response;
                        window.scec_ajax2 = r;


                        console.log("cat, builders2 change:: done");
                        console.log(response);

                        let bList= JSON.parse(response);
                        let newBList=[{value:"", name:""}];

                        for (let x = 1; x < bList[0]; x++) {
                            newBList.push(bList[x]);
                        }

                        window.scec_categories2 = newBList;
                        app.categoriesList2 = newBList;
                        app.categoriesLocalList2 = newBList;
                        app.categories2 = newBList;

                        app.selectedCategory2="";


                    }).fail(function() {
                        console.log("getsome categories2 fail");
                    }).always(function() {
                        console.log("getsome categories2 always");
                    });
                },
                onAddItemClick: function(event) {},
                onAddItemClickWC: function(event) {
                    // this points to Vue instance
                    console.log('add item WC click');
                    console.log(event);

                    var holder = event.toElement.parentElement.parentElement
                    var itemId = holder.getAttribute('id').split('_')[1];
                    var itemObj = holder.querySelectorAll('.itemObj')[0].value;


                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'sc_local_doItems',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'add',
                            what: 'WC',
                            subWhat: '',
                            param1: '' + itemObj
                        }
                    }).done(function(response) {
                        console.log("add item WC click done");
                        console.log(response);


                    }).fail(function() {
                        console.log('add item WC click fail');
                    }).always(function() {
                        console.log('add item WC click always');
                    })
                },
                onAddItemClickEC: function(event) {
                    var holder = event.toElement.parentElement.parentElement
                    var itemId = holder.getAttribute('id').split('_')[1];
                    var itemObj = holder.querySelectorAll('.itemObj')[0].value;
                    var refObj = JSON.parse(itemObj);

                    console.log(refObj)


                    /*
                    'name' => $request - > name,
                    'manufacturer' => $request - > manufacturer,
                    'part_number' => $request - > part_number,
                    'description' => $request - > name,
                    'category' => $request - > category,
                    'image' => $request - > image,
                    'thumbnail' => $request - > thumbnail,
                    'sc_product_id' => $request - > sc_product_id,
                    'sc_ec_ref_id' => $request - > sc_ec_ref_id,
                    */


                    jQuery.ajax({
                        type: 'POST',
                        url: 'https://68.183.118.155/scec_api/api/products/',

                        data: {
                            ref: itemObj,
                            name: refObj.name,
                            manufacturer: refObj.manufacturer,
                            part_number: refObj.part_number,
                            description: refObj.description,
                            category: refObj.category,
                            image: refObj.image,
                            thumbnail: refObj.thumbnail,
                            sc_product_id: refObj.sc_product_id,
                            sc_ec_ref_id: refObj.id,
                            //name: refObj.name,
                        }
                    }).done(function(response) {
                        console.log("add item EC click done");
                        console.log(response);

                        /*
                        jQuery('.id_' + response.product.sc_ec_ref_id).css({
                            'border-color': 'green',
                            'border-style': 'solid'
                        });
                        */

                        jQuery('.id_' + response.product.sc_ec_ref_id).addClass('ui_' + response.result)
                    }).fail(function() {
                        console.log('add item EC click fail');
                    }).always(function() {
                        console.log('add item EC click always');
                    });

                    return;




                    /*
                    // this points to Vue instance
                    console.log('add item click');
                    console.log(event);


                    debugger;

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo $ajax_url; ?>',

                        data: {
                            action: 'scec_doItems',
                            nonce: '<?php echo $scec_nonce ?>',
                            todo: 'add',
                            what: 'EC',
                            subWhat: '',
                            param1: '' + itemObj
                        }




                    }).done(function(response) {
                        console.log("add item click done");
                        console.log(response);


                    }).fail(function() {
                        console.log('add item click fail');
                    }).always(function() {
                        console.log('add item click always');
                    });
                    */





                },
                onViewItemClickEC: function(event) {},
                onViewItemClickWC: function(event) {},
                onEditItemClickEC: function(event) {},
                onEditItemClickWC: function(event) {},
                onDeleteItemClick: function(event) {},
                onDeleteItemClickEC: function(event) {},
                onDeleteItemClickWC: function(event) {},
            }
        });



        //get categories
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo $ajax_url; ?>',

            data: {
                action: 'sc_local_getMultitudes',
                what: 'categories',
                todo: 'getall',
                nonce: '<?php echo $scec_nonce ?>',
            }
        }).done(function(response) {
            let r = response;
            window.scec_ajax1 = r;
            console.log("1st categories done");
            console.log(response);



            // debugger;
            //regex = /([A-Za-z ]){2,}/g;
            let matches = r.replace(/category/g, "").match(/([A-Za-z ]){2,}/g);
            //let distinctMatches = matches;
            let distinctMatches = [...new Set(matches)];
            distinctMatches.unshift("");

            console.log(distinctMatches);

            //regex = new RegExp("([A-Za-z ]){2,}", "g");
            window.scec_categories1 = distinctMatches.sort();
            app.categoriesMasterList1 = window.scec_categories1;
            app.categoriesList1 = window.scec_categories1;
            app.categories1 = window.scec_categories1;

        }).fail(function() {
            console.log('1st categories fail');
        }).always(function() {
            console.log('1st categories always');
        });



        // get builders
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo $ajax_url; ?>',

            data: {
                action: 'sc_local_getMultitudes',
                what: 'builders',
                todo: 'getall',
                nonce: '<?php echo $scec_nonce ?>',
            }
        }).done(function(response) {
            let r = response;
            window.scec_ajax2 = r;

            console.log("builders, intial start:: done");
            console.log(response);

            let bList= JSON.parse(response);
            bList.unshift( {"value": "", "name": ""} );

            window.scec_builders1 = bList;
            app.buildersMasterList1 = bList;
            app.buildersList1 = bList;
            app.builders2 = bList;

        }).fail(function() {
            console.log('fail');
        }).always(function() {
            console.log('always');
        });
    </script>

</body>
</html>