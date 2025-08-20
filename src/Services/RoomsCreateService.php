<?php



class RoomsCreateService
{
    function create(int $userId, string $name, string $description)
    {
        if (empty($userId) || empty($name) || empty($description)) {
            return false;
        }

        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare(
            'INSERT INTO room (owner_user_id, name, description) VALUES (:userId, :name, :description)'
        );
        $statement->execute([
            'userId' => $userId,
            'name' => $name,
            'description' => $description
        ]);

        return true;
    }
}