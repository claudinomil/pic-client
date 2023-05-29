<!-- Formulario -->
<div id="crudForm" style="display: none;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="modal-buttons" id="crudFormButtons1">
                        <!-- store or update -->
                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_create', $ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                            <!-- Botão Confirnar Operação -->
                                <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirmar Operação" id="crudFormConfirmOperacao"><i class="fa fa-save label-icon"></i> Confirmar</button>
                        @endif

                        <!-- Botão Cancelar Operação -->
                        <button type="button" class="btn btn-secondary waves-effect btn-label waves-light crudFormCancelOperacao" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar Operação"><i class="fa fa-arrow-left label-icon"></i> Cancelar</button>
                    </div>
                    <div class="modal-buttons" id="crudFormButtons2">
                        <!-- edit or delete -->
                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                            <!-- Botão Alterar Registro -->
                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light editRecord" data-bs-toggle="tooltip" data-bs-placement="top" data-id="0" title="Alterar Registro"><i class="fas fa-pencil-alt label-icon"></i> Alterar</button>
                        @endif

                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_destroy'], $userLoggedPermissoes))
                            <!-- Botão Excluir Registro -->
                                <button type="button" class="btn btn-danger waves-effect btn-label waves-light deleteRecord" data-bs-toggle="tooltip" data-bs-placement="top" data-id="0" title="Excluir Registro"><i class="fa fa-trash-alt label-icon"></i> Excluir</button>
                        @endif

                        <!-- Botão Cancelar Operação -->
                        <button type="button" class="btn btn-secondary waves-effect btn-label waves-light crudFormCancelOperacao" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar Operação"><i class="fa fa-arrow-left label-icon"></i> Cancelar</button>
                    </div>
                    <div class="modal-loading" id="crudFormAjaxLoading" style="display: none;">
                        <div class="spinner-chase">
                            <div class="chase-dot"></div>
                            <div class="chase-dot"></div>
                            <div class="chase-dot"></div>
                            <div class="chase-dot"></div>
                            <div class="chase-dot"></div>
                            <div class="chase-dot"></div>
                        </div>
                    </div>

                    <!-- Formulário - Form -->
                    <form id="{{$ajaxNameFormSubmodulo}}" name="{{$ajaxNameFormSubmodulo}}">
                        <input type="hidden" id="frm_operacao" name="frm_operacao">
                        <input type="hidden" id="registro_id" name="registro_id">

                        <div class="row mt-4">
                            <div class="form-group col-12 col-md-3 pb-3">
                                <label class="form-label">Data</label>
                                <input type="text" class="form-control mask_date" id="data_evento" name="data_evento" required="required">
                            </div>
                            <div class="form-group col-12 col-md-3 pb-3">
                                <label class="form-label">Data (Descrição)</label>
                                <input type="text" class="form-control" id="data_evento_descricao" name="data_evento_descricao">
                            </div>
                            <div class="form-group col-12 col-md-6 pb-3">
                                <label class="form-label">Evento</label>
                                <input type="text" class="form-control" id="evento" name="evento" required="required">
                            </div>
                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label">Sugestão de Atividade</label>
                                <textarea class="form-control" id="sugestao_atividade" name="sugestao_atividade"></textarea>
                            </div>

                            <div class="row pt-4" id="divDocumentosPdfs" style="display: none;">
                                <h5 class="pb-4 text-primary"><i class="fas fa-file-pdf"></i> Documentos PDF</h5>
                                <div class="form-group col-12 col-md-12 pb-3" id="divDocumentosPdfsUpload">
                                    <label class="form-label">Arquivo PDF (Upload)</label>
                                    <div class="row">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="pdf_upload_descricao" id="pdf_upload_descricao" placeholder="Nome do Documento PDF">
                                            <input type="file" class="form-control" name="pdf_upload_arquivo" id="pdf_upload_arquivo">
                                            <button type="button" class="input-group-text btn_pdf_upload_upload" title="Fazer Upload do Documento"><i class="fa fa-upload font-size-14 text-dark"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-12 pb-3">
                                    <h4 class="text-center font-size-12">## Grade de Documentos PDF ##</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Descrição</th>
                                                <th>Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyPdfUpload"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
