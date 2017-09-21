<?php
/**
 * Created by PhpStorm.
 * User: leonardvujanic
 * Date: 21/09/2017
 * Time: 13:02
 */

require_once __DIR__ . '/core/ini.php';




echo '<ul>';
foreach (glob(__DIR__ . '/page-templates/*.php') as $filename) {
    
    $chunks = explode('page-templates/', $filename);
    
    if (count($chunks) === 2) {
        echo '<li><a href="page-templates/' . $chunks[1] . '">'. strtoupper(str_replace('.php', '', $chunks[1])).'</a></li>';
    }
    
}
echo '</ul>';
