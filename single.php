<?php get_header(); ?>

<section class="bg-gray-50 py-8">
    <div class="container mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-5">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="flex flex-col justify-center gap-3 order-2 lg:order-1">
                <!-- Title -->
                <h1 class="text-2xl lg:text-3xl font-semibold"><?php the_title(); ?></h1>

                <!-- post exseption -->
                <?php if (has_excerpt()) : ?>
                    <p class="text-gray-600"><?php the_excerpt(); ?></p>
                <?php else : ?>
                <!-- collect from the content -->
                    <p class="text-gray-600"><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></p>
                <?php endif; ?>

                <!-- Meta Info -->
                <div class="text-gray-800 text-base">
                    By <span class="font-medium"><?php the_author(); ?></span> | <?php echo get_the_date(); ?> | <?php the_category(', '); ?>
                </div>
            </div>
            <div class="flex flex-col justify-center order-1">
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-lg']); ?>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</section>

<section class="py-8 bg-white">
    <div class="container">
        <?php echo globalizer_get_breadcrumb(); ?>
    </div>

    <div class="container grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Sidebar - TOC (25%) -->
        <aside class="lg:col-span-3 space-y-6">
            <?php echo get_dynamic_toc(); ?>
        </aside>

        <!-- Main Content (50%) -->
        <main class="lg:col-span-6">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <!-- Post Content -->
                <div class="prose max-w-none prose-img:rounded-lg prose-a:text-blue-600 hover:prose-a:underline single-post">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <div class="mt-6">
                    <?php the_tags('<div class="flex flex-wrap gap-2 text-sm">', '', '</div>'); ?>
                </div>

                <!-- Post Navigation -->
                <div class="flex justify-between mt-8 border-t pt-4">
                    <div><?php previous_post_link('%link', '← Previous'); ?></div>
                    <div><?php next_post_link('%link', 'Next →'); ?></div>
                </div>
            <?php endwhile; endif; ?>
        </main>

        <!-- Right Sidebar (25%) -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Search -->
            <div class="p-4 border rounded-lg bg-white">
                <?php get_search_form(); ?>
            </div>

            <!-- Categories -->
            <div class="border rounded-lg bg-white overflow-hidden">
                <h4 class="text-lg font-bold sticky top-0 p-3 bg-white shadow">Topics We Covered</h4>
                <ul class="space-y-1 text-sm px-5 py-4">
                    <?php wp_list_categories(['title_li' => '']); ?>
                </ul>
            </div>

            <!-- Recent Posts -->
            <div class="border rounded-lg bg-white overflow-hidden">
                <h4 class="text-lg font-bold sticky top-0 p-3 bg-white shadow">Recent Post</h4>
                <ul class="space-y-2 text-sm px-5 py-4">
                    <?php
                    $recent_posts = wp_get_recent_posts(['numberposts' => 5]);
                    foreach ($recent_posts as $post) :
                        ?>
                        <li>
                            <a href="<?php echo get_permalink($post['ID']); ?>" class="hover:underline">
                                <?php echo esc_html($post['post_title']); ?>
                            </a>
                        </li>
                    <?php endforeach; wp_reset_query(); ?>
                </ul>
            </div>

            <!-- Popular Posts -->
            <div class="border rounded-lg bg-white overflow-hidden">
                <h4 class="text-lg font-bold sticky top-0 p-3 bg-white shadow">Popular Post</h4>
                <ul class="space-y-2 text-sm px-5 py-4">
                    <?php
                    $popular_posts = new WP_Query([
                        'posts_per_page' => 5,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                    ]);
                    
                    if ($popular_posts->have_posts()) :
                        while ($popular_posts->have_posts()) : $popular_posts->the_post();
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" class="hover:underline">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </div>

            
        </aside>
    </div>
</section>
<section class="bg-gray-50 py-8">
    <!-- Related Posts -->
    <div class="container my-12">
        <h2 class="text-xl font-bold mb-4">Related Post</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $categories = wp_get_post_categories(get_the_ID());
            $related = new WP_Query([
                'category__in' => $categories,
                'post__not_in' => [get_the_ID()],
                'posts_per_page' => 3
            ]);
            if ($related->have_posts()) :
                while ($related->have_posts()) : $related->the_post(); ?>
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition bg-white">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full object-cover aspect-video']); ?>
                            </a>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:underline">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>



<?php get_footer(); ?>