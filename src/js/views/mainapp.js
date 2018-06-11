define([
    'backbone',
    'hbs!../../templates/main_app',
    'views/comp/alert',
    'views/comp/popup',
    'app',
    "hbs/handlebars",
    'mobileDetect',
    'valhallaLoader',
    'jquery.nicescroll'
], function(
    Backbone,
    tpl,
    Alert,
    Popup,
    App,
    Handlebars,
    MobileDetect,
    valhallaLoader

) {
    var MainView = Backbone.View.extend({
        //className: 'page',
        id: 'main-container',
        alert: null,

        initialize: function(options) {
            App.vent = _.extend({}, Backbone.Events);
            App.md = new MobileDetect(window.navigator.userAgent);
            var self = this;

            //$('body').hide();
            if (!App.md.mobile() && !App.md.tablet()) {
                $('body').addClass('noScroll');
            }

            $(document).on('valhalla-loader-done', function() {

                //$('#main-container').addClass('itsOn');
                //$('.site-loader').hide();

                $('body').animate({
                    scrollTop: 0
                }, 0);

                if (!App.md.mobile() && !App.md.tablet() && !$("#popup").is(":visible")) {
                    if (typeof(App.nice) !== "undefined" && typeof(App.nice.remove) == "function") {
                        App.nice.remove();
                    }
                    App.nice = $('body').niceScroll({
                        cursorcolor: "#daa132",
                        cursorwidth: "12px",
                        cursorborder: '0px solid #fff',
                        zindex: 9999,
                        autohidemode: 'cursor',
                        horizrailenabled: false

                    });
                    $('body').removeClass('noScroll');
                }

            })

            $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
                $('.ajax-Loading').removeClass('show');
            });
            $(document).ajaxSuccess(function(event, xhr, settings) {
                $('.ajax-Loading').removeClass('show');
            });
            $(document).ajaxComplete(function(event, xhr, settings) {
                $('.ajax-Loading').removeClass('show');
            });

            $.ajaxSetup({
                beforeSend: function(xhr) {
                    $('.ajax-Loading').addClass('show');
                },
                error: function(x, t, m) {

                }
            });
        },

        openAlert: function(obj) {
            if (this.alert) {
                this.alert.remove();
            }
            this.alert = new Alert();
            this.$el.append(this.alert.el);
            this.alert.render(obj);
        },

        closeAlert: function() {
            if (this.alert) {
                this.alert.remove();
            }

        },

        openPopup: function(obj) {
            var self = this;
            if (this.popup) {
                this.popup.remove();
            }
            this.popup = new Popup();
            this.$el.append(this.popup.el);
            if (obj.challengeAchieved) {
                self.startChallengeAchievedAnimtion();
                $(document).one("finishChallengeAchievedMovie", function() {
                    self.popup.render(obj);

                    if (typeof self.popup.notificationId != "undefined") {
                        $.ajax({
                            url: App.APIURL + 'my-flip-madness/delete-notifications/' + self.popup.notificationId,
                            type: 'get'
                        })
                        App.notificationPopup.splice(0, 1);
                    }
                });
            } else {
                self.popup.render(obj);

                if (typeof this.popup.notificationId != "undefined") {
                    $.ajax({
                        url: App.APIURL + 'my-flip-madness/delete-notifications/' + self.popup.notificationId,
                        type: 'get'
                    })
                    App.notificationPopup.splice(0, 1);
                }
            }

        },
        startChallengeAchievedAnimtion: function() {

            $('.ChallengeAchieved-holder').fadeIn('fast');

            var outputCanvas = document.getElementById('ChallengeAchievedoutput');
            var output = outputCanvas.getContext('2d');
            var bufferCanvas = document.getElementById('ChallengeAchievedbuffer');
            var buffer = bufferCanvas.getContext('2d');

            var videoWidth = outputCanvas.width;
            var videoheight = outputCanvas.height;

            function processFrame() {
                buffer.drawImage(App.videoChallengeAchieved, 0, 0);

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
            var play = function(){
                clearInterval(self.interval);
                self.interval = setInterval(processFrame, 40)
            };
            App.videoChallengeAchieved.removeEventListener("play",play);

            App.videoChallengeAchieved.addEventListener('play', play, false);

            // Firefox doesn't support looping video, so we emulate it this way
            var ended = function() {
                $('.ChallengeAchieved-holder').fadeOut('fast');
                $(document).trigger("finishChallengeAchievedMovie");
            };
            App.videoChallengeAchieved.removeEventListener("ended",ended);
            App.videoChallengeAchieved.addEventListener('ended',ended ,  false);

            App.videoChallengeAchieved.play();

            window.setTimeout(function(){
                App.videoChallengeAchieved.removeEventListener("ended", ended);
                ended();

            },6000);
        },

        closePopup: function() {
            if (typeof this.popup === "undefined") {
                return;
            }
            this.popup.remove();
            if (App.notificationPopup.length > 0) {
                App.vent.trigger('popup:open', {
                    full: false,
                    view: App.notificationPopup[0].view,
                    notificationId: App.notificationPopup[0].id,
                    challengeAchieved: App.notificationPopup[0].challengeAchieved
                });
            }
        },

        render: function() {

            var self = this;

            this.$el.append(tpl({
                PUBLICURL:App.PUBLICURL
            }));

            App.video = document.getElementById('openVideo');
            App.video.load();
            App.videoTrophy = document.getElementById('videoTrophy');
            App.videoTrophy.load();
            App.videoChallengeAchieved = document.getElementById('videoChallengeAchieved');
            App.videoChallengeAchieved.load();

            App.valhallaLoader = new valhallaLoader();
            App.vent.on('alert:open', this.openAlert, this);
            App.vent.on('alert:close', this.closeAlert, this);

            App.vent.on('popup:open', this.openPopup, this);
            App.vent.on('popup:close', this.closePopup, this);



            return this;
        }
    });

    return MainView;
});