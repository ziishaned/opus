History Extension
=================

The History extension adds history support.

This extension requires the [Paging extension](extension-paging.html) and the [Trigger extension](extension-trigger.html).

This extension is bundled with IAS as a core extension.

## Usage

After [you initialized IAS](getting-started.html#javascript) you can register the extension:

```javascript
// needed by the history extension
ias.extension(new IASTriggerExtension());
ias.extension(new IASPagingExtension());

ias.extension(new IASHistoryExtension({
    prev: '.previous',
}));
```

You can optionally set options for this extension. See below.

## Options

### prev

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>".prev"</dd>
</dl>

Enter the selector of the link element that links to the previous page. The href attribute of this element will be used to get the items from the previous page. Make sure there is only one(1) element that matches the selector.

## Methods

### prev

Loads the previous page.

```javascript
jQuery.ias().prev();
```

## Remarks

When using the history extension it is not possible to use IAS in a overflow div.
