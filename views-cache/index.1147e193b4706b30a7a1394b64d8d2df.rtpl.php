<?php if(!class_exists('Rain\Tpl')){exit;}?><link href='/res/css/core/main.min.css' rel='stylesheet'/>
<link href='/res/css/daygrid/main.min.css' rel='stylesheet'/>
<link rel="stylesheet" href="/res/css/personalizado.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="col-md-12">
        <div class="card card-primary">



            <?php if( $eventError != '' ){ ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                <?php echo htmlspecialchars( $eventError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>

            <div class="card-body p-0">

                <div id='calendar'></div>

                <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="visevent">


                                    <form class="form-horizontal">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label for="title" class="col-sm-2 col-form-label">Titulo</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="title" name="title">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Color</label>
                                                <div class="col-sm-10">
                                                    <select name="color" class="form-control" id="color">
                                                        <option id="color"></option>
                                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                                        <option style="color:#0071c5;" value="#0071c5">Azul Turquesa
                                                        </option>
                                                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                                        <option style="color:#436EEE;" value="#436EEE">Royal Blue
                                                        </option>
                                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="start" class="col-sm-2 col-form-label">Inicio</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="start" name="start">
                                                </div>
                                            </div>

<!--                                            <div class="form-group row">-->
<!--                                                <label for="start" class="col-sm-2 col-form-label">Status</label>-->
<!--                                                <div class="col-sm-10">-->
<!--                                                    <input type="text" class="form-control" id="status" name="start">-->
<!--                                                </div>-->
<!--                                            </div>-->

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="button" class="btn btn-block btn-success">Ativado
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="button" class="btn btn-block btn-danger">Desativado
                                                    </button>
                                                </div>
                                            </div>


                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Sign in</button>
                                                <button type="submit" class="btn btn-default float-right">Cancel
                                                </button>
                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
                                    </form>

                                    <button class="btn btn-warning btn-canc-vis">Editar</button>
                                </div>
                                <div class="formedit">
                                    <span id="msg-edit"></span>
                                    <form id="editevent" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Título</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title"
                                                       placeholder="Título do evento">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Color</label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control" id="color">
                                                    <option value="">Selecione</option>
                                                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa
                                                    </option>
                                                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                                    <option style="color:#228B22;" value="#228B22">Verde</option>
                                                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Início do evento</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="start" class="form-control" id="start"
                                                       onkeypress="DataHora(event, this)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Final do evento</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="end" class="form-control" id="end"
                                                       onkeypress="DataHora(event, this)">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="button" class="btn btn-primary btn-canc-edit">Cancelar
                                                </button>
                                                <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent"
                                                        class="btn btn-success">Cadastrar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span id="msg-cad"></span>
                                <form id="formEvent" onSubmit="return validar(this);" method="POST" action="/administrador" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Título</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title"
                                                   placeholder="Título do evento">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Grupo</label>
                                        <div class="col-sm-10">
                                            <select name="fk_group" class="form-control" id="fk_group">
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
                                                <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                                <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                                <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                                <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                                <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                                <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                                <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                                <option style="color:#228B22;" value="#228B22">Verde</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Início do evento</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="start" class="form-control" id="start"
                                                   onkeypress="DataHora(event, this)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Fim do evento</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="end" class="form-control" id="end"
                                                   onkeypress="DataHora(event, this)">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success">Cadastrar</button>
                                        </div>
                                    </div>
                                </form>
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