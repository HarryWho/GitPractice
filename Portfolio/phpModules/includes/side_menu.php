<?php

foreach($my_menu->menu() as $item){
    echo "<li><a href=\"{$item->menuLink}\" class='{$my_menu->equals($item->menuDisplayName, $path->path()[1])}'><i class=\"{$item->menuImage}\"></i> {$item->menuDisplayName}</a></li>";
    $submenu = new Menu();
    $submenu->get('submenus','submenuParentId',$item->menuId);
    if($submenu->count()>0){
        echo "<div class='submenu {$my_menu->equals($item->menuDisplayName, $path->path()[1])}'><ul>";
        foreach($submenu->menu() as $sub){
            echo "<li><a href=\"{$sub->submenuLink}\" class='{$submenu->equals($sub->submenuDisplayName, $path->path()[2])}'>{$sub->submenuDisplayName}</a></li>";
        }
        echo "</ul></div>";
 
    }
    echo "</li>";
}
