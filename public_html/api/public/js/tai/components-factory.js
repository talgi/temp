$(document).on("ready , ajaxComplete", function() {
	makeItEditable();
	$('[data-toggle="tooltip"]:not(.guy-admin-menu-item)').tooltip("destroy");
	$('[data-toggle="tooltip"]:not(.guy-admin-menu-item)').tooltip()

})

function makeItEditable() {
	createPanels();
	convertToEditor();
	convertToInput();
	convertToColorPicker();
	convertToResource();
	convertToLink();
	convertToBlock();
	convertToEmbed();
	convertToJoker();
	$(document).trigger("editbaleFinish");
}

function createComponents() {
	$("#components-modal a").each(function() {
		$(this).click(function(e) {
			var elemId = $("#components-modal ").data("elemid");
			e.preventDefault();
			var url = $(this).attr("href");
			var xhr = $.ajax({
				url: url,
				type: 'post',
				data: {
					id: elemId
				}

			});
			xhr.done(function(res) {
				res = $(res);
				if (elemId) {
					$("[data-elemid='" + elemId + "']").next().html("").append(res);
				} else {
					$("#components-holder").prepend(res);
				}
				$("#components-modal").modal("hide");

			});
		});
	});
}

function createPanels(obj) {
	if ($(obj).find(".tai-panel").length > 0) {
		return;
	}
	if (obj) {
		$(obj).css("margin-top", "50px");
		var offset = $(obj).offset();

		var id = $(obj).data("componentid");
		var name = $(obj).data("componentname");

		var btnsArr = $(obj).data("btns") ? $(obj).data("btns").split(",") : [];
		var btns = "";

		$(btnsArr).each(function(index) {
			switch (btnsArr[index]) {
				case 'drag':
					if ($(obj).parents(".accordion").length == 0 && $(obj).parents(".Joker").length == 0 && $(obj).parents(".tab-content").length == 0) {
						btns += "<div type='button' data-toggle='tooltip' title='Drag'  class='btn btn-primary tai-panel-drag'><span class='fa fa-arrows' ></span> </div>";

					}
					break;
				case 'collapse':
					if ($(obj).parents(".Joker").length == 0 && $(obj).parents(".tab-content").length == 0)
						btns += "<button type='button' data-toggle='tooltip' title='Collapse' class='btn btn-info tai-panel-collapse'><span class='fa fa-minus'  ></span></button>";
					break;
				case 'save':
					if ($(obj).parents(".Joker").length == 0 && $(obj).parents(".tab-content").length == 0) {
						btns += "<button type='button' data-toggle='tooltip' title='Save' class='btn btn-success tai-panel-save'><span class='fa fa-floppy-o '></span> </button>";
						btns += "<button type='button' data-toggle='tooltip' title=' Save and publish' class='btn btn-success tai-panel-save-publish'><span class='fa fa-check '  ></span></button>";
					}
					break;
				case 'add':
					btns += "<button type='button' data-toggle='tooltip'  class='btn btn-success tai-panel-add'><span class='fa fa-plus' ></span></button>";
					break;
				case 'edit':
					btns += "<button type='button' data-toggle='tooltip'  class='btn btn-success tai-panel-edit'><span class='fa fa-pencil '  ></span></button>";
					break;
				case 'special':
					btns += "<button type='button' data-toggle='tooltip'  class='btn btn-success tai-panel-special'><span class='glyphicon glyphicon-floppy-import' ></span></button>";
					break;
				case 'connect':
					btns += "<button type='button' data-toggle='tooltip' title='Connect with page' class='btn btn-success tai-panel-connect'><span class='glyphicon glyphicon-floppy-import'  ></span></button>";
					btns += "<button type='button' data-toggle='tooltip' title='Move to connected page' class='btn btn-success tai-panel-move-to'><span class='glyphicon glyphicon-floppy-import'  ></span></button>";
					break;
				case 'delete':
					if ($(obj).parents(".Joker").length == 0 && $(obj).parents(".tab-content").length == 0)
						btns += "<button type='button' data-toggle='tooltip'  title='Delete' class='btn btn-danger tai-panel-delete'><span class='glyphicon glyphicon-trash' ></span></button>";

					break;
			}

		});


		if (!id || !name) {
			throw "you forgot to put a component id or a component name";
		}

		var panel = $("<div class='container'><div class='panel tai-panel center-block'  id='" + id + "'style='direction: ltr;background-color: transparent;'>" +


			btns +

			"</div></div>");

		var components = new window["componentsClass"]
		panel.find(".tai-panel-save").unbind("click");
		panel.find(".tai-panel-save").click(function() {
			$(".tai-input , .tai-area").each(function() {
				$(this).find("form").submit();
			})
			var lang = $(obj).data("lang");
			var json = {}
			json.text = [];
			json.resource = [];
			json.booleans = [];
			var selctor = [obj];
			if ($(obj).next().length > 0 && $(obj).next().hasClass("block_form")) {
				selctor.push($(obj).next()[0]);
			}
			if ($(obj).hasClass("accordion")) {
				selctor.push($(obj).find(".top")[0]);
			}
			selctor = $(selctor);
			selctor.each(function() {
				$(this).find(".tai-editor ,.tai-embed ,  .tai-color , .tai-input, .tai-area, .tai-checkbox, .tai-connect , .tai-link ,.tai-select").each(function(index) {
					if ($(this).is(".tai-select")) {
						var html = $(this).val();
					} else if ($(this).is(".tai-checkbox")) {
						var html = $(this).is(":checked") ? 1 : 0;
					} else {
						var html = $(this).hasClass("tai-editor") ? $(this).code() : $(this).html();
					}
					if ($.trim(html) == "Edit text" || $.trim(html) == "Edit Link" || $.trim(html) == "Edit Color" || $.trim(html) == "Edit Embed") {
						html = "";
					}
					var attr = $(this).data("attr") ? $(this).data("attr") : "";
					var allLang = $(this).hasClass("tai-connect") ? 1 : 0;

					json.text.push({
						id: $(this).data("elemid"),
						html: html,
						attr: attr,
						allLang: allLang
					});
				});
			});


			selctor.each(function() {
				$(this).find(".tai-resource").each(function(index) {

					json.resource.push({
						id: $(this).data("elemid"),
						imageId: $(this).data("imageid")
					});
				});
			});
			json = JSON.stringify(json);
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/update/" + lang + "/" + id + "/" + name,
				type: "put",
				data: {
					json: json
				}

			});

			xhr.done(function(res) {
				if (!$(obj).hasClass("accordion")) {
					$(obj).replaceWith($(res));
				}
				$(document).trigger("saveComplete");
			})

			if (typeof(components[name]) != "undefined") {
				var component = new components[name];
				if (typeof component['save'] != "undefined") {
					component.save(obj);
				}
			}
		});

		panel.find(".tai-panel-save-publish").unbind("click");
		panel.find(".tai-panel-save-publish").click(function() {
			panel.find(".tai-panel-save").click();
			$(document).unbind("saveComplete");
			$(document).on("saveComplete", function() {
				var lang = $(obj).data("lang");
				var xhr = $.ajax({
					url: base_url + "/" + CMS_NAME + "/components/publish/" + lang + "/" + id + "/" + name,
					type: "put"


				});

			});
		});


		panel.find(".tai-panel-connect").unbind("click");
		panel.find(".tai-panel-connect").click(function() {
			var $connectLink = $(obj).find(".tai-connect");
			$("#all-pages-modal").data("connectLink", $connectLink);
			$("#all-pages-modal").modal("show");
		});
		panel.find(".tai-panel-move-to").unbind("click");
		panel.find(".tai-panel-move-to").click(function() {
			var $connectLink = $(obj).find(".tai-connect");
			window.open($connectLink.data("link"), '_blank');
		});

		panel.find(".tai-panel-edit").unbind("click");
		panel.find(".tai-panel-edit").click(function() {
			var $block_form = $(this).parents(".tai-component:first").next(".block_form");
			$block_form.find(".panel-title").html($(this).find(".btn-text").html());
			$block_form.show();
			$("html, body").animate({
				scrollTop: $block_form.offset().top
			}, 1000);
			if ($block_form.find(".block-sort").data("ui-sortable")) {
				$block_form.find(".block-sort").sortable("destroy");
			}
			var componenId = null;
			var componentName = null;

			$block_form.find(".block-sort").sortable({
				handle: ".tai-block-drag",
				containment: "body",
				connectWith: ".block-sort",
				start: function(event, ui) {
					componenId = ui.item.parents(".block_form").prev().data("componentid");
					componentName = ui.item.parents(".block_form").prev().data("componentname");
				},
				beforeStop: function(ev, ui) {

					var $taiComponent = ui.item.parents(".block_form").prev();

					if ($taiComponent.data("componentname") == componentName && componenId != $taiComponent.data("componentid")) {
						var xhr = $.ajax({
							url: base_url + "/" + CMS_NAME + "/components/switchcomponentblock",
							type: "put",
							data: {

								componentId: $taiComponent.data("componentid"),
								blockId: ui.item.data("blockid")

							}

						})
					} else if ($taiComponent.data("componentname") != componentName) {
						$(this).sortable('cancel');
						alertify.error("you can only switch between 2 item from the same component type");
					}
				},
				stop: function(event, ui) {
					var json = [];


					$(ui.item.parent()).find(".block-drag").each(function(index) {
						json[index] = {
							order: index,
							id: $(this).data('blockid')
						}
					})

					json = JSON.stringify(json);
					var xhr = $.ajax({
						url: base_url + "/" + CMS_NAME + "/components/orderblock",
						type: "put",
						data: {
							json: json
						}

					})


				}

			});


		});

		if ($.inArray("add", btnsArr) > -1 || $.inArray("special", btnsArr) > -1) {
			var component = new components[name];
			component.changeText(panel);
		}
		panel.find(".tai-panel-add").unbind("click");
		panel.find(".tai-panel-add").click(function() {
			var component = new components[name];
			component.add(obj, function(res) {
				$res = $(res);
				$res.removeClass("tai-model");
				singleBlockEdit($(res), $(obj).next());
				makeItEditable();
			});


		});
		panel.find(".tai-panel-special").unbind("click");
		panel.find(".tai-panel-special").click(function() {
			var component = new components[name];
			component.special(obj);
		});
		panel.find(".tai-panel-delete").unbind("click");
		panel.find(".tai-panel-delete").click(function() {

			alertify.confirm("? Are you sure you want to delete", function(e) {
				if (e) {
					var xhr = $.ajax({
						url: base_url + "/" + CMS_NAME + "/components/remove/" + id + "/" + name,
						type: "delete"

					})

					xhr.done(function() {
						if ($(obj).next().hasClass("block_form")) {
							$(obj).next().remove();
						}
						$(obj).remove();
					})
				}

			});

		})
		panel.find(".tai-panel-collapse").unbind("click");
		panel.find(".tai-panel-collapse").click(function() {
			var $all = panel.nextAll();
			if ($all.is(":visible")) {
				$all.slideUp();
				panel.find(".glyphicon-chevron-up").addClass(".glyphicon-chevron-down").removeClass(".glyphicon-chevron-up");
			} else {
				panel.find(".glyphicon-chevron-down").addClass(".glyphicon-chevron-up").removeClass(".glyphicon-chevron-down");

				$all.slideDown();
			}
		})


		$(obj).prepend(panel);

	} else {
		$(".tai-component").each(function() {
			$(this).find(".tai-panel").parent().remove();

			createPanels(this);

		})
	}

	var $componentblockForm = null;
	$("#components-holder").sortable({
		handle: ".tai-panel-drag",
		containment: "#components-holder",
		start: function(event, ui) {
			$(".block_form").hide();
			if (ui.item.next().hasClass('blockForm')) {
				$componentblockForm = ui.item.next();
			}
		},
		stop: function(event, ui) {
			var json = [];
			$(".tai-component").each(function(index) {
				json[index] = {
					order: index,
					id: $(this).data('componentid')
				}
			})
			if ($componentblockForm) {
				ui.item.after($componentblockForm);

			}
			$componentblockForm = null;
			json = JSON.stringify(json);
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/order",
				type: "put",
				data: {
					json: json
				}

			})

		}
	});

}

function convertToColorPicker() {
	$(".tai-color").each(function() {
		$this = $(this);
		if ($this.html() == "") {
			$this.html("Edit Color");
		}
		$(this).ColorPicker({
			onChange: function(hsb, hex, rgb) {
				$this.html(hex);
				var selctor = $this.data("elemref");
				if (selctor) {
					$(selctor).css("background-color", "#" + hex);
				}

			}
		});
	});
}

function convertToEditor() {
	$(".tai-editor").each(function() {
		if ($(this).parents(".tai-model").length == 0 && !$(this).next().hasClass("note-editor") && !$(this).hasClass("note-air-editor")) {
			//   console.log($(this).data('elemid')+ "   ");
			var options = $(this).data("airmode") ? {
				airMode: true
			} : {};
			if ($(this).data("airmode") && $.trim($(this).html()) == "") {
				$(this).html("Edit text")
				$(this).focus(function() {
					if ($(this).html() == "Edit text")
						$(this).html("")
				});
				$(this).blur(function() {
					if ($.trim($(this).html()) == "")
						$(this).html("Edit text")
				})
			}
			$(this).summernote(options);

		}
	});
}


function convertToEmbed() {
	$("#embedBtnHolder").unbind("click");
	$("#embedBtnHolder").click(function() {
		$("#tai-embed-modal").modal("show");
	});
	$(".tai-embed").each(function() {
		if ($(this).parents(".tai-model").length == 0) {
			if ($.trim($(this).html()) == "") {
				$(this).html("Edit Embed")
			}
			$(this).mouseenter(function() {
				var offset = $(this).offset();
				var $embedBtnHolder = $("#embedBtnHolder")
				$embedBtnHolder.css("top", offset.top);
				$embedBtnHolder.css("left", offset.left);
				$("#tai-embed-area").val($(this).html());
				$("#tai-embed-form").data("obj", this);
				$embedBtnHolder.show();

			});


		}
	});
}


function convertToInput() {
	$(".tai-input").each(function() {
		if ($(this).parents(".tai-model").length == 0) {
			$(this).click(function() {
				$this = $(this);
				window.setTimeout(function() {
					$this.find("input").attr("list", $this.attr("list"));

				}, 300);
			})
			$(this).editable(function(value, settings) {
				return (value);
			}, {
				type: 'text',
				onblur: 'submit',
				placeholder: "Edit text"

			});


		}

	});

	$(".tai-area").each(function() {
		if ($(this).parents(".tai-model").length == 0) {
			$(this).editable(function(value, settings) {
				return (value);
			}, {
				type: 'textarea',
				onblur: 'submit',
				placeholder: "Edit text",
				rows: "3",
				cols: "50"

			});
		}
	});
}

function convertToLink() {
	$(".tai-link").each(function() {
		if ($(this).parents(".tai-model").length == 0) {
			if (!$.trim($(this).html())) {
				$(this).html("Edit Link");
			}
			$(this).unbind("click");
			$(this).click(function(e) {
				e.preventDefault();
				if ($(this).data("nolink") == true) {
					$("tai-link-modal-link").hide();
				}
				$('#tai-link-modal').modal('show');
				$('#tai-link-modal').data("obj", this);
				if ($(this).data("nohtml")) {
					$("#tai-link-form input[name='html']").hide();
				} else {
					$("#tai-link-form input[name='html']").show();
					$("#tai-link-form input[name='html']").val($(this).html());
				}
				$("#tai-link-form input[name='html']").val($(this).html());
				$("#tai-link-form input[name='attr']").val($(this).attr("href"));
			});

			$("#tai-link-form").unbind("submit");
			$("#tai-link-form")[0].reset();
			$("#tai-link-form").submit(function(e) {
				e.preventDefault();
				var obj = $(this).serializeObject();
				var elem = $('#tai-link-modal').data("obj");
				$(elem).data("attr", obj.attr);
				if (!$(elem).data("nohtml")) {
					$(elem).html(obj.html);
				}
				$("#tai-link-modal").modal("hide");

			})
		}


	})


}

function convertToResource() {
	$
	if ($(this).parents(".tai-model").length == 0) {
		$(this).unbind("click");
		$(".tai-resource").each(function() {
			$(this).click(function() {

				var $this = $(this);
				var xhr = $.ajax({
					url: base_url + "/" + CMS_NAME + "/media/show",
					type: "get",
					data: {
						modal: "yes"
					}
				})

				xhr.done(function(res) {
					var $modelBody = $('#resource-modal .modal-body');
					$modelBody.html("loding...");
					//$modelBody.html(res);
					$modelBody.html(res);
					$modelBody.data("obj", $this);
					$('#resource-modal').modal('show');
				});


			});
		});
	}
}

function convertToJoker() {
	$(".joker-select").unbind("change");
	$(".joker-select").change(function() {
		$(this).parents(".tai-component").find(".tai-panel-save").click();

	});

	$(".joker-btn").click(function() {
		$("#components-modal").modal("show");
		$("#components-modal").data("elemid", $(this).data("elemid"));
	});
}

function convertToBlock() {
	$(".tai-component").each(function() {

		if (!$(this).hasClass("accordion") && ($(this).find(".tai-block").length > 0 || $(this).hasClass("blocking")) && !$(this).next().hasClass("block_form")) {

			var $clone = $(".block_form:eq(0)").clone()
			$clone.find(".close-form").click(function() {
				$clone.hide();

			});
			$(this).after($clone);
			$clone.find(".panel-body").addClass("block-sort")
			$(this).find(".tai-block").each(function() {
				singleBlockEdit($(this), $clone);
			})
		}


	});

}


function singleBlockEdit(block, $clone) {

	var $body = $clone.find(".panel-body");
	var blockId = block.data("blockid");
	var html = $("<div class='row well block-drag' data-blockid='" + blockId + "' ></div>");


	//var html = $("<div></div>");

	block.find(".tai-resource").each(function() {
		var $col = $("<div class='col-md-4' style='height: 150px; margin-bottom:15px'></div>");
		var $imageClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$imageClone.css("height", "150px");
		$col.append($imageClone);
		html.append($col);
	});
	block.find(".tai-editor").each(function() {
		var $col = $("<div class='col-md-8' style='height: 150px; margin-bottom:15px'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$col.append($textClone);
		html.append($col);
	})
	block.find(".tai-input").each(function() {
		var $col = $("<div class='col-md-4' style='height: 150px; margin-bottom:15px'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$col.append($textClone);
		html.append($col);
	})
	block.find(".tai-area , .tai-embed").each(function() {
		var $col = $("<div class='col-md-12' style='min-height: 250px; margin-bottom:15px;'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		//$textClone.removeClass("embed-responsive")
		//$textClone.find("iframe").addClass('videoWrapper')
		//$textClone.find("iframe").attr("height", "150");
		$col.append($textClone);

		html.append($col);
	})
	block.find(".tai-checkbox").each(function() {
		var $col = $("<div class='col-md-4' style='height: 150px; margin-bottom:15px;'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$col.append($textClone);
		$col.append('Enable Video');
		html.append($col);
	})


	block.find(".tai-connect").each(function() {
		var $col = $("<div class='col-md-4' style='height: 150px; margin-bottom:15px;'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$col.append($textClone);
		html.append($col);
	})
	block.find(".tai-link").each(function() {
		var $col = $("<div class='col-md-4' style='height: 150px; margin-bottom:15px;'></div>");
		var $textClone = $(this).clone();
		if ($(this).data("modeltitle")) {
			$col.append("<h4>" + $(this).data("modeltitle") + ": </h4>");
		}
		$col.append($textClone);
		html.append($col);
	})
	//$row.append($(html));

	html.find(".tai-modal").removeClass("tai-model");
	$body.append(html);
	html.append("<div class='col-md-12' style='margin-top: 20px'>" +

		"<button class='btn btn-danger mr-5 delete-block'  data-blockid='" + blockId + "' >Delete</button>" +
		"<div type='button' aria-label='Left Align' style='text-transform: uppercase; margin-right: 5px;' class='btn btn-primary tai-block-drag'><span class='glyphicon glyphicon-move' aria-hidden='true'></span> Drag</div>" +

		"<div class='clearfix'></div>" +
		"</div>");
	makeItEditable();
	html.find(".delete-block").click(function() {

		var $this = $(this);
		var blockId = $(this).data("blockid");
		var xhr = $.ajax({
			url: base_url + "/" + CMS_NAME + "/components/block/" + blockId,
			type: "delete"
		});

		xhr.done(function() {

			block.remove();
			$this.parents(".row:first").remove();
			$this.parents(".content:first").prev(".top:first").click()


		});
	});
}


function componentsClass() {

	this.Tabs = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".nav-tabs").append(res);
				if (typeof func == "function") {
					func(res);
				}
				$(obj).find("tai-panel-save").click();

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add Tab");
			panel.find(".tai-panel-edit ").data("title", "Edit Tab");
		}
	}

	this.Embed = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".nav-tabs").append(res);
				if (typeof func == "function") {
					func(res);
				}


			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add Video Item");
			panel.find(".tai-panel-edit ").data("title", "Edit Video Item");
		}
	}

	this.EmbedSoundcloud = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".nav-tabs").append(res);
				if (typeof func == "function") {
					func(res);
				}


			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add Soundcloud Item");
			panel.find(".tai-panel-edit ").data("title", "Edit Soundcloud Item");
		}
	}



	this.SliderHome = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".swiper-container .swiper-wrapper").append(res);
				if (typeof func == "function") {
					func(res);
				}

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add Slider item");
			panel.find(".tai-panel-edit ").data("title", "Edit Slider items");
		}
	}
	this.Catalog = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".grid-sizer").next().append(res);
				if (typeof func == "function") {
					func(res);
				}

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add  item");
			panel.find(".tai-panel-edit ").data("title", "Edit  items");
		}
	}
	this.Map = function() {
		this.save = function(obj) {

			var address = $(obj).find(".tai-input").html();
			if ((address != 'undefined') && (address != '')) {
				var map = $(obj).find(".tai-input").parent().find(".map");
				if (map != 'undefined') {
					var g = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyBpXSXHr71G8GpLrZg9UA7yXrhDKJsPGLE&q=' + encodeURIComponent(address);
					map.attr('src', g);
				}
			}
		}
	}


	this.NewsTicker = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".swiper-wrapper").append(res);
				if (typeof func == "function") {
					func(res);
				}

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add .btn-text").html("Add news flash");
			panel.find(".tai-panel-edit .btn-text").html("Edit news flash");
		}
	}

	this.Gallery = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".gallery .row").append(res);
				if (typeof func == "function") {
					func(res);
				}

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add .btn-text").html("Add gallery item");
			panel.find(".tai-panel-edit .btn-text").html("Edit gallery items");
		}

	}


	this.Slider = function() {
		this.add = function(obj, func) {

			var id = $(obj).data("componentid");
			var name = $(obj).data("componentname");
			var lang = $(obj).data("lang");
			var xhr = $.ajax({
				url: base_url + "/" + CMS_NAME + "/components/addblock/" + lang + "/" + id + "/" + name,
				type: "post"

			});

			xhr.done(function(res) {
				$(obj).find(".swiper-container .swiper-wrapper").prepend(res);
				if (typeof func == "function") {
					func(res);
				}

			})
		};

		this.changeText = function(panel) {
			panel.find(".tai-panel-add ").data("title", "Add Slider item");
			panel.find(".tai-panel-edit ").data("title", "Edit Slider items");
		}
	}
}


createComponents();