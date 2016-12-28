Paging Extension
================

The paging extension adds extra functionality to Infinite AJAX Scroll.

* Tracking of pages
* A new event `pageChange`

This extension is bundled with IAS as a core extension.

## Usage

After [you initialized IAS](getting-started.html#javascript) you can register the extension:

```javascript
jQuery.ias().extension(new IASPagingExtension());
```

## Events

### pageChange

| argument     | type   | description                                       |
|--------------|--------|---------------------------------------------------|
| pageNum      | number | page number the user scrolled to (first page = 1) |
| scrollOffset | number | scroll offset at which the page starts            |
| url          | string | url of the page                                   |

Triggered when a used scroll to another page.

## Example

```javascript
jQuery.ias().on('pageChange', function(pageNum, scrollOffset, url) {
    console.log(
        "Welcome at page " + pageNum + ", " +
        "the original url of this page would be: " + url
    );
});
```
