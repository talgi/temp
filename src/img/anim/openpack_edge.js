(function(compId) {
	var _ = null,
		y = true,
		n = false,
		x1 = '6.0.0',
		x3 = '6.0.0.400',
		x2 = '5.0.0',
		x12 = 'rgba(0,0,0,0)',
		lf = 'left',
		g = 'image',
		h = 'height',
		bp = 'background-position',
		x5 = 'rgba(255,255,255,0.00)',
		e16 = '${open2}',
		x9 = '4096px',
		x11 = 'auto',
		x17 = '@@0@@px @@1@@px',
		x15 = '570px',
		x14 = '1000px',
		x10 = '8192px',
		w = 'width',
		tp = 'top',
		m = 'rect',
		x8 = '0px',
		e6 = '${openpack}',
		x4 = 'horizontal',
		x7 = 'open2',
		i = 'none';
	var g13 = 'open2.png';
	var im = 'img/',
		aud = 'media/',
		vid = 'media/',
		js = 'js/',
		fonts = {},
		opts = {
			'gAudioPreloadPreference': 'auto',
			'gVideoPreloadPreference': 'auto'
		},
		resources = [],
		scripts = [],
		symbols = {
			"stage": {
				v: x1,
				mv: x2,
				b: x3,
				stf: i,
				cg: x4,
				rI: n,
				cn: {
					dom: [{
						id: 'openpack',
						symbolName: 'openpack',
						t: m,
						r: ['0px', '0px', '1000px', '570px', 'auto', 'auto']
					}],
					style: {
						'${Stage}': {
							isStage: true,
							r: [undefined, undefined, '1000px', '570px'],
							overflow: 'hidden',
							f: [x5]
						}
					}
				},
				tt: {
					d: 3562.5,
					a: y,
					data: [
						["eid61", lf, 0, 0, "linear", e6, '0px', '0px'],
						["eid60", tp, 0, 0, "linear", e6, '0px', '0px']
					]
				}
			},
			"openpack": {
				v: x1,
				mv: x2,
				b: x3,
				stf: i,
				cg: i,
				rI: n,
				cn: {
					dom: [{
						id: x7,
						t: g,
						r: [x8, x8, x9, x10, x11, x11],
						f: [x12, im + g13, x8, x8, x9, x10]
					}],
					style: {
						'${symbolSelector}': {
							r: [_, _, x14, x15]
						}
					}
				},
				tt: {
					d: 3562.5,
					a: y,
					data: [
						["eid2", w, 0, 0, "linear", e16, '0px', '1000px'],
						["eid3", bp, 0, 0, "linear", e16, [0, 0],
							[-0, -0], {
								vt: x17
							}
						],
						["eid4", bp, 62, 0, "linear", e16, [-0, -0],
							[-1000, -0], {
								vt: x17
							}
						],
						["eid5", bp, 125, 0, "linear", e16, [-1000, -0],
							[-2000, -0], {
								vt: x17
							}
						],
						["eid6", bp, 187, 0, "linear", e16, [-2000, -0],
							[-3000, -0], {
								vt: x17
							}
						],
						["eid7", bp, 250, 0, "linear", e16, [-3000, -0],
							[-0, -570], {
								vt: x17
							}
						],
						["eid8", bp, 312, 0, "linear", e16, [-0, -570],
							[-1000, -570], {
								vt: x17
							}
						],
						["eid9", bp, 375, 0, "linear", e16, [-1000, -570],
							[-2000, -570], {
								vt: x17
							}
						],
						["eid10", bp, 500, 0, "linear", e16, [-2000, -570],
							[-3000, -570], {
								vt: x17
							}
						],
						["eid11", bp, 562, 0, "linear", e16, [-3000, -570],
							[-0, -1140], {
								vt: x17
							}
						],
						["eid12", bp, 625, 0, "linear", e16, [-0, -1140],
							[-1000, -1140], {
								vt: x17
							}
						],
						["eid13", bp, 687, 0, "linear", e16, [-1000, -1140],
							[-2000, -1140], {
								vt: x17
							}
						],
						["eid14", bp, 750, 0, "linear", e16, [-2000, -1140],
							[-3000, -1140], {
								vt: x17
							}
						],
						["eid15", bp, 812, 0, "linear", e16, [-3000, -1140],
							[-0, -1710], {
								vt: x17
							}
						],
						["eid16", bp, 875, 0, "linear", e16, [-0, -1710],
							[-1000, -1710], {
								vt: x17
							}
						],
						["eid17", bp, 937, 0, "linear", e16, [-1000, -1710],
							[-2000, -1710], {
								vt: x17
							}
						],
						["eid18", bp, 1000, 0, "linear", e16, [-2000, -1710],
							[-3000, -1710], {
								vt: x17
							}
						],
						["eid19", bp, 1062, 0, "linear", e16, [-3000, -1710],
							[-0, -2280], {
								vt: x17
							}
						],
						["eid20", bp, 1125, 0, "linear", e16, [-0, -2280],
							[-1000, -2280], {
								vt: x17
							}
						],
						["eid21", bp, 1187, 0, "linear", e16, [-1000, -2280],
							[-2000, -2280], {
								vt: x17
							}
						],
						["eid22", bp, 1250, 0, "linear", e16, [-2000, -2280],
							[-3000, -2280], {
								vt: x17
							}
						],
						["eid23", bp, 1312, 0, "linear", e16, [-3000, -2280],
							[-0, -2850], {
								vt: x17
							}
						],
						["eid24", bp, 1375, 0, "linear", e16, [-0, -2850],
							[-1000, -2850], {
								vt: x17
							}
						],
						["eid25", bp, 1437, 0, "linear", e16, [-1000, -2850],
							[-2000, -2850], {
								vt: x17
							}
						],
						["eid26", bp, 1500, 0, "linear", e16, [-2000, -2850],
							[-3000, -2850], {
								vt: x17
							}
						],
						["eid27", bp, 1562, 0, "linear", e16, [-3000, -2850],
							[-0, -3420], {
								vt: x17
							}
						],
						["eid28", bp, 1625, 0, "linear", e16, [-0, -3420],
							[-1000, -3420], {
								vt: x17
							}
						],
						["eid29", bp, 1687, 0, "linear", e16, [-1000, -3420],
							[-2000, -3420], {
								vt: x17
							}
						],
						["eid30", bp, 1750, 0, "linear", e16, [-2000, -3420],
							[-3000, -3420], {
								vt: x17
							}
						],
						["eid31", bp, 1875, 0, "linear", e16, [-3000, -3420],
							[-0, -3990], {
								vt: x17
							}
						],
						["eid32", bp, 1937, 0, "linear", e16, [-0, -3990],
							[-1000, -3990], {
								vt: x17
							}
						],
						["eid33", bp, 2000, 0, "linear", e16, [-1000, -3990],
							[-2000, -3990], {
								vt: x17
							}
						],
						["eid34", bp, 2062, 0, "linear", e16, [-2000, -3990],
							[-3000, -3990], {
								vt: x17
							}
						],
						["eid35", bp, 2125, 0, "linear", e16, [-3000, -3990],
							[-0, -4560], {
								vt: x17
							}
						],
						["eid36", bp, 2187, 0, "linear", e16, [-0, -4560],
							[-1000, -4560], {
								vt: x17
							}
						],
						["eid37", bp, 2250, 0, "linear", e16, [-1000, -4560],
							[-2000, -4560], {
								vt: x17
							}
						],
						["eid38", bp, 2312, 0, "linear", e16, [-2000, -4560],
							[-3000, -4560], {
								vt: x17
							}
						],
						["eid39", bp, 2375, 0, "linear", e16, [-3000, -4560],
							[-0, -5130], {
								vt: x17
							}
						],
						["eid40", bp, 2437, 0, "linear", e16, [-0, -5130],
							[-0, -5700], {
								vt: x17
							}
						],
						["eid41", bp, 2500, 0, "linear", e16, [-0, -5700],
							[-0, -6270], {
								vt: x17
							}
						],
						["eid42", bp, 2562, 0, "linear", e16, [-0, -6270],
							[-0, -6840], {
								vt: x17
							}
						],
						["eid43", bp, 2625, 0, "linear", e16, [-0, -6840],
							[-0, -7410], {
								vt: x17
							}
						],
						["eid44", bp, 2687, 0, "linear", e16, [-0, -7410],
							[-1000, -5130], {
								vt: x17
							}
						],
						["eid45", bp, 2750, 0, "linear", e16, [-1000, -5130],
							[-2000, -5130], {
								vt: x17
							}
						],
						["eid46", bp, 2812, 0, "linear", e16, [-2000, -5130],
							[-3000, -5130], {
								vt: x17
							}
						],
						["eid47", bp, 2875, 0, "linear", e16, [-3000, -5130],
							[-1000, -5700], {
								vt: x17
							}
						],
						["eid48", bp, 2937, 0, "linear", e16, [-1000, -5700],
							[-2000, -5700], {
								vt: x17
							}
						],
						["eid49", bp, 3000, 0, "linear", e16, [-2000, -5700],
							[-3000, -5700], {
								vt: x17
							}
						],
						["eid50", bp, 3062, 0, "linear", e16, [-3000, -5700],
							[-1000, -6270], {
								vt: x17
							}
						],
						["eid51", bp, 3125, 0, "linear", e16, [-1000, -6270],
							[-1000, -6840], {
								vt: x17
							}
						],
						["eid52", bp, 3250, 0, "linear", e16, [-1000, -6840],
							[-1000, -7410], {
								vt: x17
							}
						],
						["eid53", bp, 3375, 0, "linear", e16, [-1000, -7410],
							[-2000, -6270], {
								vt: x17
							}
						],
						["eid54", bp, 3437, 0, "linear", e16, [-2000, -6270],
							[-3000, -6270], {
								vt: x17
							}
						],
						["eid55", bp, 3500, 0, "linear", e16, [-3000, -6270],
							[-2000, -6840], {
								vt: x17
							}
						],
						["eid56", bp, 3562, 0, "linear", e16, [-2000, -6840],
							[-3000, -6840], {
								vt: x17
							}
						],
						["eid1", h, 0, 0, "linear", e16, '0px', '570px']
					]
				}
			}
		};
	AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);
})("openpack");
(function($, Edge, compId) {
	var Composition = Edge.Composition,
		Symbol = Edge.Symbol;
	Edge.registerEventBinding(compId, function($) {
		//Edge symbol: 'stage'
		(function(symbolName) {})("stage");
		//Edge symbol end:'stage'

		//=========================================================

		//Edge symbol: 'open2_symbol_1'
		(function(symbolName) {})("openpack");
		//Edge symbol end:'openpack'
	})
})(AdobeEdge.$, AdobeEdge, "openpack");