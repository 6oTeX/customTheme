        <!-- Footer -->
        <section id="footer">
            <ul class="icons">
                <!-- Update the URLs to your social profiles -->
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="<?php bloginfo('rss2_url'); ?>" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
                <li><a href="mailto:your-email@example.com" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
            </ul>
            <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
        </section>

    </div> <!-- End of Wrapper -->

    <!-- Scripts -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/browser.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/breakpoints.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/util.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
