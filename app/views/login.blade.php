@extends('template.header')

@section('titulo')
<title> Foodis - Página de Login </title>
@stop

@section('conteudo')
<div class="page page-auth clearfix">

	<div class="auth-container">
		<!-- site logo -->
		<h1 class="site-logo h2 mb15"><a href="/"><span>Foodis</span>&nbsp;Painel Administrativo</a></h1>
		<h3 class="text-normal h4 text-center">Entre com seus dados</h3>

		<div class="form-container">
			<form class="form-horizontal" action="logar" METHOD="POST">
				<div class="form-group form-group-lg">
					<input class="form-control" type="text" placeholder="Usuário" id="user" name="user">
				</div>

				<div class="form-group form-group-lg">
					<input class="form-control" type="password" placeholder="Senha" id="pass" name="pass">
				</div>

				<div class="clearfix"><a href="#/pages/forget-pass" class="right small">Perdeu sua senha?</a></div>
				<div class="clearfix mb15">
					<button type="submit" class="btn btn-lg btn-w120 btn-primary text-uppercase">Entrar</button>
					<div class="ui-checkbox ui-checkbox-primary mt15 right">
						<label>
							<input type="checkbox">
							<span>Lembrar-se</span>
						</label>
					</div>
				</div>
			</form>
		</div>

	</div>
	<!-- #end auth-wrap -->
</div>
@stop