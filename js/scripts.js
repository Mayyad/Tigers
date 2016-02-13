

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




$('.prouctImage').click(function() {
	var product =	$(this).attr("name");
	var price =	$(this).attr("name");	
	$("#appendProducts").append('<div id="'+product+'Append" class="row text-center marginBottom "><div class="col-xs-3 paddingTop">'+product+'</div><div class="col-xs-4 "><div class="input-group spinner"><input type="number"  class="amountText form-control" value="1"></div></div><div class="col-xs-3 paddingTop">14 EGP</div><div class="col-xs-2 paddingTop "><button type="button" name="'+product+'" class="deleteBtn btn-link">  X  </button></div></div>');
	
	
});

$("body").on("click", ".deleteBtn", function (e) {
	var product = $(this).attr("name");
	//alert(product);
	//$(this).parent("div").remove();
	$("#"+product+"Append").remove();
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