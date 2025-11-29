<div>
    @if($getRecord() && $getRecord()->payment_proof)
        <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800">
            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Proof Image:</h4>
            <img src="{{ Storage::url($getRecord()->payment_proof) }}" alt="Payment Proof"
                class="max-w-2xl rounded-lg shadow-lg border border-gray-300 dark:border-gray-600">
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400">No payment proof uploaded</p>
    @endif
</div>