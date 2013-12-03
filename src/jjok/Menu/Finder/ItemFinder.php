<?php

namespace jjok\Menu\Finder;

use Closure;
use RecursiveIteratorIterator;

/**
 * Finds items in a menu.
 * @author Jonathan Jefferies
 */
class ItemFinder {

	protected $iterator;
	
	/**
	 * 
	 * @param RecursiveIteratorIterator $iterator
	 */
	public function __construct(RecursiveIteratorIterator $iterator) {
		$this->iterator = $iterator;
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
