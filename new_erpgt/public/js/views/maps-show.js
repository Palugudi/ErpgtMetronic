// Action pour le menu à gauche qui affiche la liste des équipements
$('#toolbar .hamburger').on('click', function() {
	$(this).parent().toggleClass('open');
});

// Fonction pour faire un update ou une création
$("#saveEquipment").click(function(e)
{
	var id = $("#equipment_id").val();
	var SaverouteEquipment = routeEquipment;
	var token = $("#token").val();
	var form = $('#frmEquipment');
	var formData = form.serialize();
	var state = $('#saveEquipment').text();
	var type = 'POST'

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		type = 'PUT';
		SaverouteEquipment = routeEquipment+"/"+id;
	}

	$.ajax({
		url: SaverouteEquipment,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		success: function(data){
			if (data.success == 'true')
			{ 
				$('.activeElement').attr("id",data.id);
				$("#EquipmentModal").modal('toggle');
				$('#frmEquipment').trigger('reset');
			}
		},
		error:function(data)
		{
			// Permet d'afficher les messages d'erreur sous les champs
			$.each(data.responseJSON, function (key, value) {
                var input = '#frmEquipment input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmEquipment textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmEquipment select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
})

var getCanvas;

$(document).ready(function () {

	//$('#Brand').selectpicker({liveSearch:true});

    var x = null;
    //Make element draggable
    $(".drag").draggable({
        helper: 'clone',
        cursor: 'move',
        tolerance: 'fit'
    });

    //Afficher un menu lors du clic droit
	$(function(){
	    $.contextMenu({
	        selector: '.rightMenu', 
	        build: function($trigger, e) {
	        	//console.log($trigger[0].offsetTop, $trigger[0].offsetLeft);
	            // this callback is executed every time the menu is to be shown
	            // its results are destroyed every time the menu is hidden
	            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
	            return {
	                items: {
	                	"show": {name: see, icon: "fa-eye", callback: function(key, options) {
	                		document.location.href = routeEquipment+'/'+$trigger[0].id;
	                	}},
	                    "edit": {name: edit, icon: "edit", callback: function(key, options) {
							$.get(routeEquipment+"/"+$trigger[0].id+"/edit", function(data){
								// Lister les types d'équipement suivant le domaine sélectionné
						        $.get(routeDomain+"/"+data.domain_id+"/equipment_types", function(response, state){
									$('#Equipment_type').empty();
									for(j=0; j<response.length; j++){
										$('#Equipment_type').append("<option value='"+response[j].id+"'> "+response[j].name+"</option>");
									};

									ResetFields();
									
									$('.modal-title').text(EquipmentEditText);
									$('.btn-save').text(validmodif_btn);
									$('#equipment_id').val(data.id);
									$('#equipment_map_id').val(MapID);
									$('#domain_id').val(data.domain_id);
									$('#position_left').val(data.position_left);
									$('#position_top').val(data.position_top);
									$('#Equipment_type').val(data.equipment_type_id);
									$('#Brand').val(data.brand_id);
									$('#Status').val(data.status_id);
									$('#Localisation').val(data.localisation_id);
									$('#Model').val(data.model);
									$('#Quantity').val(data.quantity);
									$('#Serial_number').val(data.serial_number);
									$('#Manufacture_date').val(data.manufacture_date);
									$('#JLL_reference').val(data.JLL_reference);
									$('#Informations').val(data.informations);
		                    		$('#EquipmentModal').modal({backdrop: 'static', keyboard: false});
								});
							});
	                    }},
	                    "delete": {name: del, icon: "delete", callback: function(key, options) {
	                    	swal({
								title: EquipmentDeleteText,
								text: noReturnBackText,
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
							 	cancelButtonText: cancelText,
							 	confirmButtonText: yesDeleteText
							}).then(function () {
								$.ajax({
								    url: routeEquipment+"/"+$trigger[0].id,
									headers: {'X-CSRF-TOKEN': token},
								    type: 'DELETE',
								    success: function(result) {
									  	swal(
										    deletedText,
										    EquipmentDeletedText,
										    'success'
										);
			                    		$trigger.remove(); // Supprime l'élément
								    }
								});
							})
	                    }},
	                    "sep1": "---------",
	                    "quit": {name: quit, icon: "quit", callback: function(key, options) {}}
	                }
	            };
	        }
	    });
	});

	$("#dropzone").droppable({
		create: function( event, ui ) {
			// Lister les équipements suivant le plan sélectionné
	        $.get(routeMap+"/"+MapID+"/listequipments", function(response, state){
				$('#dropzone').empty();
				for(j=0; j<response.length; j++){
              		var htmlData="<div id='"+response[j].id+"' class='drag object rightMenu ui-draggable ui-draggable-handle' title='"+response[j].equipment_name+"' style= 'background-image: url(../images/equipments/"+response[j].picture+"); background-size: contain; position: absolute; left: "+response[j].position_left+"px; top: "+response[j].position_top+"px;'></div>"; 
					$('#dropzone').append(htmlData);
				};

				// Faire en sorte que chaque élément soit draggable
				$(".object").draggable({
		        	cursor: 'move',
		        	containment: '#dropzone',
		        	stop: function(e) {
		        		// Update de la bdd avec la nouvelle position
		        		var positionEquipment = {
				            position_top: e.target.offsetTop,
				            position_left: e.target.offsetLeft
				        }
	        			$.ajax({
							url: routeEquipment+"/"+e.target.id+"/updatePosition",
							headers: {'X-CSRF-TOKEN': token},
							type: 'PUT',
							data : positionEquipment,
							success: function(data){
								if (data.success == 'true')
								{
									PreviewReload();
	        						//console.log(e.target.id, e.target.offsetTop, e.target.offsetLeft);
								}
							},
							error:function(data)
							{
								console.log("Erreur lors de la mise à jour de la position");
							}
						});
				    }
				});
				PreviewReload();
				
			});
		},
		drop: function(event, ui) {
			var canvas = $(this);
			var id = ui.draggable[0].id
			if (!ui.draggable.hasClass('object')) {
				var canvasElement = ui.helper.clone();
		        canvasElement.addClass('object');
		        canvas.find("div").removeClass('activeElement');
		        canvasElement.addClass('activeElement');
		        canvasElement.addClass('rightMenu');
		        canvasElement.removeClass('draggable ui-draggable ui-draggable-handle ui-draggable-dragging');
		        canvas.append(canvasElement);

	        	var leftsup = $('#section-1').position().left;
		        var off = canvas.position();
		        var cElOff = {
					left: ui.position.left - leftsup -26,
					top: ui.position.top - off.top -7
	        	};

	        	//console.log(cElOff.top, cElOff.left);
			  	canvasElement.attr({id: ui.draggable[0].id});

		        canvasElement.css({
			        left: cElOff.left,
			        top: cElOff.top,
			        position: 'absolute',
			        zIndex: 10
		        });

		        // Lister les types d'équipement suivant le domaine sélectionné
		        $.get(routeDomain+"/"+id+"/equipment_types", function(response, state){
					$('#Equipment_type').empty();
					for(j=0; j<response.length; j++){
						$('#Equipment_type').append("<option value='"+response[j].id+"'> "+response[j].name+"</option>");
					};

					// Affichage de la popup pour indiquer les informations sur l'équipement
					$('#frmEquipment').trigger('reset');
					$('.btn-save').text(validate_btn);
					$('#equipment_map_id').val(MapID);
					$('#domain_id').val(ui.draggable[0].id);
					$('#position_left').val(cElOff.left);
					$('#position_top').val(cElOff.top);
					$('#EquipmentModal').modal({backdrop: 'static', keyboard: false});
				});

				PreviewReload();

		        canvasElement.draggable({
		        	cursor: 'move',
		        	containment: '#dropzone',
		        	stop: function() {
		        		// Update de la bdd avec la nouvelle position
		        		var positionEquipment = {
				            position_top: canvasElement[0].offsetTop,
				            position_left: canvasElement[0].offsetLeft
				        }
	        			$.ajax({
							url: routeEquipment+"/"+canvasElement[0].id+"/updatePosition",
							headers: {'X-CSRF-TOKEN': token},
							type: 'PUT',
							data : positionEquipment,
							success: function(data){
								if (data.success == 'true')
								{
									PreviewReload();
	        						//console.log(canvasElement[0].id, canvasElement[0].offsetTop, canvasElement[0].offsetLeft);
								}
							},
							error:function(data)
							{
								console.log("Erreur lors de la mise à jour de la position");
							}
						});
				    }
		        }).dblclick(function(){
		        	// Voir si on active ou non le double-clic
		        	//alert("Left : " + canvasElement[0].offsetLeft);
		        	//alert("Voulez-vous supprimer : " + canvasElement[0].id);
		    	});
		    }
	    }
  	});

	$("#HTML2Canvas").on('click', function () {
	    var imgageData = getCanvas.toDataURL("image/jpg");
	    // Now browser starts downloading it instead of just showing it
	    var newData = imgageData.replace(/^data:image\/jpg/, "data:application/octet-stream");
	    $("#HTML2Canvas").attr("download", "plan.jpg").attr("href", newData);
	});
});


//générer le preview
var PreviewReload = function()
{
	html2canvas($('#dropzone'), {
    	onrendered: function (canvas) {
            $("#previewImage").empty().append(canvas);
            $("#previewImage").hide();
            getCanvas = canvas;
        }
    });
}
				