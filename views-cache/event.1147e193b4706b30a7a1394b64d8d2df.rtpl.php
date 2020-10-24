<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item active">Status Evento</li>
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
                            <h3 class="card-title">Evento</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="/administrador/evento/<?php echo htmlspecialchars( $event["id_events"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                            <div class="card-body">

                                <dl class="row">

                                    <dt class="col-sm-3">Título</dt>
                                    <dd class="col-sm-9"><?php echo htmlspecialchars( $event["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></dd>

                                    <dt class="col-sm-3">Grupo</dt>
                                    <dd class="col-sm-9"><?php echo htmlspecialchars( $event["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></dd>

                                    <dt class="col-sm-3">Inicio</dt>
                                    <dd class="col-sm-9"><?php echo formatDate($event["start"]); ?></dd>

                                    <dt class="col-sm-3">Fim</dt>
                                    <dd class="col-sm-9"><?php echo formatDate($event["end"]); ?></dd>

                                    <?php if( $event["status"] == 1 ){ ?>
                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-12">
                                            <button type="submit" class="btn btn-block btn-success">Ativado
                                            </button>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-12">
                                            <button type="submit" class="btn btn-block btn-danger">Desativado
                                            </button>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </dl>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="/administrador/evento/<?php echo htmlspecialchars( $event["id_events"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/editar" type="button" class="btn btn-info" style="color: white">Editar</a>
                                <a type="submit" class="btn btn-outline-danger" href="/administrador/evento/<?php echo htmlspecialchars( $event["id_events"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/deletar"
                                   onclick="return confirm('Deseja excluir esse evento?')">Deletar</a>
                                <a href="/administrador" class="btn btn-danger" style="color: #FFF">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>