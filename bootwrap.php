<?php
/**
 * BootWrap - PHP wrapper for Bootstrap 4
 * 
 * Reduces code and mistakes in HTML markup.
 * Simply pass your content, and bootstrap class to the function.
 * 
 * @category BootWrap
 * @package BootWrap
 * @see https://github.com/ppoisson/bootwrap
 * @author Paul Poisson <paul.poisson@gmail.com>
 * @copyright Copyright (c) 2017 - 2018 Paul Poisson
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 */

/**
 * 
 */
class BootWrap {

	/**
	 * Create a container
	 * @param string $content 
	 * @param string $class 
	 * @param string $tag 
	 * @return string, HTML Markup
	 */
	function container($content, $class='', $tag='div') {
		return $this::tag([
			'tag' => $tag,
			'content' => $content,
			'class' => isset($class) ? 'container ' . $class : 'container',
			'role' => $tag != 'div' ? $tag : ''
		]);
	}

	/**
	 * Create a row
	 * @param string $content 
	 * @param string $class 
	 * @return string
	 */
	function row($content, $class='') {
		return $this::tag([
			'tag' => 'div',
			'content' => $content,
			'class' => isset($class) ? 'row ' . $class : 'row'
		]);

	}

	/**
	 * Create a column
	 * @param string $content 
	 * @param string $class 
	 * @return string
	 */
	function col($content, $class='') {
		return $this::tag([
			'tag' => 'div',
			'content' => $content,
			'class' => $class
		]);
	}

	/**
	 * Create media
	 * @param array $media 
	 * @return string
	 */
	function media($media) {
		/*
		* media model
		* @example
		$media = [
			"tag" => "div",
			"image" => [
				"src" => "", // required
				"class" => "mr-3",
				"alt" => ""
			],
			"class" => "",
			"heading" => "",
			"content" => "" // required
		];
		*/
		$tag = isset($media['tag']) ? $media['tag'] : 'div';
		$class = isset($media['class']) ? ' ' . $media['class'] : '';
		$heading = isset($media['heading']) ? '<h5 class="mt-0">' . $media['heading'] . '</h5>' : '';
		$media_image = $media['image'];
		$img = $this::tag(
			[
			  'tag' => 'img',
			  'src' => $media_image['src'],
			  'class' => isset($media_image['class']) ? $media_image['class'] : 'mr-3',
			  'alt' => $media_image['alt']
			]
		);
		$media_body = $img . $this::tag([
			'tag' => $tag,
			'content' => $heading . $media['content'],
			'class' => 'media-body'
		]);

		return $this::tag([
			'tag' => $tag,
			'content' => $media_body,
			'class' => 'media' . $class
		]);
	}

	/**
	 * Create a media list
	 * @param array $media_list_arr
	 * @return string
	 */
	function media_list($media_list_arr) {
		foreach($media_list_arr as $media_arr) {
			$li .= $this::media($media_arr);
		}
		return $this::tag([
			'tag' => 'ul',
			'content' => $this::tag([
				'tag' => 'li',
				'content' => $li,
				'class' => 'list-unstyled'
			]),
			'class' => 'list-unstyled'
		]);
	}

	/**
	 * Create navs
	 * @param type $items 
	 * @param type|string $class 
	 * @return type
	 */
	function navs($items, $class='') {
		foreach($items as $item) {

			/*
			* item model
			* $item = [
				"href" => "",
				"class" => "",
				"content" => "",
				"target" => ""
			];
			*/
			
			$content = $item['content'];
			$tag = isset($item['href']) ? 'a' : 'span';
			$nav_item = $this::tag([
					'tag' => $tag,
					'content' => $content,
					'href' => $item['href'],
					'class' => isset($item['class']) ? 'nav-link ' . $item['class'] : '',
					'target' => $item['target']
				]);
			
			$li .= $this::tag([
				'tag' => 'li',
				'content' => $nav_item,
				'class' => 'nav-item'
			]);
		}
		return $this::tag([
			'tag' => 'ul',
			'content' => $li,
			'class' => 'nav ' . $class
		]);
	}

	/**
	 * Create a button
	 * @param type $button 
	 * @return type
	 */
	function button($button) {

		/*
		* button model
		* $button = [
			"tag" => "a",
			"href" => "",
			"class" => "btn",
			"content" => "",
			"target" => "",
			"type" => "",
			"isInput" => false
		];
		*/

		$tag = isset($button['tag']) ? $button['tag'] : "a";
		$content = $button['content'];
		$class = isset($button['class']) ? 'btn ' . $button['class'] : "btn";

		if(isset($button['href'])) {
			$attr['href'] = $button['href'];
			$attr['target'] = $button['target'];
			$attr['role'] = 'button';
		}
		$attr['type'] = $button['type'];

		if($button['isInput']) {
			$tag = 'input';
			$attr['type'] = 'submit';
			$attr['value'] = $content;
		}
		return $this::tag([
			'tag' => $tag,
			'content' => $content,
			'class' => $class,
			'href' => $attr['href'],
			'target' => $attr['target'],
			'role' => $attr['role'],
			'type' => $attr['type'],
			'value' => $attr['value'],
		]);
	}

	/**
	 * Create a card
	 * @param type $card 
	 * @return type
	 */
	function card($card) {

		/*
		* card array model (in progress, more todo)
		*
		$card = [
			"header" => "",
			"footer" => "",
			"image" => [
				"class" => "card-img-top|card-img-bottom",
				"src" => "",
				"alt" => ""
			],
			"title" => "",
			"subtitle" => "",
			"text" => "",
			"class" => "",
			"buttons" => [
				[
					"content" => "",
					"class" => "",
					"href" => "",
					"type" => "",
					"isInput" => bool
				]
			],
			"body" => ""
		];
		*/

		// card header
		if(isset($card['header'])) {
			$card_header = $this::tag([
				'tag' => 'div',
				'content' => isset($card['header']) ? $card['header'] : '',
				'class' => 'card-header'
			]);
		}
		// card footer
		if(isset($card['footer'])) {
			$card_footer = $this::tag([
				'tag' => 'div',
				'content' => isset($card['footer']) ? $card['footer'] : '',
				'class' => 'card-footer'
			]);
		}
		// card image,  overwrite if header or footer is set
		if(!empty($card['image'])) {
			$card_image = $this::tag([
				'tag' => 'img',
				'src' => $card['image']['src'],
				'class' => $card['image']['class'],
				'alt' => $card['image']['alt']
			]);
			if(strpos($card['image']['class'], 'top') !== false) {
				$card_header = $card_image;
			} else {
				$card_footer = $card_image;
			}
		}
		
		$card_class = isset($card['class']) ? ' ' . $card['class'] : '';

		// card body
		$card_body .= isset($card['title']) ? '<h5 class="card-title">' . $card['title'] . '</h5>' : '';
		$card_body .= isset($card['subtitle']) ? '<h6 class="card-subtitle">' . $card['subtitle'] . '</h6>' : '';
		$card_body .= isset($card['text']) ? '<p class="card-text">' . $card['text'] . '</p>' : '';
		$card_body .= isset($card['body']) ? $card['body'] : '';

		if(!empty($card['buttons'])) {
			$card_body .= '<br>';
			foreach($card['buttons'] as $button) {
				$card_body .= $this::button([
					"content" => $button['content'],
					"class" => $button['class'],
					"href" => $button['href'],
					"type" => $button['type'],
					"isInput" => $button['isInput']
				]);
			}
		}

		$content = $card_header;
		$content .= $this::tag([
			'tag' => 'div',
			'content' => $card_body,
			'class' => 'card-body'
		]);
		$content .= $card_footer;

		return $this::tag([
			'tag' => 'div',
			'content' => $content,
			'class' => $card_class
		]);
	}

	/**
	 * Create a card layout
	 * @param type $content 
	 * @param type|string $layout 
	 * @return type
	 */
	function card_layout($content, $layout='card-deck') {
		return $this::tag([
			'tag' => 'div',
			'content' => $content,
			'class' => $layout
		]);
	}


	/* Base Method ---------------------------------------------------- */


	/**
	 * Generic method to create an HTML tag
	 * @param array $element, use a multi-dimentional array
	 * @return string, HTML markup
	 */
	function tag($attrs) {
		/**
		 * @example
		 * $attrs = [
		 *   'tag' => '', // required
		 *   'content' => '', // if present it will add an end tag
		 *   'class' => '',
		 *	 'src' => '',
		 *	 'alt' => ''
		 * ];
		 */
		if($attrs) {
			$element = $attrs['tag'];
			$end = isset($attrs['content']) ? $attrs['content'] . "</" . $element . ">" : "";
			foreach($attrs as $attr => $value) {
				if($attr === 'tag' || $attr === 'content') {
					continue;
				}
				if(isset($value)) {
					$attributes[] = $attr . "='" . $value . "'";
				}
			}
			$attrs = implode(" ", $attributes);
		}
		return "<" . $element . " " . $attrs . ">" . $end;
	}

}
?>