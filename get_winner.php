<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('data.json'), true);
$items = $data['items'];

// Sistem Weighted Random (Probabilitas Berdasarkan Persentase)
$totalPercentage = array_sum(array_column($items, 'percentage'));
$rand = mt_rand(1, $totalPercentage > 0 ? $totalPercentage : 100);

$currentSum = 0;
$winningIndex = 0;

foreach ($items as $index => $item) {
    $currentSum += $item['percentage'];
    if ($rand <= $currentSum) {
        $winningIndex = $index;
        break;
    }
}

echo json_encode([
    'index' => $winningIndex,
    'name' => $items[$winningIndex]['name']
]);
?>
