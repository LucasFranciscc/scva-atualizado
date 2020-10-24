<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/regiao">Regiões</a></li>
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
                            <h3 class="card-title">Cadastrar Região</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formRegion" onSubmit="return validar(this);" role="form" action="/administrador/regiao/cadastrar" method="post">
                            <div class="card-body">

                                <?php if( $regionError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $regionError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="region">Região</label>
                                    <input type="text" class="form-control" id="region" name="region"
                                           placeholder=Região>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                <a href="/administrador/regiao" class="btn btn-danger" style="color: #FFF">Cancelar</a>
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
        $("#formRegion").validate(({
            rules: {
                region: {
                    required: true
                }
            }
        }));
    });
</script>