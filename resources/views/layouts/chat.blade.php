<div class="d-inline-block">

{{--    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="modal" data-bs-target="#chatModal" id="chatIniciar">--}}

    <button type="button" class="btn header-item noti-icon waves-effect" id="chatIniciar">
        <i class="bx bx-chat bx-tada"></i>
        <span class="badge bg-success rounded-pill" id="chat_sistema_qtd_mensagens">@if(isset($userLoggedUnreadNotificacoes)){{ count($userLoggedUnreadNotificacoes) }}@else{{ 0 }}@endif</span>
    </button>
</div>
