<div>
    <form>
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Adicionar amigo" aria-label="Search">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                Enviar
            </button>
            <x-input-error :messages="$errors->get('form.add-friend')" class="mt-2" />
        </div>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('friendAdded', function (data) {
                alert(data.message);
            });
        });
    </script>
@endpush