<x-mary-modal id="openTradingAccountModal" wire:modal="openTradingAccountModal" class="backdrop-blur" persistent>
    <div class="mb-5">
        @if ($IsTradingAccount)
        <p>Congratulation! You already have Trading Account.</p>
        @elseif($tradingAccountRequest)
        <p>Please wait some time, your Trading Account request is ongoing. Our executive will contact you shortly.</p>
        @else
        <p>Are you sure you want to Request for Trading Account with Aone Trades</p>
        @endif
    </div>
    <div class="modal-action">
        <x-mary-button type="button" label="Cancel" @click="$wire.openTradingAccountModal = false" onclick="openTradingAccountModal.close()" />
        @if (!$tradingAccountRequest)
        <x-mary-button type="button" label="Yes" class="btn-primary" wire:click="confirmTradingAccount()" spinner="confirmTradingAccount" />
        @endif
    </div>
</x-mary-modal>
