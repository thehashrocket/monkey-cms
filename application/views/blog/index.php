<div id="content" class="row">

    <div class="eight columns">
        <h2>Capital Team Blog</h2>
        <?php foreach ($query as $entry) { ?>
        <div class="blog_entry">
            <h2><a href="/blog/entry/<?php echo $entry->url_title; ?>"><?php echo $entry->title; ?></a></h2>
            <p><span class="metadata"><?php echo $entry->author; ?></span></p>
            <p><?php echo $entry->summary; ?></p>
        </div>
        <?php } ?>
    </div>
    <div class="four columns">
        <?= $this->load->view($sidebar); ?>
    </div>

</div>