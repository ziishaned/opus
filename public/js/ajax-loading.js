$(document).ready(function() {
    var AjaxLoadingBar = {
        init: function () {
            this.bindUI();
        },
        bindUI: function () {
            var that = this;
            $.ajaxSetup({
                beforeSend: function() {
                    $('.spinner').show();
                },
                complete : function() {
                    setTimeout(function() {
                        $(".spinner").hide();
                        $("button .loader").hide();
                    }, 300);
                }
            });
        }
    };

    AjaxLoadingBar.init();
});