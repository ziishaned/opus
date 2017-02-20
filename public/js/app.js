new Vue({
    el: '#app',
    mounted() {
        
    },
    methods: {

    }
});

var App = {
    init: function(params = null) {
        this.params = params;
        this.bindUI();
        this.initJcrop();
        this.initCarousel();
        this.initTooltip();
        this.initCKEditor();

        var fixAffixWidth = function() {
            $('[data-spy="affix"]').each(function() {
                $(this).width( $(this).parent().width() );
            });
        }
        fixAffixWidth();
        $(window).resize(fixAffixWidth);
    },
    initCKEditor() {
        if($('#my1').length) {
            
            CKEDITOR.replace('my1', {
                width: "100%",
                height: 340,
                enableTabKeyTools: true,
                removePlugins: 'elementspath',
                pbckcode: {
                    highlighter: 'HIGHLIGHT',
                    modes: [
                        ['HTML', 'html'], ['CSS', 'css'], ['PHP', 'php'], ['JS', 'javascript'], ['SQL', 'sql'],
                        ['Text', 'text'], ['SH', 'sh']
                    ],
                    theme: 'textmate',
                    js: '/plugins/ckeditor/plugins/pbckcode/ace/',
                },
                extraPlugins: 'pbckcode',
                codeSnippet_theme: 'monokai_sublime',
                resize_enabled: false,
                uiColor: '#eeeeee',
                toolbar: [
                    { name: 'justify3', items: ['Format'] },
                    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'colors', items: ['TextColor', 'BGColor', 'RemoveFormat', 'SelectAll', '-', 'NumberedList', 'BulletedList'] },
                    { name: 'justify', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                    { name: 'insert', items: ['Table', 'HorizontalRule', 'PageBreak', '-', 'Link', 'Iframe'] },
                    { name: 'editing', items: ['SpellCheck', '-', 'Find', 'Replace', ] },
                    { name: 'paragraph', items: ['-', 'Outdent', 'Indent'] },
                    { name: 'justify2', items: ['pbckcode', 'Source', 'Maximize', '-', 'Undo', 'Redo'] },
                ]
            });
        }
    },
    initTooltip() {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    },
    initCarousel() {
        if ($(document).find('.Carousel').length) {
            var $carousel = $('.Carousel');
            $carousel.wrapInner($('<div class="CarouselGroup"/>'));
            var $group = $('.CarouselGroup');
            var $group2 = $group.clone().appendTo($carousel);

            var animate = function() {
              $group.css({marginLeft: 0}).animate({marginLeft: -$group.width()}, 70000, 'linear').promise().done(function() {
                animate();
              });
            };

            animate();
        }
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
    bindUI: function () {
        var that = this;

        if(document.getElementById('timezone')) {
            $('#timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
        }

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
    App.init();
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
                var html = `<p class="text-center" style="position: relative; top: -3px;">No pages yet. You can <a href="`+laroute.action('pages.create', { organization_slug: organizationSlug, wiki_slug: wikiSlug, page_id: node.id })+`">create one here</a>.</p>`;
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