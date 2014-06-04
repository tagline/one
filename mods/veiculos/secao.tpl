<!-- START BLOCK : listagem -->
<section>
	<ol class="breadcrumb">
		<li><a href="{localPath}">home</a></li>
		<li class="active">Lista de Veículos</li>
	</ol>
	<div class="section-header">
		<h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i>LISTA DE VEÍCULOS</h3>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					
					<div class="box-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Loja</th>
									<th>Ano</th>
									<th>Modelo</th>
									<th>Série</th>
									<th>Valor Diária</th>
									<th>Disponível</th>
									<th class="text-right1" style="width:90px">Ações</th>
							</tr>
						</thead>
						<tbody>
							<!-- START BLOCK : lista_veiculos -->
							<tr>
								<td>{loja}</td>
								<td>{ano}</td>
								<td>{modelo}</td>
								<td>{serie}</td>
								<td>{valor_diaria}</td>
								<td><span class="label {label_cor}">{disponibilidade}</span></td>
								<td class="text-right">
									<button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Visualizar"><i class="fa fa-file-text-o"></i></button>
									<button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></button>
									<button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Excluir"><i class="fa fa-trash-o"></i></button>
								</td>
							</tr>
							<!-- END BLOCK : lista_veiculos -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<!-- END BLOCK : listagem -->

<!-- START BLOCK : cadastro -->
<section>
	<ol class="breadcrumb">
		<li><a href="{localPath}">home</a></li>
		<li class="active">Cadastrar Veículo</li>
	</ol>
	<div class="section-header">
		<h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i> CADASTRO DE VEÍCULO</h3>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-head">
						<header><h4 class="text-light"></h4></header>
					</div>
					<div class="box-body">
						<!--
						<div class="well">
							<span class="label label-success"><i class="fa fa-comment"></i></span>
							<span>
								Resize your browser or load on different devices to test the responsive utility classes.
							</span>
						</div>
						-->
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<div class="col-lg-1 col-md-2 col-sm-3">
									<label for="loja_id" class="control-label">Loja</label>
								</div>
								<div class="col-lg-4 col-md-10 col-sm-9">
									<select name="loja_id" id="loja_id" class="form-control">
										<option>-- selecione --</option>
										<!-- START BLOCK : lista_lojas -->
										<option value="{loja_id}">{nome}</option>
										<!-- END BLOCK : lista_lojas -->
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-1 col-md-2 col-sm-3">
									<label for="email1" class="control-label">Modelo</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-9">
									<input type="text" name="modelo" id="modelo" class="form-control" >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="serie" class="control-label">Série</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="serie" id="serie" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="ano" class="control-label">Ano</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="ano" id="ano" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="potencia" class="control-label">Potência</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="potencia" id="potencia" class="form-control" >
											<p class="help-block">Ex.: 118CV</p>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="placa" class="control-label">Placa</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="placa" id="placa" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-3">
									<label for="textarea1" class="control-label">
										Características
										<small>Ex.: - Airbag;</small>
									</label>
								</div>
								<div class="col-lg-9 col-md-10 col-sm-9">
									<textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="5" ></textarea>
								</div>
							</div>
							<div class="form-footer col-lg-offset-8 col-md-offset-3 col-sm-offset-4">
								<button type="submit" class="btn btn-default">Limpar Formulário</button>
								<button type="submit" class="btn btn-primary">Salvar Veículo</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END BLOCK : cadastro -->
			