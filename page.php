<?php get_header(); ?>
<section id="index" class="container">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold mb-4">Welcome to Globalizer</h1>
        <p class="text-lg text-gray-600 mb-8">This default Page.php Template.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="button_primary">Get Started</a>
    </div>
</section>
<?php get_footer(); ?>