<?php
	require_once ('../../views/ViewModel.php');

	class IconsView extends View {
		public function render ($data) {
			$icons = array (
				'search',
				'minus-square-filled',
				'minus-circle-filled',
				'minus',
				'plus-square-filled',
				'plus-circle-filled',
				'plus',
				'play',
				'empty-trash',
				'stop',
				'pause',
				'record',
				'next',
				'previous',
				'fast-forward',
				'rewind',
				'archive',
				'arrow-left',
				'star-filled',
				'star',
				'bookmark',
				'shopping-cart',
				'music-note',
				'open-book',
				'login',
				'logout',
				'user',
				'users',
				'leaf',
				'keyboard',
				'key',
				'youtube',
				'gear',
				'hamburger',
				'arrows-ccw',
			);

			$output = '<h2>Icons and id</h2>';

			foreach ($icons as $icon) {
				$output .= IconView::render( new IconModel ($icon, $icon));
			}
			return $output;
		}
	}