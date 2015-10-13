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
	}
];

var listeners = function() {
	var $rows = $('#deviceList tbody tr');
	$rows.unbind();
	$rows.click(function() {
		var device_id = $(this).data('deviceId');
		window.location.href = '/device/' + device_id;
	});
};

$(function () {
	$('#deviceList').DataTable({
		data: devices,
		columns: columns,
		order: [[3, 'asc']],
		createdRow: function(row, data) {
			$(row).data('deviceId', data.id);
		},
		initComplete: function() {
			listeners();
		}
	});

	$('#deviceList').on('draw.dt', function () {
		listeners();
	});
});