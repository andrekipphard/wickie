<?php
    // Get the headline and text
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');

    // Convert headline to a valid ID for the section
    $headlineId = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $headline), '-'));

    // Add a unique index or random number to ensure uniqueness
    $uniqueId = uniqid(); // This generates a unique identifier
?>
<section class="faq" id="faq-<?= $headlineId; ?>-<?= $uniqueId; ?>">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
        </div>
        <?php if (have_rows('faq_item')): ?>
            <div class="accordion" id="accordion-<?= $headlineId; ?>-<?= $uniqueId; ?>">
                <?php 
                $faqItemIndex = 0;
                while (have_rows('faq_item')): the_row();
                    $faqItemQuestion = get_sub_field('faq_item_question');
                    $faqItemAnswer = get_sub_field('faq_item_answer');

                    // Convert FAQ question to a valid ID
                    $faqItemId = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $faqItemQuestion), '-'));
                ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="heading-<?= $faqItemId; ?>-<?= $uniqueId; ?>-<?= $faqItemIndex; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>-<?= $faqItemIndex; ?>" aria-expanded="false" aria-controls="collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>-<?= $faqItemIndex; ?>">
                                <?= $faqItemQuestion; ?>
                            </button>
                        </h3>
                        <div id="collapse-<?= $faqItemId; ?>-<?= $uniqueId; ?>-<?= $faqItemIndex; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $faqItemId; ?>-<?= $uniqueId; ?>-<?= $faqItemIndex; ?>" data-bs-parent="#accordion-<?= $headlineId; ?>-<?= $uniqueId; ?>">
                            <div class="accordion-body">
                                <?= $faqItemAnswer; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                $faqItemIndex++; 
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
