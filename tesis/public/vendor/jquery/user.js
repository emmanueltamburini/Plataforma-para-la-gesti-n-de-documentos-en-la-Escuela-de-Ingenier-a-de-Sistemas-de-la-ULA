$("#ID").change(function(event){
	$.get("data_user/"+$("#nationality").val()+event.target.value+"",function(response,state){
		if (Object.keys(response).length != 0) {
			$("#nationality").css("border-color", "green");
			$("#ID").css("border-color", "green");
			$("#name").val(response.name);
			$("#area").val(response.area);
		}
		else {
			$("#nationality").css("border-color", "inherit");
			$("#ID").css("border-color", "inherit");
			$("#name").val("");
			$("#area").val(1);
		}

	})
});

$("#nationality").change(function(event){
	$.get("data_user/"+event.target.value+$("#ID").val()+"",function(response,state){
		if (Object.keys(response).length != 0) {
			$("#nationality").css("border-color", "green");
			$("#ID").css("border-color", "green");
			$("#name").val(response.name);
			$("#area").val(response.area);
		}
		else {
			$("#nationality").css("border-color", "inherit");
			$("#ID").css("border-color", "inherit");
			$("#name").val("");
			$("#area").val(1);
		}
	})
});

//console.log(response);