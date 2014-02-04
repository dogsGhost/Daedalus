var main = (function($) {

	/******* VARS *******/


	/******* FUNCTIONS *******/

	var init = function() {
		//Init vars
		$search = $("#search");
		//Bind handlers
		//$example.on("click", eventHandlers.sampleHandler);
	};

	/******* EVENT HANDLERS *******/

	var eventHandlers = {
	
		sampleHandler: function() {
			//DO WORK
		}

	};

	return {
		init: init,
	};
	
})(jQuery);

jQuery(main.init);