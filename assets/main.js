$(function() {
	
	function searchEvent(e)
	{
		var q = $(this).val();
		if (q == '') {
			$('.sidebar-pf .nav-category ul li').show();
		} else {
			$('.sidebar-pf .nav-category ul li').each(function(k, v) {
				if ($(this).children('a').text().toLowerCase().indexOf(q.toLowerCase()) > -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	}
	$('#search_q').keyup(searchEvent);
	$('#search_q').keypress(searchEvent);
	
	
	$.get('README.md', function(text) {
		var converter = new showdown.Converter(),
			text = converter.makeHtml(text);
		$('#documentation-page').html(text);
	});
	
	
	loadRepo();
});


function loadRepo() {
	$.get('files/repo.json', function(d){
		$('.sidebar-pf .nav-category').remove();
		$.each(d, function(k, v) {
			var nav = $('<div>').addClass('nav-category');
				nav.append($('<h2>').text(v.title.toUpperCase()));
			var ul = $('<ul class="nav nav-pills nav-stacked">');
				$.each(v.data, function(k, v) {
					ul.append($('<li>') .append($('<a>').text(v.name)
														.attr('href', '#')
														.attr('data-src', v.src)
														.attr('data-type', v.type))
										.click(documentClick));
				});
				nav.append(ul);
			$('.sidebar-pf').append(nav);
		});
	});
	
	function documentClick(e) {
		var src = $(e.toElement).attr('data-src');
		var type = $(e.toElement).attr('data-type');
		
		$('.breadcrumb').empty();
		$('.breadcrumb').append($('<li>').html($(e.toElement).parent().parent().parent().children('h2').text()));
		$('.breadcrumb').append($('<li>').html($(e.toElement).text()));
		$.get(src, function(text) {
			if (type == 'markdown') {
				var converter = new showdown.Converter(),
					text = converter.makeHtml(text);
			}
			
			$('#documentation-page').html(text);
		});
	}
}

	
function filesGenerate(){
	$.get('filesGenerate.php', function(d) {
		console.log(d);
		//~ loadRepo();
		window.location.reload();
	});
}
