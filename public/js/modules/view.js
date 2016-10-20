var View = {
	init: function(params = null) {
		this.params = params;
		this.bindUI();
	},
	bindUI: function() {
		$(document).on({
		    mouseenter: function () {
		        $(this).text('Unfollow');
		    },

		    mouseleave: function () {
		        $(this).text('Following');
		    }
		}, '.following-button');
	}
}

$(document).ready(function() {
	View.init();
});