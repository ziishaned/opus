describe('IAS', function () {
  before(function () {
    var deferred = when.defer();

    this.timeout = 10000;

    loadFixture('multiple1.html', function () {
      [$('.overflow1'), $('.overflow2')].forEach(function ($overflow) {
        $overflow.ias({
          container:  '.container',
          item:       '.item',
          pagination: '.pagination',
          next:       '.next',
        });

        deferred.resolve();
      });
    });

    return deferred.promise;
  });

  after(function() {
    jQuery.ias('destroy');
  });

  function runTest(scrollMoreSelector, scrollLessSelector) {
    var deferred = when.defer();

    scrollDown(100, $(scrollMoreSelector)).then(function () {
      wait(1000).then(function () {
        expect($(scrollMoreSelector).find('.item').length).toEqual(20);
        expect($(scrollLessSelector).find('.item').length).toEqual(10);

        scrollDown(100, $(scrollLessSelector)).then(function () {
          wait(1000).then(function () {
            expect($(scrollMoreSelector).find('.item').length).toEqual(20);
            expect($(scrollLessSelector).find('.item').length).toEqual(20);

            scrollDown(100, $(scrollMoreSelector)).then(function () {
              wait(1000).then(function () {
                expect($(scrollMoreSelector).find('.item').length).toEqual(30);
                expect($(scrollLessSelector).find('.item').length).toEqual(20);

                deferred.resolve();
              });
            });
          });
        });
      });
    });

    return deferred.promise;
  }

  it('should scroll the first more', function () {
    return runTest('.overflow1', '.overflow2');
  });

  it('should scroll the second more', function () {
    return runTest('.overflow2', '.overflow1');
  });
});
