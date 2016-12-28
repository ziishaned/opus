buster.spec.expose();

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

  it("should call initialize on extension when loading extension", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    var anExtension = function() {};

    anExtension.prototype.bind = function(ias) {
      // an extension needs a bind method
    };
    anExtension.prototype.initialize = function(ias) {
      spy1.call();
    };

    jQuery.ias().extension(new anExtension());

    expect(spy1).toHaveBeenCalledOnce();

    deferred.resolve();

    return deferred.promise;
  });

  it("should call bind on extension when initializing", function() {
    var deferred = when.defer();
    var spy1 = this.spy();

    var anExtension = function() {};

    anExtension.prototype.bind = function(ias) {
      spy1.call();
    };

    jQuery.ias().extension(new anExtension());

    expect(spy1).toHaveBeenCalledOnce();

    deferred.resolve();

    return deferred.promise;
  });

  it("extension can add listeners", function() {
    var anExtension = function() {
      this.listeners = {
        test: new IASCallbacks()
      };
    };

    anExtension.prototype.bind = function(ias) {
    };

    anExtension.prototype.initialize = function(ias) {
      jQuery.extend(ias.listeners, this.listeners);
    };

    // when the extension isn't added, this will throw an error
    expect(
        function () {
          jQuery.ias().on('test', function () {
          });
        }
    ).toThrow('Error', 'There is no event called "test"');

    // now let's register the extension
    jQuery.ias().extension(new anExtension());

    // this should now be possible and not throw an error
    jQuery.ias().on('test', function() {});
    jQuery.ias().on('scroll', function() {});
  });
});
