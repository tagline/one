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
										<a href="{localPath}veiculos/visualizar/id/{veiculo_id}"><button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Visualizar"><i class="fa fa-file-text-o"></i></button></a>
										<a href="{localPath}veiculos/editar/id/{veiculo_id}"><button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Editar" {display_editar}><i class="fa fa-pencil"></i></button></a>
										<button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Excluir" {display_excluir} onClick="if(confirm('Você tem certeza de que deseja excluir o veículo da base de dados?')) { ajaxExcluirVeiculo('{localPath}',{veiculo_id}); } else return false;"><i class="fa fa-trash-o"></i></button>
									</td>
								</tr>
								<!-- END BLOCK : lista_veiculos -->
							</tbody>
						
							<!-- START BLOCK : sem_registros -->
							<tbody>
								<tr>
									<td colspan=7 class="f_red">Nenhum registro cadastrado.</td>
								</tr>
							</tbody>
							<!-- END BLOCK : sem_registros -->

					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>
<!-- END BLOCK : listagem -->

<!-- START BLOCK : detalhes -->
<section>
	<ol class="breadcrumb">
		<li><a href="{localPath}">home</a></li>
		<li class="active">Detalhes do Veículo</li>
	</ol>
	<div class="section-header">
		<h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i>DETALHES</h3>
	</div>
	<div class="section-body">
		<div class="row">		
		
			<ul class="list-comments">
				<li>
					<div class="box style-body">
						<div class="comment-avatar"><i class="glyphicon glyphicon-info-sign text-gray"></i></div>
						<div class="box-body">
							<h4 class="comment-title">{modelo}<small>Loja: {loja}</small>
							<!-- START BLOCK : indisponivel -->
							<span style="margin-left:40px;" class="badge badge-danger">Indisponível</span></h4>  
							<!-- END BLOCK : indisponivel -->
							<!-- START BLOCK : disponivel -->
							<span style="margin-left:40px;" class="badge badge-success">Disponível</span></h4>  
							<!-- END BLOCK : disponivel -->
							<a class="btn btn-inverse stick-top-right" style="margin:0 80px 0 0;" href="{localPath}veiculos/listar">Voltar</a>
							<!-- START BLOCK : btn_locacao -->
							<a class="btn btn-inverse-blue stick-top-right" style="margin:40px 80px 0 0;" href="#">Efetuar Locação</a>
							<!-- END BLOCK : btn_locacao -->
							<p>
							<strong>Ano:</strong> {ano} <br>
							<strong>Série:</strong> {serie} <br>
							<strong>Potência:</strong> {potencia} <br>
							<strong>Placa:</strong> {placa} <br>
							<strong>Valor Diária:</strong> {valor_diaria} <br>							
							</p>
							<p><strong>Características:</strong><br/>{caracteristicas}</p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>
<!-- END BLOCK : detalhes -->
		
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
						<form class="form-horizontal" role="form" name="form_cadastro_veiculos" method="POST" action="">
							<input type="hidden" value="{veiculo_id}" name="veiculo_id" id="veiculo_id">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="serie" class="control-label">Loja</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<select name="loja_id" id="loja_id" class="form-control">
												<option>-- selecione --</option>
												<!-- START BLOCK : lista_lojas -->
												<option value="{loja_id}" {loja_selected}>{nome}</option>
												<!-- END BLOCK : lista_lojas -->
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="ano" class="control-label">Disponível</label>
										</div>
										<div class="col-lg-4 col-md-8 col-sm-6">
											<select name="disponivel" id="disponivel" class="form-control" {disabled}>
												<option value="1" {disponivel_selected_1}>Sim</option>
												<option value="0" {disponivel_selected_0}>Não</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="serie" class="control-label">Modelo</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="modelo" id="modelo" value="{modelo}" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="ano" class="control-label">Valor Diária(R$)</label>
										</div>
										<div class="col-lg-4 col-md-8 col-sm-6">
											<input type="text" name="valor_diaria" id="valor_diaria" value="{valor_diaria}" class="form-control" >
											<p class="help-block">Ex.: 128,00</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="serie" class="control-label">Série</label>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6">
											<input type="text" name="serie" id="serie" value="{serie}" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="ano" class="control-label">Ano</label>
										</div>
										<div class="col-lg-4 col-md-8 col-sm-6">
											<input type="text" name="ano" id="ano" data-inputmask="'mask': '9999'" value="{ano}" class="form-control" >
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
											<input type="text" name="potencia" id="potencia" value="{potencia}" class="form-control" >
											<p class="help-block">Ex.: 118CV</p>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label for="placa" class="control-label">Placa</label>
										</div>
										<div class="col-lg-4 col-md-8 col-sm-6">
											<input type="text" name="placa" id="placa" value="{placa}" data-inputmask="'mask': 'AAA9999'" class="form-control" >
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
								<div class="col-lg-7 col-md-10 col-sm-9">
									<textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="5" >{caracteristicas}</textarea>
								</div>
							</div>
							<div class="form-footer col-lg-offset-6 col-md-offset-3 col-sm-offset-4">
								<button type="submit" class="btn btn-default">Limpar Formulário</button>
								<input type="button" class="btn btn-primary" onClick="ajaxCadastrarVeiculo('{localPath}');" value="Salvar Veículo">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END BLOCK : cadastro -->

<!-- START BLOCK : devolucao -->
<section>
	<ol class="breadcrumb">
		<li><a href="{localPath}">home</a></li>
		<li class="active">Devolução de Veículos</li>
	</ol>
	<div class="section-header">
		<h3 class="text-standard"><i class="fa fa-fw fa-arrow-circle-right text-gray-light"></i>VEÍCULOS LOCADOS</h3>
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
									<th>Valor Total</th>
									<th class="text-right1" style="width:90px">Ações</th>
							</tr>
						</thead>
						<tbody>
							<!-- START BLOCK : lista_veiculos_devolucao -->
							<tr>
								<td>{loja}</td>
								<td>{ano}</td>
								<td>{modelo}</td>
								<td>{serie}</td>
								<td>{valor_diaria}</td>
								<td><span class="label {label_cor}">{valor_total}</span></td>
								<td class="text-right">
									<button type="button" class="btn btn-xs btn-default btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="Devolver"><i class="fa fa-file-text-o"></i></button>
								</td>
							</tr>
							<!-- END BLOCK : lista_veiculos_devolucao -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>
<!-- END BLOCK : devolucao -->
			