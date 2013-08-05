<?php

require_once '../src/jjok/Menu/Menu.php';
require_once '../src/jjok/Menu/MenuBuilder.php';
require_once '../src/jjok/Menu/Item.php';

use jjok\Menu\Item;
use jjok\Menu\Menu;
use jjok\Menu\MenuBuilder;

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
$current_url = '#^demo.php$#';
if(!empty($_SERVER['QUERY_STRING'])) {
	$current_url = sprintf('#^demo.php\?%s$#', $_SERVER['QUERY_STRING']);
}

foreach (new RecursiveIteratorIterator($menu, RecursiveIteratorIterator::SELF_FIRST) as $item) {
	if(preg_match($current_url, $item->getHref()) === 1) {
		$item->setIsCurrent(true);
		$item->setHref(null);
	}
}

$builder = new MenuBuilder();
$built_menu = $builder->build($menu);

?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="UTF-8" />
<title>Menu test</title>
<style>
	a.current { background:red; }
</style>
</head>
<body>
<nav><?php echo $built_menu; ?></nav>
</body>
</html>