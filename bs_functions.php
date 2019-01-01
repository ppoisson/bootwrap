<?php

function bs_container($content, $class='', $tag='div') {
	$attr = "";
	if($tag !== 'div') {
		$attr .= " role='$tag'";
	}
	if(isset($class)){
		$class = " " . $class;
	}
	return base_el($tag, $content, "container" . $class, $attr);
}

function bs_row($content, $class='') {
	if(isset($class)){
		$class = " " . $class;
	}
	return base_el("div", $content, "row" . $class);
}

function bs_col($content, $class='') {
	if(isset($class)){
		$class = " " . $class;
	}
	return base_el("div", $content, $class);
}

function bs_media($media) {
	/*
	* media model
	* $media = [
		"tag" => "div",
		"image" => [
			"src" => "",
			"class" => "mr-3",
			"alt" => ""
		],
		"class" => "",
		"heading" => "",
		"content" => ""
	];
	*/
	$tag = "div";
	$media['image']['class'] = "mr-3";

	if(isset($media['tag'])){
		$tag = $media['tag'];
	}
	if(isset($media['class'])){
		$class = $media['class'];
	}
	if(isset($media['heading'])){
		$heading = "<h5 class='mt-0'>" . $media['heading'] . "</h5>";
	}
	if(isset($media['image']['class'])){
		$image_class = $media['image']['class'];
	}
	if(isset($media['image']['alt'])){
		$image_alt = $media['image']['alt'];
	}

	$img = base_img($src, $image_class, $image_alt);
	$media_content = $media['content'];
	$media_body = base_el("div", $heading . $media_content, "media-body");

	return base_el($tag, $img . $media_body, "media" . $class);
}

function bs_media_list($media_list_arr, $image_class='mr-3') {
	foreach($media_list_arr as $media_arr) {
		$li .= bs_media($media_arr, $tag='li');
	}
	return base_el("ul", base_el("li", $li, "list-unstyled"), "list-unstyled");
}

function bs_navs($items, $class='') {
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

		if(isset($item['class'])){
			$class = $item['class'];
		}
		if(isset($item['target'])){
			$target = " target='" . $item['target'] . "'";
		}
		if(isset($item['href'])) {
			$href = $item['href'];
			$atag = base_a($content, $href, "nav-link " . $class, $target);
		} else {
			$atag = base_el("span", $content, "nav-link " . $class);
		}
		
		$li .= base_el("li", $atag, "nav-item");
	}
	return base_el("ul", $li, "nav " . $class);
}

function bs_button($button) {

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

	$tag = "a";
	$class = "btn";
	$content = $button['content'];

	if(isset($button['tag'])) {
		$tag = $button['tag'];
	}
	if(isset($button['href'])) {
		$attr .= " href='" . $button['href'] . "'";
		$attr .= " role='button'";
	}
	if(isset($button['class'])) {
		$attr .= " class='" . $class . " " . $button['class'] . "'";
	} else {
		$attr .= " class='" . $class . "'";
	}
	if(isset($button['target'])) {
		$attr .= " target='" . $button['target'] . "'";
	}
	if(isset($button['type'])) {
		$attr .= " type='" . $button['type'] . "'";
	}

	if($button['isInput']) {
		$attr .= " type='submit'";
		$attr .= " value='" . $content . "'";
		return "<input $attr>";
	} else {
		return base_el($tag, $content, $class, $attr);
	}
}

function bs_card($card) {

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
		$card_header = $card['header'];
		$card_header = base_el("div", $card_header, "card-header");
	}
	// card footer
	if(isset($card['footer'])) {
		$card_footer = $card['footer'];
		$card_footer = base_el("div", $card_footer, "card-footer");
	}
	// card image,  overwrite if header or footer is set
	if(!empty($card['image'])) {
		$card_image = base_img($card['image']['src'], $card['image']['class'], $card['image']['alt']);
		if (strpos($card['image']['class'], 'top') !== false) {
			$card_header = $card_image;
		} else {
			$card_footer = $card_image;
		}
	}

	// card body
	$card_body = "";

	if(isset($card['title'])) {
		$card_title = $card['title'];
		$card_body .= "<h5 class='card-title'>" . $card_title . "</h5>";
	}
	if(isset($card['subtitle'])) {
		$card_subtitle = $card['subtitle'];
		$card_body .= "<h6 class='card-subtitle'>" . $card_subtitle . "</h6>";
	}
	if(isset($card['text'])) {
		$card_text = $card['text'];
		$card_body .= "<p class='card-text'>" . $card_text . "</p>";
	}
	if(isset($card['class'])) {
		$card_class .= " " . $card['class'];
	}
	if(isset($card['body'])) {
		$card_body .= $card['body'];
	}
	if(!empty($card['buttons'])) {
		foreach($buttons as $button) {
			$bclass = '';
			$bhref = '';
			$btype = '';
			if (isset($button['class'])) {
				$bclass = $button['class'];
			}
			if (isset($button['href'])) {
				$bhref = $button['href'];
			}
			if (isset($button['type'])) {
				$btype = $button['type'];
			}
			$card_body .= bs_button([
				"content" => $button['content'],
				"class" => $bclass,
				"href" => $href,
				"type" => $type,
				"isInput" => $button['isInput']
			]);
		}
	}

	$content = $card_header;
	$content .= base_el("div", $card_body, "card-body");
	$content .= $card_footer;
	return base_el("div", $content, "card" . $card_class);
}

function bs_card_layout($content, $layout='card-deck') {
	return base_el("div", $content, $layout);
}

/* Base Functions ---------------------------------------------------- */

function base_a($content, $href, $class='', $target='') {
	$attr = "";
	if(isset($class)) {
		$attr .= " class='" . $class . "'";
	}
	if(isset($target)) {
		$attr .= " target='" . $target . "'";
	}
	return "<a href='" . $href . "'" . $attr . ">" . $content . "</a>";
}

function base_img($src, $class, $alt) {
	$attr = "";
	if(isset($class)) {
		$attr .= " class='" . $class . "'";
	}
	if(isset($alt)) {
		$attr .= " alt='" . $alt . "'";
	}
	return "<img src='" . $src . "'" . $attr . ">";
}

function base_el($element, $content, $class='', $attrs='') {
	$attr = "";
	if(isset($attrs)) {
		$attr .= $attrs;
	}
	if(isset($class)) {
		$attr .= " class='" . $class . "'";
	}
	return "<" . $element . $attr . ">" . $content . "</" . $element . ">";
}

?>