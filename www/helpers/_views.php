<?php
	function getAddButton ($url='#') {
		return ButtonView::render (new ButtonModel(IconView::render( new IconModel ('plus', 'Add')), $url, 'add'));
	}
	function getSearchButton ($url='#') {
		return ButtonView::render (new ButtonModel(IconView::render( new IconModel ('search', 'Search')), $url, 'search'));
	}
	function getBackButton ($label = null) {
		$labelUrlVariable = $label != null ? '?label=' . $label : '';

		return ButtonView::render ( new ButtonModel(
			IconView::render( new IconModel ('arrow-left', 'Back')),	// label
			'./',														// link
			'back'														// class
		));
	}