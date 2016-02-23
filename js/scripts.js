

$(function(){
var sumOrder = 0;	
$('#myModal').modal('toggle');
$('[data-toggle="tooltip"]').tooltip();





$('#viewMyOrdersBtn').click(function()
{
//lert("a");
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

$('#viewCheckBtn').click(function()
{
	var userID=$('#userID').val();
	var to=$('#dateto').val();
	var from=$('#datefrom').val();
	
		$.ajax(
		{
			type : 'POST',
			data : 'from=' + from +'&to='+to + "&userID="+userID,
			url : "ajax-files/viewCheeckSearch.php" ,
			success : function( result )
			{
				$("#viewCheeckSearchResult").html(result);	
			}
		});
			
	
});

$('#productSearch').keyup(function()
{
	var word=$('#productSearch').val();
	//alert(word);
		$.ajax(
		{
			type : 'POST',
			data : 'word=' + word ,
			url : "ajax-files/viewProductSearch.php" ,
			success : function( result )
			{
				$(".viewMyProducts").html(result);	
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
			}
		});
			
	
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


 /*$('#checkava').click(function(){
       
       
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
        
        
    }); */




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
			setTimeout(ordersRedirectDinamicaly,10000);	
			$("#viewOrders").html(response);
		}

	});
}


/*************************  ******************************
function myOrdersRedirectDinamicaly(){
	
	$.ajax({
		url:"ajax-files/myOrdersRedirectPage.php",
		method:'get',
		data:{
			"lastModified":LastModified ,
			"LastModifiedDelivered" : LastModifiedDelivered , 
			"LastModifiedProcessing" : LastModifiedProcessing
		},
		success:function(response){
			
			LastModified = response.lastModified;
			setTimeout(myOrdersRedirectDinamicaly,10000)	
			$("#viewMyOrdersSearchView").html(response);

		}

	});
}
***********************************************************/



function myOrdersRedirectDinamicaly(){
	
	$.ajax({
		url:"ajax-files/myOrdersRedirectPage.php",
		method:'get',
		data:{
			"lastModified":LastModified 
		},
		success:function(response){
			
			LastModified = response.lastModified;
			setTimeout(myOrdersRedirectDinamicaly,10000)	
			$("#viewMyOrdersSearchView").html(response);

		}

	});
}

// scripts of On/OFF Products 
/*
function changeProudctStatusUnAvail(PID)
{
      console.log("changeProudctStatusUNAvail");
      $.post("ajax-files/available.php",
        {
            product_id: PID,
            product_avail: "product_unavail"
        },
        function(data,status){
            if(status == "success"){
                console.log(status);
               
                $('#status'+PID).attr("onclick","changeProudctStatusAvail("+PID+")");
            }
                        console.log(data);
        });
}

*/
function changeProudctStatusAvail(PID)
{
    console.log("changeProudctStatusAvail");
    $.post("ajax-files/available.php",
        {
            product_id: PID,
            product_avail: "product_avail"
        },
        function(data, status){
            if(  status == "success"){
               
                //x$('#statusspan'+PID).html("Avialble");
                $('#status'+PID).attr("onclick","changeProudctStatusUnAvail("+PID+")");
            }
            console.log(data);
        });
}




//scripts for   ON/OFF Category


function changeCatStatusUnAvail(PID)
{
      console.log("changecatStatusUNAvail");
      $.post("ajax-files/availableCat.php",
        {
            product_id: PID,
            product_avail: "product_unavail"
        },
        function(data,status){
            if(status == "success"){
                console.log(status);
               
                $('#statuss'+PID).attr("onclick","changeCatStatusAvail("+PID+")");
                $('#statuss'+PID).attr("class","btn btn-danger");
                $('#statuss'+PID).html("UnAvailable");
                
                
            }
             console.log(data);
        });
}


function changeCatStatusAvail(PID)
{
    console.log("changecatStatusAvail");
    $.post("ajax-files/availableCat.php",
        {
            product_id: PID,
            product_avail: "product_avail"
        },
        function(data, status){
            if(  status == "success"){
               
                //x$('#statusspan'+PID).html("Avialble");
                $('#statuss'+PID).attr("onclick","changeCatStatusUnAvail("+PID+")");
                $('#statuss'+PID).attr("class","btn btn-success");
                $('#statuss'+PID).html("Available");                                           
            }
            console.log(data);
        });
}