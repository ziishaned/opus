Changelog
=========

## 2.2.2

* Fix: render callback is not executed when using a custom render function (fixes #198)
* Fix: unpredictable behaviour when multiple instances used the same selectors for sub-elements (fixes #93)
* Stop ajax responder if instance was destroyed or reinitialized

## 2.2.1

* Fix: prevent multiple initialisations causing duplicate items (fixes #175, #183)

## 2.2.0

* Improved documentation on delay and negativeMargin options
* Added FAQ to support documentation
* Added Wordpress cookbook
* Fix: Maintain history state object when changing pages (longzheng)
* Fix: no longer caching $itemsContainer (fixes #153)
* Fix: really destroy instance on destroy method (fixes #160)
* Fix: Replaced deprecated size() with .length (fixes #162)
* Fix: Reworked binding and unbinding (fixes various issues with unbinding)
* Fix: Bail out when device doesn't support onScroll event (like Opera Mini) (fixes #146 by fflewddur)
* Added reinitialize method

## 2.1.3

* Bug #152 Improve compatibility support when Prototype is used along with jQuery (antoinekociuba)
* Added docs

## 2.1.2

* Added `htmlPrev` and `textPrev` options to IASTriggerExtension

## 2.1.1

* Changed argument of `load` event from url to event object
* Fixed `prev()` return value

## 2.1.0

* Added History extension
* Added `ready` event
* Added `loaded` event (`load` is now triggered before loading starts)
* Added `rendered` event (`render` is now triggered before rendering starts)
* Added priority to callbacks
* Added `initialize` call for extensions
* Added `one` method

## 2.0.0

* Completely rewritten
* Extensible through extensions
* Extensible through events
* Added an extensive test suite
