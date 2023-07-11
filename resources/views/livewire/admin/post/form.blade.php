<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nameL">Enter Title</label>
            <input wire:model.defer='post.title' type="text" class="form-control @error('name') is-invalid @enderror"
                id="nameL" placeholder="Enter Title">
            @error('post.title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="nameL">Styles</label>
            <textarea rows="4" wire:model.defer='post.style' class="form-control" placeholder="Please Enter Style(CSS Code)"></textarea>
            @error('post.style')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="nameL">Body Code</label>
            <textarea rows="6" wire:model.defer='post.body' class="form-control" placeholder="Please Enter Style(CSS Code)"></textarea>
            @error('post.body')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
