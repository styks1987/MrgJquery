<?php
	App::uses('AppHelper', 'View/Helper');
	App::uses('JqueryEngineHelper', 'View/Helper');

	class MrgJqueryEngineHelper extends JqueryEngineHelper{

		function __construct(View $view, $settings = array()){
			parent::__construct($view, $settings = array());

			$this->_init_callbacks();
		}

		protected function _init_callbacks(){
			$callbacks = [
				'gmap3'=>['mouseover'=>'marker, event, context', 'mouseout'=>''],
				'selectBoxIt'=>[],
				'nestedSortable'=>['update'=>''],
				'datepicker'=>[]
			];
			$this->_callbackArguments = array_merge($this->_callbackArguments, $callbacks);
		}

		/**
		 * When paired with the MrgGoogleMap
		 * This gives a way to output a google map
		 *
		 * Date Added: Wed, Jan 22, 2014
		 */

		public function gmap3($options){
			$template = '%s.gmap3({%s})';
			// The internal base engine helper does not work with recursive callbacks
			$options['marker']['events'] = $this->_prepareCallbacks('gmap3', $options['marker']['events']);
			$options['marker']['events'] = '{'.$this->_parseOptions($options['marker']['events'], ['mouseout', 'mouseover']).'}';
			$options['marker'] = '{'.$this->_parseOptions($options['marker'], ['events']).'}';
			$options = $this->_parseOptions($options, ['marker']);
	        return sprintf($template, $this->selection, $options);
		}

		/**
		 * When paired with the MrgCustomSelect Plugin
		 * This allows you to display a styleable select box
		 *
		 * Date Added: Wed, Jan 22, 2014
		 */

		public function selectBoxIt($options = []){
			$template = '%s.selectBoxIt({%s});';
	        return $this->_methodTemplate('selectBoxIt', $template, $options);
		}

		/**
		 * When paired with the MrgTreeSorter
		 * This gives you the ability to sort a list
		 *
		 * Date Added: Tue, Feb 04, 2014
		 */
		public function nestedSortable($options = []){
			$template = '%s.nestedSortable({%s});';
			return $this->_methodTemplate('nestedSortable', $template, $options);
		}

		/**
		 * When paired with the custom select plugin
		 * This will allow fixing the IE 9 placeholder bug
		 *
		 * Date Added: Mon, Apr 14, 2014
		 */
		public function placeholder($options = []){
			$options = $this->_parseOptions($options);
			$template = '%s.placeholder({%s});';
			return sprintf($template, $this->selection, $options);
		}


		/**
		 * When paired with the custom select plugin
		 * This will allow for adding date pickers
		 *
		 * Date Added: Thu, Jun 05, 2014
		 */
		public function datepicker($options=[]){
			$options = $this->_parseOptions($options);
			$template = '%s.datepicker({%s});';
			return sprintf($template, $this->selection, $options);
		}



	}

?>
