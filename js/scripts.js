

$(function(){
var sumOrder = 0;	
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
	var product_id =	$(this).attr("name");
	
	var product =	$(this).parent("div").children("h4").text();
	var price =	$(this).attr("alt");
	
	sumOrder=parseInt(sumOrder) + parseInt(price);
	$("#orderSum").html("Your Total Order Price : "+sumOrder + " EGP");
	if(document.getElementById(product +"Append")){
		//chidren.next(div).child.inpu
		var myval = parseInt($("#"+product +"Append").children("div").next("div").children("div").children("input").attr("value"));
		myval= myval + 1;
		price = price * myval;
	
		$("#"+product +"Append").children("div").next("div").children("div").children("input").attr("value" , myval);
		$("#"+product +"Append").children("div").next("div").next("div").children("span").text(price);
		//console.log(price + myval);
		
	}
	else
	{
		$("#appendProducts").append('<div id="'+product+'Append" class="row text-center marginBottom "><div class="col-xs-3 paddingTop">'+product+'</div><div class="col-xs-4 "><div class="input-group spinner"><input disabled type="text" id="'+product_id+'" name="'+product_id+'" class="productValue form-control" value="1"><div class="input-group-btn-vertical"><button class="incrementBtn btn btn-default" type="button"><i class="fa fa-caret-up">+</i></button><button class="decrementBtn btn btn-default" type="button"><i class="fa fa-caret-down">-</i></button></div></div></div><div class="col-xs-3 paddingTop"><span>'+price+'</span><b> EGP</b></div><div class="col-xs-2 paddingTop "><button type="button" name="'+product+'" class="deleteBtn btn-link">  X  </button></div></div>');
	}
	
});







$("body").on("click", ".incrementBtn", function (e) {
	var price = $(this).parent("div").parent("div").parent("div").next("div").children("span").text();
	
var myval = parseInt($(this).parent("div").prev().val());
	price = price / myval;
	var myval = myval + 1;
	sumOrder=parseInt(sumOrder)+ price;
	price = price * myval;
	$(this).parent("div").prev().attr("value" , myval) ;
	price = $(this).parent("div").parent("div").parent("div").next("div").children("span").text(price);
	//console.log(price + myval);
	$("#orderSum").html("Your Total Order Price : "+sumOrder + " EGP");
});



$("body").on("click", ".decrementBtn", function (e) {
var price = $(this).parent("div").parent("div").parent("div").next("div").children("span").text();
	
var myval = parseInt($(this).parent("div").prev().val());
	price = price / myval;
	if(myval > 1)
	{
		var myval = myval - 1;
		sumOrder=parseInt(sumOrder)- price;
		price = price * myval;
		
	}
	
	$(this).parent("div").prev().attr("value" , myval) ;
	price = $(this).parent("div").parent("div").parent("div").next("div").children("span").text(price);
	//console.log(price + myval);
	$("#orderSum").html("Your Total Order Price : "+sumOrder + " EGP");
});



$("body").on("click", ".deleteBtn", function (e) {
	var product = $(this).attr("name");
	var price = parseInt($(this).parent("div").prev("div").children("span").text());
	//var total= parseInt($("#orderSum").text());
	sumOrder = parseInt(sumOrder) - price;
	$("#orderSum").html("Your Total Order Price : "+sumOrder + " EGP");
	//$(this).parent("div").remove();
	$("#"+product+"Append").remove();
	
});




$('#confirmMyOrderBtn').click(function()
{
	//alert("aaaaaaaa");
	/*var to=$('#dateto').val();
	var from=$('#datefrom').val();
	if(to != "" && from != "")
	{*/
	//var ids=new Array();
	//var myorderString ='';
	//var myval=$("#appendProducts").children("div").children("div").next("div").children("div").children("input").attr("value")
	// $("#appendProducts").find("input").each(function(){ myorderString = myorderString + this.id });
	
	var roomNo=$("#roomNo").val();
	var orderNotice=$("#orderNotice").val();
	var userID=$("#userID").val();
	//console.log(userID);
	
	var idArray = [];
$('.productValue').each(function () {
    idArray.push(this.id);
});
var myString = '';
var isNullProduct=0;

for (var i = 0; i < idArray.length; i++) {
	
	var arrayVal=$("#"+idArray[i]).val();
	var myPostItem=idArray[i]+"="+arrayVal;
	if(i == 0)
	{
		myString = myPostItem;
		isNullProduct=1;
	}
	else
	{
    	myString = myString +"&"+myPostItem;
	}
}



	$("#appendProducts").html('');
	$("#orderSum").html('');
	orderNotice=$("#orderNotice").text();
		$.ajax(
		{
			type : 'POST',
			data :  myString+'&roomNo='+roomNo + '&userID='+userID+'&orderNotice='+orderNotice +'&isNullProduct='+isNullProduct ,
			url : "ajax-files/confirmMyOrder.php" ,
			success : function( result )
			{
				$("#viewConfirmOrderResult").html(result);
				viewMyRecentOrders();	
				
			},
			complete : function()
			{
				//location.href='index.php';		
			}
		});
		
			
	//}
});


function viewMyRecentOrders()
{
	$.ajax(
		{
			type : 'POST',
			url : "ajax-files/viewMyLastOrder.php" ,
			success : function( result )
			{
				$("#viewMyLastOrder").html(result);				
			}
			
		});	
}




$('#confirmOrderBtn').click(function()
{
	
	var roomNo=$("#roomNo").val();
	var orderNotice=$("#orderNotice").val();
	var userID=$("#userID").val();
	
	var idArray = [];
	$('.productValue').each(function () {
		idArray.push(this.id);
	});
	var myString = '';
	var isNullProduct=0;
	
	for (var i = 0; i < idArray.length; i++) {
		var arrayVal=$("#"+idArray[i]).val();
		var myPostItem=idArray[i]+"="+arrayVal;
		if(i == 0)
		{
			myString = myPostItem;
			isNullProduct=1;
		}
		else
		{
			myString = myString +"&"+myPostItem;
		}
	}


	$("#appendProducts").html('');
	$("#orderSum").html('');
	orderNotice=$("#orderNotice").text();
		$.ajax(
		{
			type : 'POST',
			data :  myString+'&roomNo='+roomNo + '&userID='+userID+'&orderNotice='+orderNotice +'&isNullProduct='+isNullProduct ,
			url : "ajax-files/confirmOrder.php" ,
			success : function( result )
			{
				$("#viewConfirmOrderResult").html(result);	
			}
		});
		



 
    
    

});


 $('#checkava').click(function(){
       
       
       if ($('#checkava').text('UnAvailable') )
       {
           $('#checkava').text('Available');
           $('#checkava').attr('class','btn btn-success');
       }
       
       if ($('#checkava').text('Available') )
       {
           $('#checkava').text('UnAvailable');
           $('#checkava').attr('class','btn btn-danger');
       }
       
       
       console.log('ok'); 
        
        
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



