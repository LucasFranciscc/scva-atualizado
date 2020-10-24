<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/grupo">Grupos</a></li>
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
                            <h3 class="card-title">Cadastrar Grupo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formGroup" onSubmit="return validar(this);" role="form" action="/administrador/grupo/cadastrar" method="post">
                            <div class="card-body">

                                <?php if( $groupError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $groupError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="_grupo">Grupo</label>
                                    <input type="text" class="form-control" id="_grupo" name="_grupo"
                                           placeholder=Grupo>
                                </div>

                                <div class="form-group">
                                    <label for="fk_valve">Vincular Válvula</label>
                                    <select class="form-control select2" style="width: 100%;" id="fk_valve"
                                            name="fk_valve">
                                        <?php $counter1=-1;  if( isset($valve) && ( is_array($valve) || $valve instanceof Traversable ) && sizeof($valve) ) foreach( $valve as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo htmlspecialchars( $value1["id_valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <a href="/administrador/grupo" class="btn btn-danger" style="color: #FFF">Cancelar</a>
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
        $("#formGroup").validate(({
            rules: {
                _grupo: {
                    required: true
                }
            }
        }));
    });
</script>