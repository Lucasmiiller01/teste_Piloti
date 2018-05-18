@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Olá, {{ Auth::user()->name }}.
                <?php if (Auth::user()->name != 'admin'): ?>
                        <center> Você só possui acesso de usuário.
                        <br>
                        -- Bem-vindo usuário -- </center>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6" style="margin-bottom:10px; margin-top:10px;">
                         <li> Meu usuário - {{ Auth::user()->name}}</li>
                      </div>

                      <div class="col-md-6" style="margin-bottom:10px; margin-top:10px;">
                        {{ Form::open(['method' => 'GET', 'route' => ['editUser', Auth::user()->id]]) }}
                        {{ Form::submit('Editar', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                      </div>
                     </div>
                    </div>
                    <?php endif; ?>
                    <?php if (Auth::user()->name == 'admin'): ?>
                        <center> "Com grandes poderes, vêm grandes responsabilidades.” - Stan Lee
                        <br>
                        -- Lista de usuários menos o ADM -- </center>

                        <?php foreach ($users as $user): ?>
                            <?php if ($user->name != 'admin' ): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="col-md-6" style="margin-bottom:10px; margin-top:10px;">
                                        <li> {{ $user->name}}</li>

                                      </div>

                                      <div class="col-md-3" style="margin-bottom:10px; margin-top:10px;">
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['deleteUser', $user->id]]) }}
                                        {{ Form::submit('Deletar', ['class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                      </div>
                                      <div class="col-md-3" style="margin-bottom:10px; margin-top:10px;">
                                        {{ Form::open(['method' => 'GET', 'route' => ['editUser', $user->id]]) }}
                                        {{ Form::submit('Editar', ['class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                      </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php if ($deleted != "[]"): ?>
                    <center><h1 style="margin-top:50px;"> Lista de usuários deletados<h1></center>
                    <?php foreach ($deleted as $delete): ?>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6" style="margin-bottom:10px; margin-top:10px;">
                                    <li> {{ $delete->name}}</li>
                                  </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
