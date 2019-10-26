<!DOCTYPE HTML>

<html lang="en">

<head>
    <link rel="icon" href="https://icon-library.net/images/movie-icon-images/movie-icon-images-4.jpg">
    <script src="https://kit.fontawesome.com/65af02a589.js" crossorigin="anonymous"></script>
    <title><?php page_title(); ?> | <?php site_name(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="template/assets/css/main.css" />
</head>

<body>
    <!-- Header -->
    <header id="header">
        <a class="logo" href="../index.php"><i class="fas fa-film fa-lg"></i><strong>&nbsp;&nbsp;<?php site_name() ?></strong></a>

        <nav>
            <a href="#menu">Menu</a>

        </nav>
    </header>

    <!-- Nav -->
    <nav id="menu">
        <ul class="links">
            <?php nav_menu(); ?>
        </ul>
    </nav>

    <?php page_content(); ?>

    <!-- Footer -->
    <footer id="footer">
        <a class="weatherwidget-io" href="https://forecast7.com/en/32d46n84d99/columbus/?unit=us" data-label_1="COLUMBUS" data-label_2="WEATHER" data-font="Roboto" data-icons="Climacons Animated" data-mode="Both" data-days="7" data-theme="original" data-basecolor="">COLUMBUS WEATHER</a>
        <script>
            ! function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = 'https://weatherwidget.io/js/widget.min.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'weatherwidget-io-js');
        </script>
        <br><br>
        <div class="copyright">
            <a href="https://github.com/holmesdustin/Web-Project"><i class="fab fa-github fa-2x"></i></a>
            <br><br>
            &copy;<?php echo date('Y'); ?> <?php site_name(); ?>.<br><?php site_version(); ?>

        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="template/assets/js/jquery.min.js"></script>
    <script src="template/assets/js/jquery.scrolly.min.js"></script>
    <script src="template/assets/js/skel.min.js"></script>
    <script src="template/assets/js/util.js"></script>
    <script src="template/assets/js/main.js"></script>
    <script src="template/assets/js/particles.js"></script>
    <script src="template/assets/js/app.js"></script>

    <script>
        $("#button").click(function() {
            $("#result_showed").hide();
            $("#darkModeSection").hide();
            $("#result_loading").show();
            $('html, body').animate({
                scrollTop: $("#result_loading").offset().top
            }, 1000);
            var keyword = $("#inputKey").val();
            $.ajax({
                type: 'post',
                url: '../includes/functions.php',
                data: {
                    "search": keyword
                },
                dataType: "HTML",
                success: function(result) {
                    $("#result_showed").html(result); //load the page                     
                    $("#result_showed").ready(function() { //when the page is ready
                        $("#result_loading").hide(200); //hide loading spinner
                        $("#result_showed").show(0); //show the result
                        $("#darkModeSection").show(0);
                        $('html, body').animate({
                            scrollTop: $("#result_loading").offset().top
                        }, 500);
                    });
                },
                error: function() {
                    alert("Failed to get result");
                }
            });
            
            return false;
        });

        $("#back-to-top").click(function() {
            $('html, body').animate({
                scrollTop: $("#banner").offset().top
            }, 1000);
        });

        $(window).scroll(function() {
            if ($('#customSwitch1').is(':checked')) {
                $("#result_showed").css("background-color", "#1c1c1c");
                $("#darkModeSection").css("background-color", "#1c1c1c");
                $(".card").css("background-color", "#3b3b3b");
                $(".card").css("color", "#e3e3e3");
                $(".card-title").css("color", "white");
                $(".modal-content").css("background-color", "#3b3b3b");
                $(".modal-content").css("color", "white");
            } else {
                $("#result_showed").css("background-color", "white");
                $("#darkModeSection").css("background-color", "white");
                $(".card").css("background-color", "white");
                $(".card").css("color", "#444");
                $(".card-title").css("color", "#555");
                $(".modal-content").css("background-color", "white");
                $(".modal-content").css("color", "#444");
            }

            if ($('#inputKey').length) {
                var hT = $('#inputKey').offset().top,
                    hH = $('#inputKey').outerHeight(),

                    wS = $(this).scrollTop();
                if (wS > hT + hH) {
                    $("#back-to-top").show(0);
                } else {
                    $("#back-to-top").hide(0);
                }
            }
        });

        $('#customSwitch1').change(function() {
            if ($(this).is(':checked')) {
                //dark mode on
                $(".custom-control-label").text("Dark Mode Turns On");
                $("#result_showed").css("background-color", "#1c1c1c");
                $("#darkModeSection").css("background-color", "#1c1c1c");
                $(".card").css("background-color", "#3b3b3b");
                $(".card").css("color", "#e3e3e3");
                $(".card-title").css("color", "white");
                $(".modal-content").css("background-color", "#3b3b3b");
                $(".modal-content").css("color", "white");
            } else {
                //dark mode off
                $(".custom-control-label").text("Dark Mode Turns Off");
                $("#result_showed").css("background-color", "white");
                $("#darkModeSection").css("background-color", "white");
                $(".card").css("background-color", "white");
                $(".card").css("color", "#444");
                $(".card-title").css("color", "#555");
                $(".modal-content").css("background-color", "white");
                $(".modal-content").css("color", "#444");
            }
        });
    </script>


    <script>
        $("#buttonContact").click(function() {
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha === "") {
                event.preventDefault();
                alert("Please check the reCAPTCHA");
            } else {
                var firstName = $("#firstNameContact").val();
                var lastName = $("#lastNameContact").val();
                var email = $("#emailContact").val();
                var message = $("#messageContact").val();
                if (firstName === "" || lastName === "" || email === "" || message === "") {
                    alert("Please provide all information that we need.");
                } else {
                    $("#buttonContact").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle;"></span>&nbsp;&nbsp;Sending...');
                    $.ajax({
                        type: 'post',
                        url: '../includes/mailHandler.php',
                        data: {
                            "firstName": firstName,
                            "lastName": lastName,
                            "email": email,
                            "message": message
                        },
                        dataType: "text",
                        success: function(result) {
                            alert(result);
                            $("#firstNameContact").val('');
                            $("#lastNameContact").val('');
                            $("#emailContact").val('');
                            $("#messageContact").val('');
                            $("#buttonContact").html('Send Message');
                        },
                        error: function() {
                            alert("Failed to reach server. Please try again.");
                            $("#buttonContact").html('Send Message');
                        }
                    });

                }
            }
            return false;
        });
    </script>
    <script>
        $(function() {
            function rescaleCaptcha() {
                var width = $('.g-recaptcha').parent().width();
                var scale;
                if (width < 302) {
                    scale = width / 302;
                } else {
                    scale = 1.0;
                }

                $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                $('.g-recaptcha').css('transform-origin', '0 0');
                $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
            }

            rescaleCaptcha();
            $(window).resize(function() {
                rescaleCaptcha();
            });

        });
    </script>

</body>

</html>