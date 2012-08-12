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
	<?php echo validation_errors('<p class="error">'); ?>
	<?php
	if (isset($categorydata) && count($categorydata) > 0) :
		foreach ($categorydata->result() as $row):

			?>
			<div class="row">
				<div class="twelve columns">

					<?= form_open('/client/catUpdate', 'class="nice"') ?>
					<?= form_fieldset('');?>
					<input type="hidden" name="userid" value="<?= $user_id;?>"/>
					<input type="hidden" name="idcategories" value="<?= $row->idcategories;?>"/>

					<div class="three columns"><input type="text" value="<?= $row->catname ?>" name="catname"
													  class="input-text small"></div>

					<div class="four columns"><input type="text" value="<?= $row->catdescription ?>" name="catdesc"
													 class="input-text"></div>

					<div class="one column"><INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png"
												   ALT="Submit button"></div>
					<!--<img src="" onClick="$(this).addClone();">-->
					<div class="one column"><a href="/client/deleteCategory/<?= $row->idcategories;?>"><img
						src="/assets/images/icons/delete-icon-32.png"> </a></div>
					<div class="three column"></div>


					<?= form_fieldset_close();?>
					<?= form_close()?>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<?php echo validation_errors('<p class="error">'); ?>
					<?= form_open('/client/catUpdate', 'class="nice"') ?>
					<?= form_fieldset('');?>
					<input type="hidden" name="userid" value="<?= $user_id;?>"/>

					<div class="three columns"><input type="text" placeholder="Category Name" name="catname" value=""
													  class="input-text small"></div>

					<div class="four columns"><input type="text" placeholder="Category Description" name="catdesc"
													 value="" class="input-text"></div>

					<div class="one column"><INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png"
												   ALT="Submit button"></div>
					<!--<img src="" onClick="$(this).addClone();">-->
					<div class="four column"></div>



					<?= form_fieldset_close();?>
					<?= form_close()?>
				</div>
			</div>

			<?php endforeach; else: ?>
		<div class="row">
			<div class="twelve columns">
				<?php echo validation_errors('<p class="error">'); ?>
				<?= form_open('/client/catUpdate', 'class="nice"') ?>
				<?= form_fieldset('');?>
				<input type="hidden" name="userid" value="<?= $user_id;?>"/>

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
		</div>
		<?php endif; ?>

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
								<?php
								if (isset($pagelist) && count($pagelist) > 0) :
									foreach ($pagelist->result() as $row):
										?>
										<li id="item-<?= $row->pageid ?>" class="twelve columns"><a href="/client/index/<?= $user_id ?>/<?= $row->pageid ?>"><?php echo $row->page_name ?></a></li>
										<?php endforeach; else: ?>
									<tr>No Pages Added</tr>
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
									<option value="<?= $row->pageid ?>"><?php echo $row->page_name ?></option>
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
					<div class="twelve columns">
						<INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button">
					</div>
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
			<?php if (isset($faqs) && count($faqs) > 0): foreach ($faqs->result() as $row): ?>
			<div class="row">
				<?= form_open('/client/faqUpdate', 'class=nice');?>
				<input type="hidden" name="projectid" value="<?= $projdata['idprojects_table'];?>"/>
				<input type="hidden" name="idfaq_table" value="<?= $row->idfaq_table ?>"/>
				<input type="hidden" name="userid" value="<?= $user_id;?>"/>
				<?= form_fieldset();?>
				<div class="four columns">
					<textarea rows="2" cols="20" name="question"
							  placeholder="Question: "><?= $row->question ?></textarea>
				</div>
				<div class="four columns">
					<textarea rows="2" cols="20" name="answer" placeholder="Answer: "><?= $row->answers ?></textarea>
				</div>
				<div class="one column">
					<INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button">
				</div>
				<div class="one column">
					<a href=""><img SRC="/assets/images/icons/delete-icon-32.png" ALT="Delete button"></a>
				</div>
				<?= form_fieldset_close();?>
				<?= form_close();?>
			</div>
			<?php endforeach; else: ?>
			<div class="row">
				<div><h4>No FAQs have been created!</h4></div>
			</div>

			<?php endif; ?>
			<div class="row">
				<?= form_open('/client/faqUpdate', 'class=nice');?>
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
					<INPUT TYPE="IMAGE" SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button">
				</div>
				<?= form_fieldset_close();?>
				<?= form_close();?>
			</div>
		</div>
	</div>
</div>


</div>
</div>

</div>


<!--<div class="two columns">
            <?/*= $this->load->view($sidebar); */?>
        </div>-->

</div>
