
var interpolate = function (source, target, shift) {
  return (source + (target - source) * shift);
};

var easing = function (pos) {
  return (-Math.cos(pos * Math.PI) / 2) + 0.5;
};

function scrollDown(duration, element) {
  element = element || window;
  duration = duration || 1000;

  var deferred = when.defer();
  var h = (element === window ? $(document).height() : $(element).get(0).scrollHeight);
  var y = 0;

  var endY = h - $(element).height();

  var startY = (element === window ? element.pageYOffset : element.scrollTop()),
      startT  = Date.now(),
      finishT = startT + duration,
      curY;

  var animate = function() {
    var now = +(new Date()),
        shift = (now > finishT) ? 1 : (now - startT) / duration;

    curY = interpolate(startY, endY, easing(shift));

    if (element === window) {
      element.scrollTo(0, curY);
    } else {
      element.scrollTop(curY);
    }

    if (now > finishT) {
      deferred.resolve();
    } else {
      setTimeout(animate, 15);
    }
  };

  animate();

  return deferred.promise;
}

function wait(time) {
  var deferred = when.defer();

  setTimeout(function() {
    deferred.resolve();
  }, time);

  return deferred.promise;
}

function waitUntil(condition, timeout) {
  var deferred = when.defer();

  var interval = 5;
  var time = 0;
  var result;

  timeout = timeout || 1000;

  var t = setInterval(function() {
    result = condition.call();

    if (result) {
      clearInterval(t);
      deferred.resolve();
      return;
    }

    if (timeout && time >= timeout) {
      clearInterval(t);
      deferred.reject();
      return;
    }

    time += interval;
  }, interval);

  return deferred.promise;
}

function clickAndWait(selector, time)
{
  var deferred = when.defer();

  time = time || 1000;

  $(selector).trigger('click');

  wait(time).then(function() {
    deferred.resolve();
  });

  return deferred.promise;
}

function watch(selector, timeout, interval) {
  var deferred = when.defer();

  interval = interval || 25;
  timeout = timeout || 1000;
  var tracker = 0;
  var time = 0;
  var result = false;

  var condition = function() {
    return $(selector).length > 0;
  };

  var t = setInterval(function() {
    result = condition.call();

    if (result) {
      tracker += interval;
    }

    if (timeout && time >= timeout) {
      clearInterval(t);
      deferred.resolve(tracker);
      return;
    }

    time += interval;
  }, interval);

  return deferred.promise;
}
