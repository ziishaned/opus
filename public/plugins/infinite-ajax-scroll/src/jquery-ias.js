/**
 * Infinite Ajax Scroll v2.2.2
 * A jQuery plugin for infinite scrolling
 * http://infiniteajaxscroll.com
 *
 * Commercial use requires one-time purchase of a commercial license
 * http://infiniteajaxscroll.com/docs/license.html
 *
 * Non-commercial use is licensed under the MIT License
 *
 * Copyright 2014-2016 Webcreate (Jeroen Fiege)
 */

(function($) {

  'use strict';

  var UNDETERMINED_SCROLLOFFSET = -1;

  var IAS = function($element, options) {
    this.itemsContainerSelector = options.container;
    this.itemSelector = options.item;
    this.nextSelector = options.next;
    this.paginationSelector = options.pagination;
    this.$scrollContainer = $element;
    this.$container = (window === $element.get(0) ? $(document) : $element);
    this.defaultDelay = options.delay;
    this.negativeMargin = options.negativeMargin;
    this.nextUrl = null;
    this.isBound = false;
    this.isPaused = false;
    this.isInitialized = false;
    this.jsXhr = false;
    this.listeners = {
      next:     new IASCallbacks($),
      load:     new IASCallbacks($),
      loaded:   new IASCallbacks($),
      render:   new IASCallbacks($),
      rendered: new IASCallbacks($),
      scroll:   new IASCallbacks($),
      noneLeft: new IASCallbacks($),
      ready:    new IASCallbacks($)
    };
    this.extensions = [];

    /**
     * Scroll event handler
     *
     * Note: calls to this functions should be throttled
     *
     * @private
     */
    this.scrollHandler = function() {
      // the throttle method can call the scrollHandler even thought we have called unbind()
      if (!this.isBound || this.isPaused) {
        return;
      }

      var currentScrollOffset = this.getCurrentScrollOffset(this.$scrollContainer),
          scrollThreshold = this.getScrollThreshold()
      ;

      // invalid scrollThreshold. The DOM might not have loaded yet...
      if (UNDETERMINED_SCROLLOFFSET == scrollThreshold) {
        return;
      }

      this.fire('scroll', [currentScrollOffset, scrollThreshold]);

      if (currentScrollOffset >= scrollThreshold) {
        this.next();
      }
    };

    /**
     * Returns the items container currently in the DOM
     *
     * @private
     * @returns {object}
     */
    this.getItemsContainer = function() {
      return $(this.itemsContainerSelector, this.$container);
    };

    /**
     * Returns the last item currently in the DOM
     *
     * @private
     * @returns {object}
     */
    this.getLastItem = function() {
      return $(this.itemSelector, this.getItemsContainer().get(0)).last();
    };

    /**
     * Returns the first item currently in the DOM
     *
     * @private
     * @returns {object}
     */
    this.getFirstItem = function() {
      return $(this.itemSelector, this.getItemsContainer().get(0)).first();
    };

    /**
     * Returns scroll threshold. This threshold marks the line from where
     * IAS should start loading the next page.
     *
     * @private
     * @param negativeMargin defaults to {this.negativeMargin}
     * @return {number}
     */
    this.getScrollThreshold = function(negativeMargin) {
      var $lastElement;

      negativeMargin = negativeMargin || this.negativeMargin;
      negativeMargin = (negativeMargin >= 0 ? negativeMargin * -1 : negativeMargin);

      $lastElement = this.getLastItem();

      // if the don't have a last element, the DOM might not have been loaded,
      // or the selector is invalid
      if (0 === $lastElement.length) {
        return UNDETERMINED_SCROLLOFFSET;
      }

      return ($lastElement.offset().top + $lastElement.height() + negativeMargin);
    };

    /**
     * Returns current scroll offset for the given scroll container
     *
     * @private
     * @param $container
     * @returns {number}
     */
    this.getCurrentScrollOffset = function($container) {
      var scrollTop = 0,
          containerHeight = $container.height();

      if (window === $container.get(0))  {
        scrollTop = $container.scrollTop();
      } else {
        scrollTop = $container.offset().top;
      }

      // compensate for iPhone
      if (navigator.platform.indexOf("iPhone") != -1 || navigator.platform.indexOf("iPod") != -1) {
        containerHeight += 80;
      }

      return (scrollTop + containerHeight);
    };

    /**
     * Returns the url for the next page
     *
     * @private
     */
    this.getNextUrl = function(container) {
      container = container || this.$container;

      // always take the last matching item
      return $(this.nextSelector, container).last().attr('href');
    };

    /**
     * Loads a page url
     *
     * @param url
     * @param callback
     * @param delay
     * @returns {object}        jsXhr object
     */
    this.load = function(url, callback, delay) {
      var self = this,
          $itemContainer,
          items = [],
          timeStart = +new Date(),
          timeDiff;

      delay = delay || this.defaultDelay;

      var loadEvent = {
        url: url
      };

      self.fire('load', [loadEvent]);

      this.jsXhr = $.get(loadEvent.url, null, $.proxy(function(data) {
        $itemContainer = $(this.itemsContainerSelector, data).eq(0);
        if (0 === $itemContainer.length) {
          $itemContainer = $(data).filter(this.itemsContainerSelector).eq(0);
        }

        if ($itemContainer) {
          $itemContainer.find(this.itemSelector).each(function() {
            items.push(this);
          });
        }

        self.fire('loaded', [data, items]);

        if (callback) {
          timeDiff = +new Date() - timeStart;
          if (timeDiff < delay) {
            setTimeout(function() {
              callback.call(self, data, items);
            }, delay - timeDiff);
          } else {
            callback.call(self, data, items);
          }
        }
      }, self), 'html');

      return this.jsXhr;
    };

    /**
     * Renders items
     *
     * @param callback
     * @param items
     */
    this.render = function(items, callback) {
      var self = this,
          $lastItem = this.getLastItem(),
          count = 0;

      var promise = this.fire('render', [items]);

      promise.done(function() {
        $(items).hide(); // at first, hide it so we can fade it in later

        $lastItem.after(items);

        $(items).fadeIn(400, function() {
          // complete callback get fired for each item,
          // only act on the last item
          if (++count < items.length) {
            return;
          }

          self.fire('rendered', [items]);

          if (callback) {
            callback();
          }
        });
      });

      promise.fail(function() {
        if (callback) {
          callback();
        }
      });
    };

    /**
     * Hides the pagination
     */
    this.hidePagination = function() {
      if (this.paginationSelector) {
        $(this.paginationSelector, this.$container).hide();
      }
    };

    /**
     * Restores the pagination
     */
    this.restorePagination = function() {
      if (this.paginationSelector) {
        $(this.paginationSelector, this.$container).show();
      }
    };

    /**
     * Throttles a method
     *
     * Adopted from Ben Alman's jQuery throttle / debounce plugin
     *
     * @param callback
     * @param delay
     * @return {object}
     */
    this.throttle = function(callback, delay) {
      var lastExecutionTime = 0,
          wrapper,
          timerId
      ;

      wrapper = function() {
        var that = this,
            args = arguments,
            diff = +new Date() - lastExecutionTime;

        function execute() {
          lastExecutionTime = +new Date();
          callback.apply(that, args);
        }

        if (!timerId) {
          execute();
        } else {
          clearTimeout(timerId);
        }

        if (diff > delay) {
          execute();
        } else {
          timerId = setTimeout(execute, delay);
        }
      };

      if ($.guid) {
        wrapper.guid = callback.guid = callback.guid || $.guid++;
      }

      return wrapper;
    };

    /**
     * Fires an event with the ability to cancel further processing. This
     * can be achieved by returning false in a listener.
     *
     * @param event
     * @param args
     * @returns {*}
     */
    this.fire = function(event, args) {
      return this.listeners[event].fireWith(this, args);
    };

    /**
     * Pauses the scroll handler
     *
     * Note: internal use only, if you need to pause IAS use `unbind` method.
     *
     * @private
     */
    this.pause = function() {
      this.isPaused = true;
    };

    /**
     * Resumes the scroll handler
     *
     * Note: internal use only, if you need to resume IAS use `bind` method.
     *
     * @private
     */
    this.resume = function() {
      this.isPaused = false;
    };

    return this;
  };

  /**
   * Initialize IAS
   *
   * Note: Should be called when the document is ready
   *
   * @public
   */
  IAS.prototype.initialize = function() {
    if (this.isInitialized) {
      return false;
    }

    var supportsOnScroll = (!!('onscroll' in this.$scrollContainer.get(0))),
        currentScrollOffset = this.getCurrentScrollOffset(this.$scrollContainer),
        scrollThreshold = this.getScrollThreshold();

    // bail out when the browser doesn't support the scroll event
    if (!supportsOnScroll) {
      return false;
    }

    this.hidePagination();
    this.bind();

    this.fire('ready');

    this.nextUrl = this.getNextUrl();

    // start loading next page if content is shorter than page fold
    if (currentScrollOffset >= scrollThreshold) {
      this.next();

      // flag as initialized when rendering is completed
      this.one('rendered', function() {
        this.isInitialized = true;
      });
    } else {
      this.isInitialized = true;
    }

    return this;
  };

  /**
   * Reinitializes IAS, for example after an ajax page update
   *
   * @public
   */
  IAS.prototype.reinitialize = function () {
    this.isInitialized = false;

    this.unbind();
    this.initialize();
  };

  /**
   * Binds IAS to DOM events
   *
   * @public
   */
  IAS.prototype.bind = function() {
    if (this.isBound) {
      return;
    }

    this.$scrollContainer.on('scroll', $.proxy(this.throttle(this.scrollHandler, 150), this));

    for (var i = 0, l = this.extensions.length; i < l; i++) {
      this.extensions[i].bind(this);
    }

    this.isBound = true;
    this.resume();
  };

  /**
   * Unbinds IAS to events
   *
   * @public
   */
  IAS.prototype.unbind = function() {
    if (!this.isBound) {
      return;
    }

    this.$scrollContainer.off('scroll', this.scrollHandler);

    // notify extensions about unbinding
    for (var i = 0, l = this.extensions.length; i < l; i++) {
      if (typeof this.extensions[i]['unbind'] != 'undefined') {
        this.extensions[i].unbind(this);
      }
    }

    this.isBound = false;
  };

  /**
   * Destroys IAS instance
   *
   * @public
   */
  IAS.prototype.destroy = function() {
    try {
      this.jsXhr.abort();
    } catch (e) {}

    this.unbind();

    this.$scrollContainer.data('ias', null);
  };

  /**
   * Registers an eventListener
   *
   * Note: chainable
   *
   * @public
   * @returns IAS
   */
  IAS.prototype.on = function(event, callback, priority) {
    if (typeof this.listeners[event] == 'undefined') {
      throw new Error('There is no event called "' + event + '"');
    }

    priority = priority || 0;

    this.listeners[event].add($.proxy(callback, this), priority);

    return this;
  };

  /**
   * Registers an eventListener which only gets
   * fired once.
   *
   * Note: chainable
   *
   * @public
   * @returns IAS
   */
  IAS.prototype.one = function(event, callback) {
    var self = this;

    var remover = function() {
      self.off(event, callback);
      self.off(event, remover);
    };

    this.on(event, callback);
    this.on(event, remover);

    return this;
  };

  /**
   * Removes an eventListener
   *
   * Note: chainable
   *
   * @public
   * @returns IAS
   */
  IAS.prototype.off = function(event, callback) {
    if (typeof this.listeners[event] == 'undefined') {
      throw new Error('There is no event called "' + event + '"');
    }

    this.listeners[event].remove(callback);

    return this;
  };

  /**
   * Load the next page
   *
   * @public
   */
  IAS.prototype.next = function() {
    var url = this.nextUrl,
        self = this;

    this.pause();

    if (!url) {
      this.fire('noneLeft', [this.getLastItem()]);
      this.listeners['noneLeft'].disable(); // disable it so it only fires once

      self.resume();

      return false;
    }

    var promise = this.fire('next', [url]);

    promise.done(function() {
      self.load(url, function(data, items) {
        self.render(items, function() {
          self.nextUrl = self.getNextUrl(data);

          self.resume();
        });
      });
    });

    promise.fail(function() {
      self.resume();
    });

    return true;
  };

  /**
   * Adds an extension
   *
   * @public
   */
  IAS.prototype.extension = function(extension) {
    if (typeof extension['bind'] == 'undefined') {
      throw new Error('Extension doesn\'t have required method "bind"');
    }

    if (typeof extension['initialize'] != 'undefined') {
      extension.initialize(this);
    }

    this.extensions.push(extension);

    if (this.isInitialized) {
      this.reinitialize();
    }

    return this;
  };

  /**
   * Shortcut. Sets the window as scroll container.
   *
   * @public
   * @param option
   * @returns {*}
   */
  $.ias = function(option) {
    var $window = $(window);

    return $window.ias.apply($window, arguments);
  };

  /**
   * jQuery plugin initialization
   *
   * @public
   * @param option
   * @returns {*} the last IAS instance will be returned
   */
  $.fn.ias = function(option) {
    var args = Array.prototype.slice.call(arguments);
    var retval = this;

    this.each(function() {
      var $this = $(this),
          instance = $this.data('ias'),
          options = $.extend({}, $.fn.ias.defaults, $this.data(), typeof option == 'object' && option)
          ;

      // set a new instance as data
      if (!instance) {
        $this.data('ias', (instance = new IAS($this, options)));

        $(document).ready($.proxy(instance.initialize, instance));
      }

      // when the plugin is called with a method
      if (typeof option === 'string') {
        if (typeof instance[option] !== 'function') {
          throw new Error('There is no method called "' + option + '"');
        }

        args.shift(); // remove first argument ('option')
        instance[option].apply(instance, args);
      }

      retval = instance;
    });

    return retval;
  };

  /**
   * Plugin defaults
   *
   * @public
   * @type {object}
   */
  $.fn.ias.defaults = {
    item: '.item',
    container: '.listing',
    next: '.next',
    pagination: false,
    delay: 600,
    negativeMargin: 10
  };
})(jQuery);
