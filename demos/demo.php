<?php

require_once '../src/jjok/Menu/Menu.php';
require_once '../src/jjok/Menu/Builder.php';
require_once '../src/jjok/Menu/Item.php';
require_once '../src/jjok/Menu/Item/Finder.php';

use jjok\Menu\Item\Finder;
use jjok\Menu\Item;
use jjok\Menu\Menu;
use jjok\Menu\Builder;

$menu = new Menu(array(
	new Item('some text1', 'demo.php'),
	new Item('some text2', 'demo.php?a-url2'),
	new Item(
		'Not a link, but has a sub-menu',
		null,
		new Menu(array(
			new Item('some text4', 'demo.php?a-url4'),
			new Item('some text5', 'demo.php?a-url5'),
			new Item(
				'some text6',
				'demo.php?a-url6',
				new Menu(array(
					new Item('some text7', 'demo.php?a-url7'),
					new Item('some text8', 'demo.php?a-url8'),
					new Item('some text9', 'demo.php?a-url9')
				))
			)
		))
	),
	new Item('some text2', 'demo.php?a-url2')
));

# Get the current URL
$current_url = 'demo.php';
if(!empty($_SERVER['QUERY_STRING'])) {
	$current_url = sprintf('demo.php?%s', $_SERVER['QUERY_STRING']);
}

// $finder = new Finder(
// 	new RecursiveIteratorIterator(
// 		$menu,
// 		RecursiveIteratorIterator::SELF_FIRST
// 	)
// );
foreach(Finder::create($menu)->findByHref($current_url) as $item) {
	$item->setIsCurrent(true);
	$item->setHref(null);
}

$builder = new Builder();
$built_menu = $builder->build($menu);

?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="UTF-8" />
<title>Menu test</title>
<style>
	a.current { background:red; }
	
	#nav2 ul { margin:0; padding:0; list-style:none; }
	#nav2 ul li { position:relative; }
	#nav2 > ul > li { display:inline; }
	#nav2 > ul > li ul { position:absolute; left:0; top:2.3em; }
	#nav2 > ul > li ul ul { left:100%; top:0; }
	#nav2 li ul { display:none; /*transition-property:bottom; transition-duration:2s; bottom:-100%;*/ }
	#nav2 li:hover > ul { display:block; /*bottom:0;*/ }
	#nav2 a { display:inline-block; padding:1em; outline:1px solid black; }
</style>
</head>
<body>
<nav><?php echo $built_menu; ?></nav>
<nav id="nav2"><?php echo $built_menu; ?></nav>
</body>
</html>