<section>
	<ol class="breadcrumb">
		<li><a href="{localPath}">home</a></li>
		<li class="active">Atualizar Cadastro</li>
	</ol>
	<div class="section-header">
		<h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> ATUALIZE SEU CADASTRO</h3>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-head">
						<header><h4 class="text-light"></h4></header>
					</div>
					<div class="box-body">
					    <form class="form-horizontal" role="form" name="form_cadastro_cliente" method="POST" action="">
							<input type="hidden" value="{cliente_id}" name="cliente_id" id="cliente_id">
							<div class="form-group">
								<div class="col-lg-1 col-md-2 col-sm-3">
									<label for="nome" class="control-label">Nome</label>
								</div>
								<div class="col-lg-7 col-md-10 col-sm-9">
									<input type="text" name="nome" id="nome" value="{nome}" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-1 col-md-4 col-sm-6">
									<label for="email" class="control-label">E-mail</label>
								</div>
								<div class="col-lg-7 col-md-8 col-sm-6">
									<input type="text" name="email" id="email" value="{email}" class="form-control" >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<div class="col-lg-3 col-md-4 col-sm-6">
											<label for="cpf" class="control-label">CPF</label>
										</div>
										<div class="col-lg-6 col-md-4 col-sm-6">
											<input type="text" name="cpf" id="cpf" value="{cpf}" data-inputmask="'mask':'999.999.999-99'" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-3 col-md-2 col-sm-3">
											<label for="telefone" class="control-label">Telefone</label>
										</div>
										<div class="col-lg-5 col-md-10 col-sm-9">
											<input type="text" name="telefone" id="telefone" value="{telefone}" data-inputmask="'mask':'99-9999.9999'" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<div class="col-lg-3 col-md-4 col-sm-6">
											<label for="cnh" class="control-label">CNH</label>
										</div>
										<div class="col-lg-6 col-md-8 col-sm-6">
											<input type="text" name="cnh" id="cnh" value="{cnh}" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-3 col-md-4 col-sm-6">
											<label for="data_cnh" class="control-label">Data Validade CNH</label>
										</div>
										<div class="col-lg-5 col-md-8 col-sm-6">
											<input type="text" name="data_validade_cnh" id="data_validade_cnh" data-inputmask="'alias': 'date'" value="{data_validade_cnh}" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="cnh" class="control-label">Senha</label>
										</div>
										<div class="col-lg-4 col-md-8 col-sm-6">
											<input type="password" name="senha" id="senha" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="form-footer col-lg-offset-5 col-md-offset-2 col-sm-offset-3">
								<button type="submit" class="btn btn-default">Limpar Formulário</button>
								<input type="button" class="btn btn-primary" onClick="ajaxCadastrarCliente('{localPath}');" value="Cadastrar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
