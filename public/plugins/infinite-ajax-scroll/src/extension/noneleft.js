/**
 * IAS None Left Extension
 * An IAS extension to show a message when there are no more pages te load
 * http://infiniteajaxscroll.com
 *
 * This file is part of the Infinite AJAX Scroll package
 *
 * Copyright 2014-2016 Webcreate (Jeroen Fiege)
 */

var IASNoneLeftExtension = function(options) {
  options = jQuery.extend({}, this.defaults, options);

  this.ias = null;
  this.uid = (new Date()).getTime();
  this.html = (options.html).replace('{text}', options.text);

  /**
   * Shows none left message
   */
  this.showNoneLeft = function() {
    var $element = jQuery(this.html).attr('id', 'ias_noneleft_' + this.uid),
        $lastItem = this.ias.getLastItem();

    $lastItem.after($element);
    $element.fadeIn();
  };

  return this;
};

/**
 * @public
 */
IASNoneLeftExtension.prototype.bind = function(ias) {
  this.ias = ias;

  ias.on('noneLeft', jQuery.proxy(this.showNoneLeft, this));
};

/**
 * @public
 * @param {object} ias
 */
IASNoneLeftExtension.prototype.unbind = function(ias) {
  ias.off('noneLeft', this.showNoneLeft);
};

/**
 * @public
 */
IASNoneLeftExtension.prototype.defaults = {
  text: 'You reached the end.',
  html: '<div class="ias-noneleft" style="text-align: center;">{text}</div>'
};
