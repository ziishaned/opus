None Left Extension
===================

The None Left extension adds a text when there are no more pages to load.

This extension is bundled with IAS as a core extension.

## Usage

After [you initialized IAS](getting-started.html#javascript) you can register the extension:

```javascript
ias.extension(new IASNoneLeftExtension({
    text: 'You reached the end.', // optionally
}));
```

You can optionally set options for this extension. See below.

## Options

### text

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>You reached the end.</dd>
</dl>

Text of the link.

### html

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>&lt;div class="ias-noneleft" style="text-align: center;">{text}&lt;/div></dd>
</dl>

Allows you to override the html.
