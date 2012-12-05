/**
 * Created with IntelliJ IDEA.
 * User: jason
 * Date: 10/6/12
 * Time: 10:06 PM
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(function ($) {


	$(function () {
		$.ajaxSetup({
			error: function (jqXHR, exception) {
				if (jqXHR.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (jqXHR.status === 404) {
					alert('Requested page not found. [404]');
				} else if (jqXHR.status === 500) {
					alert('Internal Server Error [500].');
				} else if (exception === 'parsererror') {
					alert('Requested JSON parse failed.');
				} else if (exception === 'timeout') {
					alert('Time out error.');
				} else if (exception === 'abort') {
					alert('Ajax request aborted.');
				} else {
					alert('Uncaught Error.\n' + jqXHR.responseText);
				}
			}
		});
	});

	sortableSideList();
	makeListClickable();
	getFAQDetails();
	getCategoryDetails();
	getLocationDetails();


	/* Delete Page and remove item from pagelist */
	$('a.pagedelete').on('click', function (e) {
		e.preventDefault();
		var pathname = $(this).attr("href").split("/");
		var pageid = pathname[pathname.length - 1];

		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		data += 'pageid=' + pageid;
		$.ajax({
			url: "/client/pageDelete",
			type: "POST",
			data: data,
			success: function (feedback) {
				console.log('Page Deleted');
				var newdata = {};

				newdata.pageid = 0;
				newdata.userid = pathname[pathname.length - 2];
				newdata.page_name = 'Insert Page Name Here';
                newdata.menu_name = 'Insert Page Menu Name Here';
				newdata.page_headline = "New Page Headline Goes Here";
				newdata.page_content = "Insert Page Content Here";

				resetPageForm(newdata);

				console.log(pageid);

				$('#item-' + pageid).fadeOut(function () {
					$(this).remove();
				});

				$.ajax({
					url: "/client/save_routes",
					type: "POST",
					success: function () {
						console.log('routes updated');
						rebuildPageList();
						sortableSideList();
					},
					failure: function () {
						console.log('routes not updated');
					}

				});


			}

		});
	});

	/* Create a New Page or update an existing one */
	$('#pageForm').submit(function (e) {
		e.preventDefault();

		var pageid = $('input[name="pageid"]').val();
		for ( instance in CKEDITOR.instances )
			CKEDITOR.instances[instance].updateElement();
		$.ajax({
			url: "/client/pageUpdate",
			type: "POST",
			dataType: 'json',
			data: $('#pageForm').serialize(),
			success: function (feedback) {
				console.log('Page Updated');

				var pathname = window.location.pathname.split("/");
				var data = {};
				data.pageid = 0;
				data.userid = pathname[pathname.length - 2];
				data.page_name = 'Insert Page Name Here';
                data.menu_name = 'Insert Page Menu Name Here';
				data.page_headline = "New Page Headline Goes Here";
				data.page_content = "Insert Page Content Here";

				resetPageForm(data);

				if (pageid === 0) {

					$('ul#reorder').append('<li id="item-' + feedback[0].pageid + '" class="twelve columns"><a href="client/index/' + feedback[0].userid + '/' + feedback[0].pageid + '">' + feedback[0].page_name + '</a></li>').fadeIn("slow");
					rebuildPageList();
					sortableSideList();

				} else {
					rebuildPageList();
					sortableSideList();
				}

				$.ajax({
					url: "/client/saveOrder",
					type: "POST",
					success: function () {
						console.log('routes updated');
						rebuildPageList();
						sortableSideList();
					},
					failure: function () {
						console.log('routes not updated');
					}

				});


			}
		});

		return false;
	});

	/* Get the FAQ details for Control Panel */

	function getFAQDetails() {
		$.ajax({
			url: "/client/getFAQList/",
			type: "POST",
			success: function (feedback) {
				var pathname = window.location.pathname.split("/");
				var user = {};
				data = $.parseJSON(feedback);
				var items = [];

				if (feedback.length > 0) {
					$('ul#faqlist').empty();
					$('ul#faqlist').append('<li><div class="row"><form name="faqCreate" class="formupdate"><input type="hidden" name="idfaq_table" value=""><fieldset><div class="four columns"><textarea rows="2" cols="20" name="question" placeholder="FAQ Question:"></textarea></div> <div class="four columns"> <textarea rows="2" cols="20" name="answer" placeholder="FAQ Answer:"></textarea> </div> <div class="two columns"> <a href="" class="faqsubmit"><img SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button"></a> </div> </fieldset> </form>');
					$.each(data, function () {
						items.push('<li> <div class="row"> <form name="faqUpdate" class="formupdate"> <input type="hidden" id="faqid" name="idfaq_table" value="' + this.idfaq_table + '"><fieldset> <div class="four columns"> <textarea rows="2" cols="20" name="question" placeholder="">' + this.question + '</textarea> </div> <div class="four columns"> <textarea rows="2" cols="20" name="answer" placeholder="">' + this.answers + '</textarea> </div> <div class="two columns"> <a href="" class="faqdelete"><img SRC="/assets/images/icons/delete-icon-32.png" ALT="Delete button"></a> </div> <div class="two columns"> <a class="faqsubmit" href=""><img SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button"></a> </div> </fieldset> </form>');
					});
				}

				$('ul#faqlist').append(items.join(''));
			},
			failure: function (data) {
				console.log('getFAQDetails Failed');
			}
		});
	}

	/* FAQ Update Function */
	$('#faqlist').on('click', 'a.faqsubmit', function (e) {
		e.preventDefault();
		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		var form = $(this).parents('form:first');
		data += $(form).serialize();

		$.ajax({
			url: "/client/faqUpdate",
			type: "POST",
			data: data,
			success: function (feedback) {
				getFAQDetails();
			},
			failure: function (feedback) {
				console.log('faq not updated: ' + feedback);
			}
		});

		return false;

	});

	/* Category Update Function */
	$('#catlist').on('click', 'a.catsubmit', function (e) {
		e.preventDefault();
		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		var form = $(this).parents('form:first');
		data += $(form).serialize();

		$.ajax({
			url: "/client/catUpdate",
			type: "POST",
			data: data,
			success: function (feedback) {
				console.log('cat updated');
				getCategoryDetails();
			},
			failure: function (feedback) {
				console.log('cat not updated: ' + feedback);
			}
		});

		return false;

	});

	/* FAQ Delete Function */
	$('#faqlist').on('click', 'a.faqdelete', function (e) {
		e.preventDefault();

		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		var form = $(this).parents('form:first');
		data += $(form).serialize();

		$.ajax({
			url: "/client/deleteFaq",
			type: "POST",
			data: data,
			success: function (feedback) {
				console.log('faq deteled');
				getFAQDetails();
			},
			failure: function (feedback) {
				console.log('faq not deleted: ' + feedback);
			}
		})

		return false;

	});

	/* Category Delete Function */
	$('#catlist').on('click', 'a.catdelete', function (e) {
		e.preventDefault();

		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		var form = $(this).parents('form:first');
		data += $(form).serialize();

		$.ajax({
			url: "/client/deleteCategory",
			type: "POST",
			data: data,
			success: function (feedback) {
				console.log('cat deteled');
				getCategoryDetails();
			},
			failure: function (feedback) {
				console.log('cat not deleted: ' + feedback);
			}
		})

		return false;

	});

	/* Get the Category details for Control Panel */

	function getCategoryDetails() {
		$.ajax({
			url: "/client/getCatList/",
			type: "POST",
			success: function (feedback) {
				var pathname = window.location.pathname.split("/");
				var user = {};
				data = $.parseJSON(feedback);
				var items = []
				$('ul#catlist').empty();
				$('ul#catlist').append('<li><div class="row"><form name="catCreate" class="nice formupdate"><input type="hidden" name="idcategories" value=""><fieldset><div class="two columns"><input type="text" placeholder="Category Name" name="catname" value="" class="input-text small"></div><div class="four columns"><input type="text" placeholder="Category Description" name="catdesc" value="" class="input-text"></div> <div class="one column"><a href="" class="catsubmit"><img SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button"></a></div> </fieldset> </form>');
				$.each(data, function () {
					items.push('<li> <div class="row"><form name="catCreate" class="nice formupdate"><input type="hidden" name="idcategories" value="' + this.idcategories + '"><fieldset><div class="two columns"><input type="text" placeholder="Category Name" name="catname" value="' + this.catname + '" class="input-text small"></div><div class="four columns"><input type="text" placeholder="Category Description" name="catdesc" value="' + this.catdescription + '" class="input-text"></div> <div class="one column"> <a href="" class="catdelete"><img SRC="/assets/images/icons/delete-icon-32.png" ALT="Delete button"></a> </div><div class="one column"><a href="" class="catsubmit"><img SRC="/assets/images/icons/save-icon-32.png" ALT="Submit button"></a></div> </fieldset> </form>')
				});
				$('ul#catlist').append(items.join(''));
			},
			failure: function (data) {
				console.log('getCatDetails Failed');
			}
		})
	}

	/* Populates the Location Editor form */
	function populateLocationForm(data) {
		console.log(data.location_name);
		$('input[name="locationid"]').val(data.idlocation);
		$('input[name="userid"]').val(data.userid);
		$('input[name="pageid"]').val(data.pageid);
		$('input[name="tbxlat"]').val(data.lat);
		$('input[name="tbxlng"]').val(data.lng);
		$('input[name="location_name"]').val(data.location_name);
		$('input[name="pageid"]').val(data.pageid);
		$('input[name="location_street"]').val(data.location_street);
		$('input[name="location_city"]').val(data.location_city);
		$('input[name="location_state"]').val(data.location_state);
		$('input[name="location_zip"]').val(data.location_zip);
		$('input[name="sale_price"]').val(data.sale_price);
		$('input[name="rent_price"]').val(data.rent_price);
		$('input[name="bedrooms"]').val(data.bedrooms);
		$('input[name="bathrooms"]').val(data.bathrooms);
		$('input[name="square_feet"]').val(data.square_feet);
		$('textarea[name="description"]').val(data.description);
		$('#location_photo').val(data.photo_id);
		CKEDITOR.instances['locationeditor'].setData(data.description);

		if (data.featured === '1') {
			$('input[name="featured"]').attr('checked', true);
		} else {
			$('input[name="featured"]').attr('checked', false);
		}

		if (data.reduced === '1') {
			$('input[name="reduced"]').attr('checked', true);
		} else {
			$('input[name="reduced"]').attr('checked', false);
		}

		if (data.rented === '1') {
			$('input[name="rented"]').attr('checked', true);
		} else {
			$('input[name="rented"]').attr('checked', false);
		}

		if (data.sold === '1') {
			$('input[name="sold"]').attr('checked', true);
		} else {
			$('input[name="sold"]').attr('checked', false);
		}

	}

	/* Resets the Page Editor form */
	function resetPageForm(data) {
		$('#parentpage').val(data.parentid);
		$('input[name="pageid"]').val(data.pageid);
		$('a.pagedelete').prop('href', '/client/pageDelete/' + data.userid + '/' + data.pageid);
		$('input[name="userid"]').val(data.userid);

		if (data.pageid !== 0) {
			$('input[name="pagename"]').val(data.page_name);
            $('input[name="menuname"]').val(data.menu_name);
			$('input[name="pageheadline"]').val(data.page_headline);
			$('textarea[name="pagecontent"]').val(data.page_content);
			CKEDITOR.instances['pagededitor'].setData(data.page_content);
		} else {
			$('input[name="pagename"]').val('').attr('placeholder','Insert Page Name');
            $('input[name="menuname"]').val('').attr('placeholder','Insert Page Menu Name');
			$('input[name="pageheadline"]').val('').attr('placeholder', 'Insert Page Headline');
			$('textarea[name="pagecontent"]').val('').attr('placeholder','Add Page Content');
			CKEDITOR.instances['pagededitor'].setData(data.page_content);
		}
	}

	/* Rebuilds the PageList sidebar */
	function rebuildPageList() {
		console.log('Entered rebuildPageList');
		$.ajax({
			url: "/pages/getPageList/",
			type: "POST",
			success: function (feedback) {
				data = $.parseJSON(feedback);

				$('ul#reorder').empty();

				$('select#parentpage').empty();

				$('ul#reorder').append('<li class="twelve columns"><a href="/client/index/1/0">Create A Page</li>');
				$('select#parentpage').append('<option value="">None</option>');

				var items = [];

				var selectitems = [];

				$.each(data, function () {
					items.push('<li id="item-' + this.pageid + '" class="twelve columns"><a href="client/index/' + this.userid + '/' + this.pageid + '">' + this.page_name + '</a></li>');
					selectitems.push('<option value="' + this.pageid + '">' + this.page_name + '</option>');

				});

				$('ul#reorder').append(items.join(''));
				$('select#parentpage').append(selectitems.join(''));


			}
		});
	}

	jQuery('ul.sf-menu').superfish();

	/* The PageList Sidebar - Makes the List Items clickable */
	function makeListClickable() {
		$('.pagelist').on('click', 'a', function (e) {

			e.preventDefault();

			var pathname = $(this).attr("href").split("/");
			var pageid = pathname[pathname.length - 1];
			var linkid = $(this).closest('li').attr('id');
			data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
			data += 'pageid=' + pageid;

			if (pageid === '0') {

				var data = {};

				data.pageid = 0;
				data.userid = pathname[pathname.length - 2];
				data.page_name = 'Insert Page Name Here';
                data.menu_name = 'Insert Page Menu Name Here';
				data.page_headline = "New Page Headline Goes Here";
				data.page_content = "Insert Page Content Here";

				resetPageForm(data);

			} else {
				$.ajax({
					url: "/client/getPageDetails/",
					type: "POST",
					data: data,
					dataType: 'json',
					success: function (data) {
						resetPageForm(data);
					}
				});
			}

			return false;
		});
	}

	/* Sortable Lists - This let's you sort the list and reorder the pages */

	function sortableSideList() {
		$('#reorder').sortable({
			opacity: '0.5',
			update: function (e, ui) {
				newOrder = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
				newOrder += $("#reorder").sortable('serialize');
				console.log(newOrder);
				$.ajax({
					url: "/client/saveOrder",
					type: "POST",
					data: newOrder,
					success: function (feedback) {
						console.log('success');
					}
				});
			}
		});
	}

	function geoCode(location) {
		$('#map-canvas').gmap3(
			{ action: 'getLatLng',
				address: location,
				callback: function (result) {
					if (result) {
						ParseLocation(result[0].geometry.location);
					} else {
						alert('Bad address!');
					}
				}
			}
		);
	}

	function ParseLocation(location, lat, lng) {
		var lat = location.lat().toString().substr(0, 12);
		var lng = location.lng().toString().substr(0, 12);

		$('#tbxlat').val(lat);
		$('#tbxlng').val(lng);

	}


	/* Get the Locations for Control Panel List of Locations */

	function getLocationDetails() {
		$.ajax({
			url: "/client/getLocationList/",
			type: "POST",
			success: function (feedback) {
				var pathname = window.location.pathname.split("/");
				var user = {};
				data = $.parseJSON(feedback);
				var items = [];
				if (feedback.length > 0) {
					$('table#locations').empty();
					$('table#locations').append('<thead><tr><th>Name</th><th>City</th><th>State</th><th>Zip</th><th>Delete</th></tr></thead>');
					$.each(data, function () {
						var newRow = $('<tr><td><a href="#" class="property" rel="' + this.idlocation + '">' + this.location_name + '</a></td><td>' + this.location_city + '</td><td>' + this.location_state + '</td><td>' + this.location_zip + '</td><td><a href="/client/deletelocation/' + this.idlocation + '" class="locdelete"><img SRC="/assets/images/icons/delete-icon-32.png" ALT="Delete button"></a></td></tr>');
						$('table#locations').append(newRow);

					});
				}
				$('table#locations').append(items.join(''));
				$("table#locations").tablesorter();
				$('table#locations').trigger("update");


			},
			failure: function (data) {
				console.log('getLocationDetails Failed');
			}
		});
	}

	/* Create a New Location or update an existing one */
	$('form#locationForm').submit(function (e) {

		e.preventDefault();

		var location = '';

		var location = $('input[name="location_street"]').val() + ', '
			+ $('input[name="location_city"]').val() + ', '
			+ $('input[name="location_state"]').val() + ', '
			+ $('input[name="location_zip"]').val();

		geoCode(location);

		var idlocation = $('input[name="idlocation"]').val();
		for ( instance in CKEDITOR.instances )
			CKEDITOR.instances[instance].updateElement();

		$.ajax({
			beforeSend: geoCode(location),
			success: function () {
				$.ajax({
					beforeSend: geoCode(location),
					url: "/client/locationUpdate",
					type: "POST",
					dataType: 'json',
					data: $('form#locationForm').serialize(),
					success: function (feedback) {
						console.log('Location Updated');
						getLocationDetails();
						var pathname = window.location.pathname.split("/");
						var data = {};
						data.idlocation = 0;
						data.userid = pathname[pathname.length - 2];


						resetLocationForm(data);
					}
				});
			}
		})


		return false;
	});

	/* Get Location For Location Form */

	$('table#locations').on('click', 'a.property', function(e) {
		e.preventDefault();
		var id = $(this).attr('rel');

		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		data += 'location=' + id;

			$.ajax({
				url: "/client/getLocationById",
				type: "POST",
				data: data,
				dataType: 'json',
				success: function(data) {
					populateLocationForm(data);

				}
			})
		});

			


	/* Category Delete Function */
	$('#locations').on('click', 'a.locdelete', function (e) {
		e.preventDefault();

		var pathname = $(this).attr("href").split("/");
		var locationid = pathname[pathname.length - 1];

		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		data += 'locationid=' + locationid;

		console.log(data);
		$.ajax({
			url: "/client/deleteLocation",
			type: "POST",
			dataType: 'html',
			data: data,
			success: function (feedback) {
				console.log('location deleted');
				getLocationDetails();
			},
			failure: function (feedback) {
				console.log('location not deleted: ' + feedback);
			}
		})

		return false;

	});

	function resetLocationForm(data) {
		$('input[name="userid"]').val(data.userid);
		$('input[name="tbxlat"]').val('');
		$('input[name="tbxlng"]').val('');
		$('input[name="locationid"]').val('');
		$('input[name="location_name"]').val('');
		$('input[name="location_street"]').val('');
		$('input[name="location_city"]').val('');
		$('input[name="location_state"]').val('');
		$('input[name="location_zip"]').val('');
		$('input[name="sale_price"]').val('');
		$('input[name="rent_price"]').val('');
		$('input[name="bedrooms"]').val('');
		$('input[name="bathrooms"]').val('');
		$('input[name="square_feet"]').val('');
		$('input[name="featured"]').attr('checked', false);
		$('input[name="rented"]').attr('checked', false);
		$('input[name="reduced"]').attr('checked', false);
		$('input[name="sold"]').attr('checked', false);

		$('textarea[name="location_description"]').val('');
		CKEDITOR.instances['locationeditor'].setData('');

	}

	

	/* Use this js doc for all application specific JS */

	/* TABS --------------------------------- */
	/* Remove if you don't need :) */

	function activateTab($tab) {
		var $activeTab = $tab.closest('dl').find('a.active'),
			contentLocation = $tab.attr("href") + 'Tab';

		// Strip off the current url that IE adds
		contentLocation = contentLocation.replace(/^.+#/, '#');

		//Make Tab Active
		$activeTab.removeClass('active');
		$tab.addClass('active');

		//Show Tab Content
		$(contentLocation).closest('.tabs-content').children('li').hide();
		$(contentLocation).css('display', 'block');
	}

	$('dl.tabs').each(function () {
		//Get all tabs
		var tabs = $(this).children('dd').children('a');
		tabs.click(function (e) {
			activateTab($(this));
		});
	});

	if (window.location.hash) {
		activateTab($('a[href="' + window.location.hash + '"]'));
		$.foundation.customForms.appendCustomMarkup();
	}

	/* ALERT BOXES ------------ */
	$(".alert-box").delegate("a.close", "click", function (event) {
		event.preventDefault();
		$(this).closest(".alert-box").fadeOut(function (event) {
			$(this).remove();
		});
	});

	/* Geocode an address before it get's submitted to db */
	var location;
	var geocode_address;
	var lat;
	var lng;

	

	/* PLACEHOLDER FOR FORMS ------------- */
	/* Remove this and jquery.placeholder.min.js if you don't need :) */

	$('input, textarea').placeholder();


});


