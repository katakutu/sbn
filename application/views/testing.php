<!doctype html>
<html>
<head>
 
<title>Allow only digits using JavaScript or jQuery</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
function checkOnlyDigits(e) {
e = e ? e : window.event;
var charCode = e.which ? e.which : e.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
document.getElementById('errorMsg').style.display = 'block';
document.getElementById('errorMsg').style.color = 'red';
document.getElementById('errorMsg').innerHTML = 'OOPs! Only digits allowed.';
return false;
} else {
document.getElementById('errorMsg').style.display = 'none';
return true;
}
}
</script>
 
<script type="text/javascript">
$(document).ready(function() {
$("#number3").keyup(function(event) {
if ( event.keyCode == 46 || event.keyCode == 8 ) {
// let it happen, don't do anything
} else if (/\D/g.test(this.value)) {
// Filter non-digits from input value.
this.value = this.value.replace(/\D/g, '');
}
});
});
</script>
</head>
<body>
 
<div>
<h2>Allow only digits using JavaScript or jQuery</h2>
</div>
 
<div id="content">
 
<label>JavaScript Example</label><br/>
<input type="text" name="number1" id="number1" onkeypress="return checkOnlyDigits(event)"/>
<div id="errorMsg"></div>
 
<p>&nbsp;</p>
 
<label>Inline Example</label><br/>
<input type="text" name="number2" id="number2" onkeyup="if(/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
 
<p>&nbsp;</p>
 
<label>jQuery Example</label><br/>
<input type="text" name="number3" id="number3"/>
 
</div>
 <script type="text/javascript">
 	if(a){
		        			if(a != data.Sid)
			        		{
			        			alert('Data Tidak Ditemukan');
			        		}else{
			        			var new_row;
					        	for(var i=0;i<data.length;i++){
					        		var obj = data[i];
								    new_row += "<tr>" + 
								    		"<td>" + obj.KodePemesanan + "</td>" + 
								    		"<td>" + obj.KodeBilling + "</td>" + 
								    		"<td>" + obj.Nominal + "</td>" + 
								    		"<td>" + obj.Status + "</td>" + 
								    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodePemesanan+"\")'>Detail</a></td>" + 
								    		"</tr>";
						        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
					        	}

					        	$("table tbody").append(new_row);
			        		}
		        		}else if(b&&c){
		        			if(b != data.Sid && c != data.Seri){
			        			alert('Data Tidak Ditemukan');
			        		}else{
			        			var new_row;
					        	for(var i=0;i<data.length;i++){
					        		var obj = data[i];
								    new_row += "<tr>" + 
								    		"<td>" + obj.KodePemesanan + "</td>" + 
								    		"<td>" + obj.KodeBilling + "</td>" + 
								    		"<td>" + obj.Nominal + "</td>" + 
								    		"<td>" + obj.Status + "</td>" + 
								    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodePemesanan+"\")'>Detail</a></td>" + 
								    		"</tr>";
						        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
					        	}

					        	$("table tbody").append(new_row);
			        		}
		        		}else if(d){
		        			if(d != data.KodePemesanan){
			        			alert('Data Tidak Ditemukan');
			        		}else{
			        			var new_row;
					        	for(var i=0;i<data.length;i++){
					        		var obj = data[i];
								    new_row += "<tr>" + 
								    		"<td>" + obj.KodePemesanan + "</td>" + 
								    		"<td>" + obj.KodeBilling + "</td>" + 
								    		"<td>" + obj.Nominal + "</td>" + 
								    		"<td>" + obj.Status + "</td>" + 
								    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodePemesanan+"\")'>Detail</a></td>" + 
								    		"</tr>";
						        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
					        	}

					        	$("table tbody").append(new_row);
			        		}
		        		}else if(e){
		        			if(e != data.KodeBilling){
			        			alert('Data Tidak Ditemukan');
			        		}else{
			        			var new_row;
					        	for(var i=0;i<data.length;i++){
					        		var obj = data[i];
								    new_row += "<tr>" + 
								    		"<td>" + obj.KodePemesanan + "</td>" + 
								    		"<td>" + obj.KodeBilling + "</td>" + 
								    		"<td>" + obj.Nominal + "</td>" + 
								    		"<td>" + obj.Status + "</td>" + 
								    		"<td><a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(\""+obj.KodePemesanan+"\")'>Detail</a></td>" + 
								    		"</tr>";
						        	// $("table tbody").show(new_row); <a class='btn btn-sm btn-primary btn-sm' href='javascript:getTransaction(" + obj.Sid + ")>Detail</a></td>
					        	}

					        	$("table tbody").append(new_row);
			        		}
		        		}else{
		        			alert("Please Fill Required Field");
				            return false;
		        		}
 </script>
</body>
</html>