<x-modal-wrapper title="Create Board">
    <form class="space-y-3" wire:submit="createBoard">
        <div>
            <x-input-label for="title" value="Title" class="sr-only" />
            <x-text-input id="title" placeholder="Board title" class="w-full" autofocus wire:model='createBoardForm.title'/>
            <x-input-error :messages="$errors->get('createBoardForm.title')" class="mt-1" />
        </div>
        <div class="flex items-center justify-between mt-2">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</x-modal-wrapper>
