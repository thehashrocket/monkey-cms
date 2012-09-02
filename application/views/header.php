<div id="wrapper" class="container">
    <div id="header" class="row">
        <div class="eight columns">
            <a href="/"><img id="logo" src="<?php echo base_url();?>assets/images/site-images/logo.png"></a>
        </div>
        <div class="four columns">
            
        </div>
    </div>
    <div id="featured" class="row">
        <div id="s1" class="twelve columns">
                        <img src="<?php echo base_url();?>assets/images/slides/anim1.jpg" alt="Animation 1" />
                        <img src="<?php echo base_url();?>assets/images/slides/anim2.jpg" alt="Animation 2" />
                    </div>
        <div id="topmenu" class="twelve columns">
            <nav>
                <ul class="menu sf-menu">
                    <?php
                     echo $navigation;
                     ?>
                </ul>
            </nav>
        </div>
    </div>
