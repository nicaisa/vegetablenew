��
 ��          � b� r  Am'`sYi[
           � b�  RtQ�l
 ��          � b Amf�
 4          � b Am'`�N
 5          � bt RtQ�
 �p         
 � gm b � 
 Am@�^JTLr
 *          � g�  R�gZ
 �         
 � g+tr 
 Yuf[uG��[
 4          � gB Rꖛm
 ��          � h Am�q
 �	          � h  R�q1r
 D�          � j Ro
 �	          � j  �gs�uQ
 4I          � j%  Rf_`l
 E�         
 � j% ��
 �g�\T�ۆ
 �[         
 � j7� A 
 �g�\��_�
 �H          � j\ Rs��
 {`         
 � j� 
 �g�\te�[MR
 p]          � j� R��KN
 �3         
 � j��  
 Am ��~�~�i
 ('         
 � k;, 
 Om3��x8\Hh
 �s          � l mQ�Y
 �          � l}  �g �NS
           � m' �  R�p��
 xI          � mb R_NL�
 �F          � n.  R�O�~
 ��          � nU  R N�Q
 [          � nW � �� R�N�[�egq
 �G          � nW *md R�N��mY�y
 $         
 � nX -W 
 mQ�NRKb9�
 �          � ns  Rz�Wf
 �X         
 � n| c� 
 mQ N�b�q��
 +          � nZ mQ N�N�R
 �s          � ndb mQz��OL�
 Ru          � nk Rf3�
 V�          � p�  R��&O
 ;]          � p\ RΏ�
 'D          � pp R����
 G          � r] �  R8l�y�X
 �<          � s�  �g�O�~
 
\          � t R�_
 ~�          � t  R�[f
 �F          � t6  R�sQg
 �L          � t�  R��~t
 �=          � t�  R�y6O
 u          � t% R�[�s
 (T          � t[ R틙q
 �^          � ta R�#k
 m�          � tb R�f
 ow          � t� R�s�s
 ��          � v R�`
 Yl          � v� RÍ�s
 �P          � w RAQ
 �[         R��
 ^Z          � w� T  Am�NQR�l
 �g          � w% R�Nq\
 �f          � y, R(W�w
 �]          � ��  R�Xs^
 ru         
 � �SbZ
 mQ*rYfir
 �          � � �gu
 �          � ��  R/c�z
 �L          � �i �gwŖ
 �K          � �t R/c�[
 Xl          � �� Rck��
 �Z          � ��  R�_�Q
 ��          � �f R�_i�
 "9          � �t Rzf�[
           � �u Rzf�n
 AM          � �$  R2mb
 �\         
 � �,t
 �g�]ߘ�N|�
 up         
 � �Y� c 
 �g�]�[r�T
 '_          � �$  R�zb
 ��          � �, R�X�[
 ,/          � �y  RX�a�
 ��          � �� RSS�_
 9�          � �#  R�hhf
 5         R�h��
 O         R}|��
 *          � �J  R�i
 	�          � �i  RP[�V
 a!          � ��  R�hZ
 �          �   ��Rs
 �          �  G ���P)Y
 U0          �   ��kQ
 q4          �  n ��kQ7Y
 �6          �    ���O�O
 6�          �   ���f
 H          � + i�  �l�]Ŗ�
 �X          � A  ��0W
 N4          � A A  ��__
 Oz          � I ? ���e�St
 ��          � L  ���
 }          � M U �����s
 !Q          � W Y Z ��ޘ�Q�
 �          � Y $ ^ ���QHTey
 �         ���QHT�
 A          � Y 8 <  ���Q'Y�v
 2          � ]  <{�{
 �L         ��g
 bn          � a _   ���\N.^
 Lu          � n �  ��Bh_l
 Rs          � v  +  ���l�Q�]
 �\          � { *  ���U^yuQ
 zq          � | � $  ��Vn��W
 x�         
 � | '� L 
 ��N�\t^�
 (u          � �  ��\
 A�          � �  ��b
 �          � � m ��y�sNN
 �          � �  ���l
 bo          � � �  ��~�K`
 l�          � �  ��̑
 ;          � � +Z ���Ruir
 ��          � �  ��ޜ
 tF          � �  ��Am
 �#          � �  ���Y
 5          � � � * ��l��|^y
 �          � �  �  ���V�@\
 �Z          � � W �  ���ޘ2u
 ��          � � %A �K � 9  ���q\0W��e&^
 �`          � � %K � 9  ���q\�e&^
 �`          � � � ���5�
 �"          � �  �b�v
 =
          � � m ��id7r
 �          � �  ��gr
 ^3          � �  G�WS
 �Z          � � 8 �  ��t^'Y	T
 ׁ          � � �  ����̑
 \          � � G ����0u
 �          � �  ��hV
 i          � � ��  ����b:g
 �w          � � n ���`�a
 M          � 	 ��n�l
 I          � 	� A  ���ln the middle
			padAxis = mapRatio > plotRatio ? this : xAxis;
			
			// Pad it
			adjustedAxisLength = (padAxis.max - padAxis.min) * padAxis.transA;
			padAxis.minPixelPadding = (padAxis.len - adjustedAxisLength) / 2;
		}
	});


	//--- Start zooming and panning features

	wrap(Chart.prototype, 'render', function (proceed) {
		var chart = this,
			mapNavigation = chart.options.mapNavigation;

		proceed.call(chart);

		// Render the plus and minus buttons
		chart.renderMapNavigation();

		// Add the double click event
		if (mapNavigation.zoomOnDoubleClick) {
			Highcharts.addEvent(chart.container, 'dblclick', function (e) {
				chart.pointer.onContainerDblClick(e);
			});
		}

		// Add the mousewheel event
		if (mapNavigation.zoomOnMouseWheel) {
			Highcharts.addEvent(chart.container, document.onmousewheel === undefined ? 'DOMMouseScroll' : 'mousewheel', function (e) {
				chart.pointer.onContainerMouseWheel(e);
			});
		}
	});

	// Extend the Pointer
	extend(Pointer.prototype, {

		/**
		 * The event handler for the doubleclick event
		 */
		onContainerDblClick: function (e) {
			var chart = this.chart;

			e = this.normalize(e);

			if (chart.isInsidePlot(e.chartX - chart.plotLeft, e.chartY - chart.plotTop)) {
				chart.mapZoom(
					0.5,
					chart.xAxis[0].toValue(e.chartX),
					chart.yAxis[0].toValue(e.chartY)
				);
			}
		},

		/**
		 * The event handler for the mouse scroll event
		 */
		onContainerMouseWheel: function (e) {
			var chart = this.chart,
				delta;

			e = this.normalize(e);

			// Firefox uses e.detail, WebKit and IE uses wheelDelta
			delta = e.detail || -(e.wheelDelta / 120);
			if (chart.isInsidePlot(e.chartX - chart.plotLeft, e.chartY - chart.plotTop)) {
				chart.mapZoom(
					delta > 0 ? 2 : 0.5,
					chart.xAxis[0].toValue(e.chartX),
					chart.yAxis[0].toValue(e.chartY)
				);
			}
		}
	});
	// Implement the pinchType option
	wrap(Pointer.prototype, 'init', function (proceed, chart, options) {

		proceed.call(this, chart, options);

		// Pinch status
		if (options.mapNavigation.enableTouchZoom) {
			this.pinchX = this.pinchHor = 
				this.pinchY = this.pinchVert = true;
		}
	});

	// Add events to the Chart object itself
	extend(Chart.prototype, {
		renderMapNavigation: function () {
			var chart = this,
				options = this.options.mapNavigation,
				buttons = options.buttons,
				n,
				button,
				buttonOptions,
				outerHandler = function () { 
					this.handler.call(chart); 
				};

			if (options.enableButtons) {
				for (n in buttons) {
					if (buttons.hasOwnProperty(n)) {
						buttonOptions = merge(options.buttonOptions, buttons[n]);

						button = chart.renderer.button(buttonOptions.text, 0, 0, outerHandler)
							.attr({
								width: buttonOptions.width,
								height: buttonOptions.height
							})
							.css(buttonOptions.style)
							.add();
						button.handler = buttonOptions.onclick;
						button.align(extend(buttonOptions, { width: button.width, height: button.height }), null, 'spacingBox');
					}
				}
			}
		},

		/**
		 * Fit an inner box to an outer. If the inner box overflows left or right, align it to the sides of the
		 * outer. If it overflows both sides, fit it within the outer. This is a pattern that occurs more places
		 * in Highcharts, perhaps it should be elevated to a common utility function.
		 */
		fitToBox: function (inner, outer) {
			each([['x', 'width'], ['y', 'height']], function (dim) {
				var pos = dim[0],
					size = dim[1];
				if (inner[pos] + inner[size] > outer[pos] + outer[size]) { // right overflow
					if (inner[size] > outer[size]) { // the general size is greater, fit fully to outer
						inner[size] = outer[size];
						inner[pos] = outer[pos];
					} else { // align right
						inner[pos] = outer[pos] + outer[size] - inner[size];
					}
				}
				if (inner[size] > outer[size]) {
					inner[size] = outer[size];
				}
				if (inner[pos] < outer[pos]) {
					inner[pos] = outer[pos];
				}
				
			});

			return inner;
		},

		/**
		 * Zoom the map in or out by a certain amount. Less than 1 zooms in, greater than 1 zooms out.
		 */
		mapZoom: function (howMuch, centerXArg, centerYArg) {

			if (this.isMapZooming) {
				return;
			}

			var chart = this,
				xAxis = chart.xAxis[0],
				xRange = xAxis.max - xAxis.min,
				centerX = pick(centerXArg, xAxis.min + xRange / 2),
				newXRange = xRange * howMuch,
				yAxis = chart.yAxis[0],
				yRange = yAxis.max - yAxis.min,
				centerY = pick(centerYArg, yAxis.min + yRange / 2),
				newYRange = yRange * howMuch,
				newXMin = centerX - newXRange / 2,
				newYMin = centerY - newYRange / 2,
				animation = pick(chart.options.chart.animation, true),
				delay,
				newExt = chart.fitToBox({
					x: newXMin,
					y: newYMin,
					width: newXRange,
					height: newYRange
				}, {
					x: xAxis.dataMin,
					y: yAxis.dataMin,
					width: xAxis.dataMax - xAxis.dataMin,
					height: yAxis.dataMax - yAxis.dataMin
				});

			xAxis.setExtremes(newExt.x, newExt.x + newExt.width, false);
			yAxis.setExtremes(newExt.y, newExt.y + newExt.height, false);

			// Prevent zooming until this one is finished animating
			delay = animation ? animation.duration || 500 : 0;
			if (delay) {
				chart.isMapZooming = true;
				setTimeout(function () {
					chart.isMapZooming = false;
				}, delay);
			}

			chart.redraw();
		}
	});
	
	/**
	 * Extend the default options with map options
	 */
	plotOptions.map = merge(plotOptions.scatter, {
		animation: false, // makes the complex shapes slow
		nullColor: '#F8F8F8',
		borderColor: 'silver',
		borderWidth: 1,
		marker: null,
		stickyTracking: false,
		dataLabels: {
			verticalAlign: 'middle'
		},
		turboThreshold: 0,
		tooltip: {
			followPointer: true,
			pointFormat: '{point.name}: {point.y}<br/>'
		},
		states: {
			normal: {
				animation: true
			}
		}
	});

	var MapAreaPoint = Highcharts.extendClass(Point, {
		/**
		 * Extend the Point object to split paths
		 */
		applyOptions: function (options, x) {

			var point = Point.prototype.applyOptions.call(this, options, x);

			if (point.path && typeof point.path === 'string') {
				point.path = point.options.path = Highcharts.splitPath(point.path);
			}

			return point;
		},
		/**
		 * Stop the fade-out 
		 */
		onMouseOver: function () {
			clearTimeout(this.colorInterval);
			Point.prototype.onMouseOver.call(this);
		},
		/**
		 * Custom animation for tweening out the colors. Animation reduces blinking when hovering
		 * over islands and coast lines. We run a custom implementation of animation becuase we
		 * need to be able to run this independently from other animations like zoom redraw. Also,
		 * adding color animation to the adapters would introduce almost the same amount of code.
		 */
		onMouseOut: function () {
			var point = this,
				start = +new Date(),
				normalColor = Color(point.options.color),
				hoverColor = Color(point.pointAttr.hover.fill),
				animation = point.series.options.states.normal.animation,
				duration = animation && (animation.duration || 500);

			if (duration && normalColor.rgba.length === 4 && hoverColor.rgba.length === 4) {
				delete point.pointAttr[''].fill; // avoid resetting it in Point.setState

				clearTimeout(point.colorInterval);
				point.colorInterval = setInterval(function () {
					var pos = (new Date() - start) / duration,
						graphic = point.graphic;
					if (pos > 1) {
						pos = 1;
					}
					if (graphic) {
						graphic.attr('fill', tweenColors(hoverColor, normalColor, pos));
					}
					if (pos >= 1) {
						clearTimeout(point.colorInterval);
					}
				}, 13);
			}
			Point.prototype.onMouseOut.call(point);
		}
	});

	/**
	 * Add the series type
	 */
	seriesTypes.map = Highcharts.extendClass(seriesTypes.scatter, {
		type: 'map',
		pointAttrToOptions: { // mapping between SVG attributes and the corresponding options
			stroke: 'borderColor',
			'stroke-width': 'borderWidth',
			fill: 'color'
		},
		colorKey: 'y',
		pointClass: MapAreaPoint,
		trackerGroups: ['group', 'markerGroup', 'dataLabelsGroup'],
		getSymbol: noop,
		supportsDrilldown: true,
		getExtremesFromAll: true,
		useMapGeometry: true, // get axis extremes from paths, not values
		init: function (chart) {
			var series = this,
				valueDecimals = chart.options.legend.valueDecimals,
				legendItems = [],
				name,
				from,
				to,
				fromLabel,
				toLabel,
				colorRange,
				valueRanges,
				gradientColor,
				grad,
				tmpLabel,
				horizontal = chart.options.legend.layout === 'horizontal';

			
			Highcharts.Series.prototype.init.apply(this, arguments);
			colorRange = series.options.colorRange;
			valueRanges = series.options.valueRanges;

			if (valueRanges) {
				each(valueRanges, function (range) {
					from = range.from;
					to = range.to;
					
					// Assemble the default name. This can be overridden by legend.options.labelFormatter
					name = '';
					if (from === UNDEFINED) {
						name = '< ';
					} else if (to === UNDEFINED) {
						name = '> ';
					}
					if (from !== UNDEFINED) {
						name += numberFormat(from, valueDecimals);
					}
					if (from !== UNDEFINED && to !== UNDEFINED) {
						name += ' - ';
					}
					if (to !== UNDEFINED) {
						name += numberFormat(to, valueDecimals);
					}
					
					// Add a mock object to the legend items
					legendItems.push(Highcharts.extend({
						chart: series.chart,
						name: name,
						options: {},
						drawLegendSymbol: seriesTypes.area.prototype.drawLegendSymbol,
						visible: true,
						setState: function () {},
						setVisible: function () {}
					}, range));
				});
				series.legendItems = legendItems;

			} else if (colorRange) {

				from = colorRange.from;
				to = colorRange.to;
				fromLabel = colorRange.fromLabel;
				toLabel = colorRange.toLabel;

				// Flips linearGradient variables and label text.
				grad = horizontal ? [0, 0, 1, 0] : [0, 1, 0, 0]; 
				if (!horizontal) {
					tmpLabel = fromLabel;
					fromLabel = toLabel;
					toLabel = tmpLabel;
				} 

				// Creates color gradient.
				gradientColor = {
					linearGradient: { x1: grad[0], y1: grad[1], x2: grad[2], y2: grad[3] },
					stops: 
					[
						[0, from],
						[1, to]
					]
				};

				// Add a mock object to the legend items.
				legendItems = [{
					chart: series.chart,
					options: {},
					fromLabel: fromLabel,
					toLabel: toLabel,
					color: gradientColor,
					drawLegendSymbol: this.drawLegendSymbolGradient,
					visible: true,
					setState: function () {},
					setVisible: function () {}
				}];

				series.legendItems = legendItems;
			}
		},

		/**
		 * If neither valueRanges nor colorRanges are defined, use basic area symbol.
		 */
		drawLegendSymbol: seriesTypes.area.prototype.drawLegendSymbol,

		/**
		 * Gets the series' symbol in the legend and extended legend with more information.
		 * 
		 * @param {Object} legend The legend object
		 * @param {Object} item The series (this) or point
		 */
		drawLegendSymbolGradient: function (legend, item) {
			var spacing = legend.options.symbolPadding,
				padding = pick(legend.options.padding, 8),
				positionY,
				positionX,
				gradientSize = this.chart.renderer.fontMetrics(legend.options.itemStyle.fontSize).h,
				horizontal = legend.options.layout === 'horizontal',
				box1,
				box2,
				box3,
				rectangleLength = pick(legend.options.rectangleLength, 200);

			// Set local variables based on option.
			if (horizontal) {
				positionY = -(spacing / 2);
				positionX = 0;
			} else {
				positionY = -rectangleLength + legend.baseline - (spacing / 2);
				positionX = padding + gradientSize;
			}

			// Creates the from text.
			item.fromText = this.chart.renderer.text(
					item.fromLabel,	// Text.
					positionX,		// Lower left x.
					positionY		// Lower left y.
				).attr({
					zIndex: 2
				}).add(item.legendGroup);
			box1 = item.fromText.getBBox();

			// Creates legend symbol.
			// Ternary changes variables based on option.
			item.legendSymbol = this.chart.renderer.rect(
				horizontal ? box1.x + box1.width + spacing : box1.x - gradientSize - spacing,		// Upper left x.
				box1.y,																				// Upper left y.
				horizontal ? rectangleLength : gradientSize,											// Width.
				horizontal ? gradientSize : rectangleLength,										// Height.
				2																					// Corner radius.
			).attr({
				zIndex: 1
			}).add(item.legendGroup);
			box2 = item.legendSymbol.getBBox();

			// Creates the to text.
			// Vertical coordinate changed based on option.
			item.toText = this.chart.renderer.text(
					item.toLabel,
					box2.x + box2.width + spacing,
					horizontal ? positionY : box2.y + box2.height - spacing
				).attr({
					zIndex: 2
				}).add(item.legendGroup);
			box3 = item.toText.getBBox();

			// Changes legend box settings based on option.
			if (horizontal) {
				legend.offsetWidth = box1.width + box2.width + box3.width + (spacing * 2) + padding;
				legend.itemY = gradientSize + padding;
			} else {
				legend.offsetWidth = Math.max(box1.width, box3.width) + (spacing) + box2.width + padding;
				legend.itemY = box2.height + padding;
				legend.itemX = spacing;
			}
		},

		/**
		 * Get the bounding box of all paths in the map combined.
		 */
		getBox: function (paths) {
			var maxX = Number.MIN_VALUE, 
				minX =  Number.MAX_VALUE, 
				maxY = Number.MIN_VALUE, 
				minY =  Number.MAX_VALUE;
			
			
			// Find the bounding box
			each(paths || this.options.data, function (point) {
				var path = point.path,
					i = path.length,
					even = false, // while loop reads from the end
					pointMaxX = Number.MIN_VALUE, 
					pointMinX =  Number.MAX_VALUE, 
					pointMaxY = Number.MIN_VALUE, 
					pointMinY =  Number.MAX_VALUE;
					
				while (i--) {
					if (typeof path[i] === 'number' && !isNaN(path[i])) {
						if (even) { // even = x
							pointMaxX = Math.max(pointMaxX, path[i]);
							pointMinX = Math.min(pointMinX, path[i]);
						} else { // odd = Y
							pointMaxY = Math.max(pointMaxY, path[i]);
							pointMinY = Math.min(pointMinY, path[i]);
						}
						even = !even;
					}
				}
				// Cache point bounding box for use to position data labels
				point._maxX = pointMaxX;
				point._minX = pointMinX;
				point._maxY = pointMaxY;
				point._minY = pointMinY;

				maxX = Math.max(maxX, pointMaxX);
				minX = Math.min(minX, pointMinX);
				maxY = Math.max(maxY, pointMaxY);
				minY = Math.min(minY, pointMinY);
			});
			this.minY = minY;
			this.maxY = maxY;
			this.minX = minX;
			this.maxX = maxX;
			
		},
		
		
		
		/**
		 * Translate the path so that it automatically fits into the plot area box
		 * @param {Object} path
		 */
		translatePath: function (path) {
			
			var series = this,
				even = false, // while loop reads from the end
				xAxis = series.xAxis,
				yAxis = series.yAxis,
				i;
				
			// Preserve the original
			path = [].concat(path);
				
			// Do the translation
			i = path.length;
			while (i--) {
				if (typeof path[i] === 'number') {
					if (even) { // even = x
						path[i] = Math.round(xAxis.translate(path[i]));
					} else { // odd = Y
						path[i] = Math.round(yAxis.len - yAxis.translate(path[i]));
					}
					even = !even;
				}
			}
			return path;
		},
		
		setData: function () {
			Highcharts.Series.prototype.setData.apply(this, arguments);
			this.getBox();
		},
		
		/**
		 * Add the path option for data points. Find the max value for color calculation.
		 */
		translate: function () {
			var series = this,
				dataMin = Number.MAX_VALUE,
				dataMax = Number.MIN_VALUE;
	
			series.generatePoints();
	
			each(series.data, function (point) {
				
				point.shapeType = 'path';
				point.shapeArgs = {
					d: series.translatePath(point.path)
				};
				
				// TODO: do point colors in drawPoints instead of point.init
				if (typeof point.y === 'number') {
					if (point.y > dataMax) {
						dataMax = point.y;
					} else if (point.y < dataMin) {
						dataMin = point.y;
					}
				}
			});
			
			series.translateColors(dataMin, dataMax);
		},
		
		/**
		 * In choropleth maps, the color is a result of the value, so this needs translation too
		 */
		translateColors: function (dataMin, dataMax) {
			
			var seriesOptions = this.options,
				valueRanges = seriesOptions.valueRanges,
				colorRange = seriesOptions.colorRange,
				colorKey = this.colorKey,
				from,
				to;

			if (colorRange) {
				from = Color(colorRange.from);
				to = Color(colorRa  � 	 � ݔSP[
 Q6          �   �~�Q
 �          �  n TZS�q
 S          �   �~�S
           �    �~6�JZ
 �a          �  D  �~6�L\
 @          �  �  �~6�8�
 ^?          �  �  �~6��Y
 S          � # m T��Tf
 �Z          � + b �~�]x^
 e|          � : :  t�ˆˆ
 �<          � @ \ �~op�O
 Y�          � V  �~>e
 O          � ] �  T�yKQ
 �w          � ` �  �~Dj�i
 ��          � n \ �~���O
 �8          � p  �~�g
 0          � � �  TOO
 �3          � �  �~B�
 x          � � }  �~��R
 �`          � � �  ��߄Oe
 t          � �  �~2u
 �-          � �  TsO�[
 vP          � �  t�ZW:_
 S          � � \ �~�{�O
 wc         
 � � �?� 
 �~��w*Yΐ
 �u          � � �  T_l�g
 �x          � �  �~Ye
 y          � �  �~�]�N
 �>          � � c �~�]�q
 6          � � �  �~���]
 م          � � � T�NP[
 +a          � �  ( �~��Nǆ
 �6          � � W  �~=^9�
 �          � � ��  �~=^P[��
 (@         
 � � �[T 
 �~=^P[b�l
 �T          � �  �~T
 y          � � � T�_Vy
 �j          � �  �e�b
 �)          � �  �~o
 ��          � � `�  /ll�lo
 �r          �  �~��
 I7          � $  TR�Yj
 JZ          � r  Tnwm
 ߇          � �  TR��g
 IZ          � R �~R�ن
 �          � J �  t����k~�
           �  t��Z
 �          �  6 � �~r�Qg�^
 �=          �  8  �~r����N
 ��          �  � �  �~r�T��v
 �"          �  �  �~r�=��e
 �B          �  � �  �~r�+s�T
 �B          �  B  �~r�WY�
 7�          �  s�  �~r�8n��
           � %� W  �~q\�TaU
 <          � & �eFU
 KD          � ,�  �_^�Y
 |w          � - �~&v
 -X          � 3  �  �~4l�Am
 �5          � ?kt �~*Y3�|�
 �1          � G T0u
 i$          � GA �~)YX
 �b          � K �~�w
 �          � Kt Td_�
 ��         
 � T	 �g 
 �~~nSň�]
 ��          � T TIZ�g
 m�          � U �~�s
 ~&          � Z �~��
 �         
 � _ F � 
 /l]x�[�[Gr
 7r          � _}  Tq{NS
 ~�          � a}  T�eNS
 pM          � b TL�
 YE          � b^ �eL��v�N
          
 � d � �
 T�yMb����
 yA          � d� T�y��
 �3          � j �~�p
 �)          � jk t �~<w*`|�
 L          � m	  �~�S�[
 bj          � mW }  �~Αޘ��
 y�         
 � m� .�
 �~�SLrh�
 �{          � nB T8��m
 P\          � o �  �~5�/OPN
 ��          � p.  TΏ%f
 �I          � p�  T�f
 -f         
 � sU n� 
 �e8n�ы:g
 wa         
 � ss� 
 �e8n|^z�u
 w/          � t �~|�
 C
          � vJ Tg�^
 ?P          � w�  TЏ��
 T�          � � �eU\
            � � �_?e:_�N
 �          � �g 6 �~ilQ�S
 Uq          � �v  T�_�T
 
S          � ��  T-N|i
 ��          � � TP[TN
 �m          �   �YLv
 �B          �  �  l�1r&O
  \          �  =  l����_
 �          � 
 $   l�̀b"k
 �8          �   ��|�
 B-          �  �  �b^sY
 S�          �    l�Eu
 ߈          �   �  l�:WjW
 ��          � $  A  ���Wh�_
 �k          � &  ���m
 �l          � & � ���mG�
 �l          � 0  l�:R
 �)         ���|
 �R          � 8 Y  l�'YΘ
 �e         
 � 8 � 6� 
 l����R�e�R
 
r          � 8 P l�����
 �!          � 9   l�۞6�
 :~          � 9 c  �����T
 �          � :  �Yˆ
 �`          � < �	 l��\;NCg
 RG          � = d l��_�y
 �P          � = �� �Y�vzf��
 ?          � @  �  l�op�=�
 �T          � A  l��
 O          � A O  l����S
           � A S 8  �s��\��
 �f          � A �  l�����
 ;          � A �  l���GY
 �-          � A iS  l����N\
 �2          � F + l���v
 �S          � F ` l�N��
 jg          � H �  l�NOe
 �f          � J w l��^�N
 g�          � S 9 ] 3�  l�\�N+Y4lR�
 �B         
 � S N � N 
 l�\Y�~Y
 �y          � S � 6 l�\KQ�e
 K          � S ? l�\�l
 s�          � U  ��m�
 �          � V  l��e
 L          � V V  l��e�e
 �|         
 � V �v �
 l��e�~T�_
 �H          � W ! l��e�h
 �W          � X F l�KYD�
 ]O          � Y  l��
 0          � Y i <  ��Θd[�\
 �         
 � Y Y� } 
 l���z����
 z4          � ] �  l�+YW
 �           � n  ����
            � n �  l�Bh(g
 Ln          � t  l�*�
 �L          � t  �  l�*��s:g
 bG          � t & � l�*�͑�~
 7H          � t U n l�*��ы
 �L          � t W �  l�*�ޘ:g
 cG          � t m b  l�*�^JT
 YL         
 � t � � �
 l�*�&qQ��u
 �L          � t � �  l�*��R:g
 {L          � t � �  l�*��[:g
 dG          � t � � ��  l�*��[:g`W�k
 _G          � t � ` $ �  l�*�OeaXN�[
 vL          � t = A V  l�*��S�v0W�e
 �K          � t ,�  l�*��N�N
 �L          � t ,�  l�*�1YT�
 �L          � t ,, l�*�1Y�N
 aG         
 � t a]=
 l�*��e�~"}
 �K          � t ��  l�*�`W�k
 `G          � u s  l�imIl
 G          � u f l��vi�
 0D          � v � J  l��Tn�!n
 m          � { '�  l�4s�pR�
          
 � }  � � 
 �������`B�
 o'          � }    ������
 (          � } � � ����
��g
 }%          � } E l�;u�
 w