<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item active">Usuários</li>
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

                        <h3 class="card-title" style="margin-top: 10px">Tabela de Regiões</h3>

                        <div class="card-tools">
                            <a type="submit" class="btn btn-success" href="/administrador/regiao/cadastrar">Cadastrar
                                Região</a>
                        </div>

                    </div>
                    <div class="card-body">

                        <?php if( $regionError != '' ){ ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            <?php echo htmlspecialchars( $regionError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        </div>
                        <?php } ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Região</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter1=-1;  if( isset($regions) && ( is_array($regions) || $regions instanceof Traversable ) && sizeof($regions) ) foreach( $regions as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["region"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a type="button" class="btn btn-info"
                                       href="/administrador/regiao/<?php echo htmlspecialchars( $value1["id_region"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        <i class="fas fa-edit"></i>
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