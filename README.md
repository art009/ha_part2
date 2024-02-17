## Тестовое задание для компании Hermes Auction
## Гостевая книга
Авторизация не нужна: при первом заходе на страницу должна 
выставляться cookie с уникальным значением в md5 первая страница должна 
выводить список тем, в которые можно "провалиться" и оставить сообщение
сообщение выводить в формате Пользователь #<user_id>, 
время сообщения <день-месяц-год часы:минуты>, само сообщение  

условие: реализация на бэкнеде обязательно на классах!
реализация на апи или с обновлением страницы - не принципиально, 
равно как стилизация - в этой задаче смотрим исключительно 
на функционал бэкенда

```sql
# темы гостевой книги
CREATE TABLE theme
(
    theme_id INT PRIMARY KEY AUTO_INCREMENT,
    theme_name VARCHAR(255)
);
INSERT INTO theme VALUES (NULL,'Тема 1'), (NULL,'Тема 2'), (NULL,'Тема 3');
# сообщения
CREATE TABLE messages
(
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    theme_id INT,
    message_text TEXT,
    message_time INT, # время в unix timestamp
    user_id INT
);
# пользователи
CREATE TABLE users
(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_hash VARCHAR(32) # md5()
);
```

## Добавим fk
```sql
ALTER TABLE `messages` ADD CONSTRAINT `fk-messages-theme_id` FOREIGN KEY (`theme_id`) 
    REFERENCES `theme`(`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `messages` ADD CONSTRAINT `fk-messages-user_id` FOREIGN KEY (`user_id`) 
    REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE; 
```