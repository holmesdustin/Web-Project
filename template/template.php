<!DOCTYPE HTML>
<!--
	Binary by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

<head>
    <title><?php page_title(); ?> | <?php site_name(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="template/assets/css/main.css" />
</head>

<body>

    <!-- Header -->
    <header id="header">
        <a href="index.html" class="logo"><?php site_name()?></a>
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
        </ul>
        <div class="copyright">
            &copy;<?php echo date('Y'); ?> <?php site_name(); ?>.<br><?php site_version(); ?>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="template/assets/js/jquery.min.js"></script>
    <script src="template/assets/js/jquery.scrolly.min.js"></script>
    <script src="template/assets/js/skel.min.js"></script>
    <script src="template/assets/js/util.js"></script>
    <script src="template/assets/js/main.js"></script>

</body>

</html>