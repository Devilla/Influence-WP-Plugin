<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://useinfluence.co
 * @since             1.0.0
 * @package           Useinfluence
 *
 * @wordpress-plugin
 * Plugin Name:       Useinfluence
 * Plugin URI:        https://github.com/InfluenceIO/wordpress-plugin
 * Description:       Influence WordPress Plugin for TrackingId Input.
 * Version:           1.0.0
 * Author:            Target Solutions
 * Author URI:        https://useinfluence.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       useinfluence
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-useinfluence-activator.php
 */
function activate_useinfluence() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-useinfluence-activator.php';
	Useinfluence_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-useinfluence-deactivator.php
 */
function deactivate_useinfluence() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-useinfluence-deactivator.php';
	Useinfluence_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_useinfluence' );
register_deactivation_hook( __FILE__, 'deactivate_useinfluence' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-useinfluence.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_useinfluence() {

	$plugin = new Useinfluence();
	$plugin->run();

}
add_action('admin_menu', 'basicPluginMenu');

function basicPluginMenu(){
  $appName = 'UseInfluence';
  $appID = 'influence-plugin';
  add_menu_page($appName, $appName, 'administrator', $appID . '-top-level', 'pluginAdminScreen');
}

function pluginAdminScreen() {
	echo "<a href='https://useinfluence.co'>";
	echo "<img class='top-logo' src='https://useinfluence.co/static/media/logo-influence-2.a5936714.png' width='180px' height='50px' style='margin-top:20px;' >";
	echo "</a>";
	echo "<br />";
  echo "<h2 href='https://useinfluence.co' class='describe' style='font-family:sans-serif;padding: 10px;border-left:  5px solid  #999;background: #99999930;'>If you don't have an account - signup here!</h2>";
	echo "<a>";
	echo "<strong>Please enter your Tracking ID</strong>";
	echo "</a>";
	echo "<form action='' method='POST'>";
  echo "<input type='text' class='api' style='padding: 5px 10px; border-radius:5px;' placeholder='e.g. INF-xxxxxxxx'></input>";
	echo "<br /> <hr />";
	echo "<input type='submit' class='submit' style='padding: 5px 10px ;cursor:pointer; color:#fff; border-radius:5px;background-color:#097fff' value='Save'></input>";
	echo "<form>";

	$table = "wp_table";
	$data = $wpdb->get_results("SELECT * FROM $table WHERE 1=1", ARRAY_A);
	echo "data : "+$data;
	echo "table : "+$table;
}


run_useinfluence();
