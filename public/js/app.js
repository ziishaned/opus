var App = {
    init: function(params = null) {
        this.bindUI();
        this.initJcrop();
        this.initTooltip();
        this.params         = params;
        this.categoryBackup = '';
        // this.loadOrganizationActivites();
        this.loadCategories();
    },
    initTooltip: function() {
        $('[data-toggle="tooltip"]').tooltip();
    },
    loadCategories: function() {
        $('.categories-con').infinitescroll({
            loading : {
                finished: undefined,
                finishedMsg: null,
                msg: '',
                msgText: '',
                speed: 0,
                start: undefined,
                img: "/images/loader.gif",
                selector: ".infinitescroll-loader-con",
            },
            navSelector : ".categories-pagination-con .pagination",
            nextSelector : ".categories-pagination-con .pagination li.active + li a",
            itemSelector : ".categories-item",
        });

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
    getWikis: function(organizationId) {
        $.ajax({
            url: '/organizations/'+Cookies.get('organization_slug')+'/wikis',
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',
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
        $(document).on('click', '#edit-category, #cancel-category-edit', function(event) {
            event.preventDefault();

            if($('.categories-con').find('.edit-active').length > 0) {
                $('.categories-con').find('.edit-active').replaceWith(that.categoryBackup);
            }

            that.categoryBackup = $(this).closest('tr').clone();
            var tableRow = $(this).closest('tr');

            $(tableRow).addClass('edit-active');
            var categoryName = $(tableRow).find('#category_name').text();
            var categoryId = $(tableRow).find('#category_name').data('category-id');
            var organizationSlug = $(tableRow).find('#category_name').data('organization');

            var html = `<td>
                            <form action="/organizations/`+organizationSlug+`/categories/`+categoryId+`" method="POST" role="form" id="category-edit-form">
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <input type="text" name="category_name" class="form-control input-sm" style="width: 98.5% !important; border-radius: 0px !important; border-color: #66afe9; outline: 0; width: 100%; box-sizing: border-box; -webkit-box-sizing:border-box; -moz-box-sizing: border-box;" placeholder="Enter category name" value="`+categoryName+`">
                                </div>
                            </form>
                        </td>
                        <td>
                            <ul class="list-unstyled list-inline categories-actions" style="margin-bottom: 0; position: relative; top: 3px;">
                                <li><button type="button" class="btn btn-success btn-xs" onclick="event.preventDefault(); document.getElementById('category-edit-form').submit();" style="margin-right: 8px;">Save</button></li>
                                <li><button type="button" class="btn btn-default btn-xs" id="cancel-category-edit">Cancel</button></li>
                            </ul>
                        </td>`;
            $(tableRow).empty().append(html);
        });
        $(document).on('click', '#add-invitation-input', function(event) {
            event.preventDefault();
            var invitationInput = `<li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-md hidden-lg">
                                                <div class="remove-invitation-input-con">
                                                    <button type="button" class="btn-link" id="remove-invitation-input" style="font-size: 17px; font-size: 17px; width: 100%;"><i class="fa fa-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Email Address</label>
                                                    <input type="text" class="form-control input" id="" placeholder="example@example.com">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="">First Name</label>
                                                    <input type="text" class="form-control input" id="" placeholder="Optional">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Last Name</label>
                                                    <input type="text" class="form-control input" id="" placeholder="Optional">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-sm hidden-xs">
                                                <div class="remove-invitation-input-con" style="text-align: center; position: relative; top: 18px;">
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Remove invitation" class="btn-link" id="remove-invitation-input" style="font-size: 17px;"><i class="fa fa-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;
            $('#user-invitation-form .invitations-input-con').append(invitationInput);
            $('.total-invitations').text($('.invitations-input-con li').length);
            that.initTooltip();
        });
        $(document).on('click', '#remove-invitation-input', function(event) {
            event.preventDefault();
            if($('.invitations-input-con li').length > 1) {
                $(this).closest('li').remove();
            }
            $('.total-invitations').text($('.invitations-input-con li').length);
        });
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
                url: '/organizations/'+Cookies.get('organization_slug')+'/users/avatar/crop',
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
                url: '/organizations/'+Cookies.get('organization_slug')+'/users/avatar/store',
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
                var commentId = $(this).attr('data-comment-id');
                var organizationId = $(this).attr('data-organization-id');
                var wikiId = $(this).attr('data-wiki-id');
                var pageId = $(this).attr('data-page-id');
                var editCommentForm = `
                                       <form action="/organizations/`+organizationId+`/wikis/`+wikiId+`/pages/`+pageId+`/comments/`+commentId+`" method="POST" id="edit-comment-form" role="form">
                                            <input type="hidden" name="_method" value="patch">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <textarea name="comment" id="edit-comment-input" class="form-control" rows="5">` + comment + `</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="height: 35px; margin-bottom: 0px;">
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
                    content_css: "/plugins/tinymce/tinymce.css",

                    /* theme of the editor */
                    theme: "modern",
                    skin: "lightgray",

                    /* width and height of the editor */
                    width: "100%",

                    /* display statusbar */
                    menubar: false,
                    statusbar: false,
                    valid_elements: '*[*]',
                    /* plugin */
                    plugins: [
                        "advlist autolink link lists charmap hr anchor pagebreak mention",
                        "searchreplace wordcount visualblocks visualchars code nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor",
                        "leaui_code_editor autoresize"
                    ],
                    autoresize_min_height: 100,
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
                            return '<img style="max-width: 23px; max-height: 22px; min-width: 23px; min-height: 22px; position: relative; top: 5px;" class="emojioneemoji" src="/images/png/'+item.unicode+'.png">';
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

    $('.page-tree-con').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    tinymce.init({
        /* replace textarea having class .tinymce with tinymce editor */
        selector: "#page-description, #wiki-description",
        content_css : "/plugins/tinymce/tinymce.css,/plugins/tinymce/plugins/leaui_code_editor/css/pre.css", 

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
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
            "save table contextmenu directionality template paste textcolor",
            "leaui_code_editor codemirror mention autoresize"
        ],
        autoresize_min_height: 400,
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
                return '<img style="max-width: 23px; max-height: 22px; min-width: 23px; min-height: 22px; position: relative; top: 5px;" class="emojioneemoji" src="/images/png/'+item.unicode+'.png">';
            },
            render: function(item) {
                return '<li>'+
                            '<a><img class="emojioneemoji" src="/images/png/'+item.unicode+'.png" style="font-size: inherit; height: 2ex; width: 2.1ex; min-height: 20px; min-width: 20px; display: inline-block; margin: 0 5px .2ex 0; line-height: normal; vertical-align: middle; max-width: 100%; top: 0;">'+item.name+'</a>'+
                        '</li>';
            }
        },
		paste_webkit_styles: "all",
		paste_retain_style_properties: "all",

		browser_spellcheck: true,
		nonbreaking_force_tab: true,
        relative_urls: false,
        
        /* toolbar */
        toolbar: [
        	"styleselect | bold italic underline forecolor backcolor | leaui_code_editor | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | link unlink table | preview code | undo redo | localautosave",
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

    $('#comment-input').on('focus', function() {
        tinymce.init({
            selector: "#comment-input",
            content_css : "/plugins/tinymce/tinymce.css",
            statusbar: false,

            /* theme of the editor */
            theme: "modern",
            skin: "lightgray",
            
            /* width and height of the editor */
            width: "100%",

            /* display statusbar */
            menubar:false,
            statubar: false,
            paste_webkit_styles: "all",
            paste_retain_style_properties: "all",
            valid_elements: '*[*]',
            
            /* plugin */
            plugins: [
                "advlist autolink link lists charmap hr anchor pagebreak mention",
                "searchreplace wordcount visualblocks visualchars code nonbreaking",
                "save table contextmenu directionality template paste textcolor",
                "leaui_code_editor autoresize"
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
                    return '<img style="max-width: 23px; max-height: 22px; min-width: 23px; min-height: 22px; position: relative; top: 5px;" class="emojioneemoji" src="/images/png/'+item.unicode+'.png">';
                },
                render: function(item) {
                    return '<li>'+
                                '<a><img class="emojioneemoji" src="/images/png/'+item.unicode+'.png" style="font-size: inherit; height: 2ex; width: 2.1ex; min-height: 20px; min-width: 20px; display: inline-block; margin: 0 5px .2ex 0; line-height: normal; vertical-align: middle; max-width: 100%; top: 0;">'+item.name+'</a>'+
                            '</li>';
                }
            },
            autoresize_min_height: 100,

            browser_spellcheck: true,
            nonbreaking_force_tab: true,
            relative_urls: false,

            /* toolbar */
            toolbar: "bold italic underline | bullist numlist | link unlink | leaui_code_editor",
        });
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
        var currentPage = $('#wiki-page-tree').data('current-page');
        var organizationId = $('#wiki-page-tree').data('organization-id');
        $('#wiki-page-tree').jstree({
            core: {
                "themes" : {
                    'icons': false,
                    'dots' : false,
                },
                'data' : {
                    url: function (node) {    
                        return node.id === '#' ?    
                        '/organizations/'+organizationId+'/wikis/'+wikiId+'/pages' : '/organizations/'+organizationId+'/wikis/'+wikiId+'/pages/'+node.id;
                    }, 
                    data: function() {
                        if($('#current-page-id').length > 0) {
                            var openedNode = $('#current-page-id').text();
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
            },
            "plugins" : [ "search", "sort" ]
        }).on("select_node.jstree", function (e, data) { 
            document.location = data.node.a_attr.href;
        }).on("ready.jstree", function(e, data) {
            if(data.instance._cnt == 0) {
                var html = `<p class="text-center" style="position: relative; top: -3px;">No pages yet. You can <a href="/organizations/`+$('body').data('organization')+`/wikis/`+$('body').data('wiki')+`/pages/create">create one here</a>.</p>`;
                $('#wiki-page-tree').replaceWith(html);
            };
            data.instance._open_to(currentPage);
        });
    }

    if($('#reorder-page-tree').length > 0 ) {
        var wikiId = $('#reorder-page-tree').data('wiki-id');
        var currentPage = $('#reorder-page-tree').data('current-page');
        var organizationId = $('#reorder-page-tree').data('organization-id');
        $('#reorder-page-tree').jstree({
            core: {
                "check_callback" : true,
                "themes" : {
                    'icons': false,
                    'dots' : false,
                },
                'data' : {
                    url: function (node) {    
                        return node.id === '#' ?    
                        '/organizations/'+organizationId+'/wikis/'+wikiId+'/pages' : '/organizations/'+organizationId+'/wikis/'+wikiId+'/pages/'+node.id;
                    }, 
                    data: function() {
                        if($('#current-page-id').length > 0) {
                            var openedNode = $('#current-page-id').text();
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
            },
            "plugins" : [ "search", "sort", "dnd" ]
        }).on("select_node.jstree", function (e, data) { 
            document.location = data.node.a_attr.href;
        }).on("ready.jstree", function(e, data) {
            if(data.instance._cnt == 0) {
                var html = `<p class="text-center" style="position: relative; top: -3px;">No pages yet. You can <a href="/organizations/`+$('body').data('organization')+`/wikis/`+$('body').data('wiki')+`/pages/create">create one here</a>.</p>`;
                $('#reorder-page-tree').replaceWith(html);
            };
            data.instance._open_to(currentPage);
        }).on('move_node.jstree', function(e, data) {
            $.ajax({
                url: '/organizations/'+organizationId+'/wikis/'+wikiId+'/pages/reorder',
                type: 'POST',
                dataType: 'json',
                data: {
                    nodeId: data.node.id, 
                    parentId: data.parent,
                },
                error: function(error) {
                    var response = JSON.parse(error.responseText);
                    console.log(response);
                }
            });
        });
    } 
});

$(function() {    
    $("#outline, #organization-description").emojioneArea({
        pickerPosition: "bottom",
        tones: false,
        autoHideFilters: true,
        useSprite: false,
    });

    if($('#ms-container').length > 0) {
        var container = document.querySelector('#ms-container');
        var msnry = new Masonry( container, {
            itemSelector: '.ms-item',
            columnWidth: '.ms-item',                
        });      
    }

    if($('#side-nav-con').length > 0) {
        var sideNav = $('#side-nav-con').offset();

        $(window).scroll(function(){
            if($(window).scrollTop() > sideNav.top){
                $('#side-nav-con').css('position','fixed').css({
                    'top': '70px',
                    'width': '360px'
                });
            } else {
                $('#side-nav-con').removeAttr('style');
            }
        });
    }
});