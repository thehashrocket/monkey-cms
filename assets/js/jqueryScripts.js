// JavaScript Document

$(document).ready(function(){

    setupRotator();
						   
   	$('#navWrapper li:first').addClass('navFirstLi');
//	$('#navWrapper > li:not(:has(ul)').last().addClass('navLastLi');
    $('#navWrapper > li').last().addClass('navLastLi');
	
	$('.entry table thead tr th:first').addClass('firstTH');
	$('.entry table tbody tr td:first-child').addClass('firstTD');

	$('tbody tr:nth-child(odd)').addClass('odd'); // zebra table
	
	$('#featureSlide div').click(function(){
    	window.location=$(this).find('a').attr('href');return false;
	});
	
    $('#shareContainerDrop').hover(
      function () {
        $('#shareContainerWrap').show();
        $('#shareContainerDrop a:first').addClass('hovered');
      }, 
      function () {
        $('#shareContainerWrap').hide();
        $('#shareContainerDrop a:first').removeClass('hovered');
      }
    );
	
	$('#featureNav').jFlow({
		slides: '#featureSlide',
		controller: '.jFlowControl',
		slideWrapper : '#featureMask',
		selectedWrapper: 'jFlowSelected',
		width: '566px',
		height: '258px',
		duration: 400,
		prev: '#featButtonHolder .previous',
		next: '#featButtonHolder .next'
	});
	
    $('#homeTabs').tabs({ fxFade: true, fxSpeed: 'fast' });
	
	if (jQuery.browser.msie) {
		if(parseInt(jQuery.browser.version) == 6) {
			$('#commentTabs').tabs();
		}
	}
	if( (parseInt(jQuery.browser.version) == 7) || (parseInt(jQuery.browser.version) == 8) ) {
		$('#commentTabs').tabs();
	}
	else {
		$('#commentTabs').tabs({ fxFade: true, fxSpeed: 'fast' });		
	}
	
//	var twitterID = $('.tweetID').attr('title').split("id-").slice(-1);
//	var twitterQty = $('.tweet').attr('class').split(" qty-").slice(-1);
//	$('.tweet').tweet({
//		username: "dunnhillstephen"
//	});
	
});

DD_belatedPNG.fix('img.ribbon');
DD_belatedPNG.fix('#footerLogo');

//jQuery(function(){
//	var flickrID = $('.flickrID').attr('title').split("id-").slice(-1);
//	var flickrQty = $('.flickr').attr('class').split(" qty-").slice(-1);
//	jQuery.getJSON('http://api.flickr.com/services/feeds/photos_public.gne?ids=' + flickrID + '&lang=en-us&format=json&jsoncallback=?', function(data){
//		jQuery.each(data.items, function(index, item){
//			if (index == flickrQty) {
//				return false;
//			}
//			else {
//				jQuery('<img />').attr('src', item.media.m).addClass('thumb').appendTo('.flickr').wrap('<a href="' + item.link + '" mce_href="' + item.link + '"></a>').wrap('<div class="flickr-thumb" />');
//			}
//		});
//	});
//});


function setupRotator()
{
    if($('.textItem').length > 1)
    {
        $('.textItem:first').addClass('current').fadeIn(1000);
        setInterval('textRotate()', 13000);
    }
}

function textRotate()
{
    var current = $('#quotes > .current');
    if(current.next().length == 0)
    {
        current.removeClass('current').fadeOut(1000);
        $('.textItem:first').addClass('current').fadeIn(1000);
    }
    else
    {
        current.removeClass('current').fadeOut(1000);
        current.next().addClass('current').fadeIn(1000);
    }
}

function mailpage()
{
	mail_str = 'mailto:?subject=Check out the ' + document.title;
	mail_str += '&body=I thought you might be interested in the ' + document.title;
	mail_str += '. You can view it at, ' + location.href;
	location.href = mail_str;
}

