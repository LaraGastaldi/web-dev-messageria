<div>
    <form wire:submit="addFriend" class="position-relative">
        <div class="input-group">
            <input wire:keydown="searchFriend" wire:model="username" class="form-control" type="text" placeholder="{{ __('view.Add friend') }}" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                {{ __('view.Send') }}
            </button>
            <div class="position-absolute bottom-0 start-0">
                <div class="@if($username) show @endif dropdown-menu" id="dropdownFriends" aria-labelledby="button-addon2">
                    @foreach($found as $user)
                        <div class="dropdown-item d-flex align-items-center">
                            <div>
                                <strong>{{ $user->username }}</strong>
                            </div>
                            <button wire:click="sendFriendRequest({{ $user->id }})" class="btn-sm btn btn-primary ms-auto">Adicionar</button>
                        </div>
                    @endforeach
                    @if (strlen($username) < 3)
                        <div class="dropdown-item">
                            <p>{{ __('view.Type at least 3 characters.') }}</p>
                        </div>
                    @elseif($found->isEmpty())
                        <div class="dropdown-item">
                            <p>{{ __('view.No users found') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('form.add-friend')" class="mt-2" />
        </div>
    </form>
</div>

@script
    <script>
        $(() => {
            $('#dropdownFriends').removeClass('show');
            $wire.on('friendAdded', function (data) {
                alert(data.message);
            });
            $wire.on('friendFound', function (data) {
                $('#dropdownFriends').addClass('show');
                console.log(data);
            });
            $wire.on('friendEmpty', function () {
                $('#dropdownFriends').removeClass('show');
                console.log('friendEmpty');
            });
        })
    </script>
@endscript