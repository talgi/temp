define([
    'backbone',
    'hbs!../../templates/mainpage',
    'hbs!../../templates/mainpage_component/header',
    'hbs!../../templates/comp/footer',
    'hbs!../../templates/mainpage_component/bar',
    'hbs!../../templates/mainpage_component/leaderboard',
    'hbs!../../templates/mainpage_component/sidebar_lotteries',
    'hbs!../../templates/mainpage_component/sidebar_adversting',
    'hbs!../../templates/mainpage_component/mylotories',
    'hbs!../../templates/mainpage_component/my_next_chaleange',
    'views/mainpage_component/cardboard',
    'app',
    'views/modals/upcomingLotteries',
    'views/modals/lotteriesResults',
    'views/modals/allCollection',
    'views/modals/joinLottory',
    'views/modals/welcomeModal',
    'views/modals/challengeAchived',
    'views/modals/youWin',
    'views/modals/youLose',
    'views/modals/questionBeforeJoin',
    'alertify',
    'odometer',
    'swiper',
    'bootstrap',
    'facebook'
], function(
    Backbone,
    tpl,
    tpl_header,
    Footer,
    tpl_bar,
    tpl_leaderboard,
    tpl_sidebarLotteries,
    tpl_sidebarAdversting,
    tpl_myLotories,
    tpl_myNextChaleange,
    //tpl_cardboard,
    CardBoard,
    App,
    UpcomingLotteries,
    LotteriesResults,
    AllCollection,
    JoinLottory,
    WelcomeModal,
    ChallengeAchived,
    YouWin,
    YouLose,
    QuestionBeforeJoin,
    alertify,
    Odometer
) {
    var MainPage = Backbone.View.extend({
        className: 'main-bg',
        id: 'main',

        initialize: function(options) {
            var self = this;
            $(document).on("click", ".yellow-btn-join", function(event) {
                self.joinLottoryPopup(event);
            })
        },

        events: {
            'click .upcoming-btn': 'openUpcomingPopup',
            'click .results-btn': 'openResultsPopup',
            'click .headline-button-all': 'openAllCollectionPopup',
            'click #enterLottory': 'joinLottoryPopup',
            'click #upcomingLottory': 'openUpcomingPopup',
            'click .type-menu a': 'onTypeClick',
            'click #onEnterCode': 'onEnterCode',
            'click .sign-out': 'signOut',
            'click .user-image': 'onNotificationClick',
            'submit #join-lottery-form': "joinLottery",
            'click #test1': 'onTEST1',
            'click #test2': 'onTEST2',
            'click #test3': 'onTEST3',
            'click #test5': 'onTEST5'
                //'click .card-img':"openCard"
        },

        onTEST1: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: false,
                view: new WelcomeModal()
            })

            return false;
        },

        onTEST2: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: false,
                view: new ChallengeAchived()
            })

            return false;
        },

        onTEST3: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: false,
                view: new YouWin()
            })

            return false;
        },

        onTEST5: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: false,
                view: new YouLose()
            })

            return false;
        },

        openCard: function() {
            this.cardboard.openCard();
        },
        onEnterCode: function(event) {
            event.preventDefault();

            var self = this;
            $.ajax({
                url: App.APIURL + 'codes',
                type: 'POST',
                dataType: 'json',
                data: {
                    code: $('#code').val()
                }
            }).done(function(e) {
                $('#code').val("");
                if (e.success) {
                    ga('send', 'event', 'Entering a flipcode');

                    var xhr = $.ajax({
                        url: App.APIURL + 'booklet/user-booklets/' + App.generalDetails.id,
                        type: 'get'
                    })

                    xhr.done(function(response) {
                        var res = {
                            collaction: response
                        }
                        var innerCode = function() {
                            var flagAnimateOnce = 0;
                            $('html,body').animate({
                                scrollTop: $('#cardboard-holder').offset().top
                            }, 600, function() {
                                if (!flagAnimateOnce) {
                                    self.cardboard.remove();
                                    self.renderCardboard(res, false);
                                    self.cardboard.openTag(e.booklet.name, e.booklet.page_number);
                                    window.setTimeout(function() {
                                        self.updateNotification();
                                    }, 1000)
                                    flagAnimateOnce++;
                                }
                            });
                        };
                        self.cardboard.openCard(e.booklet.image1);
                        $(document).one("finishMovie", function() {

                            self.increaseScore(e.booklet.points);
                            if (e.booklet.finishCollaction == 1) {
                                self.cardboard.startTrophyAnimtion();

                                $(document).one("finishTrophyMovie", function() {
                                    innerCode();
                                });
                            } else {
                                window.setTimeout(function() {
                                    innerCode();
                                }, 2500);

                            }
                        })
                    })

                } else {
                    var err = e.error;
                    /*
                    var html = '<h3>Oops, something has happened!</h3>';
                    $.each(err, function(index, val) {
                        console.log(val)
                        html += '<p>' + val + '</p>';
                    });
                    */
                    alertify.alert(err);
                }
            }).fail(function() {
                console.log("error");
            })
            return false;
        },

        onTypeClick: function(event) {
            event.preventDefault();
            this.cardboard.openTag($(event.currentTarget).find('.text').text());
        },

        joinLottoryPopup: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: false,
                view: new JoinLottory()
            })
            return false;
        },

        openUpcomingPopup: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: true,
                view: new UpcomingLotteries()
            })
            return false;
        },

        openResultsPopup: function(event) {
            event.preventDefault();

            App.vent.trigger('popup:open', {
                full: true,
                view: new LotteriesResults()
            })
            return false;
        },


        openAllCollectionPopup: function(event) {
            event.preventDefault();
            var self = this;
            var id = $(event.currentTarget).data("id");
            var d = {
                name: $(event.currentTarget).find('.flippers-info .name').text(),
                score: $(event.currentTarget).find('.flippers-info .score').text(),
            }
            $.ajax({
                url: App.APIURL + 'booklet/user-booklets/' + id,
                type: 'get'
            }).done(function(e) {
                $.extend(true, d, e);

                App.vent.trigger('popup:open', {
                    full: true,
                    view: new AllCollection(d)
                })
            });

            return false;
        },

        signOut: function(e) {
            e.preventDefault();
            $.ajax({
                url: App.APIURL + 'auth/logout',
                type: 'get'
            }).done(function(e) {
                App.Router.navigate("", true);
            });

        },

        onNotificationClick: function(event) {
            event.preventDefault();
            $('.notification-box').toggle();
            if (!$('.notification-box').is(":visible")) {
                $('.notification-box ul').empty();
                $.ajax({
                    url: App.APIURL + 'my-flip-madness/delete-notifications',
                    type: 'get'
                }).done(function(e) {
                    $(".notification").hide();
                    $('.notification-box ul').html('<li>No New Notification!</li>');
                });
            }


        },

        onClose: function() {
            var self = this;
            $(document).off("click", ".yellow-btn-join");
            self.$el.find(".time-counting").each(function() {
                if ($(this).data("end")) {
                    $(this).countdown('destroy');
                }

            });
            self.$el.find(".time-count").each(function() {
                if ($(this).data("end")) {
                    $(this).countdown('destroy');
                }

            });
        },

        updateNotification: function() {
            $.ajax({
                url: App.APIURL + 'my-flip-madness/notifications',
                type: 'get',
                dataType: 'json'
            }).done(function(e) {
                if (e.length > 0) {
                    var box = [];

                    $.each(e, function(index, value) {
                        switch (value.type) {
                            case "challenge achieved":
                                App.notificationPopup.push({
                                    id: value.id,
                                    view: new ChallengeAchived(value.details),
                                    challengeAchieved: 1
                                });
                                break;
                            case "medal":
                                $(".darken-medal:first").removeClass("darken-medal");
                                box.push(value.medal.notification_text)
                                break;
                            case "lottery losser":
                                App.notificationPopup.push({
                                    id: value.id,
                                    view: new YouLose(value.details)
                                });
                                break;
                            case "lottery winner":
                                App.notificationPopup.push({
                                    id: value.id,
                                    view: new YouWin(value.details)
                                });
                                break;
                            default:
                                box.push(value.free_text)
                        }
                    });


                    if (App.notificationPopup.length > 0) {
                        App.vent.trigger('popup:open', {
                            full: false,
                            view: App.notificationPopup[0].view,
                            notificationId: App.notificationPopup[0].id,
                            challengeAchieved: App.notificationPopup[0].challengeAchieved
                        });
                    }

                    if (box.length > 0) {
                        $(".bar .notification").show();
                        $(".bar .notification-text").html(box.length)
                        $(".bar .notification-content ul").html("");
                        $.each(box, function(index, value) {
                            $(".bar .notification-content ul").append("<li>" + value + "</li>");
                        });
                    } else {
                        $(".bar .notification").hide();
                        $('.notification-box ul').html('<li>No New Notification!</li>');
                    }

                } else {
                    $(".bar .notification").hide();
                    $('.notification-box ul').html('<li>No New Notification!</li>');
                }
            });
        },

        renderBar: function(res) {
            var self = this;
            var width = App.generalDetails.score / 40001 * 100
            width = width > 100 ? 100 : width;
            var medals = res.medals
            $.each(medals, function(index, value) {
                var persent = App.generalDetails.views / medals[index].views * 100;
                medals[index].percent = persent > 100 ? 100 : persent;
                medals[index].points = persent > 100 ? medals[index].views : App.generalDetails.views;
                medals[index].user_views = App.generalDetails.views >= medals[index].views ? medals[index].views : App.generalDetails.views;
                //console.log(medals[index].views);
            });



            return tpl_bar({
                IMAGEURL: App.IMAGEURL,
                PUBLICURL: App.PUBLICURL,
                bar_width: width,
                barAchivments: res.barAchivments,
                score: App.generalDetails.score,
                myBooks: res.collaction.ownedBooklets,
                totalBooks: res.collaction.totalBooklets,
                image: App.generalDetails.image,
                name: App.generalDetails.firstName + " " + App.generalDetails.lastName,
                medals: medals,
                collaction: self.arrangeCollaction(res.collaction)
            });
        },

        arrangeCollaction: function(collaction) {
            collaction.currentTag;
            collaction.currentPage;
            collaction.currentTotalPages = 0;
            App.tags = [];
            var currentPageSumBooklets = -1;
            $.each(collaction.collaction, function(index, obj) {
                App.tags.push(index);
                $.each(obj.pages, function(index2, ob2) {
                    var activeBookletsCounter = 0;
                    $.each(ob2.booklets, function(index3, obj3) {
                        if (obj3.active) {
                            activeBookletsCounter++;
                        }
                        if (obj3.total_books == 1) {
                            obj3.total_books == 0
                        }
                    });
                    if (activeBookletsCounter > currentPageSumBooklets) {
                        collaction.currentPage = index2;
                        collaction.currentTag = index;
                        currentPageSumBooklets = activeBookletsCounter;
                        collaction.currentTotalPages = obj.totalPages;

                    }

                });

            });

            return collaction;
        },

        renderLeaderBourd: function(res) {
            var players = res.topPlayers;
            var friends = res.topFriends;
            //console.log(players);
            $.each(players, function(index) {
                if (typeof players[index].rank == "undefined") {
                    players[index].rank = index + 1;
                }

            });
            $.each(friends, function(index) {
                if (typeof friends[index].rank == "undefined") {
                    friends[index].rank = index + 1;
                }
            });
            return tpl_leaderboard({
                IMAGEURL: App.IMAGEURL,
                PUBLICURL: App.PUBLICURL,
                topPlayers: players,
                topFriends: friends
            })
        },

        renderCardboard: function(res, renderCard) {
            var self = this;
            self.cardboard = new CardBoard();
            $.extend(res.collaction, {
                PUBLICURL: App.PUBLICURL,
                userId: App.generalDetails.id
            });

            self.cardboard.render(
                res.collaction,
                renderCard
            )
            $('#cardboard-holder').append(self.cardboard.el);


        },

        increaseScore: function(score) {
            var self = this;
            /*
            $(".time-count").each(function(index, el) {
                $(this).countdown('destroy');
            });

            $(".time-counter").each(function(index, el) {
                $(this).countdown('destroy');
            });
            */



            $(".time-counting").each(function(index, el) {
                $(this).countdown('destroy');
            });


            App.generalDetails.score = parseInt(App.generalDetails.score);
            App.generalDetails.score += parseInt(score);
            var width = App.generalDetails.score / 40001 * 100
            width = width > 100 ? 100 : width;
            $('.bar-yellow').css('width', width + "%");
            $.ajax({
                url: App.APIURL + 'my-flip-madness/increase-score',
                type: 'get',
                dataType: 'json',

            }).done(function(e) {
                self.od_score.update(App.generalDetails.score);
                $(".user-challenges").html(tpl_myLotories({
                    IMAGEURL: App.IMAGEURL,
                    PUBLICURL: App.PUBLICURL,
                    lotteris: e.userLotteris,
                    fill_lot_details: App.generalDetails.fill_lot_details ? 0 : 1
                }));
                if (e.nextLottery) {
                    $(".user-challenges").append(tpl_myNextChaleange({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL,
                        'lottery': e.nextLottery,
                        score: App.generalDetails.score,
                        fill_lot_details: App.generalDetails.fill_lot_details ? 0 : 1

                    }));
                    var points = App.generalDetails.score >= e.nextLottery.required_points ? 100 : App.generalDetails.score / e.nextLottery.required_points * 100;
                    $(".progress-bar-warning").css("width", points + "%");
                }

                $(".leaderborad_tabs").replaceWith(self.renderLeaderBourd(e));
                self.initCountDown();
            });

        },
        initCountDown: function() {
            var self = this;
            self.$el.find(".time-counting").each(function() {
                if ($(this).data("end")) {
                    var timeleft = $(this).data("end") - App.generalDetails.server_time +10;

                    $(this).countdown({
                        until: +timeleft,
                        format: "dHMS",
                        layout: "{dnn}:{hnn}:{mnn}:{snn}",
                        onExpiry: function() {

                            self.increaseScore(0);
                            self.updateNotification();
                        }
                    });
                } else {
                    $(this).html("No draws at this moment")
                    $(this).css("font-size", "25px");
                }
            })
            self.$el.find(".time-count").each(function() {
                var timeleft = $(this).data("end") - App.generalDetails.server_time +10;
                $(this).countdown({
                    until: +timeleft,
                    format: "dHMS",
                    layout: "{dnn}:{hnn}:{mnn}:{snn}",
                    onExpiry: function() {


                    }
                })

            })
        },

        render: function() {
            var self = this;

            this.content = {
                v1: 1,
                v2: 2
            }
            $.ajax({
                url: App.APIURL + 'my-flip-madness/all-page',
                type: 'get',
                dataType: 'json',

            }).done(function(e) {

                self.allPageData = e

                var all = {
                    PUBLICURL: App.PUBLICURL,
                    IMAGEURL: App.IMAGEURL,
                    header: tpl_header({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL
                    }),
                    bar: self.renderBar(e),
                    leaderboard: self.renderLeaderBourd(e),
                    adversting: tpl_sidebarAdversting({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL
                    }),
                    sidebar_lotteries: tpl_sidebarLotteries({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL,
                        end: e.closestLottery.end
                    }),

                    mylotories: tpl_myLotories({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL,
                        lotteris: e.userLotteris,
                        fill_lot_details: App.generalDetails.fill_lot_details ? 0 : 1
                    }),
                    footer: Footer({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL
                    })
                }



                if (e.nextLottery) {
                    all.nextChalelange = tpl_myNextChaleange({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL,
                        'lottery': e.nextLottery,
                        score: App.generalDetails.score,
                        fill_lot_details: App.generalDetails.fill_lot_details ? 0 : 1

                    });
                }

                self.$el.append(tpl(all));


                var bar_width = App.generalDetails.score / 40001 * 100
                bar_width = bar_width > 100 ? 100 : bar_width;


                $(document).on('valhalla-loader-done', function() {
                    $('.bar-yellow').css('width', bar_width + "%");

                });


                if (e.nextLottery) {
                    var points = App.generalDetails.score >= e.nextLottery.required_points ? 100 : App.generalDetails.score / e.nextLottery.required_points * 100;
                    $(".progress-bar-warning").css("width", points + "%");
                }
                self.updateNotification();


                self.renderCardboard(e);
                $("#tabs ul li a").tab();

                $('#tabs ul li a').on('click', function() {
                    ga('send', 'event', 'button', 'click', 'Friends-flippers');
                });

                $('.headline-button-all').on('click', function() {
                    ga('send', 'event', 'button', 'click', 'Viewing-another-user-profile');
                });


                $('[data-toggle="tooltip"]').tooltip();

                self.od_score = new Odometer({
                    //auto: false,
                    el: $('.score-number')[0],
                    value: 0,
                    duration: 3001
                });
                App.valhallaLoader.start();
                self.initCountDown();
                self.od_score.update(App.generalDetails.score);
            });



            return this;
        }
    });
    return MainPage;
});