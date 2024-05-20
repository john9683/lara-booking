<div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
    <div class="flex flex-col justify-end items-end bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
        <form method="GET" action="<?php echo e(url('booking-list')); ?>" id="not_canceled_form">
            <label for="not_canceled">Не показывать отменённые бронирования</label>
            <input type="checkbox" id="not_canceled" name="not_canceled" value="true"
            <?php if($checked): ?> checked <?php endif; ?>
            >
        </form>
    </div>
</div>

<script>
    const form = document.getElementById("not_canceled_form");
    const input = document.getElementById("not_canceled");

    input.addEventListener('click', () => form.submit())
</script>

<?php /**PATH /var/www/project/resources/views/components/bookings/booking-cancel-box.blade.php ENDPATH**/ ?>