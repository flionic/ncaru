<?php ?>
<footer class="footer">
    <div class="container">
        <div class="social">
            <?php get_template_part('social'); ?>
        </div>
        <span><?php echo get_option('footer_text'); ?></span>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>