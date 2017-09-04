$(function() {
    //Easy Pie Chart
    //------------------------

    try {
        $('.easypiechart#newvisits').easyPieChart({
            barColor: "#16a085",
            trackColor: 'transparent',
            scaleColor: '#eee',
            scaleLength: 8,
            lineCap: 'square',
            lineWidth: 2,
            size: 96,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $('.easypiechart#bouncerate').easyPieChart({
            barColor: "#7ccc2e",
            trackColor: 'transparent',
            scaleColor: '#eee',
            scaleLength: 8,
            lineCap: 'square',
            lineWidth: 2,
            size: 96,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $('.easypiechart#clickrate').easyPieChart({
            barColor: "#e84747",
            trackColor: 'transparent',
            scaleColor: '#eee',
            scaleLength: 8,
            lineCap: 'square',
            lineWidth: 2,
            size: 96,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });
        $('.easypiechart#covertionrate').easyPieChart({
            barColor: "#8e44ad",
            trackColor: 'transparent',
            scaleColor: '#eee',
            scaleLength: 8,
            lineCap: 'square',
            lineWidth: 2,
            size: 96,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });


        $('#updatePieCharts').on('click', function() {
            $('.easypiechart#newvisits').data('easyPieChart').update(Math.random()*100);
            $('.easypiechart#bouncerate').data('easyPieChart').update(Math.random()*100);
            $('.easypiechart#clickrate').data('easyPieChart').update(Math.random()*100);
            $('.easypiechart#covertionrate').data('easyPieChart').update(Math.random()*100);
            return false;
        });
    }
    catch(e) {}

});