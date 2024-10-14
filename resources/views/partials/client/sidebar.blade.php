<div class="box mb-5">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('client.profile') }}"
                class="btn form-control btn-outline-primary mb-3 {{ Route::is('client.profile*','client.edit_profile') ? 'active' : '' }}">Profile</a>
            <a href="{{ route('client.transaction') }}"
                class="btn form-control btn-outline-primary {{ Route::is('client.transaction*') ? 'active' : '' }}">Transaction</a>
            <a href="{{ route('client.attending') }}"
                class="btn form-control btn-outline-primary mt-3 {{ Route::is('client.attending*') ? 'active' : '' }}">Attending</a>
        </div>
    </div>
</div>