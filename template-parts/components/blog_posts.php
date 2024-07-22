<?php
    $headline = get_sub_field('headline');
    $buttonText = get_sub_field('button_text');
    $buttonUrl = get_sub_field('button_url');
    $numberOfPosts = get_sub_field('number_of_posts');
    $excerptLength = 20;
?>
<section class="blog-posts">
    <div class="container">
        <div class="title">
            <h2><?= esc_html($headline); ?></h2>
            <a href="<?= esc_url($buttonUrl); ?>">
                <button type="button" class="btn btn-primary">
                    <?= esc_html($buttonText); ?>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </a>
        </div>
        <div class="blog-posts-wrapper">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => (int)$numberOfPosts,
                'post_status' => 'publish'
            ));

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_excerpt = wp_trim_words(get_the_excerpt(), $excerptLength);
                    $post_date = get_the_date('F j, Y');
                    $post_url = get_permalink();
                    $post_image_url = get_the_post_thumbnail_url($post_id, 'large');
                    $categories = get_the_category();
                    $category_names = wp_list_pluck($categories, 'name');
                    $category_list = implode(', ', $category_names);
            ?>
                <a class="blog-post" href="<?= esc_url($post_url); ?>">
                    <img class="w-100" loading="lazy" decoding="async" src="<?= esc_url($post_image_url); ?>" alt="<?= esc_attr($post_title); ?>">
                    <div class="content">
                        <div class="text">
                            <div class="blog-post-info">
                                <span class="highlight"><?= esc_html($category_list); ?></span>
                                <span><?= esc_html($post_date); ?></span>
                            </div>
                            <h3 class="title"><?= esc_html($post_title); ?></h3>
                            <span><?= esc_html($post_excerpt); ?></span>
                        </div>
                        <button type="button" class="btn btn-link">
                            Read more
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
