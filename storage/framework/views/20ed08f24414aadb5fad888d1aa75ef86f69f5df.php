<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="<?php echo e($hotel->hotelImgUrl); ?>" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold"><?php echo e($hotel->title); ?></div>
                <div class="flex items-center">
                    <div class="h-5 mr-1 font-bold text-blue-700">
                        <?php echo e($hotel->city); ?>

                    </div>
                </div>
                <div><?php echo e($hotel->descr); ?></div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <form method="get" action="<?php echo e(url('available-room-show', ['hotel' => $hotel->id])); ?>">
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="started_at" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e($startedAt); ?>"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="finished_at" type="date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e($finishedAt); ?>"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.the-button','data' => ['type' => 'submit','class' => ' h-full w-full']]); ?>
<?php $component->withName('the-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'submit','class' => ' h-full w-full']); ?>Посмотреть свободные номера <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>
            </form>

            <?php if($startedAt && $finishedAt): ?>
                <div class="flex flex-col w-full lg:w-4/5">
                    <?php if(isset($availableRoomList)): ?>
                        <?php if($availableRoomList): ?>
                            <?php $__currentLoopData = $availableRoomList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.rooms.room-list-item','data' => ['room' => $room,'booking' => $booking,'startedAt' => $startedAt,'finishedAt' => $finishedAt,'class' => 'mb-4']]); ?>
<?php $component->withName('rooms.room-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['room' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($room),'booking' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($booking),'startedAt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($startedAt),'finishedAt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($finishedAt),'class' => 'mb-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="text-2xl text-center md:text-start font-bold">На выбранные даты свободных номеров в этом отеле уже нет :-)</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $roomList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.rooms.room-list-item','data' => ['room' => $room,'startedAt' => $startedAt,'finishedAt' => $finishedAt,'class' => 'mb-4']]); ?>
<?php $component->withName('rooms.room-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['room' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($room),'startedAt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($startedAt),'finishedAt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($finishedAt),'class' => 'mb-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            <?php else: ?>
                <div>Не выбран период проживания</div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /var/www/project/resources/views/hotels/show.blade.php ENDPATH**/ ?>