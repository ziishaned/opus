describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    }).extension(new IASPagingExtension());

    jQuery.ias().initialize();
  });

  after(function() {
    jQuery.ias('destroy');
  });

  it("should call pageChange listener", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    jQuery.ias().on('pageChange', spy1);

    // asset page2
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy1).toHaveBeenCalledOnce();
        expect(spy1).toHaveBeenCalledWith(2); // pagenum 2

        // asset page3
        scrollDown().then(function() {
          wait(2000).then(function() {
            expect(spy1).toHaveBeenCalledTwice();
            expect(spy1).toHaveBeenCalledWith(3); // pagenum 3

            deferred.resolve();
          });
        });
      });
    });

    return deferred.promise;
  });

  it("callbacks should be called when render returns false", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    jQuery.ias().on('render', function() { spy1(); return false; });
    // If the user uses their own render function (which returns false), then IAS
    // doesn't call other render callbacks such as the one that sets the next URL
    // This is tested by adding our own render callback and then adding checks to
    // confirm the render callback actually did run and the nextUrl has been updated.
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy1).toHaveBeenCalledOnce();
        buster.assert.contains(jQuery.ias().nextUrl, "page3.html");

        deferred.resolve();
      })
    })
    return deferred.promise;
  });
});
