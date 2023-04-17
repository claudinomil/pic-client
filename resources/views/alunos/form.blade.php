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

                        <!-- Botão Extra -->
                        <button type="button" class="btn btn-warning waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target=".modal-aluno" onclick="alunoExtraData();" data-id="0"><i class="bx bx-photo-album label-icon"></i> Extra</button>

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
                        <fieldset disabled id="fieldsetForm">
                            <input type="hidden" id="frm_operacao" name="frm_operacao">
                            <input type="hidden" id="registro_id" name="registro_id">

                            <div class="row mt-4">
                                <div class="row pt-4">
                                    <h5 class="pb-4 text-primary"><i class="fas fa-user"></i> Dados Pessoais</h5>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name" required="required">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Nascimento</label>
                                        <input type="text" class="form-control mask_date" id="data_nascimento" name="data_nascimento" required="required">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Gênero</label>
                                        <select class="select2 form-control" name="genero_id" id="genero_id" required="required">
                                            <option value="">Selecione...</option>

                                            @foreach ($generos as $key => $genero)
                                                <option value="{{ $genero['id'] }}">{{ $genero['name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Raça</label>
                                        <select class="select2 form-control" name="raca_id" id="raca_id" required="required">
                                            <option value="">Selecione...</option>

                                            @foreach ($racas as $key => $raca)
                                                <option value="{{ $raca['id'] }}">{{ $raca['name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Nacionalidade</label>
                                        <select class="form-control select2" name="nacionalidade_id" id="nacionalidade_id">
                                            <option value="">Selecione...</option>

                                            @foreach ($nacionalidades as $key => $nacionalidade)
                                                <option value="{{ $nacionalidade['id'] }}">{{ $nacionalidade['name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Naturalidade</label>
                                        <select class="form-control select2" name="naturalidade_id" id="naturalidade_id">
                                            <option value="">Selecione...</option>

                                            @foreach ($naturalidades as $key => $naturalidade)
                                                <option value="{{ $naturalidade['id'] }}">{{ $naturalidade['name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Pai</label>
                                        <input type="text" class="form-control" id="pai" name="pai">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Mãe</label>
                                        <input type="text" class="form-control" id="mae" name="mae">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Telefone Pai</label>
                                        <input type="text" class="form-control mask_phone_with_ddd" id="telefone_pai" name="telefone_pai">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Telefone Mãe</label>
                                        <input type="text" class="form-control mask_phone_with_ddd" id="telefone_mae" name="telefone_mae">
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <h5 class="pb-4 text-primary"><i class="fas fa-paste"></i> Documentos</h5>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">CPF</label>
                                        <input type="text" class="form-control mask_cpf" id="cpf" name="cpf" required="required">
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <h5 class="pb-4 text-primary"><i class="fas fa-list"></i> Dados Escolares</h5>

                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Turma</label>
                                            <select class="select2 form-control" name="turma_id" id="turma_id" required="required">
                                                <option value="">Selecione...</option>

                                                @foreach ($turmas as $key => $turma)
                                                    <option value="{{ $turma['id'] }}">{{ ' Nome: '.$turma['name'].' - Escola: '.$turma['escolaName'].' - Professor: '.$turma['professorName'] }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <h5 class="pb-4 text-primary"><i class="fas fa-paste"></i> Dados Saúde</h5>

                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Responsável Legal - Nome</label>
                                            <input type="text" class="form-control" id="responsavel_legal_nome" name="responsavel_legal_nome">
                                        </div>
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Responsável Legal - Parentesco</label>
                                            <input type="text" class="form-control" id="responsavel_legal_parentesco" name="responsavel_legal_parentesco">
                                        </div>
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Responsável Legal - Telefone</label>
                                            <input type="text" class="form-control mask_phone_with_ddd" id="responsavel_legal_telefone" name="responsavel_legal_telefone">
                                        </div>
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Responsável Legal - Celular</label>
                                            <input type="text" class="form-control mask_cell_with_ddd" id="responsavel_legal_celular" name="responsavel_legal_celular">
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Problema Saúde</label>
                                            <select class="form-control select2" name="problema_saude" id="problema_saude">
                                                <option value="">Selecione...</option>
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-8 pb-3">
                                            <label class="form-label">Problema Saúde - Descrição</label>
                                            <textarea class="form-control" id="problema_saude_descricao" name="problema_saude_descricao"></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Acompanhamento Saúde</label>
                                            <select class="form-control select2" name="acompanhamento_saude" id="acompanhamento_saude">
                                                <option value="">Selecione...</option>
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-8 pb-3">
                                            <label class="form-label">Acompanhamento Saúde - Descrição</label>
                                            <textarea class="form-control" id="acompanhamento_saude_descricao" name="acompanhamento_saude_descricao"></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Medicamento Controlado</label>
                                            <select class="form-control select2" name="medicamento_controlado" id="medicamento_controlado">
                                                <option value="">Selecione...</option>
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-8 pb-3">
                                            <label class="form-label">Medicamento Controlado - Descrição</label>
                                            <textarea class="form-control" id="medicamento_controlado_descricao" name="medicamento_controlado_descricao"></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="form-group col-12 col-md-4 pb-3">
                                            <label class="form-label">Laudo Deficiência ou Transtorno</label>
                                            <select class="form-control select2" name="laudo_deficiencia_ou_transtorno" id="laudo_deficiencia_ou_transtorno">
                                                <option value="">Selecione...</option>
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-md-8 pb-3">
                                            <label class="form-label">Laudo Deficiência ou Transtorno - Descrição</label>
                                            <textarea class="form-control" id="laudo_deficiencia_ou_transtorno_descricao" name="laudo_deficiencia_ou_transtorno_descricao"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <h5 class="pb-4 text-primary"><i class="fas fa-house-user"></i> Endereço</h5>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">CEP</label>
                                        <input type="text" class="form-control mask_cep" id="cep" name="cep" onblur="pesquisacep(this.value);">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro" readonly="readonly">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" readonly="readonly">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">Localidade</label>
                                        <input type="text" class="form-control" id="localidade" name="localidade" readonly="readonly">
                                    </div>
                                    <div class="form-group col-12 col-md-4 pb-3">
                                        <label class="form-label">UF</label>
                                        <input type="text" class="form-control" id="uf" name="uf" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
