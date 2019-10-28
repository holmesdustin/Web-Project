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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <br><br>
            &copy;<?php echo date('Y'); ?> <?php site_name(); ?>.<br><?php site_version(); ?>

        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="template/assets/js/jquery.min.js"></script>
    <script src="template/assets/js/jquery.scrolly.min.js"></script>
    <script src="template/assets/js/skel.min.js"></script>
    <script src="template/assets/js/util.js"></script>
    <script src="template/assets/js/main.js"></script>
    <script src="template/assets/js/particles.js"></script>
    <script src="template/assets/js/app.js"></script>

</body>

</html>