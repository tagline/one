$(document).ready(function(){
 
	$("#btn_login").click(function () {
      if($('#login').val() != "" && $('#senha').val() != "")
        form_login.submit();
      else {
        $("#form_login_retorno").html('Se você já é cadastrado, preencha os campos de login corretamente.');
        return false;
      }
    });
	
	$("#btn_sair").click(function () {
		alert('teste');
		$.ajax({
			type: "POST",
			//url: url + "capa/logout",
			url: url + "capa/logout",
			data: '',
			success: function(retorno) {
	      	window.location = retorno;  
	    }
	  });
		
    });
	
});