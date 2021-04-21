<!-- phpcs:disable -->

<!--
<form action='' method='post'>
    <div class="categories"></div>
    <div class="sc_items"></div>
    <div class="wc_items"></div>
    <div class="scec_buttons"></div>


    <input name='test' id='test' type='text' value='testing'/>
    <input type='hidden' name='action' value='sc_wc_test'/>
    <input type='submit'/>
</form>
-->


    <!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--  
    <style>
        .test {}

        .test ul {
            width: 1200px;
        }

        .item {
            width: 500px;
            float: left;

            /* border: 1px solid black; */
            border: 1px dashed black;
            border-radius: 25px;

            padding: 20px;
            margin: 0 10px 10px 0;
        }

        .test .topRow {
            /* margin-bottom: 20px; */
        }



        .test .grid-1 {
            display: grid;
            grid-template-columns: 100px 1fr;
            /*grid-template-columns: 150px 150px 150px;*/
            /* grid-template-columns: repeat(3, 33.33%); */
            /* grid-template-columns: repeat(2, 1fr); */
            /* grid-template-rows: auto auto auto; */
            grid-gap: 15px;
            grid-auto-flow: dense;
        }

        .test .grid-1 label {
            grid-column: 1/2;
            /* text-align:right; */
            justify-self: end;
        }

        .test .grid-1 input {
            grid-column: 2/3;
            align-self: start;
        }



        .test img {
            width: 150px;
            height: auto;
        }

        .test img.imageThumb {
            width: 50px;
        }

        .test button {
            justify-self: end;
            margin-left: 10px;
        }

        /*
        .test input[type='checkbox']{
            text-align: left;
            justify-self: start;
        }
        */

        .test code {
            background-color: #ddd;
        }

        .test .itemRaw {
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




        .test .cls {
            clear: both;
        }




        .ui-grid {
            display: grid;
            justify-content: space-evenly;
            align-content: center;
        }

        .ui_created {
            border-color: green;
            border-style: solid;
        }

        .ui_updated {
            border-color: blue;
            border-style: solid;
        }

        .ui_falied {
            border-color: red;
            border-style: solid;
        }




        select,
        option {
            text-transform: capitalize;
        }

        .ui1 {
            width: 620px;

            border: solid black 2px;
            border-radius: 25px;

            padding: 15px;
        }

        .ui1-divider {
            font-weight: bold;
            font-size: 24px;
            text-align: center
        }

        .catList2 {
            width: 620px;
        }

        .catList {
            /* width: 300px; */
            /* height: 300px; */

            border: 1px solid green;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 100px;
        }

        .catList li:hover {
            color: red;
            cursor: pointer;

        }

        .catList li {
            float: left;
            width: 300px;
            margin-right: 10px;
            text-transform: capitalize;
        }

        .categoryList {
            /* width: 300px; */
            /* height: 300px; */

            border: 1px solid green;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 100px;
        }

        .categoryList li:hover {
            color: red;
            cursor: pointer;

        }

        .categoryList li {
            float: left;
            width: 300px;
            margin-right: 10px;
            text-transform: capitalize;
        }



        .buildersList {
            border: 1px solid green;
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .buildersList li:hover {
            color: red;
            cursor: pointer;

        }

        .buildersList li {
            float: left;
            width: 300px;
            margin-right: 10px;
            text-transform: capitalize;
        }


        .dev2Div + hr{
            /* display: none; */
        }

        .dev2Div{
            border: 1px solid red;
            padding: 10px;
            margin: 10px;
            margin-bottom: 50px;
            display: none;
        }

        .miscButtonsDiv{
            
        }

        .cls {
            clear: both;
        }
    </style>
    -->


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

$scec_nonce = wp_create_nonce('scec_nonce');
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


<div class="vue-div container" id="vue-div">
    <!-- Message {{message}}! -->

    <div class='border border-primary rounded p-1 mb-1'>
    <!-- <div class="buildersList"> -->
        <h4>Local Builders</h4>
        <ul>
            <li v-for="(b, index) in buildersMasterList1">{{b.name}}</li>
        </ul>

        <br class='cls' />
    </div>

    <div class='border border-primary rounded p-1 mb-1'>
    <!-- <div class="catList"> -->
        <h4>Local Categories</h4>
        <ul>
            <li v-for="cat in categoriesMasterList1" v-if="cat.length > 0">{{cat}}</li>
        </ul>

        <br class='cls' />
    </div>



    <form v-on:submit.prevent="function(){ ; }">
        <div class="miscButtonsDiv border rounded-pill border-primary p-1 mb-2">
            Buttons of Power:

            <button type="button" class="btn btn-primary" v-on:click="onClickDisplayPartsNumbers">
                Enable and Display all( local\global ) Part numbers
            </button>
        </div>


        <div class="searchButtonsDiv border rounded-pill border-primary p-1 mb-1">
            Items from:
            <input type="radio" name="selectItems" value="scLocal" checked />Select Connect - Local
            <input type="radio" name="selectItems" value="scRemote" />Select Connect - Remote
            <input type="radio" name="selectItems" value="wc" />Woo Commerce
            <input type="radio" name="selectItems" value="wc" />E-Commerce
        </div>
        <br />

        <div class="ui1 test">
            <div class="scec_categories grid-1">
                <label for="catOptions1">Categories:</label>
                <select name="catOptions1" v-model="selectedCategory1" v-on:change="onCategoryChange1">
                    <option v-for="cat in categories1" v-bind:value="cat">
                        {{cat}}
                    </option>
                </select>

                <label for="buildOptions1">Builders:</label>
                <select name="buildOptions1" v-model="selectedBuilder1" v-on:change="onBuilderChange1">
                    <option v-for="b in builders1" v-bind:value="b.value">
                        {{b.name}}
                    </option>
                </select>
            </div>
            <br />

            <div class="ui1-divider"> &laquo; OR &raquo;
            </div>
            <br />


            <div class="scec_builders grid-1">
                <label for="buildOptions2">Builders:</label>
                <select v-model="selectedBuilder2" v-on:change="onBuilderChange2">
                    <option v-for="builder in builders2" v-bind:value="builder.value">
                        {{builder.name}}
                    </option>
                </select>

                <label for="catOptions2">Categories:</label>
                <select name="catOptions2" v-model="selectedCategory2" v-on:change="onCategoryChange2">
                    <option v-for="cat in categories2" v-bind:value="cat.value">
                        {{cat.name}}
                    </option>
                </select>
            </div>

        </div>
        <br />






        <div class="catList catList2" v-if='selectedCategory1 != "" && buildersLocalList1.length > 0' >
            <h4>Category Builders({{buildersLocalList1.length-1}})</h4>
            <ul>
                <li v-for="b in buildersLocalList1" v-if="b.name.length > 0">{{b.name}}</li>
            </ul>

            <br class='cls' />
        </div>
        <br />





        <div class="catList catList2" v-if='selectedBuilder2 != "" && categoriesLocalList2.length > 0'>
            <h4>Builder Categories({{categoriesLocalList2.length-1}})</h4>
            <ul>
                <li v-for="cat in categoriesLocalList2" v-if="cat.name.length > 0">{{cat.name}}</li>
            </ul>

            <br class='cls' />
        </div>
        <br />

















        <div>
            <label for="searchTxt">Search :</label>
            <input name="searchTxt" id="seatchTxt" type="text" value="Search for SKU">
        </div>

        <div>
            Items ({{items.length}}) for Category:: {{selectedCategory1 + selectedCategory2}}
        </div>
        <br />



        <div class="scec_items1 test" v-if="items.length">
            <ul>
                <li v-for="item in items" v-bind:key="item.id" v-bind:class="'id_'+item.id" class="item" v-bind:data-id="item.id">
                    <div v-bind:name="'item_'+item.id" v-bind:id="'item_'+item.id">
                        <div class="topRow">
                            <button v-on:click="onViewItemClickEC" style="width: 100px; float:right;">View EC Item</button>

                            <button v-on:click="onViewItemClickWC" style="width: 100px; float:right;">View WC Item</button>
                            
                            <br class="cls" />
                            <br class="cls" />

                            <input type="checkbox">

                            <button v-on:click="onAddItemClickEC" style="width: 100px; float:right;">Add EC Item</button>
                            <button v-on:click="onAddItemClickWC" style="width: 100px; float:right;">Add WC Item</button>
                            <button v-on:click="onAddItemClick" style="width: 100px; float:right;">Both</button>
                            <br class="cls" />
                            <br class="cls" />

                            <button v-on:click="onEditItemClickEC" style="width: 100px; float:right;">Edit EC Item</button>
                            <button v-on:click="onEditItemClickWC" style="width: 100px; float:right;">Edit WC Item</button>
                            <br class="cls" />
                            <br class="cls" />

                            <button v-on:click="onDeleteItemClickEC" style="width: 100px; float:right;">Delete EC Item</button>
                            <button v-on:click="onDeleteItemClickWC" style="width: 100px; float:right;">Delete WC Item</button>
                            <button v-on:click="onDeleteItemClick" style="width: 100px; float:right;">Both</button>
                            <br class="cls" />
                            <br class="cls" />
                        </div>
                        <br class="cls" />



                        <div class="middleRow">
                            <div class="images" style="float:left; ">
                                <img v-bind:src="item.image" class="image"></img>
                                <br />

                                <img v-bind:src="item.thumbnail" class="imageThumb"></img>
                            </div>

                            <div class="grid-1" style="">
                                <input type="hidden" name='itemObj' id='itemObj' class='itemObj' v-bind:value="JSON.stringify(item)">

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

