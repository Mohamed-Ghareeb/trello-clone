<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $board->title }}
        </h2>
    </x-slot>
    <div class="w-full p-6 overflow-x-scroll">
        <div 
            class="flex w-max space-x-6 h-[calc(theme('height.screen')-64px-73px-theme('padding.12'))]"
            wire:sortable="sortOrder" 
            wire:sortable-group="moved" 
            wire:sortable.options="{ animation: 250 }">
            @foreach ($columns as $column)
                <div wire:key="{{ $column->id }}" wire:sortable.item="{{ $column->id }}">
                    <livewire:column :key="$column->id" :column="$column" />
                </div>
            @endforeach
            <div
                x-data="{ adding:false }"
                x-on:column-created.window="adding = false"
                >
                <template x-if="adding">
                    <form 
                        class="bg-white shadow-sm px-4 py-3 rounded-lg w-[260px]"
                        wire:submit="createColumn"
                        >
                        <div>
                            <x-input-label for="title" value="Title" class="sr-only" />
                            <x-text-input id="title" placeholder="Column title" class="w-full"
                            wire:model='createColumnForm.title' x-init="$el.focus()" />
                            <x-input-error :messages="$errors->get('createColumnForm.title')" class="mt-1" />
                        </div>
                        <div class="flex items-center space-x-3 mt-2">
                            <x-primary-button>
                                Create
                            </x-primary-button>
                            <button
                             type="button" 
                             class="text-sm text-gray-500 ml-2"
                             x-on:click="adding = false">Cancel</button>
                        </div>
                    </form>
                </template>
                <button 
                    class="bg-gray-200 shadow-sm px-4 py-3 flex items-center space-x-1 rounded-lg w-[260px]"
                    x-show="!adding"
                    x-on:click="adding = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Add a Column</span>
                </button>
            </div>
        </div>
    </div>
</div>
