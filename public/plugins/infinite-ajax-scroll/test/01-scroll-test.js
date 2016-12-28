describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    });
  });

  after(function() {
    jQuery.ias('destroy');
  });

  it("should hide the pagination", function() {
    var deferred = when.defer();

    wait(250).then(function() {
      expect($('.navigation').css('display')).toEqual('none');

      deferred.resolve();
    });

    return deferred.promise;
  });

  it("should load the next page", function() {
    var deferred = when.defer();

    expect($('#post11').length).toEqual(0);
    expect($('#post21').length).toEqual(0);

    // assert page2
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect($('#post11').length).toEqual(1);

        // assert page3
        scrollDown().then(function() {
          wait(2000).then(function() {
            expect($('#post21').length).toEqual(1);

            deferred.resolve();
          });
        });

      });
    });

    return deferred.promise;
  });

  it("should work in a overflowed div", function() {
    var deferred = when.defer();

    jQuery.ias('destroy');

    loadFixture("framed.html", function() {
      var $element = jQuery("#content");

      $element.ias({
        container : '.listing',
        item: '.post',
        pagination: '.navigation',
        next: '.next-posts a'
      });

      expect($('#post11').length).toEqual(0);
      expect($('#post21').length).toEqual(0);

      scrollDown(1000, $element).then(function() {
        wait(2000).then(function() {
          expect($('#post11').length).toEqual(1);
          expect($('#post21').length).toEqual(0);

          $element.ias('destroy');

          deferred.resolve();
        });
      });
    });

    return deferred.promise;
  });

  it("should load the next page when content length is less than page fold", function() {
    var deferred = when.defer();

    jQuery.ias('destroy');

    loadFixture("short.html", function() {
      jQuery.ias({
        container : '.listing',
        item: '.post',
        pagination: '.navigation',
        next: '.next-posts a'
      });

      expect($('#post11').length).toEqual(0);

      // expect the second page to be loaded without scrolling
      wait(1000).then(function() {
        expect($('#post11').length).toEqual(1);

        deferred.resolve();
      });
    });

    return deferred.promise;
  });
});
