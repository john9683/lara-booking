<h3>
    <?php if($emailForUser): ?><?php echo e($name); ?><?php endif; ?>
    <?php echo e($text); ?>

</h3>

<div>Тип транзакции: <?php echo e($transactionType); ?></div>
<div>Идентификатор брони: <?php echo e($id); ?></div>
<div>Отель: <?php echo e($hotel); ?></div>
<div>В городе: <?php echo e($city); ?></div>
<div>Номер: <?php echo e($roomType); ?></div>
<div>Дата заезда: <?php echo e($startedAt); ?></div>
<div>Дата выезда: <?php echo e($finishedAt); ?></div>

<?php if(!$emailForUser && $isCancel): ?>
    <br>
    <div>Причина отмены: <?php echo e($cancelReason); ?></div>
    <div>Дата отмены: <?php echo e($cancelDate); ?></div>
    <div>Отменил: <?php echo e($cancelUserRole); ?> <?php echo e($cancelUserName); ?></div>
<?php endif; ?>
<?php /**PATH /var/www/project/resources/views/mail/booking_transaction.blade.php ENDPATH**/ ?>