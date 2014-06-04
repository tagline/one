<!-- START BLOCK : login -->
<div class="box-type-login">
	<div class="box text-center">
		<div class="box-head">
			<h4 class="text-light text-inverse-alt">
				<img src="{imagePath}logoone_menor.png" >
				<p style="clear:both">Nossos carros estão aguardando por você! Venha testar o seu.</p>
			</h4>
		</div>		
		<div class="box-body box-centered style-inverse">
			<h2 class="text-light">Efetue seu Login</h2>
			<br/>
			<form action="{localPath}capa/logon" name="form_login" method="POST">
				<div id="form_login_retorno"></div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" name="login" id="login" class="form-control" placeholder="E-mail">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-left">
						<div data-toggle="buttons">
						</div>
					</div>
					<div class="col-xs-6 text-right">
						<button class="btn btn-primary" type="submit" id="btn_login">
							<i class="fa fa-key"></i>
							Acessar
						</button>
					</div>
				</div>
			</form>
		</div><!--end .box-body -->
		<div class="box-footer force-padding">
			<a class="text-grey" href="{localPath}capa/cadastro">Ainda não possui um cadastro? Clique aqui.</a>  
			
		</div>
	</div>
</div>
<!-- END BLOCK : login -->

<!-- START BLOCK : cadastro -->
<div class="box-type-login" >
	<div class="box text-center">
		<div class="box-head">
			<h4 class="text-light text-inverse-alt">
				<img src="{imagePath}logoone_menor.png" >
				<p style="clear:both">Nossos carros estão aguardando por você! Venha testar o seu.</p>
			</h4>
		</div>
		
		<div class="box-body-cadastro box-centered style-inverse">
			<h2 class="text-light">Cadastre-se</h2>
			<br/>
			<form class="form-validate" name="form_cadastro" method="POST">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" id="nome" name="nome" class="form-control" placeholder="Nome">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-phone"></i></span>
						<input type="text" id="telefone" nome="telefone" class="form-control" placeholder="Telefone">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input type="text" id="email" nome="email" class="form-control" placeholder="E-mail">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
						<input type="text" id="cpf" nome="cpf" class="form-control" placeholder="CPF">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
						<input type="text" id="cnh" nome="cnh" class="form-control" placeholder="CNH">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" id="cnh" nome="cnh" class="form-control" placeholder="Data de Validade CNH">
					</div>
				</div>				
				<div class="row">
					<div class="col-xs-6 text-left">
						<div data-toggle="buttons">
						</div>
					</div>
					<div class="col-xs-6 text-right">
						<button class="btn btn-primary" type="submit" id="btn_salvar">
							<i class="fa fa-save"></i>
							Cadastrar
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="box-footer force-padding-maior">
			<a class="text-grey" href="{localPath}capa">Efetuar Login</a> 			
		</div>
	</div>
</div>
<!-- END BLOCK : cadastro -->

<!-- START BLOCK : principal -->
teste
<!-- END BLOCK : principal -->