var displayMap = function() {
	var floor = $('#floorEdit').val();
	var img = $('<img>').attr('src', '/img/floors/' + floor + '.png');
	$('#floorPosition').empty().append(img);
};

$('#deviceDialog').on('shown.bs.modal', function () {

	displayMap();

	$('#floorEdit').change(function() {
		displayMap();
	});

	$('#deviceDialog .modal-footer .btn-primary').click(function() {
		if ( $(this).data('method') === 'save' ) {
			home.post('network/devices/add',
				{
					data: {
						name: $('#deviceEdit').val(),
						hostname: $('#hostnameEdit').val(),
						ip_address: $('#ipEdit').val(),
						mac_address: $('#macEdit').val(),
						device_type: $('#typeEdit').val(),
						primary_user: $('#userEdit').val(),
						location_floor: $('#floorEdit').val(),
						location_x: $('#locationXEdit').val(),
						location_y: $('#locationYEdit').val()
					}
				}
			).done(function() {
				//$('#deviceDialog').modal('hide');
				window.location.reload();
			});
		} else {
			home.post('network/devices/update',
				{
					id: $('#deviceId').val(),
					data: {
						name: $('#deviceEdit').val(),
						hostname: $('#hostnameEdit').val(),
						ip_address: $('#ipEdit').val(),
						mac_address: $('#macEdit').val(),
						device_type: $('#typeEdit').val(),
						primary_user: $('#userEdit').val(),
						location_floor: $('#floorEdit').val(),
						location_x: $('#locationXEdit').val(),
						location_y: $('#locationYEdit').val()
					}
				}
			).done(function() {
				//$('#deviceDialog').modal('hide');
				window.location.reload();
			});
		}
	});
});