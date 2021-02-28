
// FIX

(function () {

	function init() {
		var input = BX('form-search-input');
		var btnFilter = BX('btn-form-search');

		input.focus();

		BX.bind(input, 'keypress', BX.debounce(function (e) {
			btnFilter.click();
		}, 500));
	}

	BX.ready(init);
	BX.addCustomEvent('onAjaxSuccess', init);
	BX.addCustomEvent('onComponentAjaxHistorySetState', init);
})();
