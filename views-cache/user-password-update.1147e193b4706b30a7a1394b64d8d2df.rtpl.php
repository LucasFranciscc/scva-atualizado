<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-6">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/usuario">Usuários</a></li>
                        <li class="breadcrumb-item active">Alterar Senha</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Alterar senha</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formUser" onSubmit="return validar(this);" role="form" action="/administrador/usuario/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/alterar-senha" method="post">
                            <div class="card-body">

                                <?php if( $userError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $userError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Nova Senha</label>
                                        <input type="password" class="form-control" id="password"
                                               name="password" value="<?php echo htmlspecialchars( $registerValuesUser["password"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confirm">Confirmar Senha</label>
                                        <input type="password" class="form-control" id="password_confirm"
                                               name="password_confirm">
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(document).ready(function () {
        $("#formUser").validate(({
            rules: {
                password: {
                    required: true
                },

                password_confirm: {
                    required: true
                },
            }
        }));
    });
</script>