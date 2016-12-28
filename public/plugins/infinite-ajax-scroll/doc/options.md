Options
=======

### container

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>"#container"</dd>
</dl>

Enter the selector of the element containing your items that you want to paginate.

### item

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>".item"</dd>
</dl>

Enter the selector of the element that each item has. Make sure the elements are inside the container element.

### pagination

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>"#pagination"</dd>
</dl>

Enter the selector of the element that contains your regular pagination links, like next, previous and the page numbers. This element will be hidden when Infinite AJAX Scroll loads.

### next

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>".next"</dd>
</dl>

Enter the selector of the link element that links to the next page. The href attribute of this element will be used to get the items from the next page. Make sure there is only one(1) element that matches the selector.

### delay

<dl>
    <dt>Type</dt>
    <dd>integer</dd>

    <dt>Default</dt>
    <dd>600</dd>

    <dt>In</dt>
    <dd>milliseconds</dd>
</dl>

Minimal number of milliseconds to stay in a loading state.

To improve user experience, website visitors should be aware when fresh results are appended to the current list. Infinite AJAX Scroll displays a spinner/loader (only when the spinner extension is used). When the loading of the next page only takes a few miliseconds the spinner isn't displayed long enough to be noticed by the visitor. With the delay option you can extend the time at which to spinner is shown, before new items are appended.

### negativeMargin

<dl>
    <dt>Type</dt>
    <dd>integer</dd>

    <dt>Default</dt>
    <dd>10</dd>
</dl>

On default IAS starts loading new items when you scroll to the last `.item` element. The `negativeMargin` will be added to the items' offset, giving you the ability to load new items earlier (please note that the margin is always transformed to a negative integer).

For example:

Setting a `negativeMargin` of 250 means that IAS will start loading 250 pixel before the last item has scrolled into view.

Note: user experience can degrade if new pages are loaded too quickly without visual feedback (also see [delay](options.html#delay)). Use with caution.
