function mudaDiv(a) {
	if(a == 1){
		div2 = document.getElementById("activity");
		li = document.getElementById("li1");
		div = document.getElementById("timeline");
		li2 = document.getElementById("li2");
		div.attributes["class"].value="active tab-pane";
		div2.attributes["class"].value="tab-pane";
		li2.attributes["class"].value="active";
		li.attributes["class"].value="";

	}
	else if(a == 2){
		div = document.getElementById("timeline");
		li2 = document.getElementById("li2");
		div2 = document.getElementById("activity");
		li = document.getElementById("li1");
		div2.attributes["class"].value="active tab-pane";
		div.attributes["class"].value="tab-pane";
		li.attributes["class"].value="active";
		li2.attributes["class"].value="";
	}
}
function testeUrl() {
	var hashtag = window.location.hash;
    if (hashtag == "#activity") {
      mudaDiv(2);
    } 
    else if (hashtag == "#timeline"){
      mudaDiv(1);
    }
}