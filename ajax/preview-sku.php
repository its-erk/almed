<?php
require_once('../dist/config.php');

header('Content-Type: application/json');

$category_id = (int)($_POST['category_id'] ?? 0);

if ($category_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid category']);
    exit;
}

// Fetch category code
$stmt = $pdo->prepare("
    SELECT code 
    FROM categories 
    WHERE id = :id AND status = 'active'
    LIMIT 1
");
$stmt->execute(['id' => $category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo json_encode(['success' => false, 'message' => 'Category not found']);
    exit;
}

$prefix = strtoupper($category['code']);

// Get last SKU
$stmt = $pdo->prepare("
    SELECT sku 
    FROM products 
    WHERE sku LIKE :prefix
    ORDER BY id DESC
    LIMIT 1
");
$stmt->execute(['prefix' => $prefix . '-%']);
$lastSku = $stmt->fetchColumn();

$next = $lastSku
    ? ((int)substr($lastSku, strrpos($lastSku, '-') + 1) + 1)
    : 1;

$sku = sprintf('%s-%04d', $prefix, $next);

echo json_encode([
    'success' => true,
    'sku' => $sku
]);
