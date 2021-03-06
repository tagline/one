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
				<input type="text" name="busca_veiculo" id="busca_veiculo" class="form-control navbar-input" placeholder="Buscar ve�culo">
				<span class="input-group-btn">
					<a href="javascript:;" onClick="efetuarBusca('{localPath}');"><button id="btn_buscar" class="btn btn-equal" type="button"><i class="fa fa-search"></i></button></a>
				</span>
			</div>
		</div>
	</form>
	
	<!-- START BLOCK : menu_administrador_geral -->
	<ul class="main-menu">
		<li>
		<a href="{localPath}veiculos/devolver" class="active">
			<i class="fa fa-check fa-fw"></i><span class="title">Devolu��o de Ve�culo</span>
		</a>
		</li>
		<li>
			<a href="javascript:void(0);" class="active">
				<i class="fa fa-list fa-fw"></i><span class="title">Gerenciar Ve�culos</span> <span class="expand-sign">+</span>
			</a>
			<ul>
				<li><a href="{localPath}veiculos/listar">Listar</a></li>
				<li><a href="{localPath}veiculos/cadastrar">Cadastrar</a></li>			
			</ul>
		<!--
		<li>
			<a href="javascript:void(0);" class="active">
				<i class="fa fa-users fa-fw"></i><span class="title">Gerenciar Usu�rios</span>
			</a>
		</li>
		-->
		<li>
		<a href="{localPath}" class="active">
			<i class="fa fa-paperclip fa-fw"></i><span class="title">Relat�rios</span></span>
		</a>
		</li>
	</ul>
	<!-- END BLOCK : menu_administrador_geral -->
	
	<!-- START BLOCK : menu_administrador -->
	<ul class="main-menu">
		<li>
		<a href="{localPath}" class="active">
			<i class="fa fa-paperclip fa-fw"></i><span class="title">Relat�rios</span></span>
		</a>
		</li>
	</ul>
	<!-- END BLOCK : menu_administrador -->
	
	<!-- START BLOCK : menu_secretaria -->
	<ul class="main-menu">
		<li>
			<a href="javascript:void(0);" class="active">
				<i class="fa fa-list fa-fw"></i><span class="title">Gerenciar Ve�culos</span> <span class="expand-sign">+</span>
			</a>
			<ul>
				<li><a href="{localPath}veiculos/listar">Listar</a></li>
				<li><a href="{localPath}veiculos/cadastrar">Cadastrar</a></li>			
			</ul>
		<li>
		<a href="{localPath}" class="active">
			<i class="fa fa-paperclip fa-fw"></i><span class="title">Relat�rios</span></span>
		</a>
		</li>
	</ul>
	<!-- END BLOCK : menu_secretaria -->
	
	<!-- START BLOCK : menu_cliente -->
	<ul class="main-menu">
		<li>
		<a href="{localPath}veiculos/devolver" class="active">
			<i class="fa fa-check fa-fw"></i><span class="title">Devolu��o de Ve�culo</span>
		</a>
		</li>
		<li>
			<a href="{localPath}veiculos/listar" class="active">
				<i class="fa fa-list fa-fw"></i><span class="title">Visualizar Ve�culos</span> <span class="expand-sign">+</span>
			</a>
		</li>	
	</ul>
	<!-- END BLOCK : menu_cliente -->
	
	
</div>
