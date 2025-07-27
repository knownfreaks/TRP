<?php
class Order
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT o.*, c.name AS customer FROM orders o LEFT JOIN customers c ON o.customer_id = c.id ORDER BY o.id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM orders WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO orders (customer_id, order_date, status, total) VALUES (?,?,?,?)');
        $stmt->execute([
            $data['customer_id'],
            $data['order_date'],
            $data['status'],
            $data['total'],
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE orders SET customer_id=?, order_date=?, status=?, total=? WHERE id=?');
        $stmt->execute([
            $data['customer_id'],
            $data['order_date'],
            $data['status'],
            $data['total'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM orders WHERE id=?');
        $stmt->execute([$id]);
    }
}
