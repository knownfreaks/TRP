<?php
class Customer
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM customers ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM customers WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO customers(name,email,phone,address) VALUES(?,?,?,?)');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['address']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE customers SET name=?, email=?, phone=?, address=? WHERE id=?');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM customers WHERE id=?');
        $stmt->execute([$id]);
    }
}
