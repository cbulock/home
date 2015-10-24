$(function() {
	//want to shrink the floorplan map to half the size
	var floormap = $('.location p img');
	if (floormap) {
		var width = $(floormap).width();
		var height = $(floormap).height();
		$(floormap).width( width/2 );
		$(floormap).height( height/2 );
	}
});