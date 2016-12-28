describe("IAS", function () {
  before(function() {
    this.timeout = 10000;

    window.scrollTo(0, 0);
  });

  after(function() {
    jQuery.ias('destroy');
  });

  var dataProvider = [200, 400, 1000],
      _delay_,
      i;

  for (i in dataProvider) {
    _delay_ = dataProvider[i];

    it("should delay for ~"+_delay_+" miliseconds", function() {
      var deferred = when.defer();
      var startTime, endTime, diffTime = 0;

      jQuery.ias({
        container : '.listing',
        item: '.post',
        pagination: '.navigation',
        next: '.next-posts a',
        delay: _delay_
      })
          .on('next', function() { startTime = +new Date(); }) // called before loading
          .on('render', function() { endTime = +new Date(); }) // called after loading
      ;

      // assert page2
      scrollDown().then(function() {
        wait(2000).then(function() {
          diffTime = endTime - startTime;

          expect(diffTime).toBeGreaterThan(_delay_ - 100);
          expect(diffTime).toBeLessThan(_delay_ + 100);

          deferred.resolve();
        });
      });

      return deferred.promise;
    });
  }
});
