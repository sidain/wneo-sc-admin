<?php

namespace WebsiteNEO\SelectConnect\SCADMIN\Settings;

/**
 * Admin_settings class
 */
class Admin_Settings
{
    /**
     * Setup admin menu, adnmin scripts
     */
    public static function setup(){
        // add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\func_load_vuescripts');
        // add_action('admin_enqueue_scripts', array($this, 'func_load_vuescripts') );
        // add_action('admin_menu', get_class() . '\scec_options_page1');
        // add_action('wp_enqueue_scripts', 'func_load_vuescripts');
        // add_action( 'admin_enqueue_scripts', 'scec_my_enqueue' );
        // add_action( 'admin_enqueue_scripts', 'my_enqueue' );

        // add_action('wp_ajax_scec_getMultitudes', array($this, 'scec_ajax_getMultitudes'));
        // add_action('wp_ajax_scec_doItems', array($this, 'scec_ajax_doItems'));

        
        add_action('admin_menu', array(__CLASS__, 'scadmin_page1'));
  
        add_action('admin_init', '\WebsiteNEO\SelectConnect\SCADMIN\Ajax_scadmin::init');   
        
        add_action('admin_enqueue_scripts', array( __CLASS__,'func_load_scadmin_scripts'));
    }


    /**
     * Register new scec testing page
     *
     * @return void
     * @author Robert Chula
     *
     */
    // public function scec_page1(Type $var = null)
    public static function scadmin_page1()
    {
        /*
        add_menu_page( 
            string $page_title, 
            string $menu_title, 
            string $capability, 
            string $menu_slug, 
            callable $function = '', 
            string $icon_url = '', 
            int $position = null 
        )
        */
        
        add_menu_page(
            'SCADMIN Options',
            'SCADMIN',
            'manage_options',
            'scadmin_plugin',
            array(__CLASS__, 'page1_init')
        );
        

        /*
        add_submenu_page( 
            $parent_slug:string, 
            $page_title:string, 
            $menu_title:string, 
            $capability:string, 
            $menu_slug:string, 
            $function:callable, 
            $position:integer|null 
        )
        */

        
        /*
        add_submenu_page(
            'websiteneo-furniture-plugin-options',
            'SCADMIN Options',
            'SCADMIN Options',
            'manage_options',
            'SCADMIN',
            array(__CLASS__, 'page1_init')            
        );
        */
        
        
        /*
        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE1',
            'M1 MAIN INFO',
            'manage_options',
            'SCADMIN_page1',
            array(__CLASS__, 'page1_init')            
        );
        */
        
        
        /*
        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE2',
            'M2',
            'manage_options',
            'SCADMIN_page2',
            array(__CLASS__, 'page2_init')            
        );
        */
        

        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE3',
            'M8',
            'manage_options',
            'SCADMIN_page3',
            array(__CLASS__, 'page8_init')            
        );
              
        

        /*
        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE5',
            'M5',
            'manage_options',
            'SCADMIN_page5',
            array(__CLASS__, 'page5_init')            
        );
        */
        
        
        /*
        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE6',
            'M6',
            'manage_options',
            'SCADMIN_page6',
            array(__CLASS__, 'page6_init')            
        );
        */
        
        
        /*
        add_submenu_page(
            'scadmin_plugin',
            'SCADMIN PAGE7',
            'M7',
            'manage_options',
            'SCADMIN_page7',
            array(__CLASS__, 'page7_init')            
        );
        */
        

        add_submenu_page(
            'scadmin_plugin',
            'Various Logs',
            'Logs',
            'manage_options',
            'SCADMIN_page_logs',
            array(__CLASS__, 'page_logs_init')            
        );



    }

    public static function page1_init()
    {
        include __DIR__ . '/pages/settingsPage1.php';        
    }

    public static function page2_init()
    {
        include __DIR__ . '/pages/settingsPage2.php';        
    }

    public static function page3_init()
    {
        include __DIR__ . '/pages/settingsPage3.php';        
    }

    public static function page5_init()
    {
        include __DIR__ . '/pages/settingsPage5.php';        
    }

    public static function page6_init()
    {
        include __DIR__ . '/pages/settingsPage6.php';        
    }

    public static function page7_init()
    {
        include __DIR__ . '/pages/settingsPage7.php';        
    }

    public static function page8_init()
    {
        include __DIR__ . '/pages/settingsPage8.php';        
    }

    public static function page_logs_init()
    {
        include __DIR__ . '/pages/settingsPageLogs.php';        
    }

    public static function page_init()
    {

        //Add Vue.js
        // wp_enqueue_script('wpvue_vuejs');

        //wp_enqueue_script( 'scec_script1', plugins_url( '/js/myjquery.js', __FILE__ ), array('jquery'); )

        //need db table wp_ wneo_ products

        /*
        echo "<h1>SC CATEGORIES</h1>";
        $scCategorys = $wpdb->get_results(
        "
        select distinct  category
        from {$wpdb->prefix}wneof_products
        limit 1
        "
        );
        d($scCategorys);
         */

        /*
        echo "<h1>SC Builders</h1>";
        $scBuilders = $wpdb->get_results(
        "
        select distinct  manufacturer
        from {$wpdb->prefix}wneof_products
        order by manufacturer asc
        limit 1
        "
        );
        d($scBuilders);
         */

        include __DIR__ . '/pages/settingsPage.php';
    }

public static function func_load_scadmin_scripts($hook)
{
    // write_log($hook);

    if ($hook == 'selectconnect_page_SCADMIN' || $hook == 'toplevel_page_scadmin_plugin' ) {
        /*
        BOOTSTRAP CSS & JS
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        */

        /*
        wp_register_style( 'bootstrap.min', 'http://domain.cz/wp-content/themes/theme-name/css/bootstrap.min.css' );
        wp_enqueue_style('bootstrap.min');
        */

        /*
        wp_register_script
        wp_register_style
        */

        // wp_register_style( 'bootstrap_css', 'href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', '', '', 'all');
        
        /*
        wp_register_script( 'bootstrap_css', 'href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', '', '', 'all');
        wp_enqueue_style('bootstrap_css');
        
        wp_register_script( 'bootstrap_popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', 'jquery', '', false );
        wp_enqueue_script('bootstrap_popper');
        
        wp_register_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', 'jquery', '', false );
        wp_enqueue_script('bootstrap_js');


        wp_register_script('wpvue_vuejs', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js', '', '', false);
        wp_enqueue_script('wpvue_vuejs');
        */
    }
}


    /**
     * class construct  function
     */
    public function __construct()
    {
        
    }
}
