var App = {
    init: function(params = null) {
        this.params = params;
        this.bindUI();
        this.makeContributionGraph();
        this.initJcrop();
        $('[data-toggle="tooltip"]').tooltip();
    },
    initJcrop: function() {
        var that = this;
        $('#cropimage').Jcrop({
            onSelect: that.updateCropCoords,
            bgColor: 'black',
            bgOpacity: .6,
            boxWidth: 300, 
            boxHeight: 300,
            aspectRatio: 1,
            setSelect: [160, 160, 160, 160],
        });
    },
    updateCropCoords: function(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    },
    makeContributionGraph: function() {
        if($('#contribution-graph').length > 0) {
            var userId = $('#contribution-graph').data('user-id');
            $.ajax({
                url: '/users/activity',
                type: 'POST',
                dataType: 'json',
                data: {
                    _method: 'get',
                    user_id: userId,
                },
                success: function(data) {
                    Object.keys(data).map(function(key, index) {
                       data[key].date =  moment(data[key].date).toDate(); 
                    });

                    var heatmap = calendarHeatmap()
                        .data(data)
                        .selector('#contribution-graph')
                        .tooltipEnabled(true)
                        .onClick(function (data) {
                            console.log('data', data);
                        });
                    heatmap();  // render the chart
                },
                error: function(error) {
                    var response = JSON.parse(error.responseText);
                    console.log(response);
                }
            });
        }
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
    getOrganizations: function() {
        $.ajax({
            url: '/users/organizations',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var html = '';
                $(data).each(function(index, el) {
                    html += '<li><a href="'+el.url+'">'+el.name+'</a></li>'
                });
                $('.header-menu').find('#organizations-list .li-loader').replaceWith(html);
            }, 
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    getWikis: function(organizationId) {
        $.ajax({
            url: '/organizations/wikis',
            type: 'GET',
            dataType: 'json',
            data: {
                organization_id: organizationId
            },
            success: function(data) {
                var html = '';
                $(data).each(function(index, el) {
                    html += '<li><a href="'+el.url+'">'+el.name+'</a></li>'
                });
                $('.header-menu').find('#wikis-list .li-loader').replaceWith(html);
            }, 
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    bindUI: function () {
        var that = this;
        $(document).on('click', '#get-organizations', function(event) {
            event.preventDefault();            
            if($('#get-organizations').attr('data-appended') == 'false') {
                $(this).attr('data-appended', true);
                that.getOrganizations();
            }
        });
        $(document).on('click', '#get-wikis', function(event) {
            event.preventDefault();            
            if($('#get-wikis').attr('data-appended') == 'false') {
                $(this).attr('data-appended', true);
                var organizationId = $(this).attr('data-organizationId');
                that.getWikis(organizationId);
            }
        });
        $('#update-image-size').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/users/avatar/crop',
                type: 'POST',
                dataType: 'json',
                data: {
                    'image' : $('#crop-image-form').find('#profile-image-name').val(),
                    'x'     : $('#crop-image-form').find('#x').val(),
                    'y'     : $('#crop-image-form').find('#y').val(),
                    'w'     : $('#crop-image-form').find('#w').val(),
                    'h'     : $('#crop-image-form').find('#h').val(),

                },
                success: function(data) {
                    $("#profile-pic-cropper").modal('hide');
                    window.location.reload();
                }, 
                error: function(error) {
                    console.log(error);
                }
            });
        });
        $('#profile_image[type="file"]').on('change', function() {
            var formData = new FormData($("#avatar-upload-form")[0]);
            $.ajax({
                url: '/users/avatar/store',
                type: 'POST',
                cache:false,
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    console.log(data);
                    $("#profile-pic-cropper #cropimage").attr('src', '/images/profile-pics/' + data.image);
                    $("#profile-pic-cropper").modal('show');
                    $("#profile-pic-cropper").find('#profile-image-name').val(data.image);
                }, 
                error: function(error) {
                    console.log(error);
                }
            });
        });
        $(document).on('click', 'button', function() {
            $(this).find('.loader').show();
        });
        $(document).on('click', '#edit-comment', function (e) {
            e.preventDefault();
            var curComment = this;
            var comment = $(this).closest('.comment-box').find('#comment-fedit').text();
            var commentContent = $(this).closest('.comment-box').find('.comment-content').html();
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
                    valid_elements: '*[*]',
                    auto_convert_smileys: true,
                    /* plugin */
                    plugins: [
                        "advlist autolink link lists charmap hr anchor pagebreak mention",
                        "searchreplace wordcount visualblocks visualchars code nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor placeholder",
                        "leaui_code_editor"
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
                
                    /* toolbar */
                    toolbar: "bold italic underline | bullist numlist | emoticons link unlink | leaui_code_editor",
                });
            }
            $('#close-edit-comment-form').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('#edit-comment-form').remove();
                $(curComment).closest('.comment-box').find('.comment-content').html(commentContent);
            });
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

        $(document).on('click', '#watch-wiki-btn', function(event) {
            event.preventDefault();
            $(this).html('<img src="/images/btn-loader.gif" class="img-responsive loader" alt="Image">');
            var wikiId = $(this).attr('data-wiki-id');
            that.watchWiki(wikiId);
        });

        $(document).on('click', '#watch-page-btn', function(event) {
            event.preventDefault();
            $(this).html('<img src="/images/btn-loader.gif" class="img-responsive loader" alt="Image">');
            var pageId = $(this).attr('data-page-id');
            that.watchPage(pageId);
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
    watchPage: function(id) {
        $.ajax({
            url: '/pages/'+id+'/watch',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if(data.watch) {
                    var totalWatch = parseInt($(document).find('.page-watch-count').text());
                    $(document).find('.page-watch-count').text(totalWatch+1);
                    $(document).find('#watch-page-btn').html('Unwatch');
                }
                if(data.unwatch) {
                    var totalWatch = parseInt($(document).find('.page-watch-count').text());
                    $(document).find('.page-watch-count').text(totalWatch-1);
                    $(document).find('#watch-page-btn').html('Watch');
                }
            },
            error: function(error) {
                var response = JSON.parse(error.responseText);
                console.log(response);
            }
        });
    },
    watchWiki: function(id) {
        $.ajax({
            url: '/wikis/'+id+'/watch',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if(data.watch) {
                    var totalWatch = parseInt($(document).find('.wiki-watch-count').text());
                    $(document).find('.wiki-watch-count').text(totalWatch+1);
                    $(document).find('#watch-wiki-btn').html('Unwatch');
                }
                if(data.unwatch) {
                    var totalWatch = parseInt($(document).find('.wiki-watch-count').text());
                    $(document).find('.wiki-watch-count').text(totalWatch-1);
                    $(document).find('#watch-wiki-btn').html('Watch');
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
    }
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

    if($('#timezone').length > 0) {
        $('#timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
    }

    if($('.wiki-list').length > 0) {
        new List('wiki-list-con', { 
          valueNames: ['name'], 
          plugins: [ ListFuzzySearch() ] 
        });
    }

    $('.page-tree-con').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "#page-description, #wiki-description",
        content_css : "/css/bootstrap.min.css,/css/tinymce.css,/js/plugins/leaui_code_editor/css/pre.css", 

        /* theme of the editor */
        theme: "modern",
        skin: "lightgray",
        
        /* width and height of the editor */
        width: "100%",
        height: 400,
        
        /* display statusbar */
        menubar: false,
        statusbar: false,
        valid_elements: '*[*]',
        /* plugin */
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak localautosave",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality template paste textcolor placeholder",
            "leaui_code_editor codemirror mention jbimages"
        ],
        mentions: {
            delimiter: ':',
            queryBy: 'name',
            source: function (query, process, delimiter) {
                if (delimiter === ':') {
                    $.ajax({
                        url: '/js/emoji.json',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var ok = [];
                            $(data).each(function(index, el) {
                                if(el.name.indexOf( query ) > -1) {
                                    ok.push(el);
                                }
                            });   
                            process(ok);
                        }, 
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            },
            insert: function(item) {
                return item.code;
            },
            render: function(item) {
                return '<li>'+
                            '<a><img alt="👍" class="emojioneemoji" src="/images/png/'+item.unicode+'.png" style="font-size: inherit; height: 2ex; width: 2.1ex; min-height: 20px; min-width: 20px; display: inline-block; margin: 0 5px .2ex 0; line-height: normal; vertical-align: middle; max-width: 100%; top: 0;">'+item.name+'</a>'+
                        '</li>';
            }
        },
		paste_webkit_styles: "all",
		paste_retain_style_properties: "all",

		browser_spellcheck: true,
		nonbreaking_force_tab: true,
        relative_urls: false,
        auto_convert_smileys: true,
        
        /* toolbar */
        toolbar: [
        	"styleselect | bold italic underline forecolor backcolor | leaui_code_editor | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | jbimages media | link unlink table | preview code | undo redo | localautosave",
        ],
        codemirror: {
            indentOnInit: true,
            fullscreen: false,
            path: 'CodeMirror',
            config: {
                // theme: 'monokai',
                tabSize: 4, 
                mode: 'htmlmixed',
                extraKeys: {"Ctrl-Space": "autocomplete"},
                lineNumbers: true,
                styleActiveLine: true
            },
            width: 800,
            height: 500,        
            cssFiles: [
                'addon/hint/show-hint.css',
                // 'theme/monokai.css',
            ],
            jsFiles: [          
               'mode/htmlmixed/htmlmixed.js',
               'addon/hint/show-hint.js',
               'addon/hint/html-hint.js',
               'addon/hint/css-hint.js',
               'addon/hint/xml-hint.js',
            ]
          },
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
        paste_webkit_styles: "all",
        paste_retain_style_properties: "all",
        valid_elements: '*[*]',
        auto_convert_smileys: true,
        
        /* plugin */
        plugins: [
            "advlist autolink link lists charmap hr anchor pagebreak mention",
            "searchreplace wordcount visualblocks visualchars code nonbreaking",
            "save table contextmenu directionality template paste textcolor placeholder",
            "leaui_code_editor"
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

        browser_spellcheck: true,
        nonbreaking_force_tab: true,
        relative_urls: false,

        /* toolbar */
        toolbar: "bold italic underline | bullist numlist | link unlink | leaui_code_editor",
    });
});

// Semantic UI
$(function() {
    $('.ui.dropdown').dropdown();
});

// jsTree
$(function() {
    if($('#wiki-page-tree').length > 0 ) {
        var wikiId = $('#wiki-page-tree').data('wiki-id');
        $('#wiki-page-tree').jstree({
            core: {
                "themes" : {
                    // 'stripes': true, // Background highlighted of current node or page
                    'icons': false,
                    'dots' : false,
                    "variant" : "large"
                },
                'data' : {
                    url: function (node) {    
                        return node.id === '#' ?    
                        '/wikis/'+wikiId+'/pages' : '/wikis/'+wikiId+'/pages/'+node.id;
                    }, 
                    data: function() {
                        if($('#current-page-id').length > 0) {
                            var openedNode = $('#current-page-id').val();
                            $('#current-page-id').remove();

                            return {
                                'opened_node': openedNode 
                            };
                        }
                    }
                }
            },
            sort: function (a, b) {
                return moment(new Date(this.get_node(a).data.created_at)) > moment(new Date(this.get_node(b).data.created_at)) ? 1 : -1;
                // return this.get_node(a).original.px > this.get_node(b).original.px ? 1 : -1;
            },
            "plugins" : [ "search", "sort" ]
        }).on("select_node.jstree", function (e, data) { 
            document.location = data.node.a_attr.href;
        }).on("ready.jstree", function(e, data) {
            data.instance._open_to($('#current-node').val());
        });

        var to = false;
        $('#searchinput').keyup(function () {
            if(to) { 
                clearTimeout(to); 
            }
            to = setTimeout(function () {
                var v = $('#searchinput').val();
                $('#wiki-page-tree').jstree(true).search(v);
            }, 250);
        });
    } 
});

// Select2
$(function() {
    $('#timezone, #wiki_visibility').select2({
        minimumResultsForSearch: 5
    });
    
    $("#outline, #organization-description").emojioneArea({
        pickerPosition: "bottom",
        tones: false,
        autoHideFilters: true,
        useSprite: false,
    });
});