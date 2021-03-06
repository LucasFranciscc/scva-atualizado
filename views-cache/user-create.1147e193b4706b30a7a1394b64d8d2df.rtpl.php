<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-6">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/usuario">Usuários</a></li>
                        <li class="breadcrumb-item active">Cadastrar</li>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Cadastrar Usuário</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formUser" onSubmit="return validar(this);" role="form" action="/administrador/usuario/cadastrar" method="post">
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
                                            <input type="text" class="form-control" id="registration"
                                                   name="registration"
                                                   value="<?php echo htmlspecialchars( $registerValuesUser["registration"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="<?php echo htmlspecialchars( $registerValuesUser["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="telephone">Telefone</label>
                                            <input type="text" class="form-control" id="telephone"
                                                   name="telephone" value="<?php echo htmlspecialchars( $registerValuesUser["telephone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                                   data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="<?php echo htmlspecialchars( $registerValuesUser["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">Senha</label>
                                            <input type="password" class="form-control" id="password"
                                                   name="password" value="<?php echo htmlspecialchars( $registerValuesUser["password"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="fk_level_access">Nível de acesso</label>
                                            <select class="form-control select2" style="width: 100%;" id="fk_level_access"
                                                    name="fk_level_access">
                                                <?php $counter1=-1;  if( isset($level) && ( is_array($level) || $level instanceof Traversable ) && sizeof($level) ) foreach( $level as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["id_level_access"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["level"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
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
                },

                password: {
                    required: true
                }
            }
        }));
    });
</script>