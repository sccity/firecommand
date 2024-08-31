$(function () {
    const $container = $('.container');
    const callId = $container.data('call-id');
    const updateUrl = $container.data('update-url');

    function refreshUnits() {
        $.ajax({
            url: updateUrl,
            method: 'GET',
            data: {
                callid: callId,
                units: true
            },
            success: function (data) {
                // Collect all existing unit IDs in the DOM across all columns
                $('.column .box').each(function () {
                    const unitElement = $(this);
                    const unitName = unitElement.data('unit-name');

                    // Find the corresponding unit in the fetched data
                    const updatedUnit = data.units.find(u => u.unit === unitName);

                    if (updatedUnit) {
                        // Update the status in the unit header
                        unitElement.find('small').text(updatedUnit.status);
                    }
                });

                // Add any new units that don't already exist in the DOM
                data.units.forEach(function (unit) {
                    const existingUnit = $('.column .box[data-unit-name="' + unit.unit + '"]');
                    if (existingUnit.length === 0) {
                        // Only add the unit if it doesn't exist in any column
                        $('#unassigned').append(
                            '<div class="box" data-unit-name="' + unit.unit + '">' +
                            '<div class="unit-header">' + unit.unit + '<br><small>' + unit.status + '</small></div>' +
                            '</div>'
                        );
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('Error refreshing units:', status, error);
            }
        });
    }

    function refreshComments() {
        $.ajax({
            url: updateUrl,
            method: 'GET',
            data: {
                callid: callId,
                comments: true
            },
            success: function (data) {
                $('.comments-container').html(data.comments);
            },
            error: function (xhr, status, error) {
                console.error('Error refreshing comments:', status, error);
            }
        });
    }

    // Set intervals for refreshing data
    setInterval(refreshUnits, 5000);
    setInterval(refreshComments, 5000);
});