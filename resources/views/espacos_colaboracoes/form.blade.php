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
                            <div class="form-group col-12 col-md-4 pb-3">
                                <label class="form-label">Aluno</label>
                                <select class="select2 form-control" name="aluno_id" id="aluno_id" required="required">
                                    <option value="" data-professor-id="{{ $userLoggedData['professor_id'] }}">Selecione...</option>

                                    @foreach ($alunos_turmas_professores as $key => $aluno_turma_professor)
                                        <option value="{{ $aluno_turma_professor['alunoId'] }}" data-professor-id="{{ $aluno_turma_professor['professorId'] }}">{{ $aluno_turma_professor['alunoName'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-12 col-md-4 pb-3">
                                <label class="form-label">Professor</label>
                                <select class="select2 form-control" name="professor_id" id="professor_id" required="required">
                                    <option value="">Selecione...</option>

                                    @foreach ($professores as $key => $professor)
                                        <option value="{{ $professor['id'] }}">{{ $professor['name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-12 col-md-2 pb-3">
                                <label class="form-label">Data</label>
                                <input type="text" class="form-control mask_date" id="data" name="data">
                            </div>
                            <div class="form-group col-12 col-md-2 pb-3">
                                <label class="form-label">Hora</label>
                                <input type="text" class="form-control mask_time" id="hora" name="hora">
                            </div>
                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label">Observação Resumo</label>
                                <input type="text" class="form-control" id="observacao_resumo" name="observacao_resumo" required>
                            </div>
                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="10" required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
