<div class="footer-top">
    <div class="box">
    	
        <div class="col1">
            <h5>Receba Novidades</h5>
            <div id="retornoNews" class="retorno" style="display:none; width:400px;"></div>
            <form id="form_newsletter" name="form_newsletter" method="POST" action="">
            	<input type="text" name="news_nome" id="news_nome" value="Nome" class="input" onfocus="if(this.value == 'Nome') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Nome'; }" />
                <input type="text" name="news_email" id="news_email" value="E-mail" class="input" onfocus="if(this.value == 'E-mail') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'E-mail'; }" />
                <input name="submit" type="button" onClick="enviaCadastroNewsletter('{localPath}');" id="btnCadastroNews" value="ok" class="button" />
            </form>
        </div>
        
        <div class="col2">
        	<h5>Acesso Rápido</h5>
            <ul>
            	<li><a href="{localPath}a_fruki/nossa_historia" title="A FRUKI">A FRUKI</a></li>
                <li><a href="{localPath}destaques/noticias" title="DESTAQUES">DESTAQUES</a></li>
                <li><a href="{localPath}fale_conosco/contato" title="FALE CONOSCO">FALE CONOSCO</a></li>
                <li><a href="{localPath}fale_conosco/trabalhe_conosco" title="TRABALHE CONOSCO">TRABALHE CONOSCO</a></li>
            </ul>
        </div>
        
        <div class="col3">
        	<h5>Marcas &amp; Produtos</h5>
            <div class="fruki-list">
            	   <ul>
                	  <li class="active"><a href="javascript:;" title="FRUKI" onClick="carregaProdutoRodape('{localPath}',1);">FRUKI</a></li>
                    <li><a href="javascript:;" title="FRUKITO" onClick="carregaProdutoRodape('{localPath}',2); $(this).addClass('active');">FRUKITO</a></li>
                    <li><a href="javascript:;" title="ÁGUA DA PEDRA" onClick="carregaProdutoRodape('{localPath}',3); $(this).addClass('active');">ÁGUA DA PEDRA</a></li>
                </ul>
                <div class="column" id="mostra_produto_rodape">
                	  <img src="{foto_rodape}" alt="{nome_rodape}" title="{nome_rodape}" class="left" />
                    <h6>{nome_rodape}</h6>
                    <p>{texto_rodape}</p>
                </div>
            </div>
        </div>
 
        <div class="col4">
        	<h5>Canais Interativos</h5>
            <div class="facebook-block">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FOficial-Bebidas-Fruki%2F189313907836732&amp;width=240&amp;height=62&amp;colorscheme=dark&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:133px; color:red;" allowTransparency="true"></iframe>
            <!--<img src="{imagePath}img_facebook_block.png" width="262" height="131" alt="facebook block" /> -->
            </div>
        </div>
      
    </div>
    <div class="clear"></div>
</div>


<div class="footer-bot">
	<div class="box">
        <div class="col1">
            <a href="index.html" title="FRUKI"><img src="{imagePath}footer_logo.png" width="50" height="45" alt="FRUKI" /></a>
            <p>&copy; Copyright 2014. Todos direitos reservados.<span>Produzido por Zipernet e Trunfo. </span></p>
        </div>
        
        <div class="col2">
        	<h5>Endereços</h5>
            <div class="row" id="slider_rodape">
            	  <a href="javascript:;" class="prev_rodape" title="Anterior"></a>
                <a href="javascript:;" class="next_rodape" title="Próximo"></a>
                <ul>
                  <!-- START BLOCK : lista_unidades_rodape -->
                  <li><p>{endereco}, {cidade}<span>{nome}</span></p></li>
                  <!-- END BLOCK : lista_unidades_rodape -->
            </div>
        </div>
        <div class="col3">
        	<h5>Atendimento Mercado Externo</h5>
        	  <!-- START BLOCK : agente_exportador -->
            <strong>{nome}</strong>
            <p>{endereco} - {cidade} Fone: {telefone} <a href="mailto:{email}" title="{email}">{email}</a> - <a href="http://{site}" target="_blank" title="{site}">{site}</a></p>
            <!-- END BLOCK : agente_exportador -->
        </div>
        
    </div>
    
    <div class="col4">
    	<div class="box">
        	<p>{texto_rodape}</p>
        </div>
    </div>
    
	<div class="clear"></div>
</div>