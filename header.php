<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
    <div class="header-container">
        <div class="logo-section">
            <div class="logo">DD</div>
            <div class="site-name"><?php echo get_bloginfo('name') ? get_bloginfo('name') : 'Degree Drishti'; ?></div>
        </div>
        
        <nav class="main-nav">
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li class="dropdown">
                    <a href="#programs">Programs</a>
                    <div class="dropdown-content">
                        <div class="dropdown-section">
                            <h4>Master's Programs</h4>
                            <a href="#mba">MBA</a>
                            <a href="#mba-dual">MBA (Dual Specification)</a>
                            <a href="#mba-wx">MBA (WX)</a>
                            <a href="#executive-mba">Executive MBA (1 year)</a>
                            <a href="#mca">MCA</a>
                            <a href="#mcom">MCom</a>
                            <a href="#msc-data-science">MSc (Data Science)</a>
                            <a href="#ma-journalism">MA (Journalism & Mass Communication)</a>
                            <a href="#ma-public-policy">MA (Public Policy & Governance)</a>
                        </div>
                        <div class="dropdown-section">
                            <h4>Bachelor's Programs</h4>
                            <a href="#bba">BBA</a>
                            <a href="#bca">BCA</a>
                            <a href="#bcom">BCom</a>
                            <a href="#ba">BA</a>
                        </div>
                        <div class="dropdown-section">
                            <h4>Integrated Programs</h4>
                            <a href="#bca-mca">BCA + MCA</a>
                            <a href="#bba-mba">BBA + MBA</a>
                            <a href="#bcom-mba">B.Com + MBA</a>
                            <a href="#bcom-acca">B.Com + ACCA</a>
                        </div>
                        <div class="dropdown-section">
                            <h4>Certification & Diploma</h4>
                            <a href="#cert-3months">Certification Diploma (3 Months)</a>
                            <a href="#cert-6months">Certification Diploma (6 Months)</a>
                            <a href="#diploma-1year">Diploma (1 Year)</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>