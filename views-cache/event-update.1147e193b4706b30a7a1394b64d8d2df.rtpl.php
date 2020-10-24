<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/administrador">Home</a></li>
                        <li class="breadcrumb-item"><a href="/administrador/regiao">Regiões</a></li>
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
                            <h3 class="card-title">Editar Evento</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formEvent" onSubmit="return validar(this);" role="form" action="/administrador/evento/<?php echo htmlspecialchars( $event["id_events"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/editar" method="post">
                            <div class="card-body">

                                <?php if( $eventError != '' ){ ?>
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                                    <?php echo htmlspecialchars( $eventError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                </div>
                                <?php } ?>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title"
                                               value="<?php echo htmlspecialchars( $event["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Grupo</label>
                                    <div class="col-sm-10">
                                        <select name="fk_group" class="form-control" id="fk_group" onselect="<?php echo htmlspecialchars( $event["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                            <option value="<?php echo htmlspecialchars( $event["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $event["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php $counter1=-1;  if( isset($group) && ( is_array($group) || $group instanceof Traversable ) && sizeof($group) ) foreach( $group as $key1 => $value1 ){ $counter1++; ?>
                                            <option value="<?php echo htmlspecialchars( $value1["id_group"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["_grupo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Cor</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="color">
                                            <?php if( $event["color"] == '#FFD700' ){ ?>
                                            <option style="color:#FFD700;" value="#FFD700" selected>Amarelo</option>
                                            <?php }else{ ?>
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#0071c5' ){ ?>
                                            <option style="color:#0071c5;" value="#0071c5" selected>Azul Turquesa</option>
                                            <?php }else{ ?>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#FF4500' ){ ?>
                                            <option style="color:#FF4500;" value="#FF4500" selected>Laranja</option>
                                            <?php }else{ ?>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#8B4513' ){ ?>
                                            <option style="color:#8B4513;" value="#8B4513" selected>Marrom</option>
                                            <?php }else{ ?>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#436EEE' ){ ?>
                                            <option style="color:#436EEE;" value="#436EEE" selected>Royal Blue</option>
                                            <?php }else{ ?>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#A020F0' ){ ?>
                                            <option style="color:#A020F0;" value="#A020F0" selected>Roxo</option>
                                            <?php }else{ ?>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#40E0D0' ){ ?>
                                            <option style="color:#40E0D0;" value="#40E0D0" selected>Turquesa</option>
                                            <?php }else{ ?>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <?php } ?>

                                            <?php if( $event["color"] == '#228B22' ){ ?>
                                            <option style="color:#228B22;" value="#228B22" selected>Verde</option>
                                            <?php }else{ ?>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Início do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="start" class="form-control" id="start"
                                               value='<?php echo formatDate($event["start"]); ?>'>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Fim do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="end" class="form-control" id="end"
                                               value='<?php echo formatDate($event["end"]); ?>'>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Editar</button>
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
        $("#formEvent").validate(({
            rules: {
                title: {
                    required: true
                },

                start: {
                    required: true
                },

                end: {
                    required: true
                }
            }
        }));
    });
</script>