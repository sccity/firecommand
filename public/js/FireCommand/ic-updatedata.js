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
                $('.column .box').each(function () {
                    const unitElement = $(this);
                    const unitName = unitElement.data('unit-name');

                    const updatedUnit = data.units.find(u => u.unit === unitName);

                    if (updatedUnit) {
                        unitElement.find('small').text(updatedUnit.status);
                    }
                });

                data.units.forEach(function (unit) {
                    const existingUnit = $('.column .box[data-unit-name="' + unit.unit + '"]');
                    if (existingUnit.length === 0) {
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
                // Assuming comments are returned as a string of HTML content
                if (data.comments) {
                    $('.comments-container').html(data.comments);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error refreshing comments:', status, error);
            }
        });
    }

    setInterval(refreshUnits, 5000);
    setInterval(refreshComments, 5000);
});