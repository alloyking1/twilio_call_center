{{-- <div>
    <button class="bg-white text-blue-500 p-3 rounded-md border border-blue-500" wire:click="Call">Connect to que</button>
</div> --}}



<div>
    <h1>Call Center</h1>

    <div>
        @if ($agentAvailable)
            <button wire:click="toggleAgentAvailability">Make agent unavailable</button>
        @else
            <button wire:click="toggleAgentAvailability">Make agent available</button>
        @endif
    </div>
</div>
