<?php get_header(); ?>
<section class="bg-white py-12">
    <div class="flex flex-col items-center justify-center py-8">
        <?php
            if (is_category()) {
                echo '<h1 class="text-3xl font-bold mb-4">' . single_cat_title('', false) . '</h1>';
                echo '<p class="text-gray-600">' . category_description() . '</p>';
            } elseif (is_tag()) {
                echo '<h1 class="text-3xl font-bold mb-4">Posts Tagged: ' . single_tag_title('', false) . '</h1>';
                echo '<p class="text-gray-600">' . tag_description() . '</p>';
            } elseif (is_author()) {
                the_post();
                echo '<h1 class="text-3xl font-bold mb-4">Author: ' . get_the_author() . '</h1>';
                echo '<p class="text-gray-600">Browse all posts by ' . get_the_author() . '</p>';
                rewind_posts();
            } elseif (is_day()) {
                echo '<h1 class="text-3xl font-bold mb-4">Daily Archives: ' . get_the_date() . '</h1>';
            } elseif (is_month()) {
                echo '<h1 class="text-3xl font-bold mb-4">Monthly Archives: ' . get_the_date('F Y') . '</h1>';
            } elseif (is_year()) {
                echo '<h1 class="text-3xl font-bold mb-4">Yearly Archives: ' . get_the_date('Y') . '</h1>';
            } else {
                echo '<h1 class="text-3xl font-bold mb-4">Archives</h1>';
            }
        ?>

        <!-- Search Form -->
        <div class="flex-1 max-w-xl mx-auto px-4 w-full py-3">
            <?php get_search_form(); ?>
        </div>
    </div>
</section>

<section id="archive" class="container py-12">
    <!-- Archive Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="bg-white shadow rounded-lg p-5 hover:shadow-lg transition-shadow duration-300">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-4">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'w-full object-cover rounded-lg aspect-video']); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <h2 class="text-xl font-semibold mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:underline underline-offset-2">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="text-gray-500 text-sm mb-4">
                    <span>By <?php the_author(); ?></span> |
                    <span><?php echo get_the_date(); ?></span> |
                    <span><?php the_category(', '); ?></span>
                </div>
                <p class="text-gray-700 mb-4">
                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?> 
                    <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:underline">Read more</a>
                </p>
            </article>
        <?php endwhile; else : ?>
            <p class="text-gray-500">No posts found in this archive.</p>
        <?php endif; wp_reset_postdata(); ?>
    </div>

    <!-- Pagination -->
    <?php globalizer_pagination(); ?>
</section>

<?php get_footer(); ?>
