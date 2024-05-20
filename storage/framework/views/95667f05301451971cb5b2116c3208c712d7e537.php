<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="<?php echo e($hotel->hotelImgUrl); ?>" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="<?php echo e(url('hotel-show', ['hotel' => $hotel->id])); ?>"><?php echo e($hotel->title); ?>

            </a>
            <div class="text-xs">
                <?php echo e($hotel->city); ?>

            </div>
        </div>
        <div class="pt-2">
            <span class="text-2xl text-grey-darkest">
                 от <?php echo e($hotel->minPrice); ?>

            </span>
            <span class="text-lg"> ₽ за ночь</span>
        </div>

        <?php if($hotel->facilities->isNotEmpty()): ?>
            <div class="flex items-center py-2">
                <?php $__currentLoopData = $hotel->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="pr-2 text-xs">
                        <span>•</span> <?php echo e($facility->title); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-end">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.link-button','data' => ['href' => ''.e(url('hotel-show', ['hotel' => $hotel->id])).'']]); ?>
<?php $component->withName('link-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(url('hotel-show', ['hotel' => $hotel->id])).'']); ?>Подробнее <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/project/resources/views/components/hotels/hotel-card.blade.php ENDPATH**/ ?>