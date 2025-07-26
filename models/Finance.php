<?php
class Finance
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM finance ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM finance WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO finance (description, amount, type) VALUES (?,?,?)');
        $stmt->execute([
            $data['description'],
            $data['amount'],
            $data['type'],
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE finance SET description=?, amount=?, type=? WHERE id=?');
        $stmt->execute([
            $data['description'],
            $data['amount'],
            $data['type'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM finance WHERE id=?');
        $stmt->execute([$id]);
    }
}
