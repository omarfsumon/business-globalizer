<?php get_header(); ?>
<section id="404" class="container">
    <div class="flex flex-col items-center justify-center min-h-[80vh]">
        <h1 class="text-9xl font-bold mb-4">404</h1>
        <p class="text-lg text-gray-600 mb-8 text-center">
            Oops! The page you are looking for does not exist.
            <br>
            It might have been moved or deleted.
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="button_primary">Go Back Home</a>
    </div>
</section>
<?php get_footer(); ?>