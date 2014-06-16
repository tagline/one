$(document).ready(function(){
 
	$(":input").inputmask();
	
	$("#btn_login").click(function () {
      if($('#login').val() != "" && $('#senha').val() != "")
        form_login.submit();
      else {
        $("#form_login_retorno").html('Se você já é cadastrado, preencha os campos de login corretamente.');
        return false;
      }
    });	
	
	
});

function validaEmail(val){
	var rep=val.replace(/^[^0-9a-zA-Z_\[\]\.\-@]+$/,"");
	return(val==""||(val==rep&&(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/.test(val))));
}

function dataValida(val) {
	var reDate = /^(0?[1-9]|[12]\d|3[01])\/(0?[1-9]|1[0-2])\/(19|20)?\d{2}$/;
	
	return reDate.test(val);
	//return false;
}

function efetuarBusca(url) {
	
	$.ajax({
		type: "POST",
		url: url + "veiculos/ajax/buscar",
		data: { busca_veiculo : $("#busca_veiculo").val() },
		context: document.body
	}).done(function(retorno) {
		$("#content").html(retorno);
	});	
}

function ajaxExcluirVeiculo(url, id) {
	
	$.ajax({
		type: "POST",
		url: url + "veiculos/ajax/excluir",
		data: { veiculo_id : id },
		context: document.body
	}).done(function(retorno) {
		window.location = retorno;
	});
	
}

function ajaxLogout(urlLocal) {
	
	$.ajax({
		type: "POST",
		url: urlLocal + "capa/ajax/logout",
		context: document.body
	}).done(function(retorno) {
		window.location = retorno;
	});		
	
}

function ajaxCadastrarCliente(url) {

	var validacao = '';
	
	// validação dos campos
    if ($('#nome').val().length < 2) {
    	validacao += '>> NOME\n'
    }    
    if ($('#telefone').val().length < 8) {
    	validacao += '>> TELEFONE\n';
    }   
    if ( (validaEmail($('#email').val())) == false || $('#email').val().length < 1) {
    	validacao += '>> E-MAIL\n';
    } 
    if ($('#cpf').val().length < 2) {
    	validacao += '>> CPF\n';
    }
    if ($('#cnh').val().length < 2) {
    	validacao += '>> CNH\n';
    }
    if ( (dataValida($('#data_validade_cnh').val())) == false || $('#data_validade_cnh').val().length < 1) {
    	validacao += '>> DATA DE VALIDADE DA CNH';
    }
    
    if(validacao != '') {
    	alert('Preencha corretamente o(s) campo(s) abaixo: \n' + validacao);
    	return 0;
    }	
    
	$.ajax({
		type: "POST",
		url: url + "cadastro/ajax/cadastrarCliente",
		data: { nome : $("#nome").val(), telefone : $("#telefone").val(), email : $("#email").val(), cpf : $("#cpf").val(), cnh : $("#cnh").val(), data_validade_cnh : $("#data_validade_cnh").val(), senha : $("#senha").val() },
		context: document.body
	}).done(function(retorno) {	
		if(retorno==1)
			alert("Seu cadastro foi atualizado com sucesso!");
		else {
			alert("Seu cadastro foi concluído com sucesso! BEM VINDO!");
			window.location = retorno;
		}
	});
	
}

function ajaxCadastrarVeiculo(url) {

	var validacao = '';
		
	// validação dos campos
    if ($('#loja_id').val().length < 1) {
    	validacao += '>> LOJA\n'
    }    
    if ($('#modelo').val().length < 2) {
    	validacao += '>> MODELO\n';
    }   
    if ($('#serie').val().length < 2) {
    	validacao += '>> SERIE\n';
    }
    if ($('#ano').val().length < 3) {
    	validacao += '>> ANO\n';
    }
    if ($('#potencia').val().length < 3) {
    	validacao += '>> POTÊNCIA\n';
    }
    if ($('#placa').val().length < 3) {
    	validacao += '>> PLACA\n';
    }
    if ($('#valor_diaria').val().length < 5) {
    	validacao += '>> VALOR DIÁRIA\n';
    }
    if ($('#caracteristicas').val().length < 5) {
    	validacao += '>> CARACTERÍSTICAS\n';
    }
    
    if(validacao != '') {
    	alert('Preencha corretamente o(s) campo(s) abaixo: \n' + validacao);
    	return 0;
    }	
	    
	$.ajax({
		type: "POST",
		url: url + "veiculos/ajax/cadastrar",
		data: { loja_id : $("#loja_id").val(), modelo : $("#modelo").val(), serie : $("#serie").val(), ano : $("#ano").val(), potencia : $("#potencia").val(), placa : $("#placa").val(), caracteristicas : $("#caracteristicas").val(), valor_diaria : $("#valor_diaria").val() , veiculo_id : $("#veiculo_id").val() },
		context: document.body
	}).done(function(retorno) {
		
		if($("#veiculo_id").val() > 0)
			alert("Registro atualizado com sucesso!");
		else
			alert("Veículo inserido com sucesso!");
		
		window.location = retorno;
	});
	
}