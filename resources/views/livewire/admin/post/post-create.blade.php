<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Movie</h3>
    </div>
    <div class="card-body">
        @include('livewire.admin.post.form')
    </div>
    <div class="card-footer">
        <div class="float-right">
            <button type="buttom" wire:click="save()" wire:loading.attr="disabled" wire:target="save" class="btn btn-primary">
                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Submit
            </button>
        </div>
    </div>
</div>
