<div id="content" class="row" >

    <div class="eight columns">

	    <?php

	        echo '<h2>' . $page_content->page_headline . '</h2>';

	        echo $page_content->page_content;

	        ?>

    </div>
    <div class="four columns">
        <?php $this->load->view($sidebar); ?>
    </div>

</div>