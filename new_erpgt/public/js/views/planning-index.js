// Afficher la liste
$(document).ready(function(){
	PlanningList();
	Datepickerinit();
	Datetimepickerinit();
});

// Fonction pour afficher la liste
var PlanningList = function()
{
	$.ajax({
		type:'get',
		url: routePlanningAjax,
		success: function(data){
			$('#planningList').empty().html(data);
			Planning();
		}
	});
}

var DeletePlanning = function(id)
{
	swal({
	  title: PlanningDeleteText,
	  text: noReturnBackText,
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: cancelText,
	  confirmButtonText: yesDeleteText
	}).then(function () {
		$.ajax({
			url: routePlanning+"/"+id,
			headers: {'X-CSRF-TOKEN': token},
			type: 'DELETE',
			data: id,
			success:function(data){
				if (data.success == 'true') 
				{
					swal(
					    deletedText,
					    PlanningDeletedText,
					    'success'
					);
					PlanningList();
				}
			}
		});
	});
};

var EditPlanning = function(id)
{	
	ResetFields();

	$.get(routePlanning+"/"+id+"/edit", function(data){
		$('.modal-title').text(PlanningEditText);
		$('.btn-save').text(validmodif_btn);
		$('#planning_id').val(data.id);
		$('#Planning').val(data.name);
		$('#Planning').focus();
		$('#PlanningModal').modal('show');
	});
};


var Planning = function()
{
	$('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay,listMonth'
			},
		locale: LocaleLanguage,
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: plannings,
		eventRender: function(event, element) {
			var originalClass = element[0].className;
            element[0].className = originalClass + ' rightMenu';
            element[0].setAttribute("id", event.id);
			$(element).tooltip({title: event.description, placement: "bottom"});
	        /*$(element).on("contextmenu",function(){
		       return false;
		    });*/
        },
	    eventDrop: function(event, delta, revertFunc) {
	    	$.ajax({
				url: routePlanning+"/"+event.id,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				data : "Date="+event.start.format() +
					   "&drop=" + 1 + 
					   "&site_id=" + event.site_id + 
					   "&equipment_id=" + event.equipment_id + 
					   "&Name=" + event.name + 
					   "&Description=" + event.description ,
				success: function(data){
					if (data.success == 'true')
					{
	        			//alert(event.start.format());
					}
				},
				error:function(data)
				{
			        revertFunc();
				}
			});
	    }
    });
}

//Afficher un menu lors du clic droit
$(function(){
    $.contextMenu({
        selector: '.rightMenu', 
        build: function($trigger, e) {
        	//console.log($trigger[0].offsetTop, $trigger[0].offsetLeft);
            // this callback is executed every time the menu is to be shown
            // its results are destroyed every time the menu is hidden
            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
            //console.log($trigger[0]);
            if($trigger[0].href=="") {
            	return {
            		items: {
            			"edit": {
            				name: edit, icon: "edit", callback: function(key, options) {
							$.get(routePlanning+"/"+$trigger[0].id+"/edit", function(data){
								var date = data.date;
							   	if(LocaleLanguage == "en") {
									var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
								} else {
									var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
								}

								var remDate = data.reminder;
								if(remDate != null) {
									if(LocaleLanguage == "en") {
										var rem = remDate.substring(5,7)+"/"+remDate.substring(8,10)+"/"+remDate.substring(0,4);
											//+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
										if (remDate.substring(11,13) > 12) {
											var hours = remDate.substring(11,13)-12;
											rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " PM";
										} else if (remDate.substring(11,13) == 12) {
											rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " PM";
										}
										else if (remDate.substring(11,13) == 0) {
											var hours = 12;
											rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " AM";
										}
										else {
											rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " AM";
										}
									}
									else {
										var rem = remDate.substring(8,10)+"/"+remDate.substring(5,7)+"/"+remDate.substring(0,4)+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
									}
								}

								ResetFields();

								$('.modal-title').text(EventEditText);
								$('.btn-save').text(validmodif_btn);
								$('#planning_id').val(data.id);
								$('#site_id').val(data.site_id);
								$('#equipment_id').val(data.equipment_id);
								$('#Name').val(data.name);
								$('#Date').val(dateFinale);
								$('#Description').val(data.description);
								$('#Reminder').val(rem);
								$('#PlanningModal').modal('show');
							});
	                    }},
	                    "delete": {
	                    	name: del, icon: "delete", callback: function(key, options) {
	                    	swal({
								title: EventDeleteText,
								text: noReturnBackText,
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
							 	cancelButtonText: cancelText,
							 	confirmButtonText: yesDeleteText
							}).then(function () {
								$.ajax({
								    url: routePlanning+"/"+$trigger[0].id,
									headers: {'X-CSRF-TOKEN': token},
								    type: 'DELETE',
								    success: function(result) {
									  	swal(
										    deletedText,
										    EventDeletedText,
										    'success'
										);
			                    		$trigger.remove(); // Supprime l'élément
								    }
								});
							})
	                    }},
	                    "sep1": "---------",
	                    "quit": {
	                    	name: quit, icon: "quit", callback: function(key, options) {}
	                	}
	            	}
            	}
            }

            return {
                items: {
                	"show": {name: see, icon: "fa-eye", callback: function(key, options) {
	                		document.location.href = $trigger[0].href;
	                	}},
                    "edit": {name: edit, icon: "edit", callback: function(key, options) {
						$.get(routePlanning+"/"+$trigger[0].id+"/edit", function(data){
							var date = data.date;
						   	if(LocaleLanguage == "en") {
								var dateFinale = date.substring(5,7)+"/"+date.substring(8,10)+"/"+date.substring(0,4);
							} else if (LocaleLanguage == "fr") {
								var dateFinale = date.substring(8,10)+"/"+date.substring(5,7)+"/"+date.substring(0,4);
							}

							var remDate = data.reminder;
							if(remDate != null) {
								if(LocaleLanguage == "en") {
									var rem = remDate.substring(5,7)+"/"+remDate.substring(8,10)+"/"+remDate.substring(0,4);
										//+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
									if (remDate.substring(11,13) > 12) {
										var hours = remDate.substring(11,13)-12;
										rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " PM";
									} else if (remDate.substring(11,13) == 12) {
										rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " PM";
									}
									else if (remDate.substring(11,13) == 0) {
										var hours = 12;
										rem = rem + (hours > 9 ? " " : " 0") + hours + ":" + remDate.substring(14,16) + " AM";
									}
									else {
										rem = rem +" "+remDate.substring(11,13)+":"+remDate.substring(14,16) + " AM";
									}
								}
								else {
									var rem = remDate.substring(8,10)+"/"+remDate.substring(5,7)+"/"+remDate.substring(0,4)+" "+remDate.substring(11,13)+":"+remDate.substring(14,16);
								}
							}

							ResetFields();


							$('.modal-title').text(EventEditText);
							$('.btn-save').text(validmodif_btn);
							$('#planning_id').val(data.id);
							$('#site_id').val(data.site_id);
							$('#equipment_id').val(data.equipment_id);
							$('#Name').val(data.name);
							$('#Date').val(dateFinale);
							$('#Description').val(data.description);
							$('#Reminder').val(rem);
							$('#PlanningModal').modal('show');
						});
                    }},
                    "delete": {name: del, icon: "delete", callback: function(key, options) {
                    	swal({
							title: EventDeleteText,
							text: noReturnBackText,
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
						 	cancelButtonText: cancelText,
						 	confirmButtonText: yesDeleteText
						}).then(function () {
							$.ajax({
							    url: routePlanning+"/"+$trigger[0].id,
								headers: {'X-CSRF-TOKEN': token},
							    type: 'DELETE',
							    success: function(result) {
								  	swal(
									    deletedText,
									    EventDeletedText,
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


var NewPlanning = function(site_id)
{	
	ResetFields();
	
	$('#planningModalTitle').text(EventAddText);
	$('#savePlanning').text(validate_btn);
	$('#planning_id').val("");
	$('#equipment_id').val(0);
	$('#site_id').val(site_id);
	$('#Name').val("");
	$('#Date').val("");
	$('#Description').val("");
	$('#Reminder').val("");
	$('#Planning').val("");
	$('#Planning').focus();
	$('#PlanningModal').modal('show');
};

// Fonction pour faire un update ou une création
$("#savePlanning").click(function(e)
{
	var form = $('#frmPlanning')[0];
	var formData = new FormData(form);
	var id = $("#planning_id").val();
	var Saveroute = routePlanning;
	var state = $('#savePlanning').text();
	var type = 'POST'	

	e.preventDefault();
	$('input+small').text('');
    $('input').parent().removeClass('has-error');
	
	if (state!=validate_btn){
		Saveroute = routePlanning+"/"+id;
	}

	$.ajax({
		url: Saveroute,
		headers: {'X-CSRF-TOKEN': token},
		type: type,
		data : formData,
		contentType: false,
    	processData: false,
		success: function(data){
			if (data.success == 'true')
			{
				PlanningList();
				$("#PlanningModal").modal('toggle');
				$('#frmPlanning').trigger('reset');

				if (state==validmodif_btn){
					$("#message-update").fadeIn();
					$('#message-update').show().delay(3000).fadeOut(1);
				}else {
					$("#message-new").fadeIn();
					$('#message-new').show().delay(3000).fadeOut(1);
				}
			}
		},
		error:function(data)
		{
			// Permet d'afficher les messages d'erreur sous les champs
			$.each(data.responseJSON, function (key, value) {
                var input = '#frmPlanning input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');

                var textarea = '#frmPlanning textarea[name=' + key + ']';
                $(textarea + '+small').text(value);
                $(textarea).parent().addClass('has-error');

                var select = '#frmPlanning select[name=' + key + ']';
                $(select + '+small').text(value);
                $(select).parent().addClass('has-error');
            });
		}
	});
});

var Datepickerinit = function() {
	$('#Date').datetimepicker({
    	locale: LocaleLanguage,
    	format: "L"
    });
};

var Datetimepickerinit = function() {
	if(LocaleLanguage == "en") {
		var formatDate = "L hh:mm A";
	}
	else {
		var formatDate = "L HH:mm";
	}

	$('#Reminder').datetimepicker({
    	locale: LocaleLanguage,
    	format: formatDate
    });
};