<!DOCTYPE HTML>

<html lang="en">

<head>
    <link rel="icon" href="https://i.pinimg.com/originals/6b/4a/73/6b4a738dd051ec314307435efa574807.png">
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
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="https://github.com/holmesdustin/Web-Project" class="icon fa-github"><span class="label">GitHub</span></a></li>
        </ul>
        <div class="copyright">
            &copy;<?php echo date('Y'); ?> <?php site_name(); ?>.<br><?php site_version(); ?>
        </div>
    </footer>

    <!-- Scripts -->
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
            $("#result_showed").show();
            $('html, body').animate({
                scrollTop: $("#result_showed").offset().top
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
                    $("#result_showed").delay("slow").fadeIn();
                    $("#result_showed").html(result);

                },
                error: function() {
                    alert("Failed to get result");
                }
            });
            return false;
        });
    </script>


    <script>
        $("#buttonContact").click(function() {
            var firstName = $("#firstNameContact").val();
            var lastName = $("#lastNameContact").val();
            var email = $("#emailContact").val();
            var message = $("#messageContact").val();
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
                },
                error: function() {
                    alert("Failed to reach server. Please try again.");
                }
            });
            return false;
        });
    </script>

</body>

</html>