<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
    <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
        <div class="flex justify-between w-full py-2 border-b border-gray-200">
                <div>
                    <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">
                        <?php if(isset($message)): ?>
                            <?php echo e($message); ?> <?php echo e($booking->id); ?>

                        <?php else: ?>
                            Бронирование #<?php echo e($booking->id); ?>

                        <?php endif; ?>
                    </p>

                    <p class="text-base font-medium leading-6 text-gray-600 "><?php echo e($booking->createdAt); ?></p>
                </div>

                <div class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-red-600">
                    <?php echo e($booking->cancelStatus); ?>

                </div>


            <?php if($showLink ?? false): ?>
            <div class="flex">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.link-button','data' => ['href' => ''.e(url('booking-show', ['booking' => $booking->id])).'']]); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(url('booking-show', ['booking' => $booking->id])).'']); ?>Подробнее <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:space-x-6 w-full">
            <div class="pb-4 w-full md:w-2/5">
                <img class="w-full block" src="<?php echo e($booking->roomTypeImgUrl); ?>" alt="image"/>
            </div>
            <div
                class="md:flex-row flex-col flex justify-between items-start w-full md:w-3/5 pb-8 space-y-4 md:space-y-0">
                <div class="w-full flex flex-col justify-start items-start space-y-8">
                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800"><?php echo e($booking->roomTypeTitle); ?></h3>
                    <div class="flex justify-start items-start flex-col space-y-2">
                        <p class="text-sm leading-none text-gray-800"><span>Даты: </span>
                            <?php echo e($booking->startedAt); ?>

                            по
                            <?php echo e($booking->finishedAt); ?></p>
                        <p class="text-sm leading-none text-gray-800"><span>Кол-во ночей: </span> <?php echo e($booking->totalNights); ?>

                        </p>
                    </div>
                </div>
                <div class="flex justify-end space-x-8 items-end w-full">
                    <p class="text-base xl:text-lg font-semibold leading-6 text-gray-800">
                        Стоимость: <?php echo e($booking->totalPrice); ?> руб</p>
                </div>
            </div>
        </div>

        <?php if(isset($cancelBooking)): ?>
            <?php if($cancelBooking): ?>
                <div class="container flex flex-row justify-end">
                    <form method="POST" action="<?php echo e(url('booking-cancel')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($booking->id); ?>">
                        <label for="cancel_reason">Если вы действительно хотите отменить бронь, пожалуйста, укажите причину отмены:</label>
                        <select class="select" id="cancel_reason" name="cancel_reason_id" required>
                            <option></option>
                            <?php $__currentLoopData = $cancelReasonArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancelReason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cancelReason['id']); ?>"><?php echo e($cancelReason['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="container flex flex-row justify-end">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.the-button','data' => []]); ?>
<?php $component->withName('the-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Отменить бронь')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($cancelBooking)): ?>
            <?php if(!isset($showLink) && !$cancelBooking && !$booking->cancelStatus): ?>
                <div class="container flex flex-row justify-end">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.link-button','data' => ['href' => ''.e(url('booking-show', ['booking' => $booking->id, 'cancel' => 'cancel'])).'']]); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(url('booking-show', ['booking' => $booking->id, 'cancel' => 'cancel'])).'']); ?>Хочу отменить бронь <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH /var/www/project/resources/views/components/bookings/booking-card.blade.php ENDPATH**/ ?>