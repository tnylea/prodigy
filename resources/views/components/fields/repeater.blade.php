@props(['key', 'data', 'block'])

<x-prodigy::editor.field-wrapper :width="$data['width'] ?? 100" x-data>
    <x-prodigy::editor.label :data="$data" :key="$key" for="block.content.{{$key}}"/>


    <div class="pro-flex pro-flex-col" x-data="">
        @forelse($block->children as $child_block)
            <x-prodigy::editor.block-row :block="$child_block"
                                         :label="'Item ' . $loop->index + 1"
                                         draggable="true"
                                         x-on:dragstart="event.dataTransfer.setData('text/plain', {{ $child_block->id }});"
                                         x-on:drop.prevent="$wire.reorder(event.dataTransfer.getData('text/plain'), {{ $loop->index }}); $el.classList.remove('pro-bg-blue-500'); $el.classList.add('pro-bg-white');"
                                         x-on:dragover.prevent="$el.classList.add('pro-bg-blue-500');$el.classList.remove('pro-bg-white');"
                                         x-on:dragleave.prevent="$el.classList.remove('pro-bg-blue-500');$el.classList.add('pro-bg-white');"
            >
                <x-slot:actions>
                    <button
                            x-on:click="Livewire.emit('editBlock', {{ $child_block->id }})"
                            class="pro-text-blue-500 hover:pro-text-blue-700 hover:pro-underline pro-mr-2">
                        Edit
                    </button>
                    <button class="pro-text-gray-500 hover:pro-text-red-500 pro-relative pro-top-[0.2rem]"
                            x-on:click="alert('todo')">
                        <x-prodigy::icons.close class="w-4"/>
                    </button>
                </x-slot:actions>
            </x-prodigy::editor.block-row>
        @empty
        @endforelse
        <x-prodigy::editor.button
                x-on:click="Livewire.emit('addChildBlockThenEdit', 'repeater', {{ $block->id }});">+ Add New
        </x-prodigy::editor.button>
    </div>

</x-prodigy::editor.field-wrapper>