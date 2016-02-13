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

$('#resetMyOrdersPageBtn').click(function()
{
	alert("aaaaaa");
	$.ajax(
	{
		type : 'POST',
		url : "ajax-files/viewMyOrdersReset.php" ,
		success : function( result )
		{
			$("#viewMyOrdersSearchView").html(result);	
		}
	});
});


/*
$('.collapse').collapse({
  toggle: true 
  //hidden.bs.collapse = true
});
*/
});
