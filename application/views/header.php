<div id="wrapper" class="container">
    <div id="header" class="row">
        <div class="eight columns">
            <a href="/"><img id="logo" src="<?php echo base_url();?>/assets/images/site-images/logo.png"></a>
        </div>
        <div class="four columns">
            <img id="slogan" src="<?php echo base_url();?>/assets/images/site-images/tagline.png">
        </div>
    </div>
    <div id="tagline" class="row">
        <div id="topmenu" class="six columns offset-by-three menu">
			<nav>
				<ul class="pagelist">
					<?php
					if (isset($pagelist) && count($pagelist) > 0) :
						foreach ($pagelist->result() as $row):
							?>
							<li class=""><a href="/index/<?= $row->page_name ?>"><?php echo strtoupper($row->page_name) ?></a></li>
							<?php endforeach; else: ?>
						<tr>No Pages Added</tr>
						<?php endif; ?>
				</ul>
			</nav>
        </div>
        <div class="three columns"><p class="subheader">A Taragon International, Ltd. Venture.</p></div>
    </div>
    <div id="submenu" class="row">
        <div class="submenu seven columns centered">

        </div>
    </div>
