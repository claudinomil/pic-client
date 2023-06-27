<div>
    <!-- Modal para mostrar Perfil de Usuário -->
    <div class="modal fade modal-profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: var(--bs-body-bg);">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-5">

                            <!-- Card -->
                            <div class="card overflow-hidden">
                                <div class="bg-primary bg-soft">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary">Perfil</h5>
                                                <p>Usuário do Sistema</p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <button type="button" class="btn-close float-end px-1 py-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <img src="{{ asset('build/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="" alt="" class="img-thumbnail rounded-circle jsonUserAvatar" id="imgImageAvatar">
                                            </div>
                                            <h5 class="font-size-15 text-truncate jsonUserName"></h5>
                                            <p class="text-muted mb-0 text-truncate jsonUserFunction"></p>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Grupo</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonUserGroup"></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Situação</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonUserSituacao"></p>
                                                    </div>
                                                </div>
                                                <div class="row" id="modal-profile-botoes">
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao(['users_perfil_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-success waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadAvatar"><i class="fas fa-address-card label-icon"></i>Avatar</button>
                                                            <button class="btn btn-warning waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadAvatarClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao(['users_perfil_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-primary waves-effect btn-label waves-light btn-sm float-end" id="buttonEditEmail"><i class="fas fa-envelope label-icon"></i>E-mail</button>
                                                            <button class="btn btn-warning waves-effect btn-label waves-light btn-sm float-end" id="buttonEditEmailClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao(['users_perfil_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-danger waves-effect btn-label waves-light btn-sm float-end" id="buttonEditPassword"><i class="fas fa-key label-icon"></i>Senha</button>
                                                            <button class="btn btn-warning waves-effect waves-light btn-label btn-sm float-end" id="buttonEditPasswordClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divUploadAvatar" style="display: none;">
                                            <h4 class="text-success"><b>:: </b>Alterar Avatar</h4>

                                            <form method="post" enctype="multipart/form-data" id="frm_upload_avatar">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonUserId" id="upload_avatar_user_id" name="upload_avatar_user_id" value="">

                                                <div class="row mt-4">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="avatar_file" id="avatar_file">
                                                        <button type="submit" class="input-group-text">Upload</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-upload-avatar-error"></span>
                                            </form>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divEditEmail" style="display: none;">
                                            <h4 class="text-primary"><b>:: </b>Alterar E-mail</h4>

                                            <form method="post" enctype="multipart/form-data" id="frm_edit_email">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonUserId" id="edit_email_user_id" name="edit_email_user_id" value="">

                                                <div class="row mt-4">
                                                    <div class="form-group col-12 pb-3">
                                                        <label class="form-label">E-mail Atual</label>
                                                        <input type="email" class="form-control jsonUserCurrentEmail" id="current_email" name="current_email" readonly>
                                                        <span class="col-12 text-danger font-size-11" id="current-email-error"></span>
                                                    </div>
                                                    <div class="form-group col-12 pb-3">
                                                        <label class="form-label">E-mail Novo</label>
                                                        <input type="email" class="form-control" id="new_email" name="new_email">
                                                        <span class="col-12 text-danger font-size-11" id="new-email-error"></span>
                                                    </div>
                                                    <div class="form-group col-12 pb-3">
                                                        <button type="submit" class="btn btn-secondary">Confirmar</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-edit-email-error"></span>
                                            </form>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divEditPassword" style="display: none;">
                                            <h4 class="text-danger"><b>:: </b>Alterar Senha</h4>

                                            <form method="post" id="frm_edit_password" name="frm_edit_password">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonUserId" id="edit_password_user_id" name="edit_password_user_id" value="">

                                                <div class="row mt-4">
                                                    <div class="form-group col-12 pb-3">
                                                        <label class="form-label">Senha Atual</label>
                                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                                        <span class="col-12 text-danger font-size-11" id="current-password-error"></span>
                                                    </div>
                                                    <div class="form-group col-12 pb-3">
                                                        <label class="form-label">Senha Nova</label>
                                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                                        <span class="col-12 text-danger font-size-11" id="new-password-error"></span>
                                                    </div>
                                                    <div class="form-group col-12 pb-3">
                                                        <label class="form-label">Confirmar Senha Nova</label>
                                                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                                                        <span class="col-12 text-danger font-size-11" id="confirm-new-password-error"></span>
                                                    </div>
                                                    <div class="form-group col-12 pb-3">
                                                        <button type="submit" class="btn btn-secondary">Confirmar</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-edit-password-error"></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações Pessoais -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Informações Pessoais</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Name :</th>
                                                <td class="jsonUserName"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td class="jsonUserEmail"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Localização :</th>
                                                <td class="jsonUserLocalizacao"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium mb-2">Inclusões</p>
                                                    <h4 class="mb-0 jsonTransacoesInclusions">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                                        <span class="avatar-title bg-success"><i class="bx bx-plus font-size-24"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium mb-2">Alterações</p>
                                                    <h4 class="mb-0 jsonTransacoesAlterations">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                        <span class="avatar-title bg-primary"><i class="bx bx-edit font-size-24"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium mb-2">Exclusões</p>
                                                    <h4 class="mb-0 jsonTransacoesExclusions">0</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm mini-stat-icon rounded-circle bg-danger">
                                                        <span class="avatar-title bg-danger"><i class="bx bx-trash font-size-24"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Log de Transações</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0 class-datatable-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Operação</th>
                                                    <th scope="col">Submódulos</th>
                                                    <th scope="col">Data</th>
                                                </tr>
                                            </thead>
                                            <tbody class="jsonTransacoesTable"></tbody>
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

    <!-- Modal para mostrar Foto e Transações do Aluno -->
    <div class="modal fade modal-aluno" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: var(--bs-body-bg);">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-5">

                            <!-- Card -->
                            <div class="card overflow-hidden">
                                <div class="bg-primary">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-white p-3">
                                                <h5 class="text-white">Extra</h5>
                                                <p>Aluno do Sistema</p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <button type="button" class="btn-close float-end px-1 py-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <img src="{{ asset('build/assets/images/aluno-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="" alt="" class="img-thumbnail rounded-circle jsonAlunoFoto" id="imgImageAlunoExtraFoto">
                                            </div>
                                            <h5 class="font-size-15 text-truncate jsonAlunoName"></h5>
                                            <p class="text-muted mb-0 text-truncate jsonAlunoFuncao"></p>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Escolaridade</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonAlunoEscolaridade"></p>
                                                    </div>
                                                    <div class="col-6">&nbsp;
{{--                                                        <h5 class="font-size-15">Gênero</h5>--}}
{{--                                                        <p class="text-muted mb-0 text-truncate jsonAlunoGenero"></p>--}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-danger waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadAlunoExtraFoto"><i class="fas fa-address-card label-icon"></i>Foto</button>
                                                            <button class="btn btn-warning waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadAlunoExtraFotoClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divUploadAlunoExtraFoto" style="display: none;">
                                            <h4 class="text-success"><b>:: </b>Alterar Foto</h4>

                                            <form method="post" enctype="multipart/form-data" id="frm_upload_aluno_extra_foto">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonAlunoId" id="upload_aluno_extra_foto_aluno_id" name="upload_aluno_extra_foto_aluno_id" value="">

                                                <div class="row mt-4">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="aluno_extra_foto_file" id="aluno_extra_foto_file">
                                                        <button type="submit" class="input-group-text">Upload</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-upload-aluno-extra-foto-error"></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações Pessoais -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Informações Pessoais</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Name :</th>
                                                <td class="jsonAlunoName"></td>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <th scope="row">E-mail :</th>--}}
{{--                                                <td class="jsonAlunoEmail"></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <th scope="row">Admissão :</th>--}}
{{--                                                <td class="jsonAlunoDataAdmissao"></td>--}}
{{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Transações</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0 class-datatable-2">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Operação</th>
                                            </tr>
                                            </thead>
                                            <tbody class="jsonAlunoTransacoesTable"></tbody>
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

    <!-- Modal para mostrar Foto e Transações do Funcionario -->
    <div class="modal fade modal-funcionario" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: var(--bs-body-bg);">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-5">

                            <!-- Card -->
                            <div class="card overflow-hidden">
                                <div class="bg-danger">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-white p-3">
                                                <h5 class="text-white">Extra</h5>
                                                <p>Funcionario do Sistema</p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <button type="button" class="btn-close float-end px-1 py-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <img src="{{ asset('build/assets/images/funcionario-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="" alt="" class="img-thumbnail rounded-circle jsonFuncionarioFoto" id="imgImageFuncionarioExtraFoto">
                                            </div>
                                            <h5 class="font-size-15 text-truncate jsonFuncionarioName"></h5>
                                            <p class="text-muted mb-0 text-truncate jsonFuncionarioFuncao"></p>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Escolaridade</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonFuncionarioEscolaridade"></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Gênero</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonFuncionarioGenero"></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-danger waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadFuncionarioExtraFoto"><i class="fas fa-address-card label-icon"></i>Foto</button>
                                                            <button class="btn btn-warning waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadFuncionarioExtraFotoClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divUploadFuncionarioExtraFoto" style="display: none;">
                                            <h4 class="text-success"><b>:: </b>Alterar Foto</h4>

                                            <form method="post" enctype="multipart/form-data" id="frm_upload_funcionario_extra_foto">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonFuncionarioId" id="upload_funcionario_extra_foto_funcionario_id" name="upload_funcionario_extra_foto_funcionario_id" value="">

                                                <div class="row mt-4">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="funcionario_extra_foto_file" id="funcionario_extra_foto_file">
                                                        <button type="submit" class="input-group-text">Upload</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-upload-funcionario-extra-foto-error"></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações Pessoais -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Informações Pessoais</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Name :</th>
                                                <td class="jsonFuncionarioName"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td class="jsonFuncionarioEmail"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Admissão :</th>
                                                <td class="jsonFuncionarioDataAdmissao"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Transações</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0 class-datatable-2">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Operação</th>
                                            </tr>
                                            </thead>
                                            <tbody class="jsonFuncionarioTransacoesTable"></tbody>
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

    <!-- Modal para mostrar Foto e Transações do Professor -->
    <div class="modal fade modal-professor" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: var(--bs-body-bg);">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-5">

                            <!-- Card -->
                            <div class="card overflow-hidden">
                                <div class="bg-success">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-white p-3">
                                                <h5 class="text-white">Extra</h5>
                                                <p>Professor do Sistema</p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <button type="button" class="btn-close float-end px-1 py-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <img src="{{ asset('build/assets/images/professor-img.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="" alt="" class="img-thumbnail rounded-circle jsonProfessorFoto" id="imgImageProfessorExtraFoto">
                                            </div>
                                            <h5 class="font-size-15 text-truncate jsonProfessorName"></h5>
                                            <p class="text-muted mb-0 text-truncate jsonProfessorFuncao"></p>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Escolaridade</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonProfessorEscolaridade"></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">Gênero</h5>
                                                        <p class="text-muted mb-0 text-truncate jsonProfessorGenero"></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 mt-4 px-0">
                                                        @if(\App\Facades\Permissoes::permissao([$ajaxPrefixPermissaoSubmodulo.'_edit'], $userLoggedPermissoes))
                                                            <button class="btn btn-danger waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadProfessorExtraFoto"><i class="fas fa-address-card label-icon"></i>Foto</button>
                                                            <button class="btn btn-warning waves-effect btn-label waves-light btn-sm float-end" id="buttonUploadProfessorExtraFotoClose" style="display: none;"><i class="fas fa-address-card label-icon"></i>Fechar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pt-4" id="divUploadProfessorExtraFoto" style="display: none;">
                                            <h4 class="text-success"><b>:: </b>Alterar Foto</h4>

                                            <form method="post" enctype="multipart/form-data" id="frm_upload_professor_extra_foto">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" class="jsonProfessorId" id="upload_professor_extra_foto_professor_id" name="upload_professor_extra_foto_professor_id" value="">

                                                <div class="row mt-4">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="professor_extra_foto_file" id="professor_extra_foto_file">
                                                        <button type="submit" class="input-group-text">Upload</button>
                                                    </div>
                                                </div>

                                                <span class="col-12 text-danger text-center" id="frm-upload-professor-extra-foto-error"></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações Pessoais -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Informações Pessoais</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Name :</th>
                                                <td class="jsonProfessorName"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td class="jsonProfessorEmail"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Admissão :</th>
                                                <td class="jsonProfessorDataAdmissao"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Transações</h4>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0 class-datatable-2">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Operação</th>
                                            </tr>
                                            </thead>
                                            <tbody class="jsonProfessorTransacoesTable"></tbody>
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

    <!-- Modal para mostrar Notificação que o usuário logado clicou para ler (Topbar) -->
    <div class="modal fade modal-notificacao-ler" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: var(--bs-body-bg);">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card overflow-hidden">
                                <div class="bg-secondary">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-white p-3">
                                                <h5 class="text-white">Notificação</h5>
                                                <p class="jsonNotificacaoLerTitulo"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-muted pt-4 mb-0 jsonNotificacaoLerNotificacao" style="text-align: justify"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
