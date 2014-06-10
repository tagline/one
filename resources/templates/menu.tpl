<div class="sidebar-back"></div>
<div class="sidebar-content">
	<div class="nav-brand">
		<a class="main-brand">
			<img src="{imagePath}logoone2.png" border='0'>
		</a>
	</div>
	<form class="sidebar-search" role="search">
		<a href="javascript:void(0);"><i class="fa fa-search fa-fw search-icon"></i><i class="fa fa-angle-left fa-fw close-icon"></i></a>
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control navbar-input" placeholder="Buscar veículo">
				<span class="input-group-btn">
					<button class="btn btn-equal" type="button"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>
	</form>
	<ul class="main-menu">
		<li>
		<a href="{localPath}veiculos/devolver" class="active">
			<i class="fa fa-check fa-fw"></i><span class="title">Devolução de Veículo</span>
		</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="active">
				<i class="fa fa-list fa-fw"></i><span class="title">Gerenciar Veículos</span> <span class="expand-sign">+</span>
			</a>
			<ul>
				<li><a href="{localPath}veiculos/listar">Listar</a></li>
				<li><a href="{localPath}veiculos/cadastrar">Cadastrar</a></li>			
			</ul>
		<li>
			<a href="javascript:void(0);" class="active">
				<i class="fa fa-users fa-fw"></i><span class="title">Gerenciar Usuários</span>
			</a>
		</li>
		<li>
		<a href="{localPath}" class="active">
			<i class="fa fa-paperclip fa-fw"></i><span class="title">Relatórios</span></span>
		</a>
		</li>
	</ul>
</div>
