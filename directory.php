<?php
/**
 * Plugin Name: Directory
 * Plugin URI: https://github.com/m-e-h/directory
 * Description: A base plugin for building directory Web sites.
 * Version: 1.0.0
 * Author: Marty Helmick
 * Author URI: http://martyhelmick.com
 * Text Domain: directory
 *
 *
 * @package    Directory
 * @version    1.0.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Sets up and initializes the Directory plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
final class DOC_Directory {

    /**
     * Holds the instances of this class.
     *
     * @since  1.0.0
     * @access private
     * @var    object
     */
    private static $instance;

    /**
     * Sets up needed actions/filters for the plugin to initialize.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __construct() {

        /* Set the constants needed by the plugin. */
        add_action('plugins_loaded', array( $this, 'constants' ), 1);

        /* Load the functions files. */
        add_action('plugins_loaded', array( $this, 'includes' ), 3);

        /* Load the admin files. */
        //add_action('plugins_loaded', array( $this, 'admin' ), 4);

        /* Enqueue scripts and styles. */
        //add_action('admin_init', array( $this, 'register_directory_styles' ));

        /* Register activation hook. */
        register_activation_hook(__FILE__, array( $this, 'activation' ));
    }

    /**
     * Defines constants for the plugin.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function constants() {

        /* Set the version number of the plugin. */
        define('DIRECTORY_VERSION', '1.0.0');

        /* Set the database version number of the plugin. */
        define('DIRECTORY_DB_VERSION', 1);

        /* Set constant path to the plugin directory. */
        define('DIRECTORY_DIR', trailingslashit(plugin_dir_path(__FILE__)));

        /* Set constant path to the plugin URI. */
        define('DIRECTORY_URI', trailingslashit(plugin_dir_url(__FILE__)));
    }

    /**
     * Loads files from the '/inc' folder.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function includes() {
        require_once(DIRECTORY_DIR . 'inc/vendor/posts-to-posts/posts-to-posts.php');
        require_once(DIRECTORY_DIR . 'inc/vendor/cmb2/init.php');
        require_once(DIRECTORY_DIR . 'inc/p2p-connections.php');
        require_once(DIRECTORY_DIR . 'inc/core.php');
		require_once(DIRECTORY_DIR . 'inc/extended-taxos.php');
		require_once(DIRECTORY_DIR . 'inc/extended-cpts.php');
        require_once(DIRECTORY_DIR . 'inc/post-types.php');
        require_once(DIRECTORY_DIR . 'inc/taxonomies.php');
        require_once(DIRECTORY_DIR . 'inc/meta.php');
    }

    // public function admin() {
	//
    //     if (is_admin()) {
    //         // require_once( DIRECTORY_DIR . 'admin/class-directory-admin.php'    );
    //         // require_once( DIRECTORY_DIR . 'admin/class-directory-settings.php' );
    //     }
    // }

    // public static function register_directory_styles() {
	//
    //     /* Enqueue the stylesheet. */
    //     wp_register_style(
    //         'doc-directory',
    //         trailingslashit(plugin_dir_url(__FILE__)) . "css/directory.css");
	//
    //         wp_enqueue_style('doc-directory');
    // }




    /**
     * On plugin activation, add custom capabilities to the 'administrator' role.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function activation() {

        $role = get_role('administrator');

        if (!empty($role)) {
            $role->add_cap('manage_directory');
            $role->add_cap('create_directory_items');
            $role->add_cap('edit_directory_items');
        }
    }

    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {

        if (!self::$instance)
            self::$instance = new self;

        return self::$instance;
    }
}

DOC_Directory::get_instance();
