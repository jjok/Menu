<?php

namespace jjok\Menu2;

/**
 * 
 * @author Jonathan Jefferies
 * @version 0.1.0
 */
class MenuBuilder {
	
	/**
	 * 
	 * @param Menu $menu
	 * @return string
	 */	
	public function build(Menu $menu) {

		$output = '';
	
		if ($menu->count() > 0) {
			$output .= '<ul>';
			foreach ($menu as $item) {
				$output .= '<li>';
				$output .= sprintf(
					'<a%s%s>%s</a>',
					$item->getHref() === null? '': sprintf(' href="%s"', $item->getHref()),
					$item->getIsCurrent()? ' class="current"': '',
					$item->getText()
				);
				if($item->hasSubMenu()) {
					$output .= $this->build($item->getSubMenu());
				}
				$output .= '</li>';
			}
			$output .= '</ul>';
		}
	
		return $output;
	}
}
