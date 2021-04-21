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
    ?>

    
</body>
</html>