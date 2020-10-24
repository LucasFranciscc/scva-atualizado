<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/operador">Home</a></li>
                        <li class="breadcrumb-item active">Visualizar</li>
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
                            <h3 class="card-title">Chamado</h3>
                        </div>

                        <form role="form" action="/operador/visualizar-chamado/<?php echo htmlspecialchars( $called["id_called"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

                        <div class="card-body">

                            <input type="hidden" name="id_called" value="<?php echo htmlspecialchars( $called["id_called"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                            <div class="form-group">
                                <label for="grupo">Grupo</label>
                                <input type="text" class="form-control" id="grupo" name="grupo" disabled
                                       placeholder=Válvula value="<?php echo htmlspecialchars( $called["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>

                            <div class="form-group">
                                <label for="fk_valve">Válvula</label>
                                <input type="text" class="form-control" id="fk_valve" name="fk_valve" disabled
                                       placeholder=Válvula value="<?php echo htmlspecialchars( $called["valve"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>

                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" name="description" id="description" rows="5" disabled><?php echo htmlspecialchars( $called["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status" disabled
                                       placeholder=Válvula value="<?php echo htmlspecialchars( $called["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Aberto por</label>
                                <input type="text" class="form-control" id="name" name="name" disabled
                                       placeholder=Válvula value="<?php echo htmlspecialchars( $called["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>

                            <div class="form-group">
                                <label for="update_date">Data de abertura</label>
                                <input type="text" class="form-control" id="update_date" name="update_date" disabled
                                       placeholder=Válvula value='<?php echo formatDate($called["update_date"]); ?>'>
                            </div>

                            <div class="form-group">
                                <label for="description">Resposta</label>
                                <textarea class="form-control" name="answer" id="answer" rows="5"></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="/operador" type="submit" class="btn btn-info">voltar</a>

                                <button type="submit" class="btn btn-danger"
                                        href="/operador/visualizar-chamado/<?php echo htmlspecialchars( $called["id_called"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                        onclick="return confirm('Deseja fechar esse chamado?')"> Fechar Chamado
                                </button>

                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
</div>

</section>
<!-- /.content -->
</div>