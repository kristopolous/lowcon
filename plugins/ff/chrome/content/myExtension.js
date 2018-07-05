/* forwards document to new URL */
function me_loadURL(url)
{
    window._content.document.location = url;
    window.content.focus();
}

/* executes the search */
function me_searchBlog()
{
	var term = document.getElementById('myExtension-search-toolbar-box').value;
	if(term.length > 0 && term != 'Search...') me_loadURL('http://yourdomain.tld/?search=' + encodeURIComponent(term));
}

/* listen for focus/blur on the search box */
function me_focus(state)
{
	var box = document.getElementById('myExtension-search-toolbar-box');
	if(state) { //focus
		if(box.value == 'Search...') box.value = '';
		box.select();
      box.style.color = '#000000';
	}
	else {
		if(box.value == '') {
			box.value = 'Search...';
			box.style.color = '#666666';
		}
	}
}

/* listen for search commit via keyboard */
function me_keypress(event)
{
	if (event.keyCode == event.DOM_VK_RETURN) me_searchBlog();
}
