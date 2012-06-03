<div id="content" class="row">

    <div class="twelve columns">
        <div class="row">
            <div class="twelve columns">
                <form id="category">
                <div class="one column">
                    <p><?=form_label('Category', 'category')?></p>
                </div>
                <div class="five columns">
                    <select id="catMenu" name="catMenu">
                        <?php foreach ($categories->result() as $row): ?>
                        <option value="/projects/index/<?=$row->idcategories?>" > <?=$row->idcategories?> - <?=$row->category_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="two columns">
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <h2>Capital Team: Projects</h2>
                <p>You are currently viewing projects in the <?= $catname; ?> category.</p>

            </div>
        </div>
        <div class="row">
            <?php if(count($projects)>0) : foreach ($projects->result() as $row): ?>
                <div style="margin-left: 10px" class="projectGalleryItem six columns">
                    <div class="row">
                        <div class="four columns">
                            <a href="/project/index/<?= $row->idprojects_table ?>"><img src="<?=$row->thumb ?>" /></a>
                        </div>
                        <div class="eight columns">
                            <a href="/project/index/<?= $row->idprojects_table ?>">
                                <div class="row">
                                    <div class="twelve columns">

                                        <h3><?= $row->ProjectTitle ?>,<br/> <?= $row->ProjectSubTitle ?></h3>
                                        <h4>by <?= $row->first_name ?> <?= $row->last_name ?> in <?= $row->city ?>, <?= $row->state ?></h4>
                                        <p><?= $row->ProjectDescription ?></p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="six columns">
                                        <p>[Pledge Total]</p>
                                    </div>
                                    <div class="six columns">
                                        <p>[Time Left]</p>
                                    </div>
                                </div>
                            </a>
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
        </div>
    </div>


</div>

<script type="text/javascript">

    var selectmenu=document.getElementById("catMenu")
    selectmenu.onchange=function(){ //run some code when "onchange" event fires
        var chosenoption=this.options[this.selectedIndex] //this refers to "selectmenu"
        if (chosenoption.value!="nothing"){
            window.open(chosenoption.value, "_top", "") //open target site (based on option's value attr) in new window
        }
    }

</script>