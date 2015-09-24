// ==UserScript==
// @name          Unfuckupify
// @namespace     http://*/
// @description   Unfuckipify websites
// @include       *
// ==/UserScript==

window.addEventListener('load', function() { initMachine(); }, false );

var iframe, mybody, title;

var database = new Array();
var url = new Array();
var dates = new Array();
var years = new Array();
var datesAsString = new Array();

function initMachine()
{
	iframe = document.createElement("iframe");
	iframe.style.width = "100%";
	iframe.style.position = "absolute";
	iframe.style.top = "0";
	iframe.style.left = "0";
	iframe.style.zIndex = "10";
	iframe.setAttribute("height", "10px");
	iframe.setAttribute("width", "100%");
	iframe.setAttribute("frameborder", "0");
	document.body.insertBefore(iframe, document.body.firstChild);

	iframe.addEventListener('load', function ()
	{
		document.body.style.marginTop = "10px";
		myhead = iframe.contentDocument.getElementsByTagName("head")[0];
		myhead.innerHTML = 
			["<style>",
			"body {",
			"overflow: hidden;",
			"white-space: nowrap;",
			"padding: 0;",
			"margin: 0;",
			"}",
			"div {",
			"font-size: 10px;",
			"line-height: 8px;",
			"padding: 0;",
			"text-align: center;",
			"clear: none;",
			"float: left;",
			"cursor: pointer",
			"}",
			".c0:hover, {",
			"opacity: 0.6;",
			"}",
			".c0 {",
			"background-color: #D0D0FF;",
			"}",
		       	".c1 {",
			"background-color: #FFD0FF;",
			"}</style>"].join("");

		mybody = iframe.contentDocument.getElementsByTagName("body")[0];
		if(document.location.href.indexOf("http://web.archive.org/web") == 0)
		{
			tMachine();
		}
		else if(document.location.href.indexOf("?") == -1 && top.location == self.location)
		{
			tMachineCollapse();
		}
	}, false);
}

function tMachineCollapse()
{
	mybody.innerHTML = "<div id='active' style='{position:absolute;-moz-border-radius:3px;background-color:#E8E8F0;border:1px solid black;padding:5px;padding-left:5px;left:-4px;padding-bottom:1px;top:-6px;color:black;}'>archives</div>";
	title = iframe.contentDocument.getElementById("active");
	title.addEventListener("click", tMachine, true);
}

function openSite(url)
{
	document.location.href = url;
}

function showYear(year)
{
	var loc = document.location.href;
	year = parseInt(year);
	var cycle = 0;
	var upper = dates[years[year + 1] - 1];
	var toprint = "";
	var oldpoint = 0;
	var mywidth = 100 / (years[year + 1] - years[year]);
	var usepx = 0;
	
	mywidth=Math.floor(mywidth);
	if (mywidth < 1)
	{
		mywidth = window.innerWidth / (years[year + 1] - years[year]);
		usepx = 1;
	}

	for(i = years[year]; i < years[year+1]; i ++)
	{
		if(url[i] == loc)
		{
			cycle = 2;
		}
		toprint += "<div style='{width: "+ mywidth + (usepx ? "px" : "%") + ";}' href=" + url[i] + " class=c" + cycle + " title=\"" + datesAsString[i] + "\">&nbsp;</div>";
		cycle ++;
		cycle %= 2;

	}
	mybody.innerHTML=toprint;
	var divs = iframe.contentDocument.getElementsByTagName("div");
	for(var i in divs)
	{
		divs[i].addEventListener("click", function() 
				{
					openSite(this.getAttribute("href")); 
				}, true);
	}
}

function dload(details)
{
	var loc = document.location.href;

	var caloffset = new Array
	(
		0,	
		0,
		31,
		60,
		91,
		121,
		152,
		182,
		213,
		244,
		274,
		305,
		335
	);

	var result = details.responseText.substring(
			details.responseText.indexOf("<!-- SEARCH RESULTS"),
			details.responseText.indexOf("<!-- /SEARCH RESULTS"));

	_eom = document.createElement("div");
	_eom.innerHTML = result;

	var v = _eom.getElementsByTagName("a");
	var old, cur;

	for(a = 0; a < v.length; a++)
	{
		if(v[a].href.indexOf("http://web.archive.org/web/") > -1 && v[a].innerHTML.length < 15)
		{
			cur = v[a].href.substring(29,35);

			if(cur != old)
			{
				database.push(v[a].href.substring(29,41));
				url.push(v[a].href);
				datesAsString.push(v[a].innerHTML);
			}

			old = cur;
		}
	}
	title.innerHTML = "parsing...";

	if(database.length > 0)
	{
		var n = database[0];
		var yr = parseInt(n.substring(0,2), 10);
		// Do the year from 1900
		if(yr < 80)
		{
			yr += 100;
		}
		var mo = caloffset[parseInt(n.substring(2,4), 10)];
		var day = parseInt(n.substring(4,6), 10);
		var offset = (yr * 366 + mo + day);
		var lastYear = 0;
		var yearCount = 0;

		for(i = 0; i < database.length; i ++)
		{
			var n = database[i];
			var yr = parseInt(n.substring(0,2), 10);
			var mo = caloffset[parseInt(n.substring(2,4), 10)];
			var day = parseInt(n.substring(4,6), 10);

			// Do the year from 1900
			if(yr < 80)
			{
				yr += 100;
			}
			dates.push((yr * 366 + mo + day) - offset);
			if(lastYear != yr)
			{
				years[yr + 1900] = i;
				lastYear = yr;
				yearCount++;
			}
		}
		var upper = dates[dates.length - 1];

		var oldpoint = 0;
		var toprint = "";
		var cycle = 1;
		var mywidth = window.innerWidth - 20;
		var point;

		var imgwidth = 100 / yearCount;
		for(i in years)
		{
			cycle ++;
			cycle %= 2;

			toprint += "<div style='{width: " + imgwidth + "%}' class=c" + cycle + ">" + i + "</div>";
		}
		mybody.innerHTML = toprint;
		var divs = iframe.contentDocument.getElementsByTagName("div");
		for(var i in divs)
		{
			divs[i].addEventListener("click", function() { showYear(this.innerHTML); }, true);
		}

/*
		for(i = 0; i < dates.length; i ++)
		{
			point = ((dates[i] / upper) * mywidth * 4);

			if(url[i] == loc)
			{
				cycle = 2;
			}
			toprint += "<a href=" + url[i] + "><img border=0 title=\"" + datesAsString[i] + "\" src=http://qaa.ath.cx/" + cycle + ".png height=20 width=" + (point - oldpoint) + "></a>";
			cycle ++;
			cycle %= 2;

			oldpoint = point;
			
		}
		*/
	}
	else
	{
		title.setAttribute("title", "Nothing Found");
		title.innerHTML="!";
		title.style.backgroundColor="#E0E0E0";
	}
}

function tMachine()
{
	var loc = document.location.href;
	var url;
	title.style.backgroundColor = "#E0FFE0";
	title.innerHTML = "searching";
	if(loc.indexOf("http://web.archive.org/web/") == -1)
	{
		url = "http://web.archive.org/web/*/" + loc;
	}
	else if(loc.indexOf("http://web.archive.org/web/") == 0)
	{	
		url = "http://web.archive.org/web/*/" + loc.substring(42, loc.length);
	}

	GM_xmlhttpRequest(
		{
		method:"GET", 
		url:url,
		onload:dload});
}

