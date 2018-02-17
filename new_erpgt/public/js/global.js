var ResetFields = function() {
	$('input+small').text('');
	$('select+small').text('');
	$('textarea+small').text('');
    $('input').parent().removeClass('has-error');
    $('select').parent().removeClass('has-error');
    $('textarea').parent().removeClass('has-error');
};

var IncompleteProfile = function()
{
	swal({
	  title: "Erreur !",
	  text: "Vous devez terminer votre inscription en changeant votre mot de passe pour accéder aux fonctionnalités du site !",
	  type: 'error'
	}).then(function () {
	});
};