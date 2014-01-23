<?php

namespace jjok\Menu\Item;

use Closure;
use jjok\Menu\Menu;
use RecursiveIteratorIterator;

/**
 * Finds items in a menu.
 * @author Jonathan Jefferies
 */
class Finder {

	/**
	 * 
	 * @var RecursiveIteratorIterator
	 */
	protected $iterator;
	
	/**
	 * 
	 * @param RecursiveIteratorIterator $iterator
	 */
	public function __construct(RecursiveIteratorIterator $iterator) {
		$this->iterator = $iterator;
	}
	
	public static function create(Menu $menu) {
		return new static(
			new RecursiveIteratorIterator(
				$menu,
				RecursiveIteratorIterator::SELF_FIRST
			)
		);
	}
	
	/**
	 * Find a menu item by the exact URL.
	 * @param string $href
	 * @return jjok\Menu\Item[]
	 */
	public function findByHref($href) {
		return $this->find(function($item, $href) {
			return $href == $item->getHref();
		}, $href);
	}
	
	/**
	 * 
	 * @param string $href
	 * @return jjok\Menu\Item[]
	 */
	public function matchByHref($href) {
		return $this->find(function($item, $href) {
			return preg_match($href, $item->getHref()) === 1;
		}, $href);
	}
	
	/**
	 * 
	 * @param Closure $callback
	 * @param string $needle
	 * @return jjok\Menu\Item[]
	 */
	public function find(Closure $callback, $needle) {

		//TODO Redo this with `array_map()?`
		$results = array();
		
		foreach($this->iterator as $item) {
			if($callback($item, $needle)) {
				$results[] = $item;
			}
		}
		
		return $results;
	}
}
