<?php
    $headline = get_sub_field('headline');
    $fullHeight = get_sub_field('full_height');
?>
<section class="contact-boxes" style="
    <?php if ($fullHeight === 'Yes'): ?>
        height: 100vh;
        display: flex; align-items: center; padding-top:0; padding-bottom:0;
    <?php endif; ?>
    ">
    <div class="container">
        <h2><?= $headline; ?></h2>
        <?php if( have_rows('contact_box')):?>
            <div class="contact-boxes-wrapper">
                <?php while( have_rows('contact_box') ): the_row();
                $contactBoxHeadline = get_sub_field('contact_box_headline');
                $contactBoxButtonText = get_sub_field('contact_box_button_text');
                $contactBoxButtonUrl = get_sub_field('contact_box_button_url');?>
                    <a class="contact-box" href="<?= $contactBoxButtonUrl; ?>">
                        <h3><?= $contactBoxHeadline; ?></h3>
                        <?php if( have_rows('contact_box_list_item')):?>
                            <ul>
                                <?php while( have_rows('contact_box_list_item') ): the_row();
                                $contactBoxListItemText = get_sub_field('contact_box_list_item_text');
                                $contactBoxListItemUrl = get_sub_field('contact_box_list_item_url');?>
                                    <?php if($contactBoxListItemUrl):?><a href="<?= $contactBoxListItemUrl; ?>"><?php endif;?><li><?= $contactBoxListItemText; ?></li><?php if($contactBoxListItemUrl):?></a><?php endif;?>
                                <?php endwhile;?>
                            </ul>
                        <?php endif;?>
                            <button type="button" class="btn btn-primary">
                                <?= $contactBoxButtonText; ?>
                            </button>
                        </a>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
</section>