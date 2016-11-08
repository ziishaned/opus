var App = {
    init: function(params = null) {
        this.params = params;
        this.bindUI();
        this.initSelectize();
    },
    inviteUserToOrganization: function (userId, organizationId) {
        $.ajax({
            url: '/organizations/invite',
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
            url: '/organizations/invite',
            type: 'DELETE',
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
        $(document).on('click', '#edit-comment', function (e) {
            e.preventDefault();
            var curComment = this;
            var comment = $(this).closest('.comment-box').find('.comment-content').html();
            if($('#edit-comment-form').length == 0) {
                var commentId = $(this).attr('data-commentid');
                var editCommentForm = `
                                       <form action="/comments/`+commentId+`" method="POST" id="edit-comment-form" role="form" data-toggle="validator">
                                            <input type="hidden" name="_method" value="patch">
                                            <div class="form-group" style="margin-bottom: 0;">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <textarea name="comment" id="edit-comment-input" class="form-control" rows="5" placeholder="Submit your comment..">` + comment + `</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top: 10px; height: 35px; margin-bottom: 10px;">
                                                <input type="submit" class="btn btn-default pull-left" id="close-edit-comment-form" value="Close">
                                                <input type="submit" class="btn btn-success pull-right" id="submit-comment" value="Update Comment">
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    `;
                $(this).closest('.comment-box').find('.comment-content').empty();
                $(this).closest('.comment-box').find('.comment-content').append(editCommentForm);
                tinymce.remove("#edit-comment-input");
                tinymce.init({
                    selector: "#edit-comment-input",
                    content_css: "/css/bootstrap.min.css,/css/tinymce.css",

                    /* theme of the editor */
                    theme: "modern",
                    skin: "lightgray",

                    /* width and height of the editor */
                    width: "100%",
                    height: 100,

                    /* display statusbar */
                    menubar: false,
                    statusbar: false,

                    /* plugin */
                    plugins: [
                        "advlist autolink link lists charmap hr anchor pagebreak mention",
                        "searchreplace wordcount visualblocks visualchars code nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor codesample placeholder"
                    ],
                    mentions: {
                        source: function (query, process, delimiter) {
                            if (delimiter === '@') {
                                $.getJSON('/users/search/' + query, function (data) {
                                    process(data)
                                });
                            }
                        },
                        insert: function (item) {
                            return '<a href="/users/' + item.slug + '" style="font-weight: bold;">@' + item.name + '</a>';
                        }
                    },
                    paste_webkit_styles: "all",
                    paste_retain_style_properties: "all",

                    browser_spellcheck: true,
                    nonbreaking_force_tab: true,
                    relative_urls: false,
                    codesample_languages: [
                        {text: 'HTML/XML', value: 'markup'},
                        {text: 'JavaScript', value: 'javascript'},
                        {text: 'CSS', value: 'css'},
                        {text: 'PHP', value: 'php'},
                        {text: 'Ruby', value: 'ruby'},
                        {text: 'Python', value: 'python'},
                        {text: 'Java', value: 'java'},
                        {text: 'C', value: 'c'},
                        {text: 'C#', value: 'csharp'},
                        {text: 'C++', value: 'cpp'},
                        {text: 'SQL', value: 'sql'},
                        {text: 'Bash', value: 'bash'}
                    ],

                    /* toolbar */
                    toolbar: "bold italic underline | bullist numlist | emoticons link unlink | codesample",
                });
            }
            $('#close-edit-comment-form').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('#edit-comment-form').remove();
                $(curComment).closest('.comment-box').find('.comment-content').html(comment);
            });
        });
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

        $(document).on('click', '#follow-button', function() {
            var followId = $(this).attr('data-follow-id');
            that.followUser(followId);
        });

        $(document).on('click', '#unfollow-button', function() {
            var followId = $(this).attr('data-follow-id');
            that.unFollowUser(followId);
        });

        // $(document).on('click', '#submit-comment', function(event) {
        //     event.preventDefault();
        //     var comment = $(document).find('#comment-input').val();
        //     var wikiId  = $(document).find('#wiki-id').val();
        //     that.saveComment(comment, wikiId);
        // });

        $(document).on('click', '#like-page', function(event) {
            event.preventDefault();
            var pageId = $(this).attr('data-pageid');
            that.starPage(pageId);
        });

        $(document).on('click', '#like-comment', function(event) {
            event.preventDefault();
            var commentId = $(this).attr('data-commentid');
            that.starComment(commentId);
        });
    },
    starComment: function(id) {
        $.ajax({
            url: '/comments/'+id+'/star',
            type: 'POST',
            dataType: 'json',
            data: {
                commentId: id
            },
            success: function(data) {
                if(data.star) {
                    var totalStars = parseInt($(document).find('#comment-total-star[data-commentid="'+id+'"]').text());
                    $(document).find('#comment-total-star[data-commentid="'+id+'"]').text(totalStars+1);
                }
                if(data.unstar) {
                    var totalStars = parseInt($(document).find('#comment-total-star[data-commentid="'+id+'"]').text());
                    $(document).find('#comment-total-star[data-commentid="'+id+'"]').text(totalStars-1);
                }
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    starPage: function(id) {
        $.ajax({
            url: '/pages/'+id+'/star',
            type: 'POST',
            dataType: 'json',
            data: {
                pageId: id
            },
            success: function(data) {
                if(data.star) {
                    var totalStars = parseInt($(document).find('#page-total-star').text());
                    $(document).find('#page-total-star').text(totalStars+1);
                }
                if(data.unstar) {
                    var totalStars = parseInt($(document).find('#page-total-star').text());
                    $(document).find('#page-total-star').text(totalStars-1);
                }
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    unFollowUser: function(followId, elm) {
        $.ajax({
            url: '/users/unfollow',
            type: 'POST',
            dataType: 'json',
            data: {
                followId: followId
            },
            success: function(data) {
                document.location = '/users/' + followId;
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    followUser: function(followId, elm) {
        $.ajax({
            url: '/users/follow',
            type: 'POST',
            dataType: 'json',
            data: {
                followId: followId
            },
            success: function(data) {
                document.location = '/users/' + followId;
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    initSelectize: function() {
        this.params.selectOrganization.selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: false,
            render: {
                option: function(item, escape) {
                    var elm = '<div class="row">'+
                                    '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><img src="/images/default.png" width="50"></div>'+
                                    '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><h4 style="font-size: 13px; font-weight: bold; text-transform: capitalize; margin-bottom: 5px;">'+item.name+'</h4></div>'+
                               '</div>';
                    return elm;
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/organizations/search/' + query,
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
        this.params.selectWiki.selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: false,
            render: {
                option: function(item, escape) {
                    var elm = '<div class="row">'+
                                    '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><img src="/images/default.png" width="50"></div>'+
                                    '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><h4 style="font-size: 13px; font-weight: bold; text-transform: capitalize; margin-bottom: 5px;">'+item.name+'</h4></div>'+
                               '</div>';
                    return elm;
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/wikis/search/' + query,
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
        this.params.inviteUserInput.selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'email',
            create: false,
            render: {
                option: function(item, escape) {
                    var elm = '<div class="row">'+
                                    '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><img src="/images/default.png" width="50"></div>'+
                                    '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><h4 style="font-size: 13px; font-weight: bold; text-transform: capitalize; margin-bottom: 5px;">'+item.name+'</h4><p style="margin-bottom: 0;">'+item.email+'</p></div>'+
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
        this.params.selectPageParent.selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            create: false,
            render: {
                option: function(item, escape) {
                    var elm = '<div class="row">'+
                                    '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><img src="/images/default.png" width="50"></div>'+
                                    '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><h4 style="font-size: 13px; font-weight: bold; text-transform: capitalize; margin-bottom: 5px;">'+item.name+'</h4></div>'+
                               '</div>';
                    return elm;
                }
            },
            load: function(query, callback) {
                var wikiId = $('#wiki-input').val();
                if (!query.length) return callback();
                $.ajax({
                    url: '/wikis/'+ wikiId +'/pages/search/' + query,
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
        selectOrganization   : $('#organization-input'),
        selectWiki           : $('#wiki-input'),
        selectPageParent     : $('#page-parent'),
        inviteUserInput      : $('#invite-people-input'),
        inviteToOrganization : $('#invite-to-organization-id'),
    });

    $('.page-tree-con').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "#page-description",
        content_css : "/css/bootstrap.min.css,/css/tinymce.css", 

        /* theme of the editor */
        theme: "modern",
        skin: "lightgray",
        
        /* width and height of the editor */
        width: "100%",
        height: 400,
        
        /* display statusbar */
        menubar: false,
        statubar: false,
        
        /* plugin */
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak localautosave",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor codesample placeholder smileys"
        ],
		paste_webkit_styles: "all",
		paste_retain_style_properties: "all",

		browser_spellcheck: true,
		nonbreaking_force_tab: true,
        relative_urls: false,
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Ruby', value: 'ruby'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C#', value: 'csharp'},
            {text: 'C++', value: 'cpp'},
            {text: 'SQL', value: 'sql'},
            {text: 'Bash', value: 'bash'}
        ],
        auto_convert_smileys: true,
        
        /* toolbar */
        toolbar: [
        	"styleselect | bold italic underline forecolor backcolor | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | image media | link unlink table | preview smileys codesample code | undo redo | localautosave",
        ],
    });

    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "#comment-input",
        content_css : "/css/bootstrap.min.css,/css/tinymce.css",
        statusbar: false,

        /* theme of the editor */
        theme: "modern",
        skin: "lightgray",
        
        /* width and height of the editor */
        width: "100%",
        height: 100,
        
        /* display statusbar */
        menubar:false,
        statubar: false,
        
        /* plugin */
        plugins: [
            "advlist autolink link lists charmap hr anchor pagebreak mention",
            "searchreplace wordcount visualblocks visualchars code nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor codesample placeholder"
        ],
        mentions: {
            source: function (query, process, delimiter) {
                if (delimiter === '@') {
                    $.getJSON('/users/search/' + query, function (data) {
                        process(data)
                    });
                }
            },
            insert: function(item) {
                return '<a href="/users/'+item.slug+'" style="font-weight: bold;">@' + item.name + '</a>';
            }
        },
        paste_webkit_styles: "all",
        paste_retain_style_properties: "all",

        browser_spellcheck: true,
        nonbreaking_force_tab: true,
        relative_urls: false,
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Ruby', value: 'ruby'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C#', value: 'csharp'},
            {text: 'C++', value: 'cpp'},
            {text: 'SQL', value: 'sql'},
            {text: 'Bash', value: 'bash'}
        ],

        /* toolbar */
        toolbar: "bold italic underline | bullist numlist | emoticons link unlink | codesample",
    });

    $("#page-tree").fancytree({
        extensions: ["dnd", "edit"],
        icon: false,
        dnd: {
            draggable: {
                zIndex: 1000,
                scroll: false,
                revert: "invalid",
                appendTo: "body"
            },
            autoExpandMS: 400,
            focusOnClick: true,
            preventVoidMoves: true,
            preventRecursiveMoves: true,
            dragStart: function(node, data) {
                return true;
            },
            dragEnter: function(node, data) {
               return true;
            },
            dragDrop: function(node, data) {
                $.ajax({
                    url: '/pages/reorder',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _method: 'patch',
                        nodeId: data.otherNode.key,
                        parentId: data.node.key,
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        var response = JSON.parse(error.responseText);
                        console.log(response);
                    }
                });
                data.otherNode.moveTo(node, data.hitMode);
            }
        },
        activate: function(event, data){
            var node = data.node,
                orgEvent = data.originalEvent;

            if(node.data.href){
                window.location.href=node.data.href;    
            }
        },
    });
});
