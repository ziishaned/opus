buster.spec.expose();
var expect = buster.assertions.expect;
var when = buster.when;

function loadFixture(path, callback) {
  jQuery.ajax({
    url: buster.env.contextPath + "/" + path,
    async: false,
    success: function (data, textStatus, jqXHR) {
      $('body').html(data);

      callback.apply();
    }
  });
}
