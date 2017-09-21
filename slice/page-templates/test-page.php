<?php
/**
 * Created by PhpStorm.
 * User: leonardvujanic
 * Date: 21/09/2017
 * Time: 12:58
 */

require_once __DIR__ . '/../core/ini.php';

get_header();


get_partial('test/some-partial', [
    'title' => 'Ja sam prosljeđeni title',
]);


?>
    <div style="width: 500px; height: 500px; background-color: blue; padding: 30px; box-sizing: border-box;">
        <?php
        
        $content = get_partial('test/some-partial', [
            'title' => 'Ja sam prosljeđeni title u get partial sa returnom',
        ], true);
        
        echo $content;
        
        ?>
    </div>
    <div>
        <h2>Ja sam image pozvan sa bu()</h2>
        <img src="<?= bu('images/acer.jpg'); ?>" alt="Image">
    </div>
<?php


get_partial('layout/styled-div');


get_footer();