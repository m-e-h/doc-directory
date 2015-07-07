<?php
/**
 * File for registering custom taxonomies.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      1.0.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/doc-directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Agencies
add_action('init', 'doc_agencies_register_taxonomies');




#Register the Agency taxonomy.
function doc_agencies_register_taxonomies() {
    register_extended_taxonomy( 'agency', 'department', array(),
    array(
        'tax_plural' => 'agencies'
    ) );
}
