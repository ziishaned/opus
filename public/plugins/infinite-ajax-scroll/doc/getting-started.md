Getting started
===============

### Markup

This is an example of a minimal required markup.

```html
<div id="posts">
    <div class="post">...</div>
    <div class="post">...</div>
</div>

<div id="pagination">
    <a href="/page2/" class="next">next</a>
</div>
```

The required elements are:

* A container (`#posts` in this example) wrapped around your page items
* Item elements (`#posts > .post` in this example)
* A pagination element (`#pagination` in this example) containing your pagination links
* A link inside your pagination with a class that indicates it's the next link (`#pagination > .next` in this example)


### Javascript

The above markup is then mapped in the options of IAS.

```javascript
var ias = jQuery.ias({
  container:  '#posts',
  item:       '.post',
  pagination: '#pagination',
  next:       '.next'
});
```

Now you have a basic setup of Infinite AJAX Scroll. Time to add some fancy stuff.

```javascript
// Add a loader image which is displayed during loading
ias.extension(new IASSpinnerExtension());

// Add a link after page 2 which has to be clicked to load the next page
ias.extension(new IASTriggerExtension({offset: 2}));

// Add a text when there are no more pages left to load
ias.extension(new IASNoneLeftExtension({text: "You reached the end"}));
```
