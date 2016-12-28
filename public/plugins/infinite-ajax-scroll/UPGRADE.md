Upgrade from 2.1 to 2.2
=======================

Specific changes for extensions.

* `extension.bind` is now called during `bind` instead of `initialize`
* `extension.unbind` is added and called during `unbind`

Upgrade from 2.0 to 2.1
=======================

* `render` is now triggered before rendering, use `rendered` when rendering is complete
* `load` is now triggered before loading, use `loaded` when loading is complete

Upgrade from 1.x to 2.0
=======================

* `thresholdMargin` option has been replaced with `negativeMargin`
* `loaderDelay` option has been replaced with `delay`
* `trigger` option has been replaced by the IASTriggerExtensions' `text` option
* `loader` option has been replaced by the IASSpinnerExtensions' `html` option
* `noneleft` option has been replaced by the IASNoneLeftExtensions' `text` option
* `scrollContainer` option has been removed. You can now do: `$('<scrollContainer>').ias({...})`
* `onPageChange` option has been replaced by the IASPagingExtensions' `pageChange` event
* `onLoadItems` option has been replaced by the `load` event
* `onRenderComplete` option has been replaced by the `render` event
* `onScroll` option has been replaced by the `scroll` event
* `customLoaderProc` option has been replaced by the IASSpinnerExtensions `html` option
* `customTriggerProc` option has been replaced by the IASTriggerExtensions `html` option
