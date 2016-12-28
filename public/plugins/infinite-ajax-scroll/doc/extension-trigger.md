Trigger Extension
=================

The trigger extension adds a link/button which has to be clicked before loading the next page. This is very helpful when you have a footer with information. Without this your visitors could possibly not reach your footer.

This extension is bundled with IAS as a core extension.

## Usage

After [you initialized IAS](getting-started.html#javascript) you can register the extension:

```javascript
ias.extension(new IASTriggerExtension({
    text: 'Load more items', // optionally
}));
```

You can optionally set options for this extension. See below.


## Options

### text

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>Load more items</dd>
</dl>

Text of the link.

### html

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>&lt;div class="ias-trigger ias-trigger-next" style="text-align: center; cursor: pointer;">&lt;a>{text}&lt;/a>&lt;/div></dd>
</dl>

Allows you to override the html. The `{text}` placeholder will be replace by the value of the option `text`.

### textPrev

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>Load previous items</dd>
</dl>

Text of the link that will load the previous page.

### htmlPrev

<dl>
    <dt>Type</dt>
    <dd>string</dd>

    <dt>Default</dt>
    <dd>&lt;div class="ias-trigger ias-trigger-prev" style="text-align: center; cursor: pointer;">&lt;a>{text}&lt;/a>&lt;/div></dd>
</dl>

Allows you to override the html. The `{text}` placeholder will be replace by the value of the option `textPrev`.

### offset

<dl>
    <dt>Type</dt>
    <dd>integer</dd>

    <dt>Default</dt>
    <dd>0</dd>
</dl>

The number of pages which should load automatically. After that the trigger is shown for every subsequent page.

For example: if you set the offset to 2, the pages 2 and 3 (page 1 is always shown) would load automatically and for every subsequent page the user has to press the trigger to load it.
