function spoiler(obj)
{
	var btn = obj.parentNode.getElementsByTagName("input")[0];
	var inner = obj.parentNode.getElementsByTagName("div")[0];
	var title = inner.getElementsByTagName("h2")[0].innerHTML;
	if (inner.style.display == "none") {
		inner.style.display = "inline-block";
		btn.value = "Hide";
	} else {
		inner.style.display = "none";
		btn.value = title;
	}
}