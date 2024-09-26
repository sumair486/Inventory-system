// public/js/report.js

$(document).ready(function () {
    $('#report-form').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'GET',
            url: '{{ route("generate.report") }}',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                alert(data);
                displayReport(data);
            },
            error: function (error) {
                console.error(error);
            },
        });
    });

    function displayReport(reportData) {
        var tableBody = $('#report-table-body');
        tableBody.empty();

        if (reportData.length > 0) {
            $.each(reportData, function (key, transaction) {
                var row = '<tr>' +
                    '<td>' + transaction.id + '</td>' +
                    '<td>' + transaction.commission_agent_id + '</td>' +
                    '<td>' + transaction.border_id + '</td>' +
                    '<td>' + transaction.category_id + '</td>' +
                    '<td>' + transaction.product_id + '</td>' +
                    '<td>' + transaction.quantity + '</td>' +
                    '<td>' + transaction.date + '</td>' +
                    '<td>' + transaction.status + '</td>' +
                    '</tr>';
                tableBody.append(row);
            });
        } else {
            tableBody.html('<tr><td colspan="8">No data found.</td></tr>');
        }
    }
});
