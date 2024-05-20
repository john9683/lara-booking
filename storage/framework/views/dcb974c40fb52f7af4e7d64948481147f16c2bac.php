<h3><?php echo e($name); ?> <?php echo e($text); ?> </h3>

<div>Идентификатор брони: <?php echo e($id); ?></div>
<div>Отель: <?php echo e($hotel); ?></div>
<div>В городе: <?php echo e($city); ?></div>
<div>Номер: <?php echo e($roomType); ?></div>
<div>Дата заезда: <?php echo e($startedAt); ?></div>
<div>Дата выезда: <?php echo e($finishedAt); ?></div>

<h3>Ждём вас!</h3>
<?php /**PATH /var/www/project/resources/views/mail/reminder_mail.blade.php ENDPATH**/ ?>
