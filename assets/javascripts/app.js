/* Foundation v2.2.1 http://foundation.zurb.com */
jQuery(document).ready(function ($) {

//    $(function() {
//        $( "#reorder" ).sortable({opacity: 0.6,
//            data:$(this).sortable("serialize"),
//            cursor: 'move',
//            tolerance: 'pointer',
//            revert: true,
//            placeholder: 'state',
//            forcePlaceholderSize: true,
//            update: function(event, ui){
//
////send POST data ----------------
//                $.ajax({
//                    url: "/client/saveOrder",
//                    type: 'POST',
//                    data: {
//                        'order': $( "#reorder" ).sortable("serialize")
//                    },
//                    success: function (data) {
//                        $("#feedback").html(feedback);
//                    }
//
//                });
////-------------------------------
//            }
//
//        });
//    });

    $.ajaxSetup({
//        data: {
//            csrf_cookie_name: $.cookie('csrf_cookie_name')
//        }
    });

    $('#reorder').sortable({
        opacity: '0.5',
        update: function(e, ui){
            cct = $.cookie('csrf_cookie_name');
            console.log(cct);
            newOrder = $( "#reorder" ).sortable('serialize');
            console.log(newOrder);
            $.ajax({
                url: "/client/saveOrder",
                type: "POST",
                csrf_cookie_name: cct,
                data: newOrder,
                // complete: function(){},
                success: function(feedback){
                    console.log('success');
                    $("#feedback").html(feedback);
                    //$.jGrowl(feedback, { theme: 'success' });
                }
            });
        }
    });

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
