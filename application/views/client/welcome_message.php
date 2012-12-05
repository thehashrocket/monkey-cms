<div id="content" class="row">

<div class="twelve columns">
<div class="row">
	<div class="twelve columns">
		<h2>CMS Manager</h2>
	</div>
</div>
<div class="row">
	<div class="twelve columns">
		<div>
			<?php echo validation_errors(); ?>
		</div>
	</div>
</div>
<div class="row">
<div class="twelve columns">
<script>
	$(function () {
		$("#tabs").tabs({
			cookie:{
				name:'ClientTabs',
				// store cookie for a day, without, it would be a session cookie
				expires:1
			}
		});
		$("#startdate").datepicker({ dateFormat:'yy-mm-dd', minDate:+1 });
		$("#enddate").datepicker({ dateFormat:'yy-mm-dd', minDate:+7});
	});
	$(".repeat").live('click', function () {
		var $self = $(this);
		$('.repeatable').clone().insertAfter(".repeatable");
		$self.remove();
	});
</script>
<script type="text/javascript">
	jQuery.fn.addClone = function () {

		return this.each(function () {

			// get row for cloningg
			var row = $(this).parents('tr');
			var parent = {};

			// use tbody or table parent
			if ($(row).parents('tbody').length > 0) {
				parent = $(row).parents('tbody');
			} else {
				parent = $(row).parents('table');
			}

			// inject clone
			var copy = $(row).clone();
			$(copy).addClass('sadey');
			$(copy).addClass('isclone');
			$(parent).append(copy);

			// remove last td and replace with remove html
			$('.sadey').children('td:last').remove();
			$('.sadey').append('<td><img src="/assets/images/icons/delete-icon-16.png" onclick="$(this).killClone()"></td>');

			// increment all ids and names
			var id = ($('.isclone').length + 1);
			$('.sadey').find('*').each(function () {
				var tempId = $(this).attr('id');
				if (typeof tempId != 'undefined' && tempId != '') {
					$(this).attr('id', tempId + '_' + id);
				}
				var tempName = $(this).attr('name');
				if (typeof tempName != 'undefined' && tempName != '') {
					$(this).attr('name', tempName + '_' + id);
				}
			});

			// remove active tag
			$('.sadey').removeClass('sadey');

		});

	};

	// remove a row and re-index the clones
	jQuery.fn.killClone = function () {

		var row = $(this).parents('tr');
		$(row).remove();

		// re-index
		var id = 2;
		$('.isclone').each(function () {
			$(this).find('*').each(function () {

				var tempId = $(this).attr('id');
				if (typeof tempId != 'undefined' && tempId != '') {
					tempId = tempId.split('_');
					$(this).attr('id', tempId[0] + '_' + id);
				}
				var tempName = $(this).attr('name');
				if (typeof tempName != 'undefined' && tempName != '') {
					tempName = tempName.split('_');
					$(this).attr('name', tempName[0] + '_' + id);
				}
			});
			id++;
		});
	};

</script>

<div class="demo">
<div id="tabs">

<ul>
	<li><a href="#tabs-1">My Profile</a></li>
	<li><a href="#tabs-2">Categories</a></li>
	<li><a href="#tabs-3">My Images</a></li>
	<li><a href="#tabs-4">Pages</a></li>
	<li><a href="#tabs-5">FAQ</a></li>
    <li><a href="#tabs-6">Locations</a> </li>
</ul>

<!-- Your Profile -->
<div id="tabs-1">
	<h4>Your Information</h4>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php $attributes = array('class' => 'nice', 'id' => 'profileForm');
	echo form_open('/client/profileUpdate', $attributes);
	?>
	<?=form_fieldset('');?>
	<div class="row">
		<div class="twelve columns">
			<div class="six columns">
				<?=form_label('First Name:', 'bill_firstname');?>
				<input type="text" name="bill_firstname" id="bill_firstname" class="input-text" placeholder="First Name"
					   value="<?=$clientdata->first_name?>">

			</div>
			<div class="six columns">
				<?=form_label('Last Name', 'bill_lastname');?>
				<input type="text" name="bill_lastname" id="bill_lastname" class="input-text" placeholder="Last Name"
					   value="<?=$clientdata->last_name?>">

			</div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<div class="six columns">
				<?=form_label('Company Name', 'bill_company');?>
				<input type="text" name="bill_company" id="bill_company" class="input-text" placeholder="Company Name"
					   value="<?=$clientdata->company?>">

			</div>
			<div class="six columns"></div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<div class="six columns">
				<?=form_label('Email Address', 'bill_email');?>
				<input type="text" name="bill_email" id="bill_email" class="input-text" placeholder="Email Address"
					   value="<?=$clientdata->email?>">

			</div>
			<div class="six columns"></div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<?=form_label('Street Address', 'bill_street');?>
			<input type="text" name="bill_street" id="bill_street" class="input-text" placeholder="Street Address"
				   value="<?=$clientdata->street?>">

		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<div class="six columns">
				<?=form_label('City', 'bill_city');?>
				<input type="text" name="bill_city" id="bill_city" class="input-text" placeholder="Street Address"
					   value="<?=$clientdata->city?>">

			</div>
			<div class="three columns">
				<?=form_label('State', 'bill_state');?>
				<input type="text" name="bill_state" id="bill_state" class="small input-text" placeholder="State"
					   value="<?=$clientdata->state?>">

			</div>
			<div class="three columns">
				<?=form_label('Zip', 'bill_zip');?>
				<input type="text" name="bill_zip" id="bill_zip" class="small input-text" placeholder="Zip"
					   value="<?=$clientdata->zip?>">

			</div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<?= form_submit('mysubmit', 'Submit Updates!'); ?>
		</div>
	</div>
	<?= form_fieldset_close();?>
	<?= form_close()?>
</div>

<!-- Site Categories -->
<div id="tabs-2">
	<h4>Site Categories</h4>
	<ul id="catlist">
		<li><div class="row">
            <div class="twelve columns">
				<?= form_open('/client/catUpdate', 'class="nice"') ?>
				<?= form_fieldset('');?>
                <input type="hidden" name="idcategories" value=""/>

                <div class="two columns"><input type="text" placeholder="Category Name" name="catname" value=""
                                                class="input-text small"></div>

                <div class="four columns"><input type="text" placeholder="Category Description" name="catdesc" value=""
                                                 class="input-text"></div>

                <div class="one column"><INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png"
                                               ALT="Submit button"></div>
                <!--<img src="" onClick="$(this).addClone();">-->
				<?= form_fieldset_close();?>
				<?= form_close()?>
            </div>
        </div></li>
	</ul>

</div>

<!-- Photo Gallery -->
<div id="tabs-3">
	<h4>Photo Gallery</h4>
	<?php echo validation_errors('<p class="error">'); ?>
	<div id="gallery">
		<?php $results = $photos->result();
		if (isset($results) && count($results) > 0):
			foreach ($results as $row): ?>
				<div class="adminthumb">
					<div class="deleteimage"><a href="/client/deletephoto/<?=$row->photo_id ?>"><img
						src="/assets/images/icons/delete-icon-32.png" alt="Delete Image"></a></div>
					<a href="<?=$row->fullsize ?>">
						<img src="<?=$row->thumb ?>"/>
					</a>

				</div>
				<?php endforeach; else: ?>
			<div id="blank_gallery">No Photos have been uploaded!</div>
			<?php endif; ?>
	</div>

	<div id="upload">
		<?php
		$redirect = current_url();
		echo form_open_multipart('/client/gallery_up/', 'class=nice');
		echo form_hidden('redirect', $redirect);
		echo form_upload('userfile');
		echo form_submit('upload', 'Upload');
		echo form_close();
		?>
	</div>


</div>

<!-- Pages -->
<div id="tabs-4" class="pageeditor">
	<h4>Pages</h4>
	<?php echo validation_errors('<p class="error">'); ?>

	<div class="row">
		<div class="twelve columns">
			<div class="two columns">
				<h5>Pages</h5>
				<div class="row">
					<div class="twelve columns">
						<nav>
							<ul id="reorder" class="pagelist">
								<li class="twelve columns"><a href="/client/index/<?= $user_id ?>/0">Create A Page</li>
								<?php
								if (isset($pagelist) && count($pagelist) > 0) :
									foreach ($pagelist->result() as $row):
										?>
										<li id="item-<?= $row->pageid ?>" class="twelve columns"><a href="/client/index/<?= $user_id ?>/<?= $row->pageid ?>"><?php echo $row->page_name ?></a></li>
										<?php endforeach; else: ?>
									<li>No Pages Added</li>
									<?php endif; ?>
							</ul>
						</nav>
					</div>

				</div>
				<div class="row">
					<div class="twelve columns">
						<div id="feedback"></div>
					</div>
				</div>
			</div>
			<div class="ten columns">
				<h5>Page Editor</h5>

				<?php $attributes = array('class' => 'nice', 'id' => 'pageForm');
				echo form_open('/client/pageUpdate', $attributes)
				; ?>
				<input type="hidden" name="pageid" value="<?= $row->pageid ?>"/>
				<input type="hidden" name="userid" value="<?= $user_id;?>"/>



				<?= form_fieldset()
				; ?>
				<div class="row">
					<div class="four columns">
						<label for="parentpage">Parent Page</label>
						<select id="parentpage" name="parentpage">
							<option value="">None</option>
							<?php
							if (isset($pagelist) && count($pagelist) > 0) :
								foreach ($pagelist->result() as $row):
									?>
									<option value="<?= $row->pageid ?>" selected="<?= $row->parentid ?>"><?php echo $row->page_name ?></option>
									<?php endforeach; else: ?>
								<tr>No Pages Added</tr>
								<?php endif; ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="twelve columns">
						<input type="text" placeholder="Page Name" name="pagename" value="<?= $row->page_name;?>" class="input-text">
					</div>
				</div>
                <div class="row">
                    <div class="twelve columns">
                        <input type="text" placeholder="Menu Name" name="menuname" value="<?= $row->menu_name;?>" class="input-text">
                    </div>
                </div>
				<div class="row">
					<div class="twelve columns">
						<input type="text" placeholder="Page Headline" name="pageheadline" value="<?= $row->page_headline;?>"
						       class="input-text">
					</div>
				</div>
				<div class="row">
					<div class="twelve columns">
						<textarea name="pagecontent" id="pagededitor"><?= $row->page_content;?></textarea>
						<?php echo display_ckeditor($ckeditor); ?>
						<input type="hidden" name="userid" value="<?= $user_id;?>"/>
					</div>
				</div>
				<div class="row">
					<div class="two columns">
						<INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button">
					</div>
					<div class="two columns">
						<a class="pagedelete" href="/client/pageDelete/<?= $user_id;?>/<?= $row->pageid ?>"><INPUT TYPE="IMAGE" SRC="/assets/images/icons/delete-icon-32.png" ALT="Delete button"></a>
					</div>
					<div class="eight columns last"></div>
				</div>

				<?= form_fieldset_close()
				; ?>
				<?= form_close()
				; ?>

			</div>

		</div>
	</div>

</div>

<!-- FAQ -->
<div id="tabs-5">
	<h4>Frequently Asked Questions</h4>

	<div class="row">
		<div class="twelve columns">
			<ul id="faqlist">
				<li>
					<div class="row">
						<?= form_open('/client/faqUpdate', 'class="nice faqUpdate"');?>
						<input type="hidden" name="idfaq_table" value=""/>
						<input type="hidden" name="userid" value="<?= $user_id;?>"/>
						<?= form_fieldset();?>
						<div class="four columns">
							<textarea rows="2" cols="20" name="question" placeholder="FAQ Question:"></textarea>
						</div>
						<div class="four columns">
							<textarea rows="2" cols="20" name="answer" placeholder="FAQ Answer:"></textarea>
						</div>
						<div class="two columns">
							<INPUT class="submitfaq" TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button">
						</div>
						<?= form_fieldset_close();?>
						<?= form_close();?>
					</div>
				</li>
			</ul>
			
		</div>
	</div>
</div>

<!-- Haunted Locations -->
<div id="tabs-6" class="haunted-location">
    <h4>Locations</h4>

	<div class="row">
		<div class="twelve columns">
			<table id="locations" class="tablesorter">
				<thead>
					<tr>
						<th>Name</th>
						<th>City</th>
						<th>State</th>
						<th>Zip</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div id="map-canvas"></div>
	</div>

    <?php $attributes = array('class' => 'nice', 'id' => 'locationForm');
    echo form_open('', $attributes);
    ?>

	<input type="hidden" name="locationid" value=""/>
	<input type="hidden" name="userid" value="<?= $user_id;?>"/>
	<input type="hidden" name="tbxlat" id="tbxlat" >
	<input type="hidden" name="tbxlng" id="tbxlng">


    <?=form_fieldset('');?>
    <div class="row">
        <div class="twelve columns">
            <div class="six columns">
                <?=form_label('Location Name', 'location_name');?>
                <input type="text" name="location_name" id="location_name" class="input-text" placeholder="Location Name"
                       value="">

            </div>
            
        </div>
    </div>

    <div class="row">
    	<div class="three columns">
            	<?=form_label('Featured Property', 'featured');?>
            	<input type="checkbox" name="featured" id="featured" value="1">
            </div>

        <div class="three columns">
            <?=form_label('Reduced', 'reduced');?>
            <input type="checkbox" name="reduced" id="reduced" value="1">

        </div>
        <div class="three columns">
            <?=form_label('Rented', 'rented');?>
            <input type="checkbox" name="rented" id="rented" value="1">

        </div>
        <div class="three columns">
            <?=form_label('Sold', 'sold');?>
            <input type="checkbox" name="sold" id="sold" value="1">

        </div>
    </div>

    <div class="row">
        <div class="twelve columns">
            <?=form_label('Street Address', 'location_street');?>
            <input type="text" name="location_street" id="location_street" class="input-text" placeholder="Street Address"
                   value="">

        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
            <div class="six columns">
                <?=form_label('City', 'location_city');?>
                <input type="text" name="location_city" id="location_city" class="input-text" placeholder="City"
                       value="">

            </div>
            <div class="three columns">
                <?=form_label('State', 'location_state');?>
                <input type="text" name="location_state" id="location_state" class="small input-text" placeholder="State"
                       value="">

            </div>
            <div class="three columns">
                <?=form_label('Zip', 'location_zip');?>
                <input type="text" name="location_zip" id="location_zip" class="small input-text" placeholder="Zip" value="">

            </div>
        </div>
    </div>
    <div class="row">
    	<div class="twelve columns">
    		<div class="six columns">
                <?=form_label('Price', 'sale_price');?>
                <input type="text" name="sale_price" id="sale_price" class="input-text" placeholder="Sale Price"
                       value="">

            </div>
            <div class="six columns">
                <?=form_label('Rent', 'rent_price');?>
                <input type="text" name="rent_price" id="rent_price" class="input-text" placeholder="Rental Price"
                       value="">

            </div>
    	</div>
    </div>
    <div class="row">
    	<div class="twelve columns">
            <div class="four columns">
                <?=form_label('Bedrooms', 'bedrooms');?>
                <input type="text" name="bedrooms" id="bedrooms" class="input-text" placeholder="Bedrooms"
                       value="">

            </div>
            <div class="four columns">
                <?=form_label('Bathrooms', 'bathrooms');?>
                <input type="text" name="bathrooms" id="bathrooms" class="input-text" placeholder="Bathrooms"
                       value="">

            </div>
            <div class="four columns">
                <?=form_label('Square Feet', 'square_feet');?>
                <input type="text" name="square_feet" id="square_feet" class="input-text" placeholder="Square Feet"
                       value="">

            </div>
    	</div>
    </div>
    <div class="row">
    	<div class="twelve columns">
    		<?=form_label('Property Photo', 'location_photo');?>
    		<select id="location_photo" name="location_photo">
				<option value="">None</option>
				<?php
				if (isset($photolist) && count($photolist) > 0) :
					foreach ($photolist->result() as $row):
						?>
						<option value="<?= $row->photo_id ?>"><?php echo $row->photoname ?></option>
						<?php endforeach; else: ?>
					<tr>No Photos Added</tr>
					<?php endif; ?>
    		</select>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<textarea name="location_description" id="locationeditor"></textarea>
			<?php echo display_ckeditor($ckeditor2); ?>
			<input type="hidden" name="userid" value="<?= $user_id;?>"/>
		</div>
	</div>
	<div class="row">
        <div class="twelve columns">
            <?= form_submit('mysubmit', 'Submit Updates!'); ?>
        </div>
    </div>
    <?= form_fieldset_close();?>
    <?= form_close()?>
</div>


</div>
</div>

</div>


<!--<div class="two columns">
            <?/*= $this->load->view($sidebar); */?>
        </div>-->

</div>
