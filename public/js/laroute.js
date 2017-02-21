(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\UserController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\HomeController@home"},{"host":null,"methods":["GET","HEAD"],"uri":"team\/login","name":"team.login","action":"App\Http\Controllers\TeamController@login"},{"host":null,"methods":["POST"],"uri":"team\/login","name":"team.postlogin","action":"App\Http\Controllers\TeamController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"team\/create","name":"team.create","action":"App\Http\Controllers\TeamController@create"},{"host":null,"methods":["POST"],"uri":"team\/create","name":"team.store","action":"App\Http\Controllers\TeamController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"team\/join","name":"team.join","action":"App\Http\Controllers\TeamController@join"},{"host":null,"methods":["POST"],"uri":"team\/join","name":"team.postjoin","action":"App\Http\Controllers\TeamController@postJoin"},{"host":null,"methods":["GET","HEAD"],"uri":"get-pages","name":"wikis.pages","action":"App\Http\Controllers\WikiController@getWikiPages"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/teams\/{team_slug}\/wikis","name":"api.teams.wikis","action":"App\Http\Controllers\WikiController@getTeamWikis"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/teams\/{team_slug}\/categories","name":"api.teams.categories","action":"App\Http\Controllers\CategoryConroller@getTeamCategories"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/users\/{user_slug}\/settings\/profile","name":"settings.profile","action":"App\Http\Controllers\UserController@profileSettings"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/users\/{user_slug}\/settings\/account","name":"settings.account","action":"App\Http\Controllers\UserController@accountSettings"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/settings\/general","name":"teams.settings.general","action":"App\Http\Controllers\TeamController@generalSettings"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/settings\/members","name":"teams.settings.members","action":"App\Http\Controllers\TeamController@membersSettings"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/users\/activity","name":null,"action":"App\Http\Controllers\UserController@activity"},{"host":null,"methods":["DELETE"],"uri":"teams\/{team_slug}\/users\/{user_slug}","name":"users.destroy","action":"App\Http\Controllers\UserController@deleteAccount"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_slug}\/users\/{user_slug}\/password","name":"users.password.update","action":"App\Http\Controllers\UserController@updatePassword"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/users\/{user_slug}\/readlist","name":"users.readlist","action":"App\Http\Controllers\UserController@getReadList"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/users\/{user_slug}","name":"users.show","action":"App\Http\Controllers\UserController@show"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_slug}\/users\/{user_slug}","name":"users.update","action":"App\Http\Controllers\UserController@update"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/users\/avatar\/store","name":null,"action":"App\Http\Controllers\UserController@storeAvatar"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/users\/avatar\/crop","name":null,"action":"App\Http\Controllers\UserController@cropAvatar"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories","name":"categories.create","action":"App\Http\Controllers\CategoryConroller@create"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/categories","name":"categories.store","action":"App\Http\Controllers\CategoryConroller@store"},{"host":null,"methods":["DELETE"],"uri":"teams\/{team_slug}\/categories\/{category_slug}","name":"teams.categories.destroy","action":"App\Http\Controllers\CategoryConroller@destroy"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_slug}\/categories\/{category_slug}","name":"teams.categories.update","action":"App\Http\Controllers\CategoryConroller@update"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis","name":"categories.wikis","action":"App\Http\Controllers\CategoryConroller@getCategoryWikis"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/members","name":"teams.members","action":"App\Http\Controllers\TeamController@getMembers"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/invite","name":"invite.users","action":"App\Http\Controllers\TeamController@inviteUsers"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}","name":"dashboard","action":"App\Http\Controllers\UserController@dashboard"},{"host":null,"methods":["DELETE"],"uri":"teams\/{id}","name":"teams.destroy","action":"App\Http\Controllers\TeamController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/wiki","name":"teams.wiki.create","action":"App\Http\Controllers\WikiController@create"},{"host":null,"methods":["POST"],"uri":"teams\/{team_id}\/wikis\/{wiki_id}\/pages\/reorder","name":null,"action":"App\Http\Controllers\PageController@reorder"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_id}\/wikis\/{wiki_id}\/pages\/{page_id}\/comments\/{comment_id}","name":"comments.update","action":"App\Http\Controllers\CommentController@update"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/wikis","name":"wikis.store","action":"App\Http\Controllers\WikiController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/wikis\/create","name":"wikis.create","action":"App\Http\Controllers\WikiController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/wikis","name":"teams.wikis","action":"App\Http\Controllers\WikiController@getWikis"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.update","action":"App\Http\Controllers\WikiController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.show","action":"App\Http\Controllers\WikiController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/overview","name":"wikis.overview","action":"App\Http\Controllers\WikiController@overview"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/permissions","name":"wikis.permissions","action":"App\Http\Controllers\WikiController@permissions"},{"host":null,"methods":["DELETE"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}","name":"wikis.destroy","action":"App\Http\Controllers\WikiController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/reorder","name":"pages.reorder","action":"App\Http\Controllers\PageController@pagesReorder"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/create","name":"pages.create","action":"App\Http\Controllers\PageController@create"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.show","action":"App\Http\Controllers\PageController@show"},{"host":null,"methods":["DELETE"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.destroy","action":"App\Http\Controllers\PageController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/edit","name":"pages.edit","action":"App\Http\Controllers\PageController@edit"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages","name":"pages.store","action":"App\Http\Controllers\PageController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/edit","name":"wikis.edit","action":"App\Http\Controllers\WikiController@edit"},{"host":null,"methods":["PATCH"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}","name":"pages.update","action":"App\Http\Controllers\PageController@update"},{"host":null,"methods":["POST"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/comments","name":"comments.store","action":"App\Http\Controllers\CommentController@store"},{"host":null,"methods":["DELETE"],"uri":"teams\/{team_slug}\/categories\/{category_slug}\/wikis\/{wiki_slug}\/pages\/{page_slug}\/{comment_id}","name":"comments.delete","action":"App\Http\Controllers\CommentController@destroy"}],
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

