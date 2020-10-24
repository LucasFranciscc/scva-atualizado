<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Chamados</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card card-default">
                    <div class="card-header">

                        <h3 class="card-title" style="margin-top: 10px">Lista de chamados</h3>

                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Número</th>
                                <th>Matrícula</th>
                                <th>Aberto Por</th>
                                <th>Data de abertura</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($called) && ( is_array($called) || $called instanceof Traversable ) && sizeof($called) ) foreach( $called as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td>ORD<?php echo htmlspecialchars( $value1["id_called"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["registration"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo formatDate($value1["update_date"]); ?></td>
                                <td><?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>

                                    <a type="button" class="btn btn-dark" href="/operador/visualizar-chamado/<?php echo htmlspecialchars( $value1["id_called"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        <i class="fas fa-eye"> </i> Visualizar chamado
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>