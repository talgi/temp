define(function() {
    var valhallaLoader = function(options) {

        var self = this;
        var defaults = {
            ajax: true
        }
        $.extend(defaults, options);
        this.start = function() {
            $('body').removeClass('valhalla-loader-done');

            self.length = 0;
            self.counter = 0;
            self.images = {}


            countImg();
            countBackgroundImages();
            renderBar();
            $('.valhalla-loader').show();



        }


        var countImg = function() {
            $("img").each(function() {
                if (typeof self.images[$(this).attr('src')] == "undefined") {
                    self.length++;
                    self.images[$(this).attr('src')] = true;
                }
            });
        };

        var countBackgroundImages = function() {

            $('*:not(img)').each(function() {
                var bg = $(this).css('background-image');

                bg = bg.replace('url(', '').replace(')', '');
                //console.log(new RegExp('linear-gradient').test(bg));
                if (bg !== '' && typeof self.images[bg] == "undefined" && !new RegExp('linear-gradient').test(bg) && bg != "none") {
                    self.length++;
                    self.images[bg] = true;
                }
            });
        };

        var countVideos = function() {
            $("video").each(function() {
                self.length++;
            })
        };

        var renderBar = function() {

            $.each(self.images, function(index) {
                $("<img src='" + index + "'>").on("load , error", function() {
                    self.counter++;
                    updateBar();


                })
            });


        }

        var updateBar = function() {
            //console.log(self.counter);
            var loading = Math.ceil(self.counter / self.length * 100);

            $('.valhalla-loader').css('transform', 'translate3d(' + loading + '%, 0, 0)');
            $('.valhalla-loader-progress').attr('data-progress-text', loading + '%');

            if (loading >= 100) {
                $(document).trigger("valhalla-loader-done");
                $('body').addClass('valhalla-loader-done');
            }
        };

        return this;

    }

    return valhallaLoader;

});