<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <x-button.circle secondary icon="bell" onclick="$openModal('notificationsModal')" />

    <x-modal.card title="{{__('Choose Mail Provider')}}" blur wire:model.defer="notificationsModal">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">

                <x-select
                    label="{{__('Choose Mail Provider')}}"
                    placeholder="{{__('Select one of the following')}}"
                    :options="['Mailgun', 'Sendgrid', 'Postmark']"
                    wire:model.defer="mailProvider"
                />
            </div>

        </div>

        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex">
                    <x-button flat label="{{__('Cancel')}}" x-on:click="close" />
                    <x-button primary label="{{__('Save')}}" x-on:click="close" wire:click="save" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>
</div>
