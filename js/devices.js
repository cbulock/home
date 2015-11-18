var columns = [
	{
		data: 'type',
		className: 'type',
		orderable: false,
		searchable: true,
		render: function(data) {
			return "<img src='img/svg/" + data + ".svg' title='" + data + "'><span class='name'>" + data + "</span>";
		}
	},
	{
		title: 'Device',
		data: 'name',
		class: 'device'
	},
	{
		title: 'Hostname',
		data: 'hostname'
	},
	{
		title: 'IP',
		data: 'ip_address',
		class: 'ip_address'
	},
	{
		title: 'MAC',
		data: 'mac_address',
		class: 'mac_address',
	},
	{
		title: 'User',
		data: 'primary_user',
		class: 'user',
		render: function(data) {
			if (data) {
				return "<img src='img/users/" + data + ".jpg'>" + data;
			}
			return "";
		}
	},
	{
		orderable: false,
		render: function(data, type, row) {
			return "<button class='btn btn-link edit-device' data-device-id='" + row.id + "' title='Edit'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>";
		}
	}
];

var listeners = function() {
	//row click
	var $rows = $('#deviceList tbody tr');
	$rows.unbind();
	$rows.click(function() {
		var device_id = $(this).data('deviceId');
		window.location.href = '/device/' + device_id;
	});

	//edit button
	$('.edit-device').unbind();
	$('.edit-device').click(function(e) {
		e.stopPropagation();
		edit_device_dialog($(this).data('deviceId'));
	});
};

var edit_device_dialog = function(device_id) {
	home.get('network/devices/get/?id=' + device_id).done(function(data) {
		$('#deviceDialog .modal-title').html('Edit Device');
		$save_button = $('#deviceDialog .modal-footer .btn-primary');
		$save_button.html('Update Device');
		$save_button.data('method', 'update');
		//populate data into dialog form
		$('#deviceId').val(data.id);
		$('#deviceEdit').val(data.name);
		$('#hostnameEdit').val(data.hostname);
		$('#ipEdit').val(data.ip_address);
		$('#macEdit').val(data.mac_address);
		$('#typeEdit').val(data.type_id);
		$('#userEdit').val(data.primary_user_id);
		$('#floorEdit').val(data.location_floor);
		$('#locationXEdit').val(data.location_x);
		$('#locationYEdit').val(data.location_y);

		$('#deviceDialog').modal();
	});
};

$(function () {
	$('#deviceList').DataTable({
		dom: '<"#toolbar">frtlip',
		data: devices,
		columns: columns,
		order: [[3, 'asc']],
		createdRow: function(row, data) {
			$(row).data('deviceId', data.id);
		},
		initComplete: function() {
			listeners();
			//add custom toolbar content
			$('#toolbar').append( $('#toolbarTemplate').html() );
		}
	});

	$('#deviceList').on('draw.dt', function () {
		listeners();
	});
});
