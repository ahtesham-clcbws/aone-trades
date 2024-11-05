<x-mary-modal id="openConfirmModal" wire:modal="openConfirmModal" class="backdrop-blur" persistent>
    <div class="mb-5">
        @if ($IsIBPartner)
        <p>Congratulation! You already are out IB Partner.</p>
        @elseif($IbPartnerRequest)
        <p>Please wait some time, your IB Partner request is ongoing. Our executive will contact you shortly.</p>
        @else
        <p>Are you sure you want to Request to became IB Partner with Aone Trades</p>
        @endif
    </div>
    <div class="modal-action">
        <x-mary-button type="button" label="Cancel" @click="$wire.openConfirmModal = false" onclick="openConfirmModal.close()" />
        @if (!$IbPartnerRequest)
        <x-mary-button type="button" label="Yes" class="btn-primary" wire:click="confirmIBPartner()" spinner="confirmIBPartner" />
        @endif
    </div>
</x-mary-modal>
