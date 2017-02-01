var App = {
    init: function(params = null) {
        this.params = params;
        this.bindUI();
        this.initJcrop();
        this.initTooltip();
        this.loadCategories();
        this.initMasonry();
    },
    initMasonry: function() {
        var that = this;  
        if($('#ms-container').length > 0 && $('#ms-container').find('.ms-item').length > 0) {
            new Masonry(document.querySelector('#ms-container'), {
                itemSelector: '.ms-item',
                columnWidth: '.ms-item',                
            });      
        }
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
        $('#update-category-modal').on('hidden.bs.modal', function (e) {
            $('#update-category-form').find('#name').val('');
            $('#update-category-form').find('#update-outline').val('');
        });
        $(document).on('click', '#edit-category', function(event) {
            event.preventDefault();
            var curEle       =  $(this).closest('.category-item'),
                categoryslug =  $(curEle).data('category-slug'),
                name         =  $(curEle).find('#category-name').text(),
                outline      =  $(curEle).find('#category-outline').text();
            $('#update-category-form').find('#name').val(name);         
            $('#update-category-form').find('#update-outline').val(outline);
            $('#update-category-form').attr('action', laroute.action('organizations.categories.update', { organization_slug: that.params.organizationSlug, category_slug: categoryslug}));
        });
        $(document).on('click', '#add-invitation-input', function(event) {
            event.preventDefault();
            var invitationInput = `<li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-md hidden-lg">
                                                <div class="remove-invitation-input-con">
                                                    <button type="button" class="btn-link" id="remove-invitation-input"><i class="fa fa-close"></i></button>
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
                                                <div class="remove-invitation-input-con" style="text-align: center; position: relative; top: 27px;">
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Remove invitation" class="btn-link" id="remove-invitation-input"><i class="fa fa-close"></i></a>
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
        organizationSlug     : $('body').data('organization'),
    });

    if($('#timezone').length > 0) {
        $('#timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
    }

    tinymce.init({
        selector: "#page-description, #wiki-description",
        content_css : "/plugins/tinymce/tinymce.css,/plugins/tinymce/plugins/leaui_code_editor/css/pre.css", 

        theme: "modern",
        skin: "lightgray",
        
        width: "100%",
        height: 400,
        
        menubar: false,
        statusbar: false,
        valid_elements: '*[*]',
        
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak localautosave",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
            "save table contextmenu directionality template paste textcolor",
            "leaui_code_editor codemirror autoresize"
        ],
        autoresize_min_height: 400,
		paste_webkit_styles: "all",
		paste_retain_style_properties: "all",

		browser_spellcheck: true,
		nonbreaking_force_tab: true,
        relative_urls: false,
        
        toolbar: [
        	"styleselect | bold italic underline forecolor backcolor | leaui_code_editor | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | link unlink table | preview code | undo redo | localautosave",
        ],
        codemirror: {
            indentOnInit: true,
            fullscreen: false,
            path: 'CodeMirror',
            config: {
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
});

$(function() {
    if($('#wiki-page-tree').length > 0 ) {
        var wikiSlug = $('#wiki-page-tree').data('wiki-slug');
        var currentPage = $('#wiki-page-tree').data('current-page');
        var organizationSlug = $('#wiki-page-tree').data('organization-slug');
        var categorySlug = $('#wiki-page-tree').data('category-slug');
        
        $('#wiki-page-tree').jstree({
            core: {
                "themes" : {
                    'icons': false,
                    'dots' : false,
                },
                'data' : {
                    url: function (node) {
                        if($('#current-page-slug').length > 0) {
                            var opened_node = $('#current-page-slug').text();
                            $('#current-page-slug').remove();

                            return laroute.action('wikis.pages', { organization_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, page_slug: opened_node, fetch_tree: true});
                        }  

                        return (node.id === '#')    
                                ? laroute.action('wikis.pages', { organization_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, fetch: 'roots' })
                                : laroute.action('wikis.pages', { organization_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, page_slug: node.data.slug, fetch: 'children' });
                    },
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
                var html = `<p class="text-center" style="position: relative; top: -3px;">No pages yet. You can <a href="`+laroute.action('pages.create', { organization_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug })+`">create one here</a>.</p>`;
                $('#wiki-page-tree').replaceWith(html);
            };
            data.instance._open_to($('#current-page-id').text());
        });
    }

    if($('#reorder-page-tree').length > 0 ) {
        var wikiSlug         = $('#reorder-page-tree').data('wiki-slug');
        var organizationSlug = $('#reorder-page-tree').data('organization-slug');
        $('#reorder-page-tree').jstree({
            core: {
                "check_callback" : true,
                "themes" : {
                    'icons': false,
                    'dots' : false,
                },
                'data' : {
                    url: function (node) {
                        return (node.id === '#')    
                                ? laroute.action('wikis.pages', { organization_slug: organizationSlug, wiki_slug: wikiSlug })
                                : laroute.action('wikis.pages', { organization_slug: organizationSlug, wiki_slug: wikiSlug, page_id: node.id });
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
