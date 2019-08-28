<script src="js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-4').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-5').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-6').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });  
            $('#demo-pie-7').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            }); 
            $('#demo-pie-8').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-9').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
            $('#demo-pie-10').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });                       
            $('#demo-pie-11').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
             $('#demo-pie-12').pieChart({
                barColor: '#15A189',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 2,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });   

        });


    </script>