{{-- manager --}}
<div class="modal mm-animated fadeIn is-active modal-manager__Inmodal">
    <div class="modal-background" @click.stop="hideInputModal()"></div>
    <div class="modal-content mm-animated fadeInDown">
        <div class="box">
            @include('MediaManager::_manager', ['modal' => true])
            <button class="btn btn-primary btn-block mt-2" @click.stop="hideInputModal()">Submit</button>
        </div>
    </div>
    <button class="modal-close is-large is-hidden-touch" @click.stop="hideInputModal()"></button>
</div>