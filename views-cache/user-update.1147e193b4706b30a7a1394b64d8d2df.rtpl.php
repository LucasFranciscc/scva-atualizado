<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-6">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/usuario">Usuários</a></li>
                        <li class="breadcrumb-item active">Editar</li>
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
                            <h3 class="card-title">Editar Usuário</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formUser" onSubmit="return validar(this);" role="form" action="/administrador/usuario/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
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

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="registration">Matrícula</label>
                                            <input type="text" class="form-control" name="registration" id="registration"
                                                   value="<?php echo htmlspecialchars( $user["registration"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="<?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telephone">Telefone</label>
                                            <input type="text" class="form-control" id="telephone"
                                                   name="telephone" value="<?php echo htmlspecialchars( $user["telephone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                                   data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="fk_level_access">Nível de acesso</label>
                                            <select class="form-control select2" style="width: 100%;" id="fk_level_access"
                                                    name="fk_level_access">
                                                <?php $counter1=-1;  if( isset($level) && ( is_array($level) || $level instanceof Traversable ) && sizeof($level) ) foreach( $level as $key1 => $value1 ){ $counter1++; ?>
                                                <?php echo selectOption($value1["id_level_access"], $value1["level"], $user["id_level_access"]); ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Editar</button>
                                <a type="submit" class="btn btn-outline-danger" href="/administrador/usuario/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/deletar"
                                   onclick="return confirm('Deseja excluir esse usuário?')">Deletar</a>
                                <a href="/administrador/usuario" class="btn btn-danger" style="color: #FFF">Cancelar</a>
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
                registration: {
                    required: true
                },

                name: {
                    required: true
                },

                telephone: {
                    required: true
                },

                email: {
                    required: true
                }
            }
        }));
    });
</script>