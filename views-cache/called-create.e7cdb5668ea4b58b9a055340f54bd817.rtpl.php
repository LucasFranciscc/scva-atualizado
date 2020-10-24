<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/tecnico">Home</a></li>
                        <li class="breadcrumb-item"><a href="/tecnico/chamados">Chamados</a></li>
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
                            <h3 class="card-title">Abrir Chamado</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formCalled" onSubmit="return validar(this);" role="form" action="/tecnico/chamados/cadastrar" method="post">
                            <div class="card-body">

                                <?php if( $calledError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $calledError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="fk_group">Grupos</label>
                                    <select class="form-control select2" style="width: 100%;" id="fk_group"
                                            name="fk_group">
                                        <?php $counter1=-1;  if( isset($group) && ( is_array($group) || $group instanceof Traversable ) && sizeof($group) ) foreach( $group as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo htmlspecialchars( $value1["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <a href="/tecnico/chamados" class="btn btn-danger" style="color: #FFF">Cancelar</a>
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
        $("#formCalled").validate(({
            rules: {
                description: {
                    required: true
                }
            }
        }));
    });
</script>