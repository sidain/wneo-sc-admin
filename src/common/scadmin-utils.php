<?php
if (!function_exists('write_log')) {
    function write_log($log)
    {
        $args = func_get_args();
        $output="";

        foreach( $args as $arg){           
            
            if (is_array($arg) || is_object($arg)) {
                $output.=print_r($arg, true).",\n";
            } else {
                $output.=$arg.",\n";
            }
            

            /*
            if (is_array($arg) || is_object($arg)) {
                error_log(print_r($arg, true));
            } else {
                error_log($arg);
            }
            */

            /*
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
            */
        }

        error_log($output);
    }
}

if (!function_exists('var_dump_r')) {
    # code...
    function var_dump_r($mixed = null)
    {
        ob_start();
        var_dump($mixed);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>