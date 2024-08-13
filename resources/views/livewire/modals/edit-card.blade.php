<x-modal-wrapper title="Edit Card">
    <form class="space-y-3" wire:submit="updateCard">
        <div>
            <x-input-label for="title" value="Title" class="sr-only" />
            <x-text-input id="title" placeholder="Card title" class="w-full" autofocus wire:model='editCardForm.title'/>
            <x-input-error :messages="$errors->get('editCardForm.title')" class="mt-1" />
        </div>
        <div class="mt-6">
            <x-input-label for="notes" value="Notes" class="sr-only" />
            <x-textarea id="notes" rows="6" placeholder="Notes" class="w-full" wire:model='editCardForm.notes'/>
            <x-input-error :messages="$errors->get('editCardForm.notes')" class="mt-1" />
        </div>
        <div class="flex items-center justify-between mt-2">
            <x-primary-button>
                Save
            </x-primary-button>
            <x-secondary-button>
                Archive
            </x-secondary-button>
        </div>
    </form>
</x-modal-wrapper>
