Infinite AJAX Scroll
====================

A jQuery plugin to turn your paginated pages into infinite scrolling pages with ease.

Downloads, documentation and demos available at: http://infiniteajaxscroll.com/

[![Build Status](https://travis-ci.org/webcreate/infinite-ajax-scroll.png?branch=master)](https://travis-ci.org/webcreate/infinite-ajax-scroll)

## Licensing

Infinite AJAX Scroll may be used in commercial projects and applications with the one-time purchase of a commercial license.

http://infiniteajaxscroll.com/docs/license.html

For non-commercial, personal, or open source projects and applications, you may use Infinite AJAX Scroll under the terms of the MIT License. You may use Infinite AJAX Scroll for free.

## Contributing

To contribute to Infinite AJAX Scroll please follow these instructions:

* Fork the project and create a new feature branch
* Install the development tools
* Write the feature/bugfix
* Write tests for the feature/bugfix
* Run tests
* Submit your Pull Request

### Installing development tools

1. Install bower components

    ``` sh
    $ bower install
    ```

2. Install npm modules

    ``` sh
    $ npm install
    ```

### Running tests

Testing is done with [Busterjs](https://github.com/busterjs/buster) and [Grunt](https://github.com/gruntjs/grunt).

1. Start a buster server:

    ``` sh
    $ grunt buster::server:block
    ```

2. Launch some browsers and connect to `http://localhost:1111` and capture them.

3. Run tests:

    ``` sh
    $ grunt buster::test
    ```
