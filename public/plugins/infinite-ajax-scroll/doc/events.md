Events
======

### scroll

| argument        | type    | description                                                                                |
|-----------------|---------|----------------------------------------------------------------------------------|
| scrollOffset    | integer | current number of pixels scrolled from the top                                   |
| scrollThreshold | integer | threshold which marks the line from where IAS should start loading the next page |

Triggered when a visitor scrolls.

### load

| argument  | type   | description |
|-----------|--------|-------------|
| event     | object | load event  |

Triggered when a new page is about to be loaded from the server.

The load event object contains the following properties.

| property  | type          | description             |
|-----------|---------------|-------------------------|
| event.url | string        | url that will be loaded |

Using this event it is possible to change the requested url. This can be useful to append an arbitrary parameter to the requested url so the server can handle the request differently. For example to optimize the returned html by stripping everything outside the container element (header, footer, etc.).

```javascript
ias.on('load', function(event) {
    event.url = event.url + "?ajax=1";
})
```

### loaded

| argument | type   | description             |
|----------|--------|-------------------------|
| data     | string | html of the loaded page |
| items    | array  | elements                |

Triggered after a new page was loaded from the server.

```javascript
ias.on('loaded', function(data, items) {
    var $items = $(items);

    console.log('Loaded ' + $items.length + ' items from server');
})
```

### render

| argument | type  | description                                  |
|----------|-------|----------------------------------------------|
| items    | array | elements to be rendered                      |

Triggered before new items will be rendered.

By returning `false` from your callback you can prevent the items from being rendered. For example:

```javascript
ias.on('render', function(items) {
    var $items = $(items);

    do_some_special_rendering($items);

    return false;
})
```

### rendered

| argument | type  | description                                  |
|----------|-------|----------------------------------------------|
| items    | array | items to be rendered                         |

Triggered after new items have rendered.

This can be useful when you have a javascript function that normally performs some actions on the items in the `$(document).ready` event. When loading items from a new page using IAS, the document ready handler isn't called. Use this event instead.

In the following example all we iterate through the newly rendered items and setup a tooltip plugin.

```javascript
ias.on('rendered', function(items) {
    var $items = $(items);

    $items.each(function() {
        $('.tooltip', this).tooltip();
    });
})
```

### noneLeft

Triggered when there are no more pages left.

Note: This event is only fired once.

An example:

```javascript
ias.on('noneLeft', function() {
    console.log('We hit the bottom!');
})
```

### next

| argument | type   | description                                  |
|----------|--------|----------------------------------------------|
| url      | string | the url of the next page that will be loaded |

Triggered when the next page should be loaded. Happens before loading of the next page starts.

With this event it is possible to cancel the loading of the next page. You can do this by returning `false` from your callback.

Say for example you want to stop loading more pages if you hit a certain url:

```javascript
ias.on('next', function(url) {
    if (url.match(/page3\.html/)) {
        return false;
    }
})
```

### ready

Triggered when IAS and all the extensions have been initialized.
