<div id="content" class="row">

    <div class="eight columns">
        <h2><?php echo $post->title; ?></h2>
        <p><span class="metadata"><?php echo $post->author; ?></span></p>
        <?php echo $post->entry; ?>

        <p><a href="/index.php/blog/">Back to Blog</a></p>
    </div>
    <div class="four columns">
        <?= $this->load->view($sidebar); ?>
    </div>

</div>