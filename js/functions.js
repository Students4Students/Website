function isIE()
{
	var myNav = navigator.userAgent.toLowerCase();
	return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

function stretch_footer()
{
	//get the footer
	var foot = document.getElementById('footer');
	if(foot != null)
	{
		//what is the longest element?
		//alert("height before = " + height);
		var body = document.body,
		html = document.documentElement;
		var height = Math.max( body.offsetHeight, html.clientHeight, html.offsetHeight );
		
		//position is highest - 94 (height of footer)
		//alert("height after = " + height);

		//alert(html.clientHeight);
		
		if( isIE() != 8 )
		{
			var y = document.getElementsByClassName('content');
		}
		else
		{
			var y = document.querySelectorAll('.content');
		}
		
		// The following forces the header to be at the bottom of the page when the content is not very long (rather than being 1000px below the content, which would be floating mid-screen).
		var cont = y[0];
		var windowHeight = window.innerHeight;
		var footerHeight = document.getElementById("footer").offsetHeight;
		var headerHeight = document.getElementById("webnav").offsetHeight;
		//alert(oxcont.clientHeight);
		if( cont != null )
		{
			if( cont.clientHeight > windowHeight - footerHeight - headerHeight )
			{
				foot.style.position = "static";
				foot.style.bottom ="";
			}
			else
			{
				foot.style.position = "fixed";
				foot.style.bottom = "0px";
				
			}
		}
		
	}
}

function expandmobnav()
{
	if( document.getElementById('mobnav').style.left=="0px"){
		document.getElementById('mobnav').style.left="-300px";
		document.getElementById("hidemobnav").style.display="none";
	}else{
		document.getElementById('mobnav').style.left="0px";
		document.getElementById("hidemobnav").style.display="block";
	}
}