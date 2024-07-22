<?php
    $logo = get_field( 'header_logo', 'options' )
?>
<div class="container header-desktop">
    <div class="left">
        <div class="logo">
            <a href="/">
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($logo, 'large'); ?>">
            </a>
        </div>
        <div class="navigation">
            <ul class="nav">
                <li class="nav-item dropdown mega-menu-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button">
                        Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="productsDropdown">
                        <div class="row mega-menu">
                            <div class="col">
                                <div class="row">
                                    <div class="col-lg-3">
                                    <h6><i class="bi bi-cash-coin"></i>Earn and Borrow</h6>
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Wickie DUO</a></li>
                                            <li><a class="dropdown-item" href="#">Wickie Credit</a></li>
                                            <li><a class="dropdown-item" href="#">X-Accounts</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3">
                                        <h6><i class="bi bi-gift"></i>Rewards</h6>
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Cryptoback Rewards</a></li>
                                            <li><a class="dropdown-item" href="#">X-tras</a></li>
                                            <li><a class="dropdown-item" href="#">Refer a friend</a></li>
                                            <li><a class="dropdown-item" href="#">Mastercard Offers</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3">
                                        <h6><i class="bi bi-graph-up"></i>Invest and Trade</h6>
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Wickie Multiply</a></li>
                                            <li><a class="dropdown-item" href="#">Cryptocurrencies</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3">
                                        <h6><i class="bi bi-credit-card"></i>Card and Banking</h6>
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Wickie Card</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h6 class="mt-3"><i class="bi bi-diagram-3"></i>Ecosystem</h6>
                                        <ul>
                                            <li><a class="dropdown-item" href="#">Whitepaper</a></li>
                                            <li><a class="dropdown-item" href="#">Security</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="helpDropdown" role="button">
                        Help
                    </a>
                    <div class="dropdown-menu" aria-labelledby="helpDropdown">
                        <div class="row normal-menu">
                            <div class="col">
                                <ul>
                                    <li><a class="dropdown-item" href="#">Help Hub</a></li>
                                    <li><a class="dropdown-item" href="#">Create Ticket</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Company</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right">
        <button type="button" class="btn btn-link"><i class="bi bi-globe"></i>En</button>
        <?php if( have_rows('header_cta', 'options')):?>
            <?php while( have_rows('header_cta', 'options') ): the_row();
            $headerButtonUrl = get_sub_field('header_button_url');
            $headerButtonIcon = get_sub_field('header_button_icon');
            $headerButtonText = get_sub_field('header_button_text');?>
                <a href="<?=$headerButtonUrl;?>">
                    <button type="button" class="btn btn-link">
                        <i class="bi bi-<?=$headerButtonIcon;?>"></i>
                        <?=$headerButtonText;?>
                    </button>
                </a>
            <?php endwhile;?>
        <?php endif;?>
    </div>
</div>
