<?php
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
?>
<section class="faq">
    <div class="container">
        <div class="title">
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
        </div>
        <?php if (have_rows('faq_item')): ?>
            <div class="accordion" id="accordionExample">
                <?php 
                $faqItemIndex = 0;
                while (have_rows('faq_item')): the_row();
                    $faqItemQuestion = get_sub_field('faq_item_question');
                    $faqItemAnswer = get_sub_field('faq_item_answer');
                ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="heading<?= $faqItemIndex; ?>">
                            <button class="accordion-button <?php if ($faqItemIndex != 0): ?>collapsed<?php endif; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faqItemIndex; ?>" aria-expanded="<?php if ($faqItemIndex == 0): ?>true<?php else: ?>false<?php endif; ?>" aria-controls="collapse<?= $faqItemIndex; ?>">
                                <?= $faqItemQuestion; ?>
                            </button>
                        </h3>
                        <div id="collapse<?= $faqItemIndex; ?>" class="accordion-collapse collapse <?php if ($faqItemIndex == 0): ?>show<?php endif; ?>" aria-labelledby="heading<?= $faqItemIndex; ?>" data-bs-parent="#accordionExample">
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
