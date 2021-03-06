<!-- Search box -->
<div class="form-search">
	<form id="site-search" action="#na">
		<input type="search" class="form-control" placeholder="Buscar...">
		<button type="submit" class="fa fa-search"></button>
	</form>
</div>
<!-- Site nav (vertical) -->
<nav class="site-nav clearfix" role="navigation" collapse-nav-accordion highlight-active>
	<div class="nav-title panel-heading"><i>Administração</i></div>
	<ul class="list-unstyled nav-list">
		<li>
			<a href="javascript:;">
				<i class="fa fa-university icon"></i>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="text">Meus Restaurantes</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/restaurantes/cadrest">Cadastrar Restaurante</a></li>
				<li><a href="#/restaurantes/editrest">Editar Restaurante</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
				<i class="fa fa-flask icon"></i>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="text">Meus Produtos</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/prods/addprod">Cadastrar Produtos</a></li>
				<li><a href="#/prods/editprod">Editar Produtos</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
				<i class="fa fa-users icon"></i>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="text">Meus Funcionários</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/funcs/addfunc">Adicionar Funcionário</a></li>
				<li><a href="#/funcs/editfunc">Editar Funcionário</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
				<i class="fa fa-money icon"></i>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="text">Financeiro</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/financeiro/estatisticas">Ver Estatísticas de Vendas</a></li>
				<li><a href="#/financeiro/folhapgto">Gerar Folha de Estatística</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
				<i class="fa fa-mobile icon"></i>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="text">Aplicativo</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/aplicativo/taxas">Taxas</a></li>
				<li><a href="#/aplicativo/ordenspgto">Ordens de pagamento</a></li>
			</ul>
		</li>		
	</ul>
	<div class="nav-title panel-heading"><i>Navegação</i></div>
	<ul class="list-unstyled nav-list">
		<li>
			<a href="javascript:;">
				<i class="fa fa-sort-amount-asc icon"></i>
				<span class="text">Pedidos</span>
				<i class="arrow fa fa-angle-right right"></i>
				<span class="badge badge-xs right badge-success">NOVO</span>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/pedidos/aberto"><span class="badge badge-xs badge-danger">3</span>&nbsp;Em Aberto</a></li>
				<li><a href="#/pedidos/andamento"><span class="badge badge-xs badge-danger">3</span>&nbsp;Em Andamento</a></li>
				<li><a href="#/pedidos/cancelado"><span class="badge badge-xs badge-danger">3</span>&nbsp;Cancelados</a></li>
				<li><a href="#/pedidos/rejeitado"><span class="badge badge-xs badge-danger">3</span>&nbsp;Rejeitados</a></li>
				<li><a href="#/pedidos/concluido"><span class="badge badge-xs badge-danger">3</span>&nbsp;Concluidos</a></li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
				<i class="fa fa-bullhorn icon"></i>
				<span class="text">Atendimento Online</span>
				<i class="arrow fa fa-angle-right right"></i>
			</a>
			<ul class="inner-drop list-unstyled">
				<li><a href="#/pedidos/abertos">Chat pelo site</a></li>
				<li><a href="#/pedidos/andamento">WhatsApp</a></li>
			</ul>
		</li>
	</ul>
</nav>