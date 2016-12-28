buster.spec.expose();

describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);
  });

  after(function() {
    jQuery.ias('destroy');
  });

  it("should call load listeners when loading", function() {
    var deferred = when.defer();
    var spy0 = this.spy();
    var spy1 = this.spy();
    var spy2 = this.spy();

    // first method to set a listener, directly after the instantiation
    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    }).on('load', spy0);

    // another method to set a listener later on
    jQuery.ias('on', 'load', spy1);

    // yet another method to set a listener
    jQuery.ias().on('load', spy2);

    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy0).toHaveBeenCalledOnce();
        expect(spy1).toHaveBeenCalledOnce();
        expect(spy2).toHaveBeenCalledOnce();

        deferred.resolve();
      });
    });

    return deferred.promise;
  });

  it("should allow url to be changed in load event", function() {
    var deferred = when.defer();

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    });

    // first listener changes the url
    jQuery.ias().on('load', function (loadEvent) {
      // assert that it isn't already there
      buster.refute.contains(loadEvent.url, "ajax=1");

      loadEvent.url = loadEvent.url + "?ajax=1";
    });

    // second listener asserts the url is changed
    jQuery.ias().on('load', function (loadEvent) {
      buster.assert.contains(loadEvent.url, "ajax=1");
    });

    scrollDown().then(function() {
      wait(2000).then(function() {
        deferred.resolve();
      });
    });

    return deferred.promise;
  });

  it("should call render listeners when render is complete", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    })
        // register listener
        .on('render', spy1);

    // scroll to page 1
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy1).toHaveBeenCalledOnce();

        // page 2
        scrollDown().then(function() {
          wait(2000).then(function() {
            expect(spy1).toHaveBeenCalledTwice();

            deferred.resolve();
          });
        });
      });
    });

    return deferred.promise;
  });

  it("should call scroll listeners when scrolling", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    })
        // register listener
        .on('scroll', spy1);

    // scroll to page 1
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy1).toHaveBeenCalled();

        deferred.resolve();
      });
    });

    return deferred.promise;
  });

  it("should set listener owner as this", function() {
    var deferred = when.defer();

    var self = jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    })
        // register listener
        .on('load', function() {
          expect(this).toBe(self);
        })
    ;

    // scroll to page 1
    scrollDown().then(function() {
      wait(2000).then(function() {
        deferred.resolve();
      });
    });

    return deferred.promise;
  });

  it("should call noneLeft listeners when on last page", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    jQuery.ias({
      container : '.listing',
      item: '.post',
      pagination: '.navigation',
      next: '.next-posts a'
    })
        // register listener
        .on('noneLeft', spy1);

    // scroll to page 2
    scrollDown().then(function() {
      wait(2000).then(function() {
        expect(spy1).not.toHaveBeenCalled();

        // scroll to page 3
        scrollDown().then(function() {
          wait(1500).then(function() {
            expect(spy1).not.toHaveBeenCalled();

            // now on the final page, scroll down, and expect to have been called
            scrollDown().then(function() {
              wait(1500).then(function() {
                expect(spy1).toHaveBeenCalledOnce();

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
