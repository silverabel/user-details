<?php
/*
Plugin Name: User Details
License:     GPL3
 
User Details is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
User Details is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with User Details. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class User_Details_Plugin {
  
  public static function add_rewrite() {
    add_rewrite_endpoint('user-details', EP_ROOT);
    flush_rewrite_rules();
  }

  public static function remove_rewrite() {
    flush_rewrite_rules();
  }

  public static function user_details_parse( $request ) {
    if( array_key_exists( 'user-details', $request->query_vars ) ) {
      $request = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );

      if( is_wp_error( $request ) ) {
        echo 'Could not retrieve data';
        die();
      }

      $body = wp_remote_retrieve_body( $request );
      $data = json_decode( $body );

      if ( ! empty( $data ) ) {
        echo '<script src="' . plugins_url() . '/silverabel-user-details/js/main.js' . '" defer></script>';

        echo "<table> \n";
        echo "<tr> \n";
        echo "<th>ID</th> \n";
        echo "<th>Name</th> \n";
        echo "<th>Username</th> \n";
        echo "</tr> \n";
          
        foreach( $data as $user ) {
          $userid = $user->id;
          echo "<tr> \n";
          echo '<td><a href="" data-id="' . $userid . '">' . $userid . "</a></td> \n";
          echo '<td><a href="" data-id="' . $userid . '">' . $user->name . "</a></td> \n";
          echo '<td><a href="" data-id="' . $userid . '">' . $user->username . "</a></td> \n";
          echo "</tr> \n";
        }
          
        echo "</table> \n";
      }

      die();
    }
  }

  public static function addHooks() {
    add_action( 'init', 'User_Details_Plugin::add_rewrite' );
    add_action( 'parse_request', 'User_Details_Plugin::user_details_parse' );

    register_deactivation_hook( __FILE__, 'User_Details_Plugin::remove_rewrite' );
  }
}

User_Details_Plugin::addHooks();