<!-- phpcs:disable -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- VUE FRAME WORK -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


    <!-- BOOTSTRAP FRAME WORK -->
    <!-- https://v5.getbootstrap.com/ -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
    <?php
        global $wpdb;

        /**
        $scCatagories = $wpdb->get_results(
            "
            select distinct  category
            from {$wpdb->prefix}wneof_products
            where manufacturer like '%{$param1}%'
            "
        );


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

        echo "<pre>";
        // var_dump($scCategoriesList);
        foreach ($scCategoriesList as $key => $c) {
            echo $key."\t".$c."\n";
        }
        echo "</pre>";
        */

        // $plugin_dir = ABSPATH . 'wp-content/plugins/plugin-folder/';
        $plugin_dir = WP_PLUGIN_DIR;
        
        // echo $plugin_dir."<br />";
        


        /*
        $f1_file1 = WP_PLUGIN_DIR."/../debug.log";
        // echo $log_file1."<br />";
        $f1_log1 = fopen($f1_file1, 'r') or die('Cannot open file:'.$f1_file1);
        $f1_data1 = fread($f1_log1, filesize($f1_file1) );
        echo $f1_data1;
        fclose($f1_file1);
        */
        
        /*
        $f1_file1 = WP_PLUGIN_DIR."/../debug.log";
        $f1_data1 = readfile($f1_file1);
        echo $f1_data1;
        */
    ?>


        <div class="container mt-5">
            <h6> 
                <?php $f1_file1 = WP_PLUGIN_DIR."/../debug.log"; echo $f1_file1; ?>

                <div class="float-right">
                    <span class="f1-count badge badge-pill badge-secondary bg-danger">0</span>
                    <button>Reload</button>
                    <button>Clear</button>
                </div>
            </h6>
            
            <div class="overflow-auto border p-1" style="height: 512px;">
                <ul class="list-group list-group-flush">
                    <?php
                        
                        /*
                        $f1_file1 = WP_PLUGIN_DIR."/../debug.log";
                        $f1_log1 = fopen($f1_file1, 'r') or die('Cannot open file:'.$f1_file1);

                        
                        while ( !feof($f1_log1) ) {
                            echo "<li class='list-group-item'>";
                            echo fgets($f1_log1)."";
                            echo "</li>";
                        }
                        
                        fclose($f1_log1);
                        */

                        /*
                        $fl = fopen("\some_file.txt", "r");
                        for($x_pos = 0, $output = ''; fseek($fl, $x_pos, SEEK_END) !== -1; $x_pos--) {
                            $output .= fgetc($fl);
                            }
                        fclose($fl);
                        print_r($output);
                        */

                        /*
                        $fl = fopen("\some_file.txt", "r");
                        for($x_pos = 0, $ln = 0, $output = array(); fseek($fl, $x_pos, SEEK_END) !== -1; $x_pos--) {
                            $char = fgetc($fl);
                            if ($char === "\n") {
                                // analyse completed line $output[$ln] if need be
                                $ln++;
                                continue;
                                }
                            $output[$ln] = $char . ((array_key_exists($ln, $output)) ? $output[$ln] : '');
                            }
                        fclose($fl);
                        print_r($output);
                        */

                        $f1_file1 = WP_PLUGIN_DIR."/../debug.log";
                        $f1_log1 = file($f1_file1);
                        $f1_data1 = array_reverse($f1_log1);
                        $f1_count =  0;
                        
                        foreach($f1_data1 as $ln){
                            $f1_count++;
                            
                            $ln = str_ireplace('PHP Deprecated:','<span class="font-weight-bold text-danger">PHP Deprecated:</span>',$ln);
                            $ln = str_ireplace('PHP Warning:','<span class="font-weight-bold text-warning">PHP Warning:</span>',$ln);
                            $ln = str_ireplace('PHP Notice:','<span class="font-weight-bold text-info">PHP Notice:</span>',$ln);

                            echo "<li class='list-group-item'>$ln</li>";
                        }
                    ?>

                </ul>
                <script>
                    jQuery('.f1-count').text(<?=$f1_count;?>);                
                </script>
            </div>
        </div>

    
</body>
</html>