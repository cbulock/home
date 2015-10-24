var columns = [
	{
		data: 'type',
		orderable: false,
		render: function(data) {
			return "<img src='img/svg/" + data + ".svg' title='" + data + "'>";
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
		render: function(data) {
			return data.toUpperCase();
		}
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
	/* Not going to implement this yet, this enables clicking a row to view more data
	var $rows = $('#deviceList tbody tr');
	$rows.unbind();
	$rows.click(function() {
		var device_id = $(this).data('deviceId');
		window.location.href = '/device/' + device_id;
	});*/
};

var edit_device_dialog = function(device_id) {
	$.get('/api/network/devices/get/?id=' + device_id).done(function(data) {
		//populate data into dialog form
		$('#deviceId').val(data.id);
		$('#deviceEdit').val(data.name);
		$('#hostnameEdit').val(data.hostname);
		$('#ipEdit').val(data.ip_address);
		$('#macEdit').val(data.mac_address);
		$('#typeEdit').val(data.type);
		$('#userEdit').val(data.primary_user);

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
			$('.edit-device').click(function() {
				edit_device_dialog($(this).data('deviceId'));
			});
		}
	});

	$('#deviceList').on('draw.dt', function () {
		listeners();
	});
});