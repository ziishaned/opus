var App = {
    init: function(params = null) {
        this.params = params;
        this.bindUI();
        this.initSelectize();
    },
    inviteUserToOrganization: function (userId, organizationId) {
        $.ajax({
            url: '/organization/invite',
            type: 'POST',
            dataType: 'json',
            data: {
                userId          : userId,
                organizationId  : organizationId
            },
            success: function(data) {
                console.log(data);
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    removeUserFromOrganization: function (userId, organizationId) {
        $.ajax({
            url: '/organization/remove-invite',
            type: 'POST',
            dataType: 'json',
            data: {
                userId         : userId,
                organizationId : organizationId
            },
            success: function(data) {
                console.log(data);
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    bindUI: function () {
        var that = this;
        $(document).find('#add-to-invite-list').on('click', function() {
            var userId   = that.params.inviteUserInput.val();
            var userItem = that.params.inviteUserInput.closest('.row').find('.selectize-dropdown-content').children('[data-value='+userId+']').html();

            if(that.params.userInviteList.children('[data-userid='+userId+']').length != 1) {
                that.inviteUserToOrganization(userId, that.params.inviteToOrganization.val());
                that.params.userInviteList.prepend('<li data-userid="'+userId+'"><div class="row">'+userItem+'<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><i class="fa fa-close" id="rm-user-from-invite-list"></i></div></div></li>');
            }
            that.clearSelectizeCache('#invite-people-input');
        });

        $(document).on('click', '#rm-user-from-invite-list', function() {
            var userId = $(this).closest('li').attr('data-userid');
            that.removeUserFromOrganization(userId, that.params.inviteToOrganization.val());
            $(this).closest('li').remove();
        });
    },
    initSelectize() {
        this.params.inviteUserInput.selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'email',
            create: false,
            render: {
                option: function(item, escape) {
                    var elm = '<div class="row">'+
                                    '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><img src="/images/default.png" width="50"></div>'+
                                    '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><p style="font-size: 13px; font-weight: bold; text-transform: capitalize; margin-bottom: 5px;">'+item.name+'</h4><p style="margin-bottom: 0;">'+item.email+'</p></div>'+
                               '</div>';
                    return elm;
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/users/search/' + query,
                    type: 'GET',
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        });
    },
    clearSelectizeCache: function (elm) {
        $(elm)[0].selectize.setValue('');
        $(elm)[0].selectize.clearOptions();
        $(elm)[0].selectize.renderCache = {};
    },
};

$(document).ready(function() {
    App.init({
        userInviteList       : $('.user-invite-list'),
        inviteUserInput      : $('#invite-people-input'),
        inviteToOrganization : $('#invite-to-organization-id'),
    });
});
