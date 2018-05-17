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
                                        <form action="" method="get">
                                             <input type="submit" value="Deletar" name="{{ $user->id}}" class="btn btn-primary">
                                        </form>
                                      </div>
                                      <div class="col-md-3" style="margin-bottom:10px; margin-top:10px;">
                                        <form action="" method="get">
                                             <input type="submit" value="Editar" name="{{ $user->id}}" class="btn btn-primary">
                                        </form>
                                      </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                  <?php endif; ?>


                </div>
            </div>
        </div>
    </div>

</div>


@endsection
