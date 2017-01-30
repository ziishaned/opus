(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"\App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\HomeController@home"},{"host":null,"methods":["GET","HEAD"],"uri":"get-pages","name":"wikis.pages","action":"App\Http\Controllers\WikiController@getWikiPages"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/users\/activity","name":null,"action":"App\Http\Controllers\UserController@activity"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}","name":"users.destroy","action":"App\Http\Controllers\UserController@deleteAccount"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/users\/search\/{text}","name":null,"action":"App\Http\Controllers\UserController@filterUser"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}\/password","name":"users.password.update","action":"App\Http\Controllers\UserController@updatePassword"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}","name":"users.show","action":"App\Http\Controllers\UserController@show"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}","name":"users.update","action":"App\Http\Controllers\UserController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}\/organizations","name":"users.organizations","action":"App\Http\Controllers\UserController@getOrganizationsView"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/users\/{user_slug}\/wikis","name":"users.wikis","action":"App\Http\Controllers\UserController@wikis"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/users\/avatar\/store","name":null,"action":"App\Http\Controllers\UserController@storeAvatar"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/users\/avatar\/crop","name":null,"action":"App\Http\Controllers\UserController@cropAvatar"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/settings\/profile","name":"settings.profile","action":"App\Http\Controllers\UserController@profileSettings"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/settings\/account","name":"settings.account","action":"App\Http\Controllers\UserController@accountSettings"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/categories","name":"organizations.categories.store","action":"App\Http\Controllers\CategoryConroller@store"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}","name":"organizations.categories.destroy","action":"App\Http\Controllers\CategoryConroller@destroy"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}","name":"organizations.categories.update","action":"App\Http\Controllers\CategoryConroller@update"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis","name":"categories.wikis","action":"App\Http\Controllers\CategoryConroller@getCategoryWikis"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/reports","name":"organizations.reports.index","action":"App\Http\Controllers\ReportConroller@index"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/members","name":"organizations.members","action":"App\Http\Controllers\OrganizationController@getMembers"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/invite","name":"invite.users","action":"App\Http\Controllers\OrganizationController@inviteUsers"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}","name":"dashboard","action":"App\Http\Controllers\OrganizationController@getActivity"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/activity","name":"dashboard","action":"App\Http\Controllers\OrganizationController@getActivity"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/activity\/user","name":"dashboard.user.activity","action":"App\Http\Controllers\OrganizationController@getUserActivity"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories","name":"organizations.categories","action":"App\Http\Controllers\OrganizationController@getCategories"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/wikis\/user-contributions","name":"organizations.wikis.user-contributions","action":"App\Http\Controllers\OrganizationController@getUserContributedWikis"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{id}","name":"organizations.destroy","action":"App\Http\Controllers\OrganizationController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/wiki","name":"organizations.wiki.create","action":"App\Http\Controllers\WikiController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/search\/{text}","name":null,"action":"App\Http\Controllers\OrganizationController@filterOrganizations"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_id}\/wikis\/{wiki_id}\/pages\/reorder","name":null,"action":"App\Http\Controllers\PageController@reorder"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_id}\/wikis\/{wiki_id}\/pages\/{page_id}\/comments\/{comment_id}","name":"comments.update","action":"App\Http\Controllers\CommentController@update"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/wikis","name":"wikis.store","action":"App\Http\Controllers\WikiController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/wikis\/create","name":"organizations.wikis.create","action":"App\Http\Controllers\WikiController@create"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.update","action":"App\Http\Controllers\WikiController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.show","action":"App\Http\Controllers\WikiController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/overview","name":"wikis.overview","action":"App\Http\Controllers\WikiController@overview"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/permissions","name":"wikis.permissions","action":"App\Http\Controllers\WikiController@permissions"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.destroy","action":"App\Http\Controllers\WikiController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/reorder","name":"pages.reorder","action":"App\Http\Controllers\PageController@pagesReorder"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/create","name":"pages.create","action":"App\Http\Controllers\PageController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.show","action":"App\Http\Controllers\PageController@show"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.destroy","action":"App\Http\Controllers\PageController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/edit","name":"pages.edit","action":"App\Http\Controllers\PageController@edit"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages","name":"pages.store","action":"App\Http\Controllers\PageController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/edit","name":"wikis.edit","action":"App\Http\Controllers\WikiController@edit"},{"host":null,"methods":["PATCH"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.update","action":"App\Http\Controllers\PageController@update"},{"host":null,"methods":["POST"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/comments","name":"comments.store","action":"App\Http\Controllers\CommentController@store"},{"host":null,"methods":["DELETE"],"uri":"organizations\/{organization_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/{comment_id}","name":"comments.delete","action":"App\Http\Controllers\CommentController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/signin\/{step}","name":"organizations.signin","action":"App\Http\Controllers\OrganizationController@signin"},{"host":null,"methods":["POST"],"uri":"organizations\/signin\/{step}","name":"organizations.postsignin","action":"App\Http\Controllers\OrganizationController@postSignin"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/create\/{step}","name":"organizations.create","action":"App\Http\Controllers\OrganizationController@create"},{"host":null,"methods":["POST"],"uri":"organizations\/create\/{step}","name":"organizations.store","action":"App\Http\Controllers\OrganizationController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"organizations\/join\/{step}","name":"organizations.join","action":"App\Http\Controllers\OrganizationController@join"},{"host":null,"methods":["POST"],"uri":"organizations\/join\/{step}","name":"organizations.postjoin","action":"App\Http\Controllers\OrganizationController@postJoin"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

