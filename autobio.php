<?php 
/* 
Plugin Name: WPautobio
Version: 1.0
Description: Inserta automaticamente una caja de autor. Tambien se puede insertar mediante shortcode. 
Author: Marc C. G.
Author URI: http://www.laliamos.com 
Plugin URI: http://www.laliamos.com/WPautobio 
License: GNU GPL v3 or later      This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.  

*/  

add_option( 'autobio_loc', '10', '', 'yes' ); 
add_option( 'autobio_hidden', '10', '', 'yes' ); 
add_option( 'autobio_auttxt1', '50', '', 'yes' ); 
add_option( 'autobio_auttxt2', '50', '', 'yes' ); 
add_option( 'autobio_showauttxt', '10', '', 'yes' ); 
add_option( 'autobio_showautbio', '10', '', 'yes' ); 
add_option( 'autobio_showautintro', '50', '', 'yes' ); 
add_option( 'autobio_showautgra', '50', '', 'yes' ); 

$autobio_loc = get_option('autobio_loc');  

if ($autobio_loc=='' || $autobio_loc=='10')  {    

$autobio_loc='bottom';   
update_option('autobio_loc', $autobio_loc);   
update_option('autobio_auttxt1', 'has written');   
update_option('autobio_auttxt2', 'post in this blog');   
update_option('autobio_showautbio', 'y');   
update_option('autobio_showauttxt', 'y');   
update_option('autobio_showautintro', 'About');   
update_option('autobio_showautgra', 'y');   
update_option('autobio_hidden', 0);  }    


if ($autobio_loc=='top' || $autobio_loc=='bottom')  {  include('autobio_topbot.php');   }  
if ($autobio_loc=='manual')  {   include('autobio_manu.php');  }    


function autobio_admin() {     

if (!current_user_can('install_plugins')) {         

wp_die('Oops ! You need Admin power to access this page. Please call your Blog Admin for help. If you think it is a bug inform the plugin developer asap. sent mail: admin[at]laliamos.com or tweet him @laliamos');     

} 


include('autobio_admin.php');       

}

function autobio_notify() {                

$autobio_hid = get_option('autobio_hidden'); 				

if($autobio_hid != 1){ 				

echo '<div class="error fade" style="background-color:coral;"><p><strong>WPautobio necesita configurarse. Ves a la pagina de <a href="' . admin_url( 'options-general.php?page=autobiosettings' ) . '">WPautobio</a> para habilitar y configurar el plugin.</strong></p></div>'; 

 } 

}   


add_action( 'admin_notices', 'autobio_notify'); 

function autobio_admin_actions() { add_options_page("WPautobio", "WPautobio",  'install_plugins', "autobiosettings", "autobio_admin"); }   

add_action('admin_menu', 'autobio_admin_actions');
