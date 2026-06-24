jQuery(document).ready(function() {
        $(function () {
            var $cd = $('#defaultCountdown');
            if ($cd.length) {
                var targetDate = $cd.attr('data-date');
                if (targetDate) {
                    var d = new Date(targetDate.replace(/-/g, '/'));
                    $cd.countdown({until: d});
                } else {
                    $cd.countdown({until: new Date(2026, 10-1, 1, 8)});
                }
            }
        });
});		

