<?php

$pdo = new PDO('sqlite:' . __DIR__ . '/home-organisation.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("DROP TABLE IF EXISTS user");
$pdo->exec("DROP TABLE IF EXISTS rooms");
$pdo->exec("DROP TABLE IF EXISTS reminder");


$pdo->exec(
    "CREATE TABLE user(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
   first_Name TEXT(30) NOT NULL,
   last_Name TEXT(30) NOT NULL,
   email TEXT(30) NOT NULL,
   password TEXT(30) NOT NULL
);
    CREATE TABLE room(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    owner_user_id INTEGER NOT NULL,
    name TEXT(30) NOT NULL,
    description TEXT,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),
    FOREIGN KEY (owner_user_id) REFERENCES user(id)
);
    CREATE TABLE reminder(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        room_id INTEGER NOT NULL,
        title TEXT(20) NOT NULL,
        notes TEXT,
        duo_at TEXT,
        repeat_rules TEXT,
        priority INTEGER NOT NULL,
        status TEXT NOT NULL DEFAULT 'open' CHECK (status IN ('open','done','snoozed','archived')),
        created_at TEXT NOT NULL DEFAULT (datetime('now')),
        FOREIGN KEY (room_id) REFERENCES room(id)
    )
"
);

