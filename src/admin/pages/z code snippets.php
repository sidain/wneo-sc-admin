                
<div class="scec_items1 row row-cols-2 g-6 test mt-4 mb-4" v-if="items.length">

<!-- BEGIN ITEM CONTAINER -->
<div v-for="(item, index) in items" v-bind:key="item.id" v-bind:class="['id_'+item.id, {testing: true} ]" class="item card col " v-bind:data-id="item.id">

    <div v-bind:name="'item_'+item.id" v-bind:id="'item_'+item.id">
        <div class="topRow row">
            
            <div class="row">
                <!-- <div class="form-check col-1"> -->
                <div class="col-1">
                    <input class="form-check-input" type="checkbox">
                </div>

                <div class="col">
                    <!-- <h6>Title {{index}}</h6> -->
                    <h6>Title {{index}}</h6>
                </div>
            </div>

            <!--  
            <div class="row">
                <div class="col">
                    <button v-on:click="onViewItemClickEC" style="width: 100px; float:right;">View EC Item</button>
                    <button v-on:click="onViewItemClickWC" style="width: 100px; float:right;">View WC Item</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button v-on:click="onAddItemClick" style="width: 100px; float:right;">Both</button>
                    <button v-on:click="onAddItemClickEC" style="width: 100px; float:right;">Add EC Item</button>
                    <button v-on:click="onAddItemClickWC" style="width: 100px; float:right;">Add WC Item</button>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <button v-on:click="onEditItemClickEC" style="width: 100px; float:right;">Edit EC Item</button>
                    <button v-on:click="onEditItemClickWC" style="width: 100px; float:right;">Edit WC Item</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button v-on:click="onDeleteItemClick" style="width: 100px; float:right;">Both</button>
                    <button v-on:click="onDeleteItemClickEC" style="width: 100px; float:right;">Delete EC Item</button>
                    <button v-on:click="onDeleteItemClickWC" style="width: 100px; float:right;">Delete WC Item</button>
                </div>
            </div>
            -->
        </div>


        <div class="middleRow row">

            <input type="hidden" name='itemObj' id='itemObj' class='itemObj' v-bind:value="JSON.stringify(item)">

            <div class="form-group">
                <label>Name:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.name" readonly>
                <br />

                <label>ID:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.id" readonly >
                <br />

                <label>Manufacturer:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.manufacturer" readonly>
                <br />

                <label>Price:</label>
                <input class='form-control form-control-sm' type="text" placeholder="$Price?">
                <br />




                <label>Part Number:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.part_number" readonly>
                <br />

                <label>Category:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.category" readonly>
                <br />

                <label>Description:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.descripton" readonly>
                <br />

                <label>Image:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.image" readonly>
                <br />

                <label>Thumbnail:</label>
                <input class='form-control form-control-sm' type="text" readonly v-bind:value="item.thumbnail" readonly>
                <br />
            </div>

        </div>


        <div class="bottomRow row">
            <div class="itemRaw col">
                <pre><code>{{item}}</code></pre>
            </div>
        </div>

    </div>

</div>

<!--  
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
-->
</div>