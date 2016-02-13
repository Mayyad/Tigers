$(function(){
$('#myModal').modal('toggle');
$('[data-toggle="tooltip"]').tooltip();






$('#viewMyOrdersBtn').click(function()
{
	var to=$('#dateto').val();
	var from=$('#datefrom').val();
	if(to != "" && from != "")
	{
		$.ajax(
		{
			type : 'POST',
			data : 'from=' + from +'&to='+to,
			url : "ajax-files/viewMyOrdersSearch.php" ,
			success : function( result )
			{
				$("#viewMyOrdersSearchView").html(result);	
			}
		});
			
	}
});




/*
$('.collapse').collapse({
  toggle: true 
  //hidden.bs.collapse = true
});
*/
});

var LastModified = 0;

function ordersRedirectDinamicaly(){
	$.ajax({
		url:"ajax-files/ordersRedirectPage.php",
		method:'get',
		data:{
			"lastModified":LastModified
		},
		success:function(response){
			
			LastModified = response.lastModified;
			setTimeout(ordersRedirectDinamicaly,3000);	
			$("#viewOrders").html(response);
		}

	});
}