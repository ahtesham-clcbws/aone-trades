<div wire:poll.60s.visible>
   {{ \Carbon\Carbon::now($timezone)->format('l jS \\of F Y h:i A') }}
</div>
