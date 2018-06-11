function PathLoader(el) {
	this.el = el;
	// clear stroke
	this.el.style.strokeDasharray = this.el.style.strokeDashoffset = this.el.getTotalLength();
}

PathLoader.prototype._draw = function(val) {
	this.el.style.strokeDashoffset = this.el.getTotalLength() * (1 - val);
}

PathLoader.prototype.setProgress = function(val, callback) {
	this._draw(val);
	if (callback && typeof callback === 'function') {
		// give it a time (ideally the same like the transition time) so that the last progress increment animation is still visible.
		setTimeout(callback, 200);
	}
}

PathLoader.prototype.setProgressFn = function(fn) {
	if (typeof fn === 'function') {
		fn(this);
	}
}

var simulationFn = function(instance) {
	var progress = 0,
		interval = setInterval(function() {
			progress = Math.min(progress + Math.random() * 0.1, 1);
			instance.setProgress(progress);
			// reached the end
			if (progress === 1) {
				clearInterval(interval);
			}
		}, 100);
};

var loader = new PathLoader([pathselector]);
loader.setProgressFn(simulationFn);