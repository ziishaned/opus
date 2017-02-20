CKEDITOR.dialog.add('pbckcodeDialog', function(editor) {
  var tab_sizes = ['1', '2', '4', '8'];

  // CKEditor variables
  var dialog;
  var shighlighter = new PBSyntaxHighlighter(editor.settings.highlighter);

  // ACE variables
  var aceEditor, aceSession, whitespace;

  // EDITOR panel
  var editorPanel = {
    id: 'editor',
    label: editor.lang.pbckcode.editor,
    elements: [
      {
        type: 'hbox',
        children: [
          {
            type: 'select',
            id: 'code-select',
            className: 'cke_pbckcode_form',
            label: editor.lang.pbckcode.mode,
            items: editor.settings.modes,
            'default': editor.settings.modes[0][1],
            setup: function(element) {
              if (element) {
                element = element.getAscendant('pre', true);
                this.setValue(element.getAttribute('data-pbcklang'));
              }
            },
            commit: function(element) {
              if (element) {
                element = element.getAscendant('pre', true);
                element.setAttribute('data-pbcklang', this.getValue());
              }
            },
            onChange: function() {
              aceSession.setMode('ace/mode/' + this.getValue());
            }
          },
          {
            type: 'select',
            id: 'code-tabsize-select',
            className: 'cke_pbckcode_form',
            label: editor.lang.pbckcode.tabSize,
            items: tab_sizes,
            'default': editor.settings.tab_size,
            setup: function(element) {
              if (element) {
                element = element.getAscendant('pre', true);
                this.setValue(element.getAttribute('data-pbcktabsize'));
              }
            },
            commit: function(element) {
              if (element) {
                element = element.getAscendant('pre', true);
                element.setAttribute('data-pbcktabsize', this.getValue());
              }
            },
            onChange: function(element) {
              if (element) {
                whitespace.convertIndentation(aceSession, ' ', this.getValue());
                aceSession.setTabSize(this.getValue());
              }
            }
          }
        ]
      },
      {
        type: 'html',
        html: '<div></div>',
        id: 'code-textarea',
        className: 'cke_pbckcode_ace',
        style: 'position: absolute; top: 95px; left: 0px; right: 0px; bottom: 50px;',
        setup: function(element) {
          // get the value of the editor
          var code = element.getHtml();

          // replace some regexp
          code = code.replace(new RegExp('<br/>', 'g'), '\n')
            .replace(new RegExp('<br>', 'g'), '\n')
            .replace(new RegExp('&lt;', 'g'), '<')
            .replace(new RegExp('&gt;', 'g'), '>')
            .replace(new RegExp('&amp;', 'g'), '&')
            .replace(new RegExp('&nbsp;', 'g'), ' ');

          aceEditor.setValue(code);
        },
        commit: function(element) {
          element.setText(aceEditor.getValue());
        }
      }
    ]
  };

  // dialog code
  return {
    // Basic properties of the dialog window: title, minimum size.
    title: editor.lang.pbckcode.title,
    minWidth: 800,
    minHeight: 500,
    // Dialog window contents definition.
    contents: [
      editorPanel
    ],
    onLoad: function() {
      dialog = this;
      // we load the ACE plugin to our div
      aceEditor = ace.edit(dialog.getContentElement('editor', 'code-textarea')
        .getElement().getId());
      // save the aceEditor into the editor object for the resize event
      editor.aceEditor = aceEditor;

      // set default settings
      aceEditor.setTheme('ace/theme/' + editor.settings.theme);
      aceEditor.setShowPrintMargin(false);
      aceEditor.setHighlightActiveLine(true);
      aceEditor.setShowInvisibles(true);

      aceSession = aceEditor.getSession();
      aceSession.setMode('ace/mode/' + editor.settings.modes[0][1]);
      aceSession.setTabSize(editor.settings.tab_size);
      aceSession.setUseSoftTabs(true);

      // load ace extensions
      whitespace = ace.require('ace/ext/whitespace');
    },
    onShow: function() {
      // get the selection
      var selection = editor.getSelection();
      // get the entire element
      var element = selection.getStartElement();

      // looking for the pre parent tag
      if (element) {
        element = element.getAscendant('pre', true);
      }
      // if there is no pre tag, it is an addition. Therefore, it is an edition
      if (!element || element.getName() !== 'pre') {
        element = new CKEDITOR.dom.element('pre');

        if (shighlighter.getTag() !== 'pre') {
          element.append(new CKEDITOR.dom.element('code'));
        }
        this.insertMode = true;
      }
      else {
        if (shighlighter.getTag() !== 'pre') {
          element = element.getChild(0);
        }
        this.insertMode = false;
      }
      // get the element to fill the inputs
      this.element = element;

      // focus on the editor
      aceEditor.focus();

      // we empty the editor
      aceEditor.setValue('');

      // we fill the inputs
      if (!this.insertMode) {
        this.setupContent(this.element);
      }
    },
    // This method is invoked once a user clicks the OK button, confirming the dialog.
    onOk: function() {
      var pre, element;
      pre = element = this.element;

      if (this.insertMode) {
        if (shighlighter.getTag() !== 'pre') {
          element = this.element.getChild(0);
        }
      }
      else {
        pre = element.getAscendant('pre', true);
      }

      this.commitContent(element);

      // set the full class to the code tag
      shighlighter.setCls(pre.getAttribute('data-pbcklang') + ' ' + editor.settings.cls);

      element.setAttribute('class', shighlighter.getCls());

      // we add a new code tag into ckeditor editor
      if (this.insertMode) {
        editor.insertElement(pre);
      }
    }
  };
});

/*
 * Resize the ACE Editor
 */
CKEDITOR.dialog.on('resize', function(evt) {
  var AceEditor = evt.editor.aceEditor;
  if (AceEditor !== undefined) {
    AceEditor.resize();
  }
});

