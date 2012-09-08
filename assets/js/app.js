/* Foundation v2.2.1 http://foundation.zurb.com */
jQuery(document).ready(function ($) {

	$(function() {
		$.ajaxSetup({
			error: function(jqXHR, exception) {
				if (jqXHR.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (jqXHR.status == 404) {
					alert('Requested page not found. [404]');
				} else if (jqXHR.status == 500) {
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

	/* Delete Page and remove item from pagelist */
    $('a.pagedelete').on('click', function(e){
    	e.preventDefault();
    	var pathname = $(this).attr("href").split("/");
		var pageid = pathname[pathname.length-1];

    	data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
    	data += 'pageid=' + pageid;
    	$.ajax({
    		url: "/client/pageDelete",
    		type: "POST",
    		data: data,
    		success: function(feedback){
    			console.log('Page Deleted');
    			var newdata = {};

				newdata.pageid = 0;
				newdata.userid = pathname[pathname.length-2];
				newdata.page_name = 'Insert Page Name Here';
				newdata.page_headline = "New Page Headline Goes Here";
				newdata.page_content = "Insert Page Content Here";

				resetPageForm(newdata);

				console.log(pageid);

				$('#item-' + pageid).fadeOut( function() { $(this).remove(); } );

				sortableSideList();
   				makeListClickable();
    		}

    	})
    })

	/* Create a New Page or update an existing one */
	$('#pageForm').submit(function(e){
		e.preventDefault();

		var pageid = $('input[name="pageid"]').val();
		for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
		$.ajax({
			url: "/client/pageUpdate",
			type: "POST",
			dataType: 'json',
			data: $('#pageForm').serialize(),
			success: function(feedback){
				console.log('Page Updated');
				
				var pathname = window.location.pathname.split("/");
				var data = {};
				data.pageid = 0;
				data.userid = pathname[pathname.length-2];
				data.page_name = 'Insert Page Name Here';
				data.page_headline = "New Page Headline Goes Here";
				data.page_content = "Insert Page Content Here";

				resetPageForm(data);

				if (pageid == 0) {

					$('ul#reorder').append('<li id="item-' + feedback[0].pageid + '" class="twelve columns"><a href="client/index/' + feedback[0].userid + '/' + feedback[0].pageid +'">' + feedback[0].page_name + '</a></li>').fadeIn("slow");
					rebuildPageList();
					sortableSideList();
					makeListClickable();

				} else {
					rebuildPageList();
					sortableSideList();
					makeListClickable();
				}

				$.ajax({
					url:"/client/save_routes",
					type: "POST",
					success: function(){
						console.log('routes updated');
						rebuildPageList();
						sortableSideList();
						makeListClickable();
					},
					failure: function(){
						console.log('routes not updated');
					}

				})


			}
		});

		return false;
	});	

	/* Resets the Page Editor form */
	function resetPageForm(data) {
		$('input[name="pageid"]').val(data.pageid);
		$('a.pagedelete').prop('href', '/client/pageDelete/' + data.userid + '/' + data.pageid);
		$('input[name="userid"]').val(data.userid);
		$('input[name="pagename"]').val(data.page_name);
		$('input[name="pageheadline"]').val(data.page_headline);
		$('textarea[name="pagecontent"]').val(data.page_content);
		CKEDITOR.instances['pagededitor'].setData(data.page_content);
	}

	/* Rebuilds the PageList sidebar */
	function rebuildPageList() {
		console.log('Entered rebuildPageList');
		$.ajax({
			url:"/pages/getPageList/",
			type: "POST",
			success: function(feedback) {
				data = $.parseJSON(feedback);
				$('ul#reorder').empty();

				$('ul#reorder').append('<li class="twelve columns"><a href="/client/index/1/0">Create A Page</li>');
				var items = []
				$.each(data, function(){
					items.push('<li id="item-' + this.pageid + '" class="twelve columns"><a href="client/index/' + this.userid + '/' + this.pageid +'">' + this.page_name + '</a></li>');
				});

				$('ul#reorder').append( items.join ('') );


				console.log('Page List Updated');
			}
		})
	}

	jQuery('ul.sf-menu').superfish();

	/* Sortable Lists - This let's you sort the list and reorder the pages */

   function sortableSideList() {
   	 $('#reorder').sortable({
        opacity: '0.5',
        update: function(e, ui){
            newOrder = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
            newOrder += $( "#reorder" ).sortable('serialize');
            console.log(newOrder);
            $.ajax({
                url: "/client/saveOrder",
                type: "POST",
                data: newOrder,
                success: function(feedback){
                    console.log('success');
                }
            });
        }
    });
   }

   /* The PageList Sidebar - Makes the List Items clickable */
	function makeListClickable() {
		$('.pagelist').on('click','a', function(e){

		e.preventDefault();

		var pathname = $(this).attr("href").split("/");
		var pageid = pathname[pathname.length-1];
		var linkid = $(this).closest('li').attr('id');
		data = 'csrf_test_name=' + $.cookie('csrf_cookie_name') + '&';
		data += 'pageid=' + pageid;

		if (pageid == 0) {

			var data = {};

			data.pageid = 0;
			data.userid = pathname[pathname.length-2];
			data.page_name = 'Insert Page Name Here';
			data.page_headline = "New Page Headline Goes Here";
			data.page_content = "Insert Page Content Here";

			resetPageForm(data)

		} else {
			$.ajax({
			url:"/client/getPageDetails/",
			type: "POST",
			data: data,
			dataType: 'json',
			success: function(data) {
				resetPageForm(data);
			}
		})
		}

		return false;
	});
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
	$(".alert-box").delegate("a.close", "click", function(event) {
    event.preventDefault();
	  $(this).closest(".alert-box").fadeOut(function(event){
	    $(this).remove();
	  });
	});


	/* PLACEHOLDER FOR FORMS ------------- */
	/* Remove this and jquery.placeholder.min.js if you don't need :) */

	$('input, textarea').placeholder();

	/* TOOLTIPS ------------ */
	$(this).tooltips();



	/* UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE6/7/8 SUPPORT AND ARE USING .block-grids */
//	$('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
//	$('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
//	$('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
//	$('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});



	/* DROPDOWN NAV ------------- */

	var lockNavBar = false;
	$('.nav-bar a.flyout-toggle').live('click', function(e) {
		e.preventDefault();
		var flyout = $(this).siblings('.flyout');
		if (lockNavBar === false) {
			$('.nav-bar .flyout').not(flyout).slideUp(500);
			flyout.slideToggle(500, function(){
				lockNavBar = false;
			});
		}
		lockNavBar = true;
	});
  if (Modernizr.touch) {
    $('.nav-bar>li.has-flyout>a.main').css({
      'padding-right' : '75px'
    });
    $('.nav-bar>li.has-flyout>a.flyout-toggle').css({
      'border-left' : '1px dashed #eee'
    });
  } else {
    $('.nav-bar>li.has-flyout').hover(function() {
      $(this).children('.flyout').show();
    }, function() {
      $(this).children('.flyout').hide();
    })
  }


	/* DISABLED BUTTONS ------------- */
	/* Gives elements with a class of 'disabled' a return: false; */
  
});

	
