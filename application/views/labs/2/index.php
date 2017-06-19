<h3>СОСТАВЛЕНИЕ УРАВНЕНИЯ РЕГРЕССИИ (АППРОКСИМАЦИЯ). Вариант 5</h3>
<div id="chartDiv"></div>
<script>
$(document).ready(function(){
	$.jqplot('chartDiv', [$.parseJSON("<?php echo $dataAfter ?>"), $.parseJSON("<?php echo $dataBefore ?>")], {
      animate: true,
      animateReplot: true,
      cursor: {
          show: true,
          zoom: true,
          looseZoom: true,
          showTooltip: false
      },
      series:[{
          showLabel: true,
          pointLabels: {
			  show: true
		  },
          showMarker:false,
		  showHighlight: false,
		  rendererOptions: {
			  animation: {
				  speed: 5000
			  },
			  highlightMouseOver: false
		  }
	  },
          {
			  linePattern: '.',
              fill: false,
			  rendererOptions: {
				  animation: {
					  speed: 3000
				  },
				  highlightMouseOver: false
			  }
          }],
		axesDefaults: {
			pad: 0
		},
		axes: {
			xaxis: {
				tickInterval: 1,
				drawMajorGridlines: false,
				drawMinorGridlines: true,
				drawMajorTickMarks: false,
				rendererOptions: {
					tickInset: 0.5,
					minorTicks: 1
				}
			},
			yaxis: {
				tickOptions: {
					formatString: "%'d"
				},
				rendererOptions: {
					forceTickAt0: true
				}
			}
		},
		highlighter: {
			show: true,
			showLabel: true,
			tooltipAxes: 'y',
			sizeAdjust: 7.5 ,
            tooltipLocation : 'ne'
		}
	});
});
</script>