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
                        <button type="button" class="btn btn-warning waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target=".modal-funcionario" onclick="funcionarioExtraData();" data-id="0"><i class="bx bx-photo-album label-icon"></i> Extra</button>

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
                                    <label class="form-label">Estado Civil</label>
                                    <select class="form-control select2" name="estado_civil_id" id="estado_civil_id" required="required">
                                        <option value="">Selecione...</option>

                                        @foreach ($estados_civis as $key => $estado_civil)
                                            <option value="{{ $estado_civil['id'] }}">{{ $estado_civil['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Escolaridade</label>
                                    <select class="form-control select2" name="escolaridade_id" id="escolaridade_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($escolaridades as $key => $escolaridade)
                                            <option value="{{ $escolaridade['id'] }}">{{ $escolaridade['name'] }}</option>
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
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control mask_email" id="email" name="email">
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Telefone 1</label>
                                    <input type="text" class="form-control mask_phone_with_ddd" id="telefone_1" name="telefone_1">
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Telefone 2</label>
                                    <input type="text" class="form-control mask_phone_with_ddd" id="telefone_2" name="telefone_2">
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Celular 1</label>
                                    <input type="text" class="form-control mask_cell_with_ddd" id="cellular_1" name="cellular_1">
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Celular 2</label>
                                    <input type="text" class="form-control mask_cell_with_ddd" id="celular_2" name="celular_2">
                                </div>
                            </div>

                            <div class="row pt-4">
                                <h5 class="pb-4 text-primary"><i class="fas fa-user-tie"></i> Dados Profissionais</h5>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Função</label>
                                    <select class="form-control select2" name="funcao_id" id="funcao_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($funcoes as $key => $funcao)
                                            <option value="{{ $funcao['id'] }}">{{ $funcao['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Data Admissão</label>
                                    <input type="text" class="form-control mask_date" id="data_admissao" name="data_admissao">
                                </div>
                                <div class="form-group col-12 col-md-4 pb-3">
                                    <label class="form-label">Data Demissão</label>
                                    <input type="text" class="form-control mask_date" id="data_demissao" name="data_demissao">
                                </div>
                            </div>

                            <div class="row pt-4">
                                <h5 class="pb-4 text-primary"><i class="fas fa-paste"></i> Documentos</h5>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Pessoal (Órgão)</label>
                                    <select class="form-control select2" name="pessoal_identidade_orgao_id" id="pessoal_identidade_orgao_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($identidade_orgaos as $key => $identidade_orgao)
                                            <option value="{{ $identidade_orgao['id'] }}">{{ $identidade_orgao['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Pessoal (Estado)</label>
                                    <select class="form-control select2" name="pessoal_identidade_estado_id" id="pessoal_identidade_estado_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($identidade_estados as $key => $identidade_estado)
                                            <option value="{{ $identidade_estado['id'] }}">{{ $identidade_estado['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Pessoal (Número)</label>
                                    <input type="text" class="form-control" id="pessoal_identidade_numero" name="pessoal_identidade_numero">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Pessoal (Emissão)</label>
                                    <input type="text" class="form-control mask_date" id="pessoal_identidade_data_emissao" name="pessoal_identidade_data_emissao">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Profissional (Órgão)</label>
                                    <select class="form-control select2" name="profissional_identidade_orgao_id" id="profissional_identidade_orgao_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($identidade_orgaos as $key => $identidade_orgao)
                                            <option value="{{ $identidade_orgao['id'] }}">{{ $identidade_orgao['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Profissional (Estado)</label>
                                    <select class="form-control select2" name="profissional_identidade_estado_id" id="profissional_identidade_estado_id">
                                        <option value="">Selecione...</option>

                                        @foreach ($identidade_estados as $key => $identidade_estado)
                                            <option value="{{ $identidade_estado['id'] }}">{{ $identidade_estado['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Profissional (Número)</label>
                                    <input type="text" class="form-control" id="profissional_identidade_numero" name="profissional_identidade_numero">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Identidade Profissional (Emissão)</label>
                                    <input type="text" class="form-control mask_date" id="profissional_identidade_data_emissao" name="profissional_identidade_data_emissao">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-control mask_cpf" id="cpf" name="cpf" required="required">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">PIS</label>
                                    <input type="text" class="form-control mask_pis" id="pis" name="pis">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">PASEP</label>
                                    <input type="text" class="form-control mask_pasep" id="pasep" name="pasep">
                                </div>
                                <div class="form-group col-12 col-md-3 pb-3">
                                    <label class="form-label">Carteira Trabalho</label>
                                    <input type="text" class="form-control" id="carteira_trabalho" name="carteira_trabalho">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
