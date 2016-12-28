var config = module.exports,
    fs = require('fs'),
    bower = {
      jquery: {
        main: 'jquery.js'
      }
    };

if (fs.existsSync('bower_components/jquery/bower.json')) {
  bower.jquery = JSON.parse(fs.readFileSync('bower_components/jquery/bower.json', 'utf8'))
}

config["My tests"] = {
  rootPath: "../",
  environment: "browser", // or "node"
  libs: [
    "bower_components/jquery/" + bower.jquery.main.replace(/^\.\//, ''),
  ],
  sources: [
    "src/callbacks.js",
    "src/jquery-ias.js",
    "src/extension/paging.js",
    "src/extension/spinner.js",
    "src/extension/trigger.js",
    "src/extension/noneleft.js",
    "src/extension/history.js"
  ],
  resources: [
    { path: "/",            file: "test/fixtures/page1.html" },
    { path: "/page2.html",  file: "test/fixtures/page2.html" },
    { path: "/page3.html",  file: "test/fixtures/page3.html" },
    { path: "/framed.html", file: "test/fixtures/framed.html" },
    { path: "/short.html",  file: "test/fixtures/short.html" },
    { path: "/ajax1.html",   file: "test/fixtures/ajax1.html" },
    { path: "/ajax2.html",   file: "test/fixtures/ajax2.html" },
    { path: "/multiple1.html",   file: "test/fixtures/multiple1.html" },
    { path: "/multiple2.html",   file: "test/fixtures/multiple2.html" },
    { path: "/multiple3.html",   file: "test/fixtures/multiple3.html" }
  ],
  specs: [
    "test/*-test.js"
  ],
  specHelpers: [
    "test/helpers/*.js"
  ]
};
