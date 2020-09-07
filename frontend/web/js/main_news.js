var count_h3 = $("article#content_detail h2,article#content_detail h3")
if (count_h3.length>0) {
	$("#mucluc_toc").toc({
		content: "article#content_detail",
		headings: "h2,h3,h4"
	});
}else{
	$('.mucluc').hide();
}