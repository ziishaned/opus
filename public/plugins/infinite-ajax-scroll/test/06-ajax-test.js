var ias;

describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);

    ias = jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    });

    ias.extension(new IASSpinnerExtension());
    ias.extension(new IASNoneLeftExtension());
  });

  after(function() {
    ias.destroy();
  });

  it("should keep working when items container gets updated", function() {
    var deferred = when.defer();

    expect($('#post11').length).toEqual(0);
    expect($('#post21').length).toEqual(0);

    // assert page2
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect($('#post11').length).toEqual(1);

        // now simulate a ajax request that filters the results
        $("#content").load('ajax1.html', function() {
          expect($('#ajax1').length).toEqual(1);
          expect($('#post11').length).toEqual(0);

          ias.reinitialize();

          wait(1000).then(function() {
            // assert next page
            scrollDown().then(function() {
              wait(2000).then(function() {
                expect($('#ajax11').length).toEqual(1);
                expect($('#post11').length).toEqual(0);
                expect($('#post21').length).toEqual(0);

                deferred.resolve();
              });
            });
          });
        });
      });
    });

    return deferred.promise;
  });
});
