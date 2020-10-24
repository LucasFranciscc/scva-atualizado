<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/valvula">Válvulas</a></li>
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
                            <h3 class="card-title">Editar válvula</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formValve" onSubmit="return validar(this);" role="form" action="/administrador/valvula/<?php echo htmlspecialchars( $valve["id_valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                            <div class="card-body">

                                <?php if( $valveError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $valveError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="valve">Válvula</label>
                                    <input type="text" class="form-control" id="valve" name="valve"
                                           placeholder="Válvula" value="<?php echo htmlspecialchars( $valve["valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Editar</button>
                                <a type="submit" class="btn btn-outline-danger" href="/administrador/valvula/<?php echo htmlspecialchars( $valve["id_valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/deletar"
                                   onclick="return confirm('Deseja excluir essa valvula?')">Deletar</a>
                                <a href="/administrador/valvula" class="btn btn-danger" style="color: #FFF">Cancelar</a>
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
        $("#formValve").validate(({
            rules: {
                valve: {
                    required: true
                }
            }
        }));
    });
</script>