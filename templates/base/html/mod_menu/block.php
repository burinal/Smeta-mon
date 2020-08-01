<?php defined('_JEXEC') or die; ?>
<nav>
<ul>
    <?php
    foreach ($list as $i => &$item) {
        $flink = $item->flink;
        $item->link = JFilterOutput::ampReplace(htmlspecialchars($flink));

        $class = '';

        if ($item->id == $active_id) {
            $class = 'active';
        }
        $class = ' class="'.trim($class).'"';


        if($item->deeper){
            echo '
			<li'.$class.'>
				<a class="dropdown-toggle" data-toggle="dropdown" href="'.$item->link.'" title="'.$item->title.'">'.$item->title.'<b class="caret"></b></a>
				<ul class="dropdown-menu">
		';
        }

        if(!$item->deeper && !$item->parent && $item->parent_id == 1){
            echo '<li'.$class.'><a href="'.$item->link.'" title="'.$item->title.'"><span>'.$item->title.'</span><span>'.$item->note.'</span></a></li>';
        }

        if($item->parent_id > 1){
            echo '
			<li'.$class.'><a href="'.$item->link.'" title="'.$item->title.'"><span>'.$item->title.'</span><span>'.$item->note.'</span></a></li>
		';
        }
        if($item->level_diff == 1){
            echo '</ul></li>';
        }
    }
    ?>
</ul>
</nav>
