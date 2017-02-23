Vue.component('aside-category-list', {
    props: ['team', 'category'],
    template: `
        <div>
            <div class="text-center" style="margin-top: 15px;" v-show="loading"><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 22px;"></i></div>
            <li class="item" :class="{active: isCategoryActive(category) }" v-for="category of categories">
                <a :href="getCategoryUrl(category)">
                    <div class="media">
                        <div class="pull-left">
                            <div class="cateogry-icon" :style="{ 'background-color': getBackgroundColor(category.name) }"></div>
                        </div>
                        <div class="media-body">
                            <p class="wiki-name">{{ category.name }}</p>
                        </div>
                    </div>
                </a>
            </li>
        </div>
    `,
    data() {
        return {
            loading: true,
            categories: [],
        }
    },
    mounted() {
        var that = this;
        $.ajax({
            url: laroute.action('api.teams.categories', { team_slug: this.team, }),
            type: 'GET',
            dataType: 'json',
            success(data) {
                setTimeout(function() {
                    that.categories = data;
                    that.loading = false;
                }, 1500);
            },
        });
    },
    methods: {
        isCategoryActive(category) {
            return (this.category === category.slug) ? true : false;
        },
        getBackgroundColor(text) {
            let colorHash = new ColorHash();
            return colorHash.hex(text);
        },
        getCategoryUrl(category) {
            return laroute.action('categories.wikis', { team_slug: category.team.slug, category_slug: category.slug });
        }
    }
});

Vue.component('wikis-list', {
    props: ['team', 'category'],
    template: `
        <div class="list-group">
            <a :href="getWikiUrl(wiki)" class="list-group-item wikis-list-item" v-for="wiki of wikis">
                <div class="media">
                    <div class="pull-left">
                        <img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="34" height="34">
                    </div>
                    <div class="media-body">
                        <div class="wiki-top">
                            <h4 class="media-heading">{{wiki.name}}</h4>
                            <div class="item-category-label" :style="{ 'background-color': getBackgroundColor(wiki.category.name) }">{{ wiki.category.name }}</div>
                        </div>
                        <div class="wiki-item-heading-bottom">
                            <i class="fa fa-refresh fa-fw"></i> Last updated by <object><a :href="getProfileUrl(wiki)" class="person-name">{{wiki.user.first_name + ' ' + wiki.user.last_name}}</a></object> about 2 hours ago
                        </div>
                        <p class="wiki-item-description">{{ wiki.outline }}</p>
                    </div>
                </div>  
            </a>
            <div class="text-center" style="margin-top: 30px;" v-show="loading"><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 35px;"></i></div>
            <div class="text-center" style="margin-top: 20px;">
                <button type="button" class="btn btn-default" v-on:click="loadWikis" v-show="hasMoreWikis">Load More</button>
            </div>
        </div>
    `,
    data() {
        return {
            loading: true,
            wikis: [],
            nextPageUrl: '',
            hasMoreWikis: false,
        }
    },
    mounted() {
        var that = this;
        $.ajax({
            url: laroute.action('api.teams.wikis', { team_slug: this.team }),
            type: 'GET',
            dataType: 'json',
            data: {
                category_slug: this.category
            },
            success(data) {
                setTimeout(function() {
                    that.wikis = data.data;
                    that.loading = false;
                    if(data.next_page_url != null) {
                        that.nextPage = data.next_page_url;
                        that.hasMoreWikis = true;
                    } else {
                        that.hasMoreWikis = false;
                    }
                }, 1500);
            },
        });
    },
    methods: {
        loadWikis() {
            var that = this;
            that.hasMoreWikis = false;
            that.loading = true;
            $.ajax({
                url: that.nextPage,
                type: 'GET',
                dataType: 'json',
                success(data) {
                    setTimeout(function() {
                        $(data.data).each(function(index, el) {
                            that.wikis.push(el);
                        });
                        that.loading = false;
                        if(data.next_page_url != null) {
                            that.nextPage = data.next_page_url;
                            that.lodaing = false;
                            that.hasMoreWikis = true;
                        } else {
                            that.hasMoreWikis = false;
                        }
                    }, 1500);
                },
            });
        },
        getBackgroundColor(text) {
            let colorHash = new ColorHash();
            return colorHash.hex(text);
        },
        getProfileUrl(wiki) {
            return laroute.action('users.show', { team_slug: wiki.team.slug, user_slug: wiki.user.slug });
        },
        getWikiUrl(wiki) {
            return laroute.action('wikis.show', { team_slug: wiki.team.slug, category_slug: wiki.category.slug, wiki_slug: wiki.slug });
        }
    }
});

new Vue({
    el: '#app',
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
        if($('#wiki-description').length) {

            CKEDITOR.replace('wiki-description', {
                width: "100%",
                height: $('#wiki-description').data('height'),
                enableTabKeyTools: true,
                removePlugins: 'elementspath',
                extraPlugins: 'codesnippet',
                codeSnippet_theme: 'github',
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
                    { name: 'justify2', items: ['CodeSnippet', 'Source', 'Maximize', '-', 'Undo', 'Redo'] },
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
        var organizationSlug = $('#wiki-page-tree').data('organization-slug');
        var categorySlug = $('#wiki-page-tree').data('category-slug');

        $('#wiki-page-tree').jstree({
            core: {
                "check_callback" : true,
                "animation" : 250,
                "themes" : {
                    'icons': false,
                    'dots' : false,
                    'responsive': true,
                    'variant': "large",
                },
                'data' : {
                    url: function (node) {
                        if($('#current-page-slug').length > 0) {
                            var opened_node = $('#current-page-slug').text();
                            $('#current-page-slug').remove();

                            return laroute.action('wikis.pages', { team_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, page_slug: opened_node, fetch_tree: true});
                        }

                        return (node.id === '#')
                                ? laroute.action('wikis.pages', { team_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, fetch: 'roots' })
                                : laroute.action('wikis.pages', { team_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug, page_slug: node.data.slug, fetch: 'children' });
                    },
                }
            },
            sort: function (a, b) {
                return moment(new Date(this.get_node(a).data.created_at)) > moment(new Date(this.get_node(b).data.created_at)) ? 1 : -1;
            },
            "plugins" : [ "sort", "wholerow", "dnd" ]
        }).on("select_node.jstree", function (e, data) {
            document.location = data.node.a_attr.href;
        }).on("ready.jstree", function(e, data) {
            $('#wiki-page-tree').css('margin-left', '-10px');
            if(data.instance._cnt == 0) {
                var html = `<p class="text-center text-muted" style="position: relative; top: -3px; max-width: 175px; margin: auto;">No pages yet. You can <a href="`+laroute.action('pages.create', { team_slug: organizationSlug, category_slug: categorySlug, wiki_slug: wikiSlug })+`" class="text-muted">create one here</a>.</p>`;
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