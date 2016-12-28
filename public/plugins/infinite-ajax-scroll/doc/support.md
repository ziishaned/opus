Support
=======

If you have any questions on how to implement the plugin, please [ask your question on stackoverflow](http://stackoverflow.com/questions/ask?tags=jquery-ias) and tag it with `jquery-ias`.

If you have found a bug please [report those to Github](https://github.com/webcreate/infinite-ajax-scroll/issues).

FAQ
===

Below are some of the most frequently asked questions.

### Next page is loaded too early. How can I fix this?

This might happen if your container contains images with a non-fixed height. Try to set the height attribute on your images, or initialize Infinite AJAX Scroll after the images have loaded.

### Uncaught Error: Syntax error, unrecognized expression

This might happen if there is content (most of the time whitespace) before the `!DOCTYPE` tag. Make sure there is no whitespace before the `<!DOCTYPE>` tag.

### My javascript events don't work anymore after a new page is loaded

Javascript event listeners have to be reinitialized for newly loaded items. You can use the [`rendered`](events.html#rendered) event for this just like how you would use the `$(document).ready()` event.

