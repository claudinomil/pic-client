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
                        <input type="hidden" id="user_id" name="user_id">

                        <div class="row mt-4">
                            <h6 class="pb-4 text-primary">O que você achou do site? E da proposta da inclusão colaborativa? Por gentileza, em menos de cinco minutos você pode avaliar nosso conteúdo e nos auxiliar com futuras melhorias. Agradecemos desde já o apoio!</h6>

                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label pb-2">1) As informações disponibilizadas no site contribuíram para a sua prática profissional com crianças com necessidades educacionais especiais?</label>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_1" id="resposta_pergunta_1_1" value="1">
                                    <label class="form-check-label" for="resposta_pergunta_1_1">Sim</label>
                                </div>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_1" id="resposta_pergunta_1_2" value="2">
                                    <label class="form-check-label" for="resposta_pergunta_1_2">Não</label>
                                </div>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_1" id="resposta_pergunta_1_3" value="3">
                                    <label class="form-check-label" for="resposta_pergunta_1_3">Parcialmente</label>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label pb-2">2) A plataforma contribuiu no processo de colaboração entre você e a professora da Sala de Recursos?</label>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_2" id="resposta_pergunta_2_1" value="1">
                                    <label class="form-check-label" for="resposta_pergunta_2_1">Sim</label>
                                </div>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_2" id="resposta_pergunta_2_2" value="2">
                                    <label class="form-check-label" for="resposta_pergunta_2_2">Não</label>
                                </div>
                                <div class="form-check pb-2 ms-2">
                                    <input class="form-check-input" type="radio" name="resposta_pergunta_2" id="resposta_pergunta_2_3" value="3">
                                    <label class="form-check-label" for="resposta_pergunta_2_3">Parcialmente</label>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-12 pb-3">
                                <label class="form-label pb-2">3) Quais os aspéctos a serem melhorados quanto ao conteúdo e à estrutura do site?</label>
                                <div class="pb-2 ms-2">
                                    <textarea class="form-control" name="resposta_pergunta_3" id="resposta_pergunta_3" maxlength="200" rows="3" placeholder="Esta área de texto tem um limite de 225 caracteres."></textarea>
                                    <div class="float-end text-end bg-light" id="count_message"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
