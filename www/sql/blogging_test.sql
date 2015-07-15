USE blogging;
/*1. ѕровер€ем были ли от пользовател€ сообщени€ раньше*/
/*
DELETE
FROM
  messages
WHERE
  user_id = 3;
*/
/*insert into messages(user_id,previous_message,message) VALUES(4,1,'I would like participate number 1');*/
/*
SELECT
  *
FROM
  messages;
SELECT
  m1.user_id, m1.previous_message, m1.message, m2.user_id, m2.previous_message, m2.message
FROM
  messages m1, messages m2
WHERE
  m1.message_id = MOD(2, m2.message_id);
*/
/*
SELECT
  *
FROM
  messages;
*/
/* ¬ывести всю ветку сообщений где рутом €вл€тес€ конкретный пользователь*/
/*
SELECT
  m1.*
FROM
  messages m1 JOIN messages m2 ON m1.message_id = m2.message_id + 1
UNION ALL
SELECT
  m1.*
FROM
  messages m1
WHERE
  m1.message_id = m1.previous_message; 
*/
/*ѕолучаем текущее значение message_id*/
/*
select max(t.message_id) from 
(
SELECT
  m1.*
FROM
  messages m1 JOIN messages m2 ON m1.message_id = m2.message_id + 1
UNION ALL
SELECT
  m1.*
FROM
  messages m1
WHERE
  m1.message_id = m1.previous_message
) t;
*/
SELECT
  *
FROM
  messages;
/*ƒобавл€ем запись в блог*/
insert into messages(user_id,previous_message,message) values (1,7,CONCAT('new message',NOW()));
