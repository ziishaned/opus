describe("Callbacks", function () {
  before(function() {
    this.timeout = 10000;
  });

  it("can add callback", function() {
    var callbacks = new IASCallbacks(),
        spy1 = this.spy();

    expect(callbacks.has(spy1)).toBeFalse();

    callbacks.add(spy1);

    expect(callbacks.has(spy1)).toBeTrue();
  });

  it("can remove callback", function() {
    var callbacks = new IASCallbacks(),
        spy1 = this.spy();

    callbacks.add(spy1);

    expect(callbacks.has(spy1)).toBeTrue();

    callbacks.remove(spy1);

    expect(callbacks.has(spy1)).toBeFalse();
  });

  it("can fire callback", function() {
    var callbacks = new IASCallbacks(),
        spy1 = this.spy(),
        spy2 = this.spy();

    callbacks.add(spy1);
    callbacks.add(spy2);

    callbacks.fireWith(this, ['arg1']);

    expect(spy1).toHaveBeenCalledOnce();
    expect(spy2).toHaveBeenCalledOnce();
  });

  it("can be enabled/disabled", function() {
    var callbacks = new IASCallbacks(),
        spy1 = this.spy(),
        spy2 = this.spy();

    callbacks.add(spy1);
    callbacks.add(spy2);

    callbacks.disable();

    callbacks.fireWith(this, ['arg1']);

    expect(spy1).not.toHaveBeenCalled();
    expect(spy2).not.toHaveBeenCalled();

    callbacks.enable();

    callbacks.fireWith(this, ['arg1']);

    expect(spy1).toHaveBeenCalledOnce();
    expect(spy2).toHaveBeenCalledOnce();
  });

  it("can add callback with priority", function() {
    var callbacks = new IASCallbacks(),
        lastedCalledSpy = null,
        spy1 = function() { lastedCalledSpy = "spy1"; },
        spy2 = function() { lastedCalledSpy = "spy2"; };

    callbacks.add(spy1, 1000); // lowest priority, gets called last
    callbacks.add(spy2, 2000); // highest priority, gets called first

    callbacks.fireWith(this, ['arg1']);

    expect(lastedCalledSpy).toBe("spy1");
  });
});
