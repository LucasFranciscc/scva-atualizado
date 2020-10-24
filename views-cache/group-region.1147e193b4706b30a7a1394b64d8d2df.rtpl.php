<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/grupo">Grupos</a></li>
                        <li class="breadcrumb-item active">Vincular Região</li>
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
                            <h3 class="card-title">Vincular Regiões ao <?php echo htmlspecialchars( $groupName["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Regiões não vinculadas</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Região</th>
                                                    <th style="width: 240px">&nbsp;</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $counter1=-1;  if( isset($regionNotLinked) && ( is_array($regionNotLinked) || $regionNotLinked instanceof Traversable ) && sizeof($regionNotLinked) ) foreach( $regionNotLinked as $key1 => $value1 ){ $counter1++; ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars( $value1["id_region"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                    <td><?php echo htmlspecialchars( $value1["region"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                    <td>
                                                        <a href="/administrador/grupo/<?php echo htmlspecialchars( $group["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/regiao/<?php echo htmlspecialchars( $value1["id_region"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/adicionar"
                                                           class="btn btn-primary btn-xs pull-right"><i
                                                                class="fa fa-arrow-right"></i> Adicionar</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Regiões vinculadas</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Região</th>
                                                    <th style="width: 240px">&nbsp;</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $counter1=-1;  if( isset($regionLinked) && ( is_array($regionLinked) || $regionLinked instanceof Traversable ) && sizeof($regionLinked) ) foreach( $regionLinked as $key1 => $value1 ){ $counter1++; ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars( $value1["id_region"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                    <td><?php echo htmlspecialchars( $value1["region"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                                    <td>
                                                        <a href="/administrador/grupo/<?php echo htmlspecialchars( $group["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/regiao/<?php echo htmlspecialchars( $value1["id_region"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/remover"
                                                           class="btn btn-primary btn-xs pull-right"><i
                                                                class="fa fa-arrow-left"></i> Remover</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>