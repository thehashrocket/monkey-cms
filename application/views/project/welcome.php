<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=353756671316223";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="content" class="row">

    <div class="twelve columns">

        <div class="row">
            <?php if(count($project)>0) : foreach ($project->result() as $row): ?>
            <div class="twelve columns">
                <div class="row">
                    <div id="project" class="three columns">
                        <h3><?= $row->ProjectTitle ?>,<br/> <?= $row->ProjectSubTitle ?></h3>
                        <h4>by <?= $row->first_name ?> <?= $row->last_name ?> in <?= $row->city ?>, <?= $row->state ?></h4>
                        <img src="<?=$row->thumb ?>" />
                        <div class="fb-like" data-send="false" data-width="200" data-show-faces="false"></div>
                        <p>[Pledge Total]</p>
                        <p>[Time Left]</p>
                        <p>Submit Button</p>
                        <p>There is a minimum commitment of [minimum pledge]</p>
                    </div>
                    <div id="projdescription" class="five columns">
                            <div class="row">
                                <div class="twelve columns">
                                    <p><?= $row->ProjectDescription ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="six columns">
                                    
                                </div>
                                <div class="six columns">
                                    
                                </div>
                            </div>
                    </div>
                <?php endforeach; ?>
                <?php else : ?>
                <div style="margin-left: 10px" class="projectGalleryItem six columns">
                    <h4>There's no project in this category yet?</h4>
                    <p>There aren't any projects in this category yet. Submit a project
                        and you could be the first!</p>
                </div>
                <?php endif; ?>
                    <div id="commitment" class="four columns">
                        <h3>Commitment Levels</h3>
                        <div class="row">
                            <div class="eleven columns centered">
                                <div class="row">
                                    <?php if(count($pledgedata)>0) : foreach ($pledgedata->result() as $row): ?>
                                    <div class="two columns pledge">
                                        <p><?= $row->pledge_amount ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <div style="margin-left: 10px" class="projectGalleryItem six columns">
                                        <h4>There's no pledge for this project yet?</h4>
                                        <p>The submitter hasn't created any pledge levels yet.</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="eleven columns centered" id="RewardBox">
                                <h4>Commitment Reward Description</h4>
                            </div>
                            <?php if(count($pledgedata)>0) : foreach ($pledgedata->result() as $row): ?>
                                <div class="row">
                                    <div class="eleven columns centered reward">
                                        <h4><?= $row->pledge_amount ?></h4>
                                        <p><img src="<?=$row->thumb ?>" width="75px;" /></p>
                                        <p><?= $row->pledge_reward ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <div style="margin-left: 10px" class="projectGalleryItem six columns">
                                <h4>There's no pledge for this project yet?</h4>
                                <p>The submitter hasn't created any pledge levels yet.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

</div>