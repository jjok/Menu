<?php

namespace jjok\Menu;

/**
 * 
 * @author Jonathan Jefferies
 * @version 0.2.0
 */
class Menu extends \ArrayIterator implements \RecursiveIterator {

	/**
	 * (non-PHPdoc)
	 * @see RecursiveIterator::hasChildren()
	 */
	public function hasChildren() {
		return $this->current()->hasSubMenu();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see RecursiveIterator::getChildren()
	 */
	public function getChildren() {
		return $this->current()->getSubMenu();
	}
}
