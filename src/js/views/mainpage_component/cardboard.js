define([
	'backbone',
	'hbs!../../../templates/mainpage_component/cardboard',
	'hbs!../../../templates/mainpage_component/page',
	'hbs!../../../templates/mainpage_component/trophy',
	'app',
], function(
	Backbone,
	tpl,
	pages,
	trophy,
	App
) {
	var CardBoard = Backbone.View.extend({
		className: 'cardBoard',
		currentPage: 1,
		totalPages: 1,
		currentTag: null,
		adobeEdgeComp: null,
		interval: null,
		video: null,

		initialize: function(options) {

		},

		events: {
			'click .left-arrow': 'onArrowClick',
			'click .right-arrow': 'onArrowClick'
		},

		onClose: function() {


		},

		preloadImages: function(array) {
			if (!this.preloadImages.list) {
				this.preloadImages.list = [];
			}
			var list = this.preloadImages.list;
			for (var i = 0; i < array.length; i++) {
				var img = new Image();
				img.onload = function() {
					var index = list.indexOf(this);
					if (index !== -1) {
						// remove image from the array once it's loaded
						// for memory consumption reasons
						list.splice(index, 1);
					}
				}
				list.push(img);
				img.src = array[i];
			}
		},

		startTrophyAnimtion: function() {

			$('.trophyVideo-holder').fadeIn('fast');

			var outputCanvas = document.getElementById('trophyoutput');
			var output = outputCanvas.getContext('2d');
			var bufferCanvas = document.getElementById('trophybuffer');
			var buffer = bufferCanvas.getContext('2d');

			var videoWidth = outputCanvas.width;
			var videoheight = outputCanvas.height;

			function processFrame() {
				buffer.drawImage(App.videoTrophy, 0, 0);

				// this can be done without alphaData, except in Firefox which doesn't like it when image is bigger than the canvas
				var image = buffer.getImageData(0, 0, videoWidth, videoheight),
					imageData = image.data,
					alphaData = buffer.getImageData(0, videoheight, videoWidth, videoheight).data;

				for (var i = 3, len = imageData.length; i < len; i = i + 4) {
					imageData[i] = alphaData[i - 1];
				}

				output.putImageData(image, 0, 0, 0, 0, videoWidth, videoheight);
			}

			function randomColourVal() {
				return Math.floor(Math.random() * 256);
			}
			var play = function() {
				clearInterval(self.interval);
				self.interval = setInterval(processFrame, 40)
			}
			App.videoTrophy.removeEventListener("play");
			App.videoTrophy.addEventListener('play', play, false);

			// Firefox doesn't support looping video, so we emulate it this way
			var ended = function() {
				$('.trophyVideo-holder').fadeOut('fast');
				$(document).trigger("finishTrophyMovie");
			}
			App.videoTrophy.removeEventListener("ended");
			App.videoTrophy.addEventListener('ended', ended, false);

			App.videoTrophy.play();

            window.setTimeout(function(){
                App.videoTrophy.removeEventListener("ended", ended);
                ended();

            },6000);
		},

		startAnimtion: function(image, self, points) {

			App.video = document.getElementById('openVideo');

			outputCanvas = document.getElementById('output');
			output = outputCanvas.getContext('2d');
			bufferCanvas = document.getElementById('buffer');
			buffer = bufferCanvas.getContext('2d');

			App.videoWidth = outputCanvas.width;
			App.videoheight = outputCanvas.height;

			$('.openpack img').attr('src', App.IMAGEURL + image);
			$('.openpack').show();

			function processFrame() {
				buffer.drawImage(App.video, 0, 0);

				// this can be done without alphaData, except in Firefox which doesn't like it when image is bigger than the canvas
				var image = buffer.getImageData(0, 0, App.videoWidth, App.videoheight),
					imageData = image.data,
					alphaData = buffer.getImageData(0, App.videoheight, App.videoWidth, App.videoheight).data;

				for (var i = 3, len = imageData.length; i < len; i = i + 4) {
					imageData[i] = alphaData[i - 1];
				}

				output.putImageData(image, 0, 0, 0, 0, App.videoWidth, App.videoheight);
			}

			function randomColourVal() {
				return Math.floor(Math.random() * 256);
			}
			var play = function() {
				clearInterval(self.interval);
				clearInterval(self.interval);
				self.interval = setInterval(processFrame, 40);
			}

			App.video.removeEventListener("play", play);
			App.video.addEventListener('play', play, false);
			var timeupdate = function() {
				if (this.currentTime >= 2) {
					$('.openpack .center img').addClass('in');
				}
			}
			App.video.removeEventListener("timeupdate", timeupdate);
			App.video.addEventListener('timeupdate', timeupdate);


			// Firefox doesn't support looping video, so we emulate it this way
			var ended = function() {
				$('.openpack .center img').removeClass('in');
				$('.openpack').fadeOut('fast', function() {
					$(document).trigger("finishMovie");
				});
			}
			App.video.removeEventListener("ended", ended);
			App.video.addEventListener('ended', ended, false);

			App.video.play();
            window.setTimeout(function(){
                App.video.removeEventListener("ended", ended);
                ended();

            },6000);

		},

		openCard: function(image) {

			this.startAnimtion(image, this)
		},

		onArrowClick: function(event) {
			var self = this;
			event.preventDefault();
			if ($(event.currentTarget).hasClass('right-arrow')) {
				if (this.currentPage < this.totalPages) {
					this.currentPage++;
					if (this.currentPage == this.totalPages) {
						var name = "Forward to " + self.getNextTagName(this.currentTag);
						$(".right-arrow").append("<label class='tag_name right " + name + "'>" + name + "</label>")
						if (this.totalPages > 1 && this.currentPage > 1) {
							$(".left-arrow .tag_name").remove();
						}
					} else {
						if (this.totalPages > 1 && this.currentPage > 1) {
							$(".left-arrow .tag_name").remove();
						}
						$(".right-arrow .tag_name").remove();
					}
				} else {
					$(".right-arrow .tag_name").remove();
					this.currentPage = 1;
					$.each(App.tags, function(index, val) {

						if (self.currentTag == val && typeof(App.tags[(index + 1)]) == "undefined") {
							self.openTag(App.tags[0]);
							return false;
						} else if (self.currentTag == val) {
							self.openTag(App.tags[index + 1]);

							return false;
						}
					});
				}
			} else {
				if (this.currentPage > 1) {
					this.currentPage--;
					if (this.currentPage == 1) {

						var name = "Back to " + self.getPrevTagName(this.currentTag);
						$(".left-arrow").append("<label class='tag_name left " + name + "'>" + name + "</label>")
						if (this.totalPages > 1 && this.currentPage == 1) {
							$(".right-arrow .tag_name").remove();
						}
					} else {
						$(".left-arrow .tag_name").remove();
					}
				} else {
					this.currentPage = 1;
					$.each(App.tags, function(index, val) {
						if (self.currentTag == App.tags[index] && typeof(App.tags[(index - 1)]) == "undefined") {
							self.openTag(App.tags[App.tags.length - 1]);

							return false;
						} else if (self.currentTag == val) {

							self.openTag(App.tags[index - 1]);
							return false;
						}
					});
				}
			}

			$('.pagination-headline .yellow-text').text(this.currentPage);

			this.loadCard(this.currentTag, this.currentPage);
		},
		getNextTagName: function(tag) {
			var self = this;
			var result = "";
			$.each(App.tags, function(index, val) {
				if (self.currentTag == App.tags[index] && typeof(App.tags[(index + 1)]) !== "undefined") {
					result = App.tags[(index + 1)];
					return false;
				} else if (self.currentTag == App.tags[index] && typeof(App.tags[(index + 1)]) == "undefined") {
					result = App.tags[0];
					return false;

				}
			});

			return result;
		},

		getPrevTagName: function() {
			var self = this;
			var result = "";
			$.each(App.tags, function(index, val) {
				if (self.currentTag == App.tags[index] && typeof(App.tags[(index - 1)]) !== "undefined") {
					result = App.tags[(index - 1)];
					return false;
				} else if (self.currentTag == App.tags[index] && typeof(App.tags[(index - 1)]) == "undefined") {
					result = App.tags[App.tags.length - 1];
					return false;

				}
			});

			return result;
		},

		openTag: function(tag, pageNumber) {
			var self = this;
			this.currentTag = tag;
			this.currentPage = typeof pageNumber == "undefined" ? 1 : pageNumber;
			this.totalPages = this.data.collaction[tag].totalPages;
			if (this.currentPage == 1) {
				$(".left-arrow .tag_name").remove();
				var name = "Back to " + self.getPrevTagName(this.currentTag);
				$(".left-arrow").append("<label class='tag_name left " + name + "'>" + name + "</label>")
			} else {
				$(".left-arrow .tag_name").remove();
			}

			if (this.currentPage == this.totalPages) {
				var name = "Forward to " + self.getNextTagName(this.currentTag);


				$(".right-arrow").append("<label class='tag_name right " + name + "'>" + name + "</label>")
			} else {
				$(".right-arrow .tag_name").remove();
			}

			$('#totalPages').text(this.totalPages);
			$('.pagination-headline .yellow-text').text(this.currentPage);
			$('.page-headline .page').removeClass().addClass('page');
			$('.page-headline .page').addClass(tag);

			this.loadCard(this.currentTag, this.currentPage);
		},

		loadCard: function(tag, page) {
			var booklets = this.data.collaction[tag].pages[page].booklets;
			var self = this;
			$('.page-headline .page').text(this.currentTag);
			$('.page-headline .page').attr('title', this.currentTag);
			var innerCode = function() {
				$('.content-pictures').empty();

				$('.content-pictures').prepend(pages({
					IMAGEURL: App.IMAGEURL,
					PUBLICURL: App.PUBLICURL,
					booklets: booklets
				}));
				$('.content-pictures .cards').fadeIn(500);
				if ($(".cards:eq(3)").length > 0) {
					$(".cards:eq(3)").after(trophy({
						reword: self.data.collaction[tag].pages[page].reword
					}));
				} else {
					$('.content-pictures').append(trophy({
						reword: self.data.collaction[tag].pages[page].reword
					}));
				}
				if (self.data.collaction[tag].pages[page].cliamed_reword) {
					$(".card-img.trophy").addClass("active");
					$(".album-star.winner").addClass("active");
				}
			}

			if ($('.content-pictures .cards').length) {
				$('.content-pictures .cards').fadeOut(500, function() {
					innerCode();
				});
			} else {
				innerCode();
			}



		},

		render: function(obj, renderCard) {
			var self = this;
			this.data = obj;
			this.currentPage = obj.currentPage;
			this.totalPages = obj.currentTotalPages;
			this.currentTag = obj.currentTag;

			this.$el.append(tpl(obj));
			if (typeof renderCard == "undefined") {
				setTimeout(function() {
					self.openTag(self.data.currentTag, self.data.currentPage);
				}, 20);
			}



			return this;
		}
	});
	return CardBoard;
});