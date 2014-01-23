<?php

namespace jjok\Menu;

/**
 * A menu item.
 * @author Jonathan Jefferies
 * @version 0.2.0
 */
class Item {
	
	/**
	 * The text of the menu item.
	 * @var string
	 */
	protected $text;
	
	/**
	 * 
	 * @var string
	 */
	protected $href;
	
	/**
	 * A sub menu.
	 * @var Menu
	 */
	protected $sub_menu;
	
	/**
	 * 
	 * @var boolean
	 */
	protected $is_current;
	
	/**
	 * 
	 * @param string $text
	 * @param string $href
	 * @param Menu $sub_menu
	 * @param string $is_current
	 */
	public function __construct($text, $href = null, Menu $sub_menu = null, $is_current = false) {
		$this->text = $text;
		$this->href = $href;
		$this->sub_menu = $sub_menu;
		$this->is_current = $is_current;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function getHref() {
		return $this->href;
	}
	
	public function setHref($href) {
		$this->href = $href;
	}
	
	public function getSubMenu() {
		return $this->sub_menu;
	}
	
	public function hasSubMenu() {
		return $this->sub_menu != null;
	}
	
	public function getIsCurrent() {
		return $this->is_current;
	}
	
	public function setIsCurrent($value) {
		$this->is_current = $value;
	}
}
