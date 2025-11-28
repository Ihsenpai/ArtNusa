@props(['paymentMethod'])

<div class="space-y-3">
    
    <label class="relative flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all
                {{ $paymentMethod === 'transfer' ? 'border-amber-500 bg-amber-50' : 'border-stone-200 hover:border-stone-300' }}">
        
        <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="transfer" class="accent-amber-600 w-4 h-4">
        
        <div class="flex-1">
            <div class="font-bold text-stone-800 text-sm">Transfer Bank (Manual)</div>
            <div class="text-xs text-stone-400">BCA, BRI, Mandiri</div>
        </div>
        
        <i class="fa-solid fa-building-columns text-stone-300 {{ $paymentMethod === 'transfer' ? 'text-amber-600' : '' }}"></i>
    </label>

    <label class="relative flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all
                {{ $paymentMethod === 'ewallet' ? 'border-amber-500 bg-amber-50' : 'border-stone-200 hover:border-stone-300' }}">
        
        <input type="radio" wire:model.live="paymentMethod" name="payment_method" value="ewallet" class="accent-amber-600 w-4 h-4">
        
        <div class="flex-1">
            <div class="font-bold text-stone-800 text-sm">E-Wallet / QRIS</div>
            <div class="text-xs text-stone-400">GoPay, OVO, Dana</div>
        </div>
        
        <i class="fa-solid fa-qrcode text-stone-300 {{ $paymentMethod === 'ewallet' ? 'text-amber-600' : '' }}"></i>
    </label>
</div>