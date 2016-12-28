/**
 * IAS Paging Extension
 * An IAS extension providing additional events
 * http://infiniteajaxscroll.com
 *
 * This file is part of the Infinite AJAX Scroll package
 *
 * Copyright 2014-2016 Webcreate (Jeroen Fiege)
 */

var IASPagingExtension = function() {
  this.ias = null;
  this.pagebreaks = [[0, document.location.toString()]];
  this.lastPageNum = 1;
  this.enabled = true;
  this.listeners = {
    pageChange: new IASCallbacks()
  };

  /**
   * Fires pageChange event
   *
   * @param currentScrollOffset
   * @param scrollThreshold
   */
  this.onScroll = function(currentScrollOffset, scrollThreshold) {
    if (!this.enabled) {
      return;
    }

    var ias = this.ias,
        currentPageNum = this.getCurrentPageNum(currentScrollOffset),
        currentPagebreak = this.getCurrentPagebreak(currentScrollOffset),
        urlPage;

    if (this.lastPageNum !== currentPageNum) {
      urlPage = currentPagebreak[1];

      ias.fire('pageChange', [currentPageNum, currentScrollOffset, urlPage]);
    }

    this.lastPageNum = currentPageNum;
  };

  /**
   * Keeps track of pagebreaks
   *
   * @param url
   */
  this.onNext = function(url) {
    var currentScrollOffset = this.ias.getCurrentScrollOffset(this.ias.$scrollContainer);

    this.pagebreaks.push([currentScrollOffset, url]);

    // trigger pageChange and update lastPageNum
    var currentPageNum = this.getCurrentPageNum(currentScrollOffset) + 1;

    this.ias.fire('pageChange', [currentPageNum, currentScrollOffset, url]);

    this.lastPageNum = currentPageNum;
  };

  /**
   * Keeps track of pagebreaks
   *
   * @param url
   */
  this.onPrev = function(url) {
    var self = this,
        ias = self.ias,
        currentScrollOffset = ias.getCurrentScrollOffset(ias.$scrollContainer),
        prevCurrentScrollOffset = currentScrollOffset - ias.$scrollContainer.height(),
        $firstItem = ias.getFirstItem();

    this.enabled = false;

    this.pagebreaks.unshift([0, url]);

    ias.one('rendered', function() {
      // update pagebreaks
      for (var i = 1, l = self.pagebreaks.length; i < l; i++) {
        self.pagebreaks[i][0] = self.pagebreaks[i][0] + $firstItem.offset().top;
      }

      // trigger pageChange and update lastPageNum
      var currentPageNum = self.getCurrentPageNum(prevCurrentScrollOffset) + 1;

      ias.fire('pageChange', [currentPageNum, prevCurrentScrollOffset, url]);

      self.lastPageNum = currentPageNum;

      self.enabled = true;
    });
  };

  return this;
};

/**
 * @public
 */
IASPagingExtension.prototype.initialize = function(ias) {
  this.ias = ias;

  // expose the extensions listeners
  jQuery.extend(ias.listeners, this.listeners);
};

/**
 * @public
 */
IASPagingExtension.prototype.bind = function(ias) {
  try {
    ias.on('prev', jQuery.proxy(this.onPrev, this), this.priority);
  } catch (exception) {}

  ias.on('next', jQuery.proxy(this.onNext, this), this.priority);
  ias.on('scroll', jQuery.proxy(this.onScroll, this), this.priority);
};

/**
 * @public
 * @param {object} ias
 */
IASPagingExtension.prototype.unbind = function(ias) {
  try {
    ias.off('prev', this.onPrev);
  } catch (exception) {}

  ias.off('next', this.onNext);
  ias.off('scroll', this.onScroll);
};

/**
 * Returns current page number based on scroll offset
 *
 * @param {number} scrollOffset
 * @returns {number}
 */
IASPagingExtension.prototype.getCurrentPageNum = function(scrollOffset) {
  for (var i = (this.pagebreaks.length - 1); i > 0; i--) {
    if (scrollOffset > this.pagebreaks[i][0]) {
      return i + 1;
    }
  }

  return 1;
};

/**
 * Returns current pagebreak information based on scroll offset
 *
 * @param {number} scrollOffset
 * @returns {number}|null
 */
IASPagingExtension.prototype.getCurrentPagebreak = function(scrollOffset) {
  for (var i = (this.pagebreaks.length - 1); i >= 0; i--) {
    if (scrollOffset > this.pagebreaks[i][0]) {
      return this.pagebreaks[i];
    }
  }

  return null;
};

/**
 * @public
 * @type {number}
 */
IASPagingExtension.prototype.priority = 500;
