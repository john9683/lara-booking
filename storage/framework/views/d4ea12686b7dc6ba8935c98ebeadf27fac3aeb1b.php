<div class="flex flex-col md:flex-row shadow-md py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="h-full w-full md:w-2/5">
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url(<?php echo e($room->typeImgUrl); ?>)">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between">
        <div class="pb-2">
            <div class="text-xl font-bold">
                <?php echo e($room->typeTitle); ?>

            </div>

            <div class="text-xl">
                <?php echo e($room->typeDescr); ?>

            </div>

            <div>
                <?php $__currentLoopData = $room->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span>• <?php echo e($facility->title); ?> </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2">
            <div class="flex  w-full">
                <div class="text-lg font-bold">
                    <?php if(!isset($booking)): ?><span>от </span><?php endif; ?>
                        <?php echo e($room->totalPrice); ?>

                </div>
            </div>

            <?php if(isset($booking)): ?>
                <form class="ml-4" method="POST" action="<?php echo e(url('booking-create')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="started_at" value="<?php echo e($startedAt); ?>">
                    <input type="hidden" name="finished_at" value="<?php echo e($finishedAt); ?>">
                    <input type="hidden" name="hotel_id" value="<?php echo e($room->hotelId); ?>">
                    <input type="hidden" name="room_type_id" value="<?php echo e($room->typeId); ?>">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.the-button','data' => ['class' => ' h-full w-full']]); ?>
<?php $component->withName('the-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => ' h-full w-full']); ?><?php echo e(__('Забронировать')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </form>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/project/resources/views/components/rooms/room-list-item.blade.php ENDPATH**/ ?>