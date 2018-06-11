define([
    'backbone',
    'hbs!../../templates/profile_settings',
    'app',
    'alertify',
    'bootstrap',
    'facebook',
    "helper",
], function(
    Backbone,
    tpl,
    App,
    alertify

) {
    var SettingsPage = Backbone.View.extend({

        initialize: function(options) {},

        events: {
            "submit #settings-form": "updateProfile",

            "change #user_image": "imageUpload",
            'click .inner-back': 'onBack'
        },

        onClose: function() {

        },
        onBack: function(event) {
            event.preventDefault();
            App.Router.navigate("", true);
        },

        imageUpload: function(e) {
            var filesToUpload = $("#user_image")[0].files;
            var file = filesToUpload[0];

            var img = document.createElement("img");
            var reader = new FileReader();
            reader.onload = function(e) {

                $(".user_image").html(e.target.result);
                $(".profile-picture").css("background-image", "url('" + e.target.result + "')");

                $(".icon-camera").remove();
            }
            reader.readAsDataURL(file);

        },

        updateProfile: function(e) {
            e.preventDefault();
            $("#settings-loader").show();
            var formData = $("#settings-form").serializeObject();
            formData.birthday = $('#dateOfBirthDay').val() + '-' + $('#dateOfBirthMonth').val() + '-' + $('#dateOfBirthYear').val(),
                formData.user_image = $.trim($(".user_image").html());
            $.ajax({
                url: App.APIURL + 'my-flip-madness/settings',
                type: 'post',
                dataType: 'json',
                data: formData
            }).done(function(e) {
                $("#settings-loader").hide();
                if (e.success == 1) {
                    alertify.alert("your details has been saved");
                } else {
                    var msg = "";
                    if ($.isArray(e.error)) {

                        $.each(e.error, function(index, value) {
                            msg += value + "<br>";
                        });
                    }
                    alertify.alert(msg);
                }
            });
        },

        render: function() {
            var self = this;
            $.ajax({
                url: App.APIURL + 'my-flip-madness/settings',
                type: 'get',
                dataType: 'json'
            }).done(function(e) {
                App.valhallaLoader.start();
                $.extend(e, {
                    IMAGEURL: App.IMAGEURL,
                    PUBLICURL: App.PUBLICURL
                });
                self.$el.append(tpl(e));
            });

            return this;
        }
    });
    return SettingsPage;
});