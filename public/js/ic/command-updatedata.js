$(function () {
    const $container = $('.container');
    const callId = $container.data('call-id');
    console.log(callId);
    const updateUrl = `/ic/${callId}`;

    if (!callId) {
        console.error("callId is undefined or empty.");
        return;
    }

    function refreshUnits() {
        $.ajax({
            url: updateUrl,
            method: 'GET',
            data: {
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
                comments: true
            },
            success: function (data) {
                if (data.comments) {
                    $('.panel-body h4').html(data.comments);
                } else {
                    console.warn('No comments in response');
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