Methods
=======

### bind

Binds IAS to window or document events.

```javascript
jQuery.ias().bind();
```

### destroy

Unbinds and destroys instance.

### extension

Adds an extension to Infinite AJAX Scroll.

```javascript
jQuery.ias().extension(new anExtension());
```

### initialize

Initializes Infinite AJAX Scroll. Normally this happens when the DOM is ready (`$(document).ready()`), but if you want to dynamically create an IAS instance after this event, you can initialize it yourself using this method.

```javascript
jQuery.ias().initialize();
```

### reinitialize

Reinitializes Infinite AJAX Scroll after a DOM update. DOM updates could be made by page updates via AJAX, like changing the sorting of a list, or filtering a result.

```javascript
jQuery.ias().reinitialize();
```

### next

Loads the next page.

```javascript
jQuery.ias().next();
```

### off

Removes an event listener.

```javascript
jQuery.ias().off('eventName', callback);
```

### on

Adds an event listener.

```javascript
jQuery.ias().on('eventName', callback [, priority]);
```

Priority defaults to `0`. Listeners with a higher priority get called before ones with a lower priority.

See [Events](events.html) for available events.

### one

Adds an event listener that is only triggered once.

```javascript
jQuery.ias().one('eventName', callback);
```

See [Events](events.html) for available events.

### unbind

Unbinds IAS from any window or document events.

```javascript
jQuery.ias().unbind();
```
