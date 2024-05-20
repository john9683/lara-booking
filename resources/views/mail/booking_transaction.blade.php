<h3>
    @if($emailForUser){{ $name }}@endif
    {{ $text }}
</h3>

<div>Тип транзакции: {{ $transactionType }}</div>
<div>Идентификатор брони: {{ $id }}</div>
<div>Отель: {{ $hotel }}</div>
<div>В городе: {{ $city }}</div>
<div>Номер: {{ $roomType }}</div>
<div>Дата заезда: {{ $startedAt }}</div>
<div>Дата выезда: {{ $finishedAt }}</div>

@if(!$emailForUser && $isCancel)
    <br>
    <div>Причина отмены: {{ $cancelReason }}</div>
    <div>Дата отмены: {{ $cancelDate }}</div>
    <div>Отменил: {{ $cancelUserRole }} {{ $cancelUserName }}</div>
@endif
