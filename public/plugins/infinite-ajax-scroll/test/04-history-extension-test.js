describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);
  });

  after(function() {
    jQuery.ias('destroy');
  });

  it("should expose a prev method", function() {
    var ias = jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    });

    ias.extension(new IASTriggerExtension());
    ias.extension(new IASPagingExtension());
    ias.extension(new IASHistoryExtension({
      prev: '.prev-posts a'
    }));

    expect(ias.prev).toBeDefined();
  });

  it("should load the prev page when prev() is called", function() {
    var deferred = when.defer();

    loadFixture("page2.html", function() {
      var ias = jQuery.ias({
        container : '.listing',
        item: '.post',
        pagination: '.navigation',
        next: '.next-posts a'
      });

      ias.extension(new IASPagingExtension());
      ias.extension(new IASHistoryExtension({
        prev: '.prev-posts a'
      }));

      // ias auto-loads the prev page when initialized,
      // this prevents the auto loading
      var firstTime = true;
      ias.on('prev', function () {
        if (firstTime) {
          firstTime = false;

          return false;
        }

        return true;
      }, 1000);

      ias.initialize();

      expect($('#post1').length).toEqual(0);

      expect(ias.prev()).toBeTrue();

      wait(1000).then(function() {
        expect($('#post1').length).toEqual(1);

        deferred.resolve();
      });
    });

    return deferred.promise;
  });
});
