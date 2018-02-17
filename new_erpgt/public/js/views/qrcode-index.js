

var PrintQrcode = function()
{
	$.ajax({
		type:'get',
		url: routeQrcodeAjax,
		success: function(data){
			console.log("success");
		}
	});
}