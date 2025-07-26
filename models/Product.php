<?php
class Product
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM products ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products(title,sku,description,stock,price,category) VALUES(?,?,?,?,?,?)');
        $stmt->execute([
            $data['title'],
            $data['sku'],
            $data['description'],
            $data['stock'],
            $data['price'],
            $data['category'],
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE products SET title=?,sku=?,description=?,stock=?,price=?,category=? WHERE id=?');
        $stmt->execute([
            $data['title'],
            $data['sku'],
            $data['description'],
            $data['stock'],
            $data['price'],
            $data['category'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id=?');
        $stmt->execute([$id]);
    }
}

