function thebackground() {
	$('div.background img').css({opacity: 0.0});
	$('div.background img:first').css({opacity: 1.0});
	setInterval('change()',5000);
}

function change() {
	var current = ($('div.background img.show')? $('div.background img.show') : $('div.background img:first'));
	if ( current.length == 0 ) current = $('div.background img:first');
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div.background img:first') :current.next()) : $('div.background img:first'));
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');
};

$(document).ready(function() {
	$("#descript").elastic();
	$("#reply").elastic();
	
	thebackground();
	$('div.background').fadeIn(1000); // works for all the browsers other than IE
	$('div.background img').fadeIn(1000); // IE tweak
	
	
});

// for simple bbcode
function helper(id)
{
	return document.getElementById(id);
}
function insert(f, e, id)
{
	var scroll = helper(id).scrollTop;
	if(document.selection)
	{
		helper(id).focus();
		sel = document.selection.createRange();
		sel.text = f+sel.text+e;
	}
	else if(helper(id).selectionStart || helper(id).selectionStart == '0')
	{
		var startPos = helper(id).selectionStart;
		var endPos = helper(id).selectionEnd;
		helper(id).value = helper(id).value.substring(0, startPos)+f+helper(id).value.substring(startPos, endPos)+e+helper(id).value.substring(endPos, helper(id).value.length);
		helper(id).selectionStart = startPos+f.length;
		helper(id).selectionEnd = startPos+f.length+(endPos-startPos);
	}
	else
	{
		helper(id).value += msg; 
	}
	helper(id).scrollTop = scroll;
	helper(id).focus();
}

// nested comments
$(function(){
	$("a.reply").click(function() {
		var id = $(this).attr("id");
		$("#parent_id").attr("value", id);
		$("#reply").focus();
	});
});

$(document).ready(function() {
	var f = $('form');
	var l = $('#loader'); // loder.gif image
	var b = $('#button'); // upload button
	var p = $('#preview'); // preview area
	var pl = $('#preview_link');

	b.click(function(){
		// implement with ajaxForm Plugin
		f.ajaxForm({
			beforeSend: function(){
				l.show();
				b.attr('disabled', 'disabled');
				p.fadeOut();
				pl.fadeOut();
			},
			success: function(e){
				l.hide();
				f.resetForm();
				b.removeAttr('disabled');
				p.html(e).fadeIn();
				pl.fadeIn();
			},
			error: function(e){
				b.removeAttr('disabled');
				p.html(e).fadeIn();
				pl.fadeIn();
			}
		});
	});
});

$(document).ready(function(){
	$(".comment_body").emotions();
	$(".des").emotions();
});

$(document).ready(function() { 
	$('#photoimg').bind('change', function(){ 
		$("#preview").html('');
		$("#preview").html('<img src="media/images/loader.gif" alt="Uploading..."/>');
		$("#imageform").ajaxForm({
			target: '#preview'
		}).submit();
	});
});

$(document).ready(function(){
	$("a.vote_up").click(function(){
		//get the id
		the_id = $(this).attr('id'); 
		$("span#votes_count"+the_id).fadeOut("fast");
		
		//the main ajax request
		$.ajax({
			type: "POST",
			data: "type=vote_up&id="+$(this).attr("id"),
			url: "rating.php",
			success: function(msg){
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
				$("span#vote_buttons"+the_id).remove();
			}
		});
	});
	
	$("a.vote_down").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "type=vote_down&id="+$(this).attr("id"),
			url: "rating.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
				$("span#vote_buttons"+the_id).remove();
			}
		});
	});
	
});


$(function () {
		
		var filterList = {
		
			init: function () {
			
				// MixItUp plugin
				// http://mixitup.io
				$('#portfoliolist').mixitup({
					targetSelector: '.portfolio',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
					// call the hover effect
					onMixEnd: filterList.hoverEffect()
				});				
			
			},
			
			hoverEffect: function () {
			
				// Simple parallax effect
				$('#portfoliolist .portfolio').hover(
					function () {
						$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
						$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
					},
					function () {
						$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
						$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
					}		
				);				
			
			}

		};
		
		// Run the show!
		filterList.init();
		
		
	});