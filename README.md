Проект закончен в мае 2024 года

# LaraBooking - учебная работа по курсу SkillBox.Laravel

## LaraBooking - сервис интернет-бронирования

### Страница поиска и выбора номера
1. Просмотр каталога отелей
2. Фильтрация отелей по выбранным характеристикам
3. Просмотр всех номеров выбранного отеля
4. Проверка наличия свободного номера выбранного типа на выбранные даты и актуальной цены (без денормализации)
5. Бронирование номера
6. Оповещение о новой брони админа сервиса, менеджера отеля, пользователя (Jobs)

### Страница бронирований пользователя
1. Просмотр всех бронирований данного пользователя
2. Исключение из просомтра отменённых бронирований
3. Отмена брони
4. Оповещение об отмене брони админа сервиса, менеджера отеля, пользователя (через Jobs)
5. Номер после отмены брони доступен для поиска и нового бронирования 
6. Оповещение пользователя о предстоящем заезде за X дней (Schedule, Command, Jobs)
