
$(document).ready(function(){
    
     
     
    $("#linkModalBanner").fancybox({
  		'showCloseButton': false,
  		'padding' : 0,      
  		'hideOnOverlayClick': true,
  		'hideOnContentClick': false,
  		'enableEscapeButton': true
  	});
  	
});

function carregaUnidade(url,id){
  
  $.ajax({
		type: "POST",
 		url: url+'capa/ajax/carregaUnidade',
 		data: 'unidade_id='+id,
 		success: function(retorno){
 		
 			if ($.trim(retorno) != '') {
 			  //alert(retorno);
	 			$('#mostra_unidade').html(retorno);
	 		}
	 			
 		}
	});
	
}

function enviaEmailPromocao(url){

    var validacao = '';
    $('.fancybox-inner #bt_enviar_email').attr('disabled', true);
    
    // mostra div do retorno
    $('.fancybox-inner #retorno_email_promocao').show();  
                
    // validação dos campos
    if ($(".fancybox-inner #cad_nome").val().length < 4) {
    	validacao += '&raquo;&nbsp;Preencha corretamente o campo NOME.<br/>';
    }
    
    if ( (validaEmail($(".fancybox-inner #cad_email").val())) == false || $(".fancybox-inner #cad_email").val().length < 4) {
    	validacao += '&raquo;&nbsp;Preencha corretamente o campo E-MAIL.<br/>';
    } 
    
    if(validacao != '') {
    	$(".fancybox-inner #retorno_email_promocao").html("<div class='f_red'>"+validacao+"</div>");
    	window.scrollTo(0,0);
    	return false;
    }
    
    $(".fancybox-inner #form_email_promocional").submit();

}

